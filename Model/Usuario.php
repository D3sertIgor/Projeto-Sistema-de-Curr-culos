<?php 
class Usuario {
    private $id;
    private $nome;
    private $cpf;
    private $email;
    private $dataNascimento;
    private $senha;

    // ID
    public function setId($id) {
        $this->id = $id;
    }
    public function getId() {
        return $this->id;
    }

    // Nome
    public function setNome($nome) {
        $this->nome = $nome;
    }
    public function getNome() {
        return $this->nome;
    }

    // CPF
    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }
    public function getCpf() {
        return $this->cpf;
    }

    // Email
    public function setEmail($email) {
        $this->email = $email;
    }
    public function getEmail() {
        return $this->email;
    }

    // Data de nascimento
    public function setDataNascimento($dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }
    public function getDataNascimento() {
        return $this->dataNascimento;
    }

    // Senha
    public function setSenha($senha) {
        $this->senha = $senha;
    }
    public function getSenha() {
        return $this->senha;
    }

    // Inserir no banco de dados
    public function inserirBD() {
        require_once 'conexaobancodedados.php'; 
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "INSERT INTO usuario (nome, cpf, email, senha) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $this->nome, $this->cpf, $this->email, $this->senha);
        if ($stmt->execute()) {
            $this->id = $conn->insert_id;
            $stmt->close();
            $conn->close();
            return true;
        } else {
            $stmt->close();
            $conn->close();
            return false;
        }
    }

    // Carregar usuário
    public function carregarUsuario($cpf) {
        require_once 'conexaobancodedados.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM usuario WHERE cpf = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $cpf);
        $stmt->execute();
        $result = $stmt->get_result();
        $r = $result->fetch_object();
        if ($r != null) {
            $this->id = $r->idusuario;
            $this->nome = $r->nome;
            $this->email = $r->email;
            $this->cpf = $r->cpf;
            $this->dataNascimento = $r->dataNascimento;
            $this->senha = $r->senha;
            $stmt->close();
            $conn->close();
            return true;
        } else {
            $stmt->close();
            $conn->close();
            return false;
        }
    }

    // Atualizar no banco de dados
    public function atualizarBD() {
        require_once 'conexaobancodedados.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "UPDATE usuario SET nome = ?, cpf = ?, dataNascimento = ?, email = ? WHERE idusuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $this->nome, $this->cpf, $this->dataNascimento, $this->email, $this->id);
        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            return true;
        } else {
            $stmt->close();
            $conn->close();
            return false;
        }
    }
}
?>
