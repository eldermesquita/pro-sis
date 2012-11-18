<?php
	class simpleDB {

		
		private $server = "localhost";
		private $login  = "root";
		private $pass   = "root";
		private $bd     = "prosis";
		
		public function __construct(){
			$this->exec();
		}
		
		public function connect(){
			return mysql_connect($this->server, $this->login, $this->pass);
		}
		
		public function exec(){
			if ($this->connect())
				mysql_select_db($this->bd);
		}
		
		public function qry($sql){
			return mysql_query($sql);
		}
		
		public function fetch($query){
			return mysql_fetch_object($query);
		}
	}
?>