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

		public function checarFechamento(){
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


		public function cadastrar() {
			$bd = $this->bd;

			$sql = "INSERT INTO folhadeponto
		   		(ano, mes, faltas, dsr, he60, he100, feriado, cod_funcionario) 
			VALUES
				($this->ano, $this->mes, $this->faltas, $this->dsr, $this->he60, $this->he100, $this->feriado, $this->cod_funcionario)";

			$sqlFechamento = "UPDATE fechamentoFolhaDePonto 
							SET 

							fechado = 1 WHERE mes = $this->mes AND ano = $this->ano";

			// echo $sql;

			$bd->qry($sql);
			$bd->qry($sqlFechamento);
		}

		public function editar(){
			$bd = $this->bd;

			$sql = 
			"UPDATE folhadeponto 
				SET 
					faltas = $this->faltas,
					dsr = $this->dsr,
					he60 = $this->he60,
					he100 = $this->he100,
					feriado = $this->feriado
				WHERE 
					mes = $this->mes AND 
					ano = $this->ano AND
					cod_funcionario = $this->cod_funcionario";

			$bd->qry($sql);

		}

		public function getCodFuncionario(){
			return $this->cod_funcionario;
		}
		
		public function getAno(){
			return $this->ano;
		}
		
		public function getMes(){
			return $this->mes;
		}
		
		public function getFaltas(){
			return $this->faltas;
		}
		
		public function getDsr(){
			return $this->dsr;
		}
		
		public function getHe60(){
			return $this->he60;
		}
		
		public function getHe100(){
			return $this->he100;
		}
		
		public function getFeriado(){
			return $this->feriado;
		}

		public function setCodFuncionario($val){
			$this->cod_funcionario = $val;
			return $this;
		}
		
		public function setAno($val){
			$this->ano = $val;
			return $this;
		}
		
		public function setMes($val){
			$this->mes = $val;
			return $this;
		}
		
		public function setFaltas($val){
			$this->faltas = $val;
			return $this;
		}
		
		public function setDsr($val){
			$this->dsr = $val;
			return $this;
		}
		
		public function setHe60($val){
			$this->he60 = $val;
			return $this;
		}
		
		public function setHe100($val){
			$this->he100 = $val;
			return $this;
		}
		
		public function setFeriado($val){
			$this->feriado = $val;
			return $this;
		}
		
		
		
}


	
