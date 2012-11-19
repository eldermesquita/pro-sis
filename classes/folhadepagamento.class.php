<?php
	class FolhaDePagamento extends simpleDb {

		public $bd;

		public function __construct(){
			$this->connect();
		}

		public function connect(){
			$this->bd = new SimpleDb();
		}

		public function checarFechamento(){
			$bd = $this->bd;
			$mes = date('n');
			$ano = date('Y');
			$sql = "SELECT * FROM fechamentofolhadepagamento WHERE mes = $mes AND ano = $ano";

			$q = $bd->qry($sql);
			$existe = $bd->num($q);

			if ($existe == 0)
			{
				$sql = "INSERT INTO  
						fechamentofolhadepagamento (mes, ano, tipo) 

						VALUES ($mes, $ano, 0)
				";


				$bd->qry($sql);

				$sql2 = "INSERT INTO  
						fechamentofolhadepagamento (mes, ano, tipo) 

						VALUES ($mes, $ano, 1)
				";

				$bd->qry($sql2);
			}
		}
}


	
