<?php
	class Administrador extends simpleDb {

		public $bd;
		public $login;
		public $senha;

		public function __construct(){
			$this->connect();
		}

		public function connect(){
			$this->bd = new SimpleDb();
		}

		public function logIn($usuario, $senha){
			$this->setLogin($usuario);
			$this->setSenha($senha);
			$query = $this->bd->qry("SELECT * FROM administrador WHERE login = '$this->login' AND senha = '$this->senha'");
			
			if ($this->bd->num($query) > 0) {
				$sql = "UPDATE administrador SET ultimo_login = NOW() WHERE login = '$this->login'";
				$query = $this->bd->qry($sql);
				return true;
			} else {
				return false;
			}
				
		}
		
		public function getId($user){
			$sql = "SELECT id_admin FROM administrador WHERE login = '$user'";
			$query = $this->bd->qry($sql);
			
			$adm = $this->bd->fetch($query);
			
			return $adm->id_admin;
			
		}
		
		public function getNome($user){
			$sql = "SELECT nome FROM administrador WHERE login = '$user'";
			$query = $this->bd->qry($sql);
			
			$adm = $this->bd->fetch($query);
			
			return $adm->nome;
			
		}
		
		public function getEmail($user){
			$sql = "SELECT email FROM administrador WHERE login = '$user'";
			$query = $this->bd->qry($sql);
			
			$adm = $this->bd->fetch($query);
			
			return $adm->email;
			
		}
		
		public function getLastLogin($user){
			$sql = "SELECT ultimo_login FROM administrador WHERE login = '$user'";
			$query = $this->bd->qry($sql);
			
			$adm = $this->bd->fetch($query);
			
			return $adm->ultimo_login;
		}
		
		
		public function setLogin($l){
			$this->login = $l;
		}
		
		public function getLogin(){
			return $this->login;
		}
		
		public function setSenha($s){
			$this->senha = $s;
		}
		
		public function getSenha(){
			return $this->senha;
		}
		
}


	
