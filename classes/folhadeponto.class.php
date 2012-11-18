<?php
	class FolhaDePonto extends simpleDb {

		public $cod_funcionario;
		public $bd;
		public $ano;
		public $mes;
		public $faltas;
		public $dsr;
		public $he60;
		public $he100;
		public $feriado;

		public function __construct(){
			$this->connect();
		}

		public function connect(){
			$this->bd = new SimpleDb();
		}

		public function checarFechamentos(){
			$bd = $this->bd;
			$mes = date('n');
			$ano = date('Y');
			$sql = "SELECT * FROM fechamentoFolhaDePonto WHERE mes = $mes AND ano = $ano";
			$q = $bd->qry($sql);
			$existe = $bd->num($q);

			if ($existe == 0)
			{
				$sql = "INSERT INTO  
						fechamentoFolhaDePonto (mes, ano, fechado) 

						VALUES ($mes, $ano, 0)
				";

				$bd->qry($sql);
			}
		}

		function getCodFuncionario(){
			return $cod_funcionario;
		}
		
		function getAno(){
			return $ano;
		}
		
		function getMes(){
			return $mes;
		}
		
		function getFaltas(){
			return $faltas;
		}
		
		function getDsr(){
			return $dsr;
		}
		
		function getHe60(){
			return $he60;
		}
		
		function getHe100(){
			return $he100;
		}
		
		function getFeriado(){
			return $feriado;
		}

		function setCodFuncionario($val){
			$this->cod_funcionario = $val;
			return $this;
		}
		
		function setAno($val){
			$this->ano = $val;
			return $this;
		}
		
		function setMes($val){
			$this->mes = $val;
			return $this;
		}
		
		function setFaltas(){
			$this->faltas = $val;
			return $this;
		}
		
		function setDsr(){
			$this->dsr = $val;
			return $this;
		}
		
		function setHe60($val){
			$this->he60 = $val;
			return $this;
		}
		
		function setHe100($val){
			$this->he100 = $val;
			return $this;
		}
		
		function setFeriado($val){
			$this->feriado = $val;
			return $this;
		}
		
		
		
}


	
