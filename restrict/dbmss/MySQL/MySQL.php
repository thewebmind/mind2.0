<?php
/**
 * Classe respons�vel pela l�gica para o MySQL
 * 
 * @link        www.thewebmind.org
 * @version       1.0
 * @author      Jaydson Gomes <jaydson@thewebmind.org>
 * @author      Felipe Nascimento <felipenmoura@thewebmind.org>
 */
	class MySQL implements dbmsInterface
	{
		public $attType= Array();
		public $adoName= 'mysql';
		
		/**
		* Construtor		
		*/
		public function __construct()
		{
			$this->attType= Array();
			$this->defaultPort= '5432';
			$this->attType['key']		= "int8 default nextval(<mind_simpleQuoting><schemaname>.<tablename>_seq</mind_simpleQuoting>)";
			$this->attType['varchar']	= "varchar(<length>)";
			$this->attType['char']		= "char(<length>)";
			$this->attType['text']		= "text";
			$this->attType['date']		= "timestamp";
			$this->attType['blob']		= "bytea";
			$this->attType['integer']	= "integer";
			$this->attType['bigint']	= "int8";
			$this->attType['smallint']	= "int2";
			$this->attType['int']		= "int4";
			$this->attType['time']		= "timestamp";
			$this->attType['dateTime']	= "timestamp";
			$this->attType['real']		= "float";
			$this->attType['boolean']	= "boolean";
			$this->attType['serial']	= "serial";
		}
				
		/**
		* Retorna o acronimo PDO
		* @return  String 
		*/
		public function getAcronymPDO(){
			return "mysql";
		}
		/**
		* Gets how to select the schema
		* @name selectSchema
		* @return  String 
		*/
		public function selectSchema($schemaName){
			return "";
		}
		
		/**
		* Selects the schema
		* @name selectCurrentSchema
		* @return  resource
		*/
		public function selectCurrentSchema($dbConn, $schemaName){
			return true;
		}
		/**
		* Remover todas as constraints realcionadas � tabela recebida, e entao rmover a tabela
		* @return  String 
		*/
		public function removeTable($dbConn, $tableName){
			$r= @mysql_query("select k.constraint_name,
									 c.table_name
							    from information_schema.key_column_usage k,
								     information_schema.table_constraints c
							   where c.table_schema = schema()
							     and c.constraint_type='FOREIGN KEY'
							     and k.constraint_schema= schema()
							     and k.constraint_name= c.constraint_name
							     and referenced_table_name = '".$tableName."'", $dbConn);
			while($cur= mysql_fetch_assoc($r))
			{
				$alter= mysql_query("ALTER TABLE `".$cur['table_name']."` DROP FOREIGN KEY `".$cur['constraint_name']."`", $dbConn);
				if(!$alter)
					return false;
			}
			$r= mysql_query("DROP TABLE ".$tableName, $dbConn);
			return $r? true : false;
		}
		
		/**
		* Recupera o ultimo erro
		*
		* @param   Object $dbConn Conex�o
		* @return  String Erro
		*/
		function getLastError($dbConn){
			return '<br/><b>Error Message:</b> '.mysql_error($dbConn);
		}
		
		/**
		* Conecta a base de dados
		*
		* @param   Object $ob Objeto com os dados para conex�o
		* @return  Object Resource
		*/
		function connectTo($ob){
			if(is_array($ob))
				$connect= @mysql_connect($ob['dbAddress'].':'.$ob['dbPort'], $ob['rootUser'], $ob['rootUserPwd']);
			else
				$connect = @mysql_connect( $ob->host.':'.$ob->port, $ob->user, $ob->pwd);
			if(is_array($ob))
				@mysql_select_db($ob['dbName']);
			else
				@mysql_select_db($ob->name);
			if($connect)
				return $connect;
			else
				return false;
		}
		
		/**
		* Desconecta
		*
		* @param   Object $dbCon Conex�o
		* @return  Object Resource
		*/
		function disconnectFrom($dbCon){
			$connect = mysql_close($dbCon);
			return $connect;
		}
		
		/**
		* Verifica se uma tabela existe
		*
		* @param   Object $dbCon Conex�o
		* @param   String $table Nome da tabela
		* @return  Boolean
		*/
		function tableExists($dbConn, $table){
			$r= @mysql_query("select * from ".$table." limit 1", $dbConn);
			return $r? true: false;
		}
		
		/**
		* Retorna os campos da tabela
		*
		* @param   Object $dbCon Conex�o
		* @param   String $table Nome da tabela
		* @return  ObjectCollection of fields
		*/
		function getFields($dbConn, $table){
			$r= @mysql_query("select * from ".$table." limit 1", $dbConn);
			$r= mysql_fetch_assoc($r);
			$ar= Array();
			while($cur= current($r))
			{
				$ar[]= key($cur);
				next($r);
			}
			return $ar;
		}
		
		/**
		* Escreve o cabe�alho do arquivo SQL
		* @return  String Header		
		*/
		public function getHeader(){
			return "<mindComment>/*####################################################</mindComment>
<mindComment>#   Generated by Mind ".(date('H:i m/d/Y'))."               #</mindComment>
<mindComment>#   Generate MySQL DataBase Commands                 #</mindComment>
<mindComment>######################################################*/</mindComment>

";
		}
		
		/**
		* Escreve a fun��o para conex�o com o MySQL
		* @return  String Fun��o connectToMySQL()
		*/
		public function establishConnection()
		{
			return "function connectToMySQL(){
						\$db= '<dbname>';
						\$user= '<user>';
						\$pwd= '<pwd>';
						\$connection = \"host=<host>  port=<port> dbname='\$db'  user='\$user' password='\$pwd'\";
						\$connect = mysql_connect(\$connection);
						return \$connect;
					}";
		}
		
		/**
		* Executa uma Query
		*
		* @param   Object $dbCon Conex�o
		* @param   String $qr Query
		* @return  Object Resource
		*/		
		public function query($dbCon, $qr){
			return mysql_query($qr, $dbCon);
		}
		
		/**
		* Fecha uma conex�o
		* @return  String Close
		*/			
		public function closeConnection(){
			return  "mysql_close(<query>)";
		}
		
		/**
		* Equivalente mysql_fetch_array
		* @return  String mysql_fetch_array
		*/	
		public function fetchArray(){
			return "mysql_fetch_array(<source>)";
		}
		
		/**
		* Retorna o ultimo erro
		* @return  String mysql_error
		*/	
		function lastError(){
			return 'mysql_error(<source>)';
		}
		
		/**
		* Query para deletar um campo
		* @return  String mysql_query
		*/
		public function dropField(){
			return "mysql_query(<source>, 'alter table <table> drop column <column>'));";
		}
		
		/**
		* Remove um campo da tabela
		* @return  String mysql_query
		*/
		public function dropColumn($dbCon, $table, $col){
			$r= mysql_query('alter table '.$table.' drop column '.$col, $dbCon);
			return $r? true: false;
		}
		
		/**
		* Remove um campo da tabela
		* @return  String mysql_query
		*/
		public function addColumn($dbCon, $table, $col){
			$r= mysql_query('alter table '.$table.' add column '.$col, $dbCon);
			return $r? true: false;
		}
		
		/**
		* Adiciona um campo
		* @return  String mysql_query
		*/
		public function addField(){
			return "mysql_query(<source>, 'alter table <table> add column <column>'));";
		}
		
		/**
		* Exclui uma tabela
		* @return  String drop
		*/
		public function dropTable(){
			return "mysql_query(<source>, 'drop table <table>'));";
		}
		
		/**
		* Define um valor padr�o
		* @return  String default
		*/
		public function setDefaultValue(){
			return "default <defaultvalue>";
		}
		
		/**
		* Query
		* @return  String mysql_query
		*/
		public function queryCommand(){
			return "mysql_query(<query>)";
		}
		
		/*
			AINDA N�O SUPORTADO
		*/
		public function createFieldComment(){}
		
		/**
		* Cria um campo
		* @return  String createField
		*/
		public function createField(){
			return "<element><fieldname></element> <fieldtype> <allownull> <defaultvalue>";
		}
		
		/**
		* Cria uma foreign key
		* @return  String para criar Foreign Key
		*/
		public function createFK(){
			//return "<constructor>FOREIGN KEY</constructor>(<element><foreignkey></element>) <obj>REFERENCES</obj> <element><schemaname>.<references></element>";
			return "<constructor>ALTER TABLE</constructor> <objTable><table></objTable> <obj>ADD FOREIGN KEY<obj> (<element><fk></element>) <obj>REFERENCES</obj> <objTable><references></objTable>(<element><references_pk></element>);";
		}
		
		/**
		* Adiciona uma foreign key
		* @return  String para adicionar Primary Key
		*/
		public function addFK(){
			return "<constructor>FOREIGN KEY</constructor>(<element><foreignkey></element>) <obj>REFERENCES</obj> <element><references></element>";
		}

		/**
		* Primary Key padr�o
		* @return  String para Primary Key padr�o
		*/
		public function defaultPrimaryKey(){
			return "<element><fieldname></element> integer <obj>auto_increment</obj> <obj>unique</obj> <obj>not null</obj>";
		}
		
		/**
		* Cria uma primary key
		* @return  String para criar Primary Key
		*/		
		public function createPK(){
			return "<constructor>PRIMARY KEY</constructor>(<element><pk></element>)";
		}
		
		/**
		* Cria Tabela
		* @return  String para criar tabela
		*/		
		public function createTable()
		{
			return "	<mindComment>/* DDL: table <tablename> */</mindComment>
<constructor>CREATE</constructor> <obj>TABLE</obj> <objTable><tablename></objTable>
<element>(</element>
<fields>
<element>)</element>ENGINE = InnoDB;";
		}
	}
?>