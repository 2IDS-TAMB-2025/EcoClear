#include <WiFi.h>
#include <HTTPClient.h>
#include "DHT.h"

// ==== CONFIGURAÇÃO WI-FI ====
const char* ssid     = "CE370_SENAI";
const char* password = "ac3ce7ss0";

// ==== ENDEREÇO DA API ====
const char* serverUrl = "http://10.141.128.106/api_ecoclear2/dadoSensor";

// ==== SENSOR DHT11 ====
#define DHTPIN 4
#define DHTTYPE DHT11
DHT dht(DHTPIN, DHTTYPE);

// ==== SENSOR MQ135 ====
#define MQ135_A0 34
const int LIMIAR_BAIXO = 1500;
const int LIMIAR_MEDIO = 2000;
const int LIMIAR_ALTO  = 2500;

void setup() {
  Serial.begin(115200);
  delay(1000);

  // Inicia DHT11
  dht.begin();

  // Conexão Wi-Fi
  WiFi.begin(ssid, password);
  Serial.print("Conectando ao Wi-Fi");
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.print(".");
  }
  Serial.println("\nWi-Fi conectado com sucesso!");
}

void loop() {
  if (WiFi.status() == WL_CONNECTED) {
    // === Leitura DHT11 ===
    float umidade = dht.readHumidity();
    float temperatura = dht.readTemperature();

    if (!isnan(umidade) && !isnan(temperatura)) {
      Serial.println("---- DHT11 ----");
      Serial.print("Temperatura: "); Serial.println(temperatura);
      Serial.print("Umidade: "); Serial.println(umidade);

      HTTPClient http;
      http.begin(serverUrl);
      http.addHeader("Content-Type", "application/json");

      String jsonTemperatura = "{";
      jsonTemperatura += "\"dado\":" + String(temperatura) + ",";
      jsonTemperatura += "\"fk_id_sensor\":\"55\"}";
      
      int httpResponse = http.POST(jsonTemperatura);
      if (httpResponse > 0) {
        Serial.println("Temperatura enviada com sucesso!");
        Serial.println(http.getString());
      } else {
        Serial.print("Erro ao enviar temperatura: ");
        Serial.println(httpResponse);
      }
      http.end();

      delay(1000); // pequeno intervalo antes do próximo envio

      // Enviar umidade também (se necessário, pode ter outro sensor_id)
      http.begin(serverUrl);
      http.addHeader("Content-Type", "application/json");

      String jsonUmidade = "{";
      jsonUmidade += "\"dado\":" + String(umidade) + ",";
      jsonUmidade += "\"fk_id_sensor\":\"56\"}";
      
      httpResponse = http.POST(jsonUmidade);
      if (httpResponse > 0) {
        Serial.println("Umidade enviada com sucesso!");
        Serial.println(http.getString());
      } else {
        Serial.print("Erro ao enviar umidade: ");
        Serial.println(httpResponse);
      }
      http.end();
    } else {
      Serial.println("Erro ao ler o DHT11");
    }

    // === Leitura MQ135 ===
    int valorAnalogico = analogRead(MQ135_A0);
    String nivel = "Muito Alto";
    if (valorAnalogico < LIMIAR_BAIXO) nivel = "Baixo";
    else if (valorAnalogico < LIMIAR_MEDIO) nivel = "Médio";
    else if (valorAnalogico < LIMIAR_ALTO) nivel = "Alto";

    Serial.println("---- MQ135 ----");
    Serial.print("Bruto="); Serial.print(valorAnalogico);
    Serial.print(" | Nível="); Serial.println(nivel);

    HTTPClient http;
    http.begin(serverUrl);
    http.addHeader("Content-Type", "application/json");

    String jsonMQ135 = "{";
    jsonMQ135 += "\"dado\":" + String(valorAnalogico) + ",";
    jsonMQ135 += "\"fk_id_sensor\":\"57\"}";

    Serial.println(jsonMQ135);
    
    int httpResponseCode = http.POST(jsonMQ135);
    if (httpResponseCode > 0) {
      Serial.println("MQ135 enviado com sucesso!");
      Serial.println(http.getString());
    } else {
      Serial.print("Erro ao enviar MQ135: ");
      Serial.println(httpResponseCode);
    }
    http.end();

  } else {
    Serial.println("Wi-Fi desconectado. Tentando reconectar...");
    WiFi.begin(ssid, password);
  }

  delay(30000); // Aguarda 30s antes da próxima leitura
}
