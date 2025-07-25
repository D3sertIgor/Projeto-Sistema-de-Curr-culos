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

    public function inserirBD() {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "INSERT INTO usuario (nome, cpf, email, senha) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $this->nome, $this->cpf, $this->email, $this->senha);
        $result = $stmt->execute();
        if ($result) {
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

    public function carregarUsuario($cpf) {
        require_once 'ConexaoBD.php';
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

    public function atualizarBD() {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "UPDATE usuario SET nome = ?, cpf = ?, dataNascimento = ?, email = ? WHERE idusuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $this->nome, $this->cpf, $this->dataNascimento, $this->email, $this->id);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }
}

class FormacaoAcad {
    private $id;
    private $idusuario;
    private $inicio;
    private $fim;
    private $descricao;

    // ID
    public function setId($id) {
        $this->id = $id;
    }
    public function getId() {
        return $this->id;
    }

    // idusuario
    public function setIdUsuario($idusuario) {
        $this->idusuario = $idusuario;
    }
    public function getIdUsuario() {
        return $this->idusuario;
    }

    // início
    public function setInicio($inicio) {
        $this->inicio = $inicio;
    }
    public function getInicio() {
        return $this->inicio;
    }

    // fim
    public function setFim($fim) {
        $this->fim = $fim;
    }
    public function getFim() {
        return $this->fim;
    }

    // Descrição
    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    public function getDescricao() {
        return $this->descricao;
    }

    public function inserirBD() {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "INSERT INTO formacaoacademica (idusuario, inicio, fim, descricao) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $this->idusuario, $this->inicio, $this->fim, $this->descricao);
        $result = $stmt->execute();
        if ($result) {
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

    public function excluirBD($id) {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "DELETE FROM formacaoacademica WHERE idformacaoacademica = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    public function listaFormacoes($idusuario) {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM formacaoacademica WHERE idusuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idusuario);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $result;
    }
}

class ExperienciaProfissional {
    private $id;
    private $idusuario;
    private $inicio;
    private $fim;
    private $empresa;
    private $descricao;

    // ID
    public function setId($id) {
        $this->id = $id;
    }
    public function getId() {
        return $this->id;
    }

    // idusuario
    public function setIdUsuario($idusuario) {
        $this->idusuario = $idusuario;
    }
    public function getIdUsuario() {
        return $this->idusuario;
    }

    // início
    public function setInicio($inicio) {
        $this->inicio = $inicio;
    }
    public function getInicio() {
        return $this->inicio;
    }

    // fim
    public function setFim($fim) {
        $this->fim = $fim;
    }
    public function getFim() {
        return $this->fim;
    }

    // Empresa
    public function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }
    public function getEmpresa() {
        return $this->empresa;
    }

    // Descrição
    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    public function getDescricao() {
        return $this->descricao;
    }

    public function inserirBD() {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "INSERT INTO experienciaprofissional (idusuario, inicio, fim, empresa, descricao) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issss", $this->idusuario, $this->inicio, $this->fim, $this->empresa, $this->descricao);
        $result = $stmt->execute();
        if ($result) {
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

    public function excluirBD($id) {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "DELETE FROM experienciaprofissional WHERE idexperienciaprofissional = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    public function listaExperiencias($idusuario) {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM experienciaprofissional WHERE idusuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idusuario);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $result;
    }
}
?>
