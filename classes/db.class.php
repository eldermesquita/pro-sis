<?php

	/* simples classe para conexao de banco de dados
		pro-sis &copy.
	 */
	
	class SimpleDb {

		
		private $server = "localhost";
		private $login  = "root";
		private $pass   = "root";
		private $bd     = "pro-sis";
		public $link;
		
		public function __construct(){
			$this->exec();
		}
		
		public function __destruct(){
			//mysql_close($this->link);
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
		
		public function num($query){
			return mysql_num_rows($query);
		}
		
		
		
	}
