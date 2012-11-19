<?php
	class FolhaDePagamento extends simpleDb {

		public $bd;

		public function __construct(){
			$this->connect();
		}

		public function connect(){
			$this->bd = new SimpleDb();
		}

		
}


	
