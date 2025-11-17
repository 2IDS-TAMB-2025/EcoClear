<?php
require_once "../controller/conecta_banco.php";

class ModelSenha {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // Verifica se o e-mail existe (pode retornar múltiplas empresas)
    public function verificarEmail($email) {
        $stmt = $this->db->prepare("SELECT CNPJ, RAZAO_SOCIAL, EMAIL FROM empresa WHERE EMAIL = ?");
        if (!$stmt) throw new Exception("Erro no prepare: " . $this->db->error);

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC); // retorna array de empresas
    }

    // Salva token de recuperação para uma empresa específica
    public function salvarToken($cnpj, $email, $token, $expira) {
        $stmt = $this->db->prepare("
            UPDATE empresa 
            SET TOKEN_RECUPERACAO = ?, EXPIRA_TOKEN = ? 
            WHERE CNPJ = ? AND EMAIL = ?
        ");
        if (!$stmt) throw new Exception("Erro no prepare: " . $this->db->error);

        $stmt->bind_param("ssss", $token, $expira, $cnpj, $email);
        return $stmt->execute();
    }

    // Busca empresa pelo token
    public function buscarCnpjPorToken($token) {
        $stmt = $this->db->prepare("
            SELECT CNPJ, RAZAO_SOCIAL 
            FROM empresa 
            WHERE TOKEN_RECUPERACAO = ? AND EXPIRA_TOKEN > NOW()
        ");
        if (!$stmt) throw new Exception("Erro no prepare: " . $this->db->error);

        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Redefine senha pelo token
    public function redefinirSenha($token, $novaSenha) {
        $stmt = $this->db->prepare("
            UPDATE empresa 
            SET SENHA = ?, TOKEN_RECUPERACAO = NULL, EXPIRA_TOKEN = NULL 
            WHERE TOKEN_RECUPERACAO = ?
        ");
        if (!$stmt) throw new Exception("Erro no prepare: " . $this->db->error);

        $stmt->bind_param("ss", $novaSenha, $token);
        return $stmt->execute();
    }
}
?>