<?php
    require_once 'lib\database\conexao.php';    
    use lib\database\Conexao;

    class Usuario {
        private $id;
        private $usuario;
        private $senha;
        private $email;
        private $nome;

        public function __construct(){
            $this->email = $email;
            $this->senha = $senha;             
            $this->nome = $nome;
            $this->usuario = $usuario;             
        }

        public function getId() {
            return $this->id;
        }    
        public function getUsuario() {
            return $this->usuario;
        }    
        public function setUsuario($usuario) {
            $this->usuario = $usuario;
        }    
        public function getSenha() {
            return $this->senha;
        }    
        public function setSenha($senha) {
            $this->senha = $senha;
        }    
        public function getEmail() {
            return $this->email;
        }    
        public function setEmail($email) {
            $this->email = $email;
        }
        public function getNome() {
            return $this->nome;
        }    
        public function setNome($nome) {
            $this->nome = $nome;
        }   
    }
?>