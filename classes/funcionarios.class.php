<?php
	
	require "db.class.php";
	
	class Funcionarios extends simpleDb {

		public $bd;
		private $id;
		private $nome; 
		private $nasc;
		private $etnia; 
		private $estCivil; 
		private $cep; 
		private $rua; 
		private $bairro; 
		private $cidade; 
		private $estado; 
		private $numero; 
		private $telefone; 
		private $cpf; 
		private $rg;
		private $cnh; 
		private $pis; 
		private $tituloeleitoral; 
		private $escolaridade; 
		private $nacionalidade; 
		private $cargo; 
		private $salario; 
		private $cargahoraria; 
		private $adiantamento; 
		private $admissao; 
		private $banco; 
		private $agencia; 
		private $conta; 
		
		public function __construct(){
			$this->connect();
		}
		
		public function connect(){
			$this->bd = new SimpleDb();
		}
		
		public function countFuncionarios(){
			return $this->bd->num($this->bd->qry("SELECT * from funcionario"));
		}
		
		public function totalSalario(){
			$sql = "SELECT SUM(salario) AS totalSalario FROM contrato";
			$query = $this->bd->qry($sql);
			
			$total = $this->bd->fetch($query);
			
			return $total->totalSalario;
		}
		
		public function emFerias(){
			$sql = "SELECT COUNT(*) as totalFerias FROM funcionario WHERE inicio_ferias >= NOW() AND fim_ferias <= NOW()";
			$query = $this->bd->qry($sql);
			
			$total = $this->bd->fetch($query);
			
			return $total->totalFerias;
		}

		public function removerFuncionario() {
			$deletar = "DELETE FROM funcionario WHERE cod_funcionario = " . $this->id;
			$this->bd->qry($deletar);

			$deletar = "DELETE FROM contrato WHERE cod_funcionario = " . $this->id;
			$this->bd->qry($deletar);

			$deletar = "DELETE FROM documentos WHERE cod_funcionario = " . $this->id;
			$this->bd->qry($deletar);

			$deletar = "DELETE FROM endereco WHERE cod_funcionario = " . $this->id;
			$this->bd->qry($deletar);

			$deletar = "DELETE FROM telefone WHERE cod_funcionario = " . $this->id;
			$this->bd->qry($deletar);

			return true;
		}

		public function salvar(){
			if( $this->getId() == null ) 
			{
				$this->cadastrar();
			} 
			else 
			{
				$this->editar();
			}
		}

		public function cadastrar() {
			/* 
				=> table: funcionários
			*/

			$sql = "INSERT INTO funcionario
				 (cod_funcionario, nome, data_nascimento, etnia, estado_civil, banco_pagamento, agencia_pagamento, conta_pagamento) 
				 
				 VALUES 
				 (null, '$this->nome', '$this->nasc', '$this->etnia', '$this->estCivil', '$this->banco', '$this->agencia', '$this->conta');
			";

			$this->bd->qry($sql);

			/* last id inserted */
			$this->setId( mysql_insert_id() );


			/* 
				=> table: contrato 
			*/
			$sql = "INSERT INTO contrato 
				(cod_contrato, cod_funcionario, carga_horaria, adiantamento, data_admissao, data_afastamento, salario, cargo) 
				
				VALUES 
				(null, $this->id, $this->cargahoraria, $this->adiantamento, $this->admissao, 00-00-0000, $this->salario, '$this->cargo');
			";



			$this->bd->qry($sql);



			/* 
				=> table: documentos 
			*/

			$sql = "INSERT INTO documentos 
				(cod_funcionario, cpf, cnh, escolaridade, rg, titulo_eleitoral, pis, nacionalidade) 

				VALUES 
				($this->id, '$this->cpf', '$this->cnh', '$this->escolaridade', '$this->rg', '$this->tituloeleitoral', '$this->pis', '$this->nacionalidade');
			";
			
			$this->bd->qry($sql);



			/* 
				=> table: endereco 
			*/
			$sql = "INSERT INTO endereco (cod_funcionario, id_endereco, rua, numero, cep, bairro, cidade, estado) 

				VALUES 
				($this->id, null, '$this->rua', $this->numero, '$this->cep', '$this->bairro', '$this->cidade', '$this->estado');
			";

			$this->bd->qry($sql);




			/* 
				=> table: endereco 
			*/
			$sql = "INSERT INTO telefone (cod_funcionario, telefone) 

				VALUES 
				($this->id, '$this->telefone');
			";

			$this->bd->qry($sql);
		}
		
		public function editar(){

			/* funcionario */
			$sql = 
			"UPDATE funcionario SET 
				nome = '$this->nome', 
				data_nascimento = '$this->nasc', 
				etnia = '$this->etnia', 
				estado_civil = '$this->estCivil', 
				banco_pagamento = '$this->banco', 
				agencia_pagamento = '$this->agencia', 
				conta_pagamento = '$this->conta' 

			WHERE 
				cod_funcionario = $this->id";

			$this->bd->qry($sql);



			/* contrato */
			$sql = 
			"UPDATE contrato SET 
				carga_horaria = $this->cargahoraria, 
				adiantamento = $this->adiantamento, 
				data_admissao = '$this->admissao', 
				data_afastamento = 00-00-0000, 
				salario = $this->salario, 
				cargo = '$this->cargo' 

			WHERE 
				cod_funcionario = $this->id";

			$this->bd->qry($sql);



			/* documentos */
			$sql = 
			"UPDATE documentos SET 
				cpf = '$this->cpf', 
				cnh = '$this->cnh', 
				escolaridade = '$this->escolaridade', 
				rg = '$this->rg', 
				pis = '$this->pis', 
				nacionalidade = '$this->nacilidade' 

			WHERE 
				cod_funcionario = $this->id";

			$this->bd->qry($sql);


			/* endereco */
			$sql = 
			"UPDATE endereco SET 
				rua = '$this->cpf', 
				numero = $this->cnh, 
				cep = '$this->cep', 
				bairro = '$this->bairro', 
				cidade = '$this->cidade', 
				estado = '$this->estado' 

			WHERE 
				cod_funcionario = $this->id";

			$this->bd->qry($sql);



			/* telefone */
			$sql = 
			"UPDATE endereco SET 
				telefone = '$this->telefone'

			WHERE 
				cod_funcionario = $this->id";

			$this->bd->qry($sql);



		}

		public function setId($val){
			$this->id = $val;
			return $this;
		}

		public function getId(){
			return $this->id;
		}

		public function setNome($val){
			$this->nome = $val;
			return $this;
		}

		public function getNome(){
			return $this->nome;
		}

		public function setDataNascimento($val){
			$this->nasc = $val;
			return $this;
		}

		public function getDataNascimento(){
			return $this->nasc;
		}

		public function setEtnia($val){
			$this->etnia = $val;
			return $this;
		}

		public function getEtnia(){
			return $this->etnia;
		}

		public function setEstadoCivil($val){
			$this->estCivil = $val;
			return $this;
		}

		public function getEstadoCivil(){
			return $this->estCivil;
		}

		public function setCep($val){
			$this->cep = $val;
			return $this;
		}

		public function getCep(){
			return $this->cep;
		}

		public function setRua($val){
			$this->rua = $val;
			return $this;
		}

		public function getRua(){
			return $this->rua;
		}

		public function setBairro($val){
			$this->bairro = $val;
			return $this;
		}

		public function getBairro(){
			return $this->bairro;
		}

		public function setCidade($val){
			$this->cidade = $val;
			return $this;
		}

		public function getCidade(){
			return $this->cidade;
		}

		public function setEstado($val){
			$this->estado = $val;
			return $this;
		}

		public function getEstado(){
			return $this->estado;
		}

		public function setNumero($val){
			$this->numero = $val;
			return $this;
		}

		public function getNumero(){
			return $this->numero;
		}

		public function setTelefone($val){
			$this->telefone = $val;
			return $this;
		}

		public function getTelefone(){
			return $this->telefone;
		}

		public function setCpf($val){
			$this->cpf = $val;
			return $this;
		}

		public function getCpf(){
			return $this->cpf;
		}

		public function setRg($val){
			$this->rg = $val;
			return $this;
		}

		public function getRg(){
			return $this->rg;
		}

		public function setCnh($val){
			$this->cnh = $val;
			return $this;
		}

		public function getCnh(){
			return $this->cnh;
		}

		public function setPis($val){
			$this->pis = $val;
			return $this;
		}

		public function getPis(){
			return $this->pis;
		}

		public function setTituloEleitoral($val){
			$this->tituloeleitoral = $val;
			return $this;
		}

		public function getTituloEleitoral(){
			return $this->tituloeleitoral;
		}

		public function setEscolaridade($val){
			$this->escolaridade = $val;
			return $this;
		}

		public function getEscolaridade(){
			return $this->escolaridade;
		}

		public function setNacionalidade($val){
			$this->nacionalidade = $val;
			return $this;
		}

		public function getNacionalidade(){
			return $this->nacionalidade;
		}

		public function setCargo($val){
			$this->cargo = $val;
			return $this;
		}

		public function getCargo(){
			return $this->cargo;
		}

		public function setSalario($val){
			$this->salario = $val;
			return $this;
		}

		public function getSalario(){
			return $this->salario;
		}

		public function setCargaHoraria($val){
			$this->cargahoraria = $val;
			return $this;
		}

		public function getCargaHoraria(){
			return $this->cargahoraria;
		}

		public function setAdiantamento($val){
			$this->adiantamento = $val;
			return $this;
		}

		public function getAdiantamento(){
			return $this->adiantamento;
		}

		public function setAdmissao($val){
			$this->admissao = $val;
			return $this;
		}

		public function getAdmissao(){
			return $this->admissao;
		}

		public function setBanco($val){
			$this->banco = $val;
			return $this;
		}

		public function getBanco(){
			return $this->banco;
		}

		public function setAgencia($val){
			$this->agencia = $val;
			return $this;
		}

		public function getAgencia(){
			return $this->agencia;
		}

		public function setConta($val){
			$this->conta = $val;
			return $this;
		}

		public function getConta(){
			return $this->conta;
		}

	}
