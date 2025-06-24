<?php
include_once '../controller/conecta_banco.php';
class Administrador_empresa{
     public function getAdministrador_EmpresaId($ID){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM  ADMINISTRADOR_EMPRESA WHERE ID LIKE ?");
        $stmt->bind_param("i", $ID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getAdministrador_Empresa_FkAdmId($FK_ADMINISTRADOR_ID){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM ADMINISTRADOR_EMPRESA WHERE  FK_ADMINISTRADOR_ID LIKE ?");
        $stmt->bind_param("i", $FK_ADMINISTRADOR_ID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getAdministrador_Empresa_FkEmpresaCnpj($FK_EMPRESA_CNPJ){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM  ADMINISTRADOR_EMPRESA WHERE FK_EMPRESA_CNPJ LIKE ?");
        $stmt->bind_param("s", $FK_EMPRESA_CNPJ);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>