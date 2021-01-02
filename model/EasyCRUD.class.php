<?php 
/**
* Easy Crud  -  This class kinda works like ORM. Just created for fun :) 
*
* @author		Author: Vivek Wicky Aswal. (https://twitter.com/#!/VivekWickyAswal)
* @version      0.1a
*/
//require_once(__DIR__ . '/../Db.class.php');
require_once('Db.class.php');
class Crud {

	private $db;

	public $variables;

	public function __construct($data = array()) {
		$this->db =  new DB();	
		$this->variables  = $data;
	}

	public function __set($name,$value){
		if(strtolower($name) === $this->pk) {
			$this->variables[$this->pk] = $value;
		}
		else {
			$this->variables[$name] = $value;
		}
	}

	public function __get($name)
	{	
		if(is_array($this->variables)) {
			if(array_key_exists($name,$this->variables)) {
				return $this->variables[$name];
			}
		}

		$trace = debug_backtrace();
		trigger_error(
		'Undefined property via __get(): ' . $name .
		' in ' . $trace[0]['file'] .
		' on line ' . $trace[0]['line'],
		E_USER_NOTICE);
		return null;
	}

	public function save($id = "0") {
		$this->variables[$this->pk] = (empty($this->variables[$this->pk])) ? $id : $this->variables[$this->pk];

		$fieldsvals = '';
		$columns = array_keys($this->variables);

		foreach($columns as $column)
		{
			if($column !== $this->pk)
			$fieldsvals .= $column . " = :". $column . ",";
		}

		$fieldsvals = substr_replace($fieldsvals , '', -1);

		if(count($columns) > 1 ) {
			$sql = "UPDATE " . $this->table .  " SET " . $fieldsvals . " WHERE " . $this->pk . "= :" . $this->pk;
			return $this->db->query($sql,$this->variables);
		}
	}
	public function saveall() {
		$fieldsvals = '';
		$columns = array_keys($this->variables);

		foreach($columns as $column)
		{
			if($column !== $this->pk)
			$fieldsvals .= $column . " = :". $column . ",";
		}

		$fieldsvals = substr_replace($fieldsvals , '', -1);

		if(count($columns) >= 1 ) {
			$sql = "UPDATE " . $this->table .  " SET " . $fieldsvals ;
			return $this->db->query($sql,$this->variables);
		}
	}
	
	public function create() { 
		$bindings   	= $this->variables;

		if(!empty($bindings)) {
			$fields     =  array_keys($bindings);
			$fieldsvals =  array(implode(",",$fields),":" . implode(",:",$fields));
			$sql 		= "INSERT INTO ".$this->table." (".$fieldsvals[0].") VALUES (".$fieldsvals[1].")";
		}
		else {
			$sql 		= "INSERT INTO ".$this->table." () VALUES ()";
		}

		return $this->db->query($sql,$bindings);
	}

	public function delete($id = "") {
		$id = (empty($this->variables[$this->pk])) ? $id : $this->variables[$this->pk];

		if(!empty($id)) {
			$sql = "DELETE FROM " . $this->table . " WHERE " . $this->pk . "= :" . $this->pk. " " ;
			return $this->db->query($sql,array($this->pk=>$id));
		}
	}

	public function find($id = "") {
		$id = (empty($this->variables[$this->pk])) ? $id : $this->variables[$this->pk];

		if(!empty($id)) {
			$sql = "SELECT * FROM " . $this->table ." WHERE " . $this->pk . "= :" . $this->pk . " LIMIT 1";	
			return $this->variables = $this->db->row($sql,array($this->pk=>$id));
		}
	}
	public function FindDetailsByColumn($selectColumns = array(),$noOfRows = "") {
		$condn = $where = '';
		if(is_array($this->variables) && !empty($this->variables)){
			foreach($this->variables as $key => $val){
				$condn .= " AND ". $key . "= :" . $key ." ";
			}
		}
		if(!empty($condn)){
			$where = " WHERE " . ltrim($condn," AND");
		}
		$fields = '*';
		if(!empty($selectColumns)){
			$fields = implode(',',$selectColumns);
		}
		$sql = "SELECT ".$fields." FROM " . $this->table . $where. " ";
		if($noOfRows == 'single'){
			return $this->db->row($sql,$this->variables);
		}else{
			return $this->db->query($sql,$this->variables);
		}
	}
	public function checkRecordExists($id = '') {
		$condn = $where = '';
		if(is_array($this->variables) && !empty($this->variables)){
			foreach($this->variables as $key => $val){
					$condn .= " AND ". $key . "= :" . $key;
			}
		}
		if(!empty($id)){
			$condn .= " AND ". $this->pk . " != " . $id;
		}
		if(!empty($condn)){
			$where = " WHERE " . trim($condn," AND");
		}
		if(!empty($where)) {
			$sql = "SELECT ". $this->pk . " FROM " . $this->table . $where. " ";
			return $this->variables = $this->db->row($sql,$this->variables);
		}
	}
	
	/*
	* Search by field name
	* @returns Column selected
	*/
	public function FindDetailsByField($field = '',$value="") {
		$condn = $where = '';
		if(!empty($field)){
			$condn .= " AND ". $field . " = '" . $value."'";
		}
		if(!empty($condn)){
			$where = " WHERE " . trim($condn," AND");
		}
		if(!empty($where)) {
			$sql = "SELECT ". $this->pk . " FROM " . $this->table . $where. " ";
			return $this->variables = $this->db->column($sql,$this->variables);
		}
	}

	/*
	* Search by field name 
	* @returns All values
	*/
	public function FindDetailsByFieldCustom($field = '',$value="") {
		$condn = $where = '';
		if(!empty($field)){
			$condn .= " AND ". $field . " = '" . $value."'";
		}
		if(!empty($condn)){
			$where = " WHERE " . trim($condn," AND");
		}
		if(!empty($where)) {
			$sql = "SELECT * FROM " . $this->table . $where. " ";
			return $this->variables = $this->db->query($sql);
		}
	}

	public function all(){
		return $this->db->query("SELECT * FROM " . $this->table);
	}
	public function allPaginate($start,$limit){
		return $this->db->query("SELECT * FROM " . $this->table . " LIMIT {$start}, {$limit} ");
	}
	
	public function min($field)  {
		if($field)
		return $this->db->single("SELECT min(" . $field . ")" . " FROM " . $this->table);
	}

	public function max($field)  {
		if($field)
		return $this->db->single("SELECT max(" . $field . ")" . " FROM " . $this->table);
	}

	public function avg($field)  {
		if($field)
		return $this->db->single("SELECT avg(" . $field . ")" . " FROM " . $this->table);
	}

	public function sum($field)  {
		if($field)
		return $this->db->single("SELECT sum(" . $field . ")" . " FROM " . $this->table);
	}

	public function count($field)  {
		if($field)
		return $this->db->single("SELECT count(" . $field . ")" . " FROM " . $this->table);
	}
	public function lastInsertId()  {
		return $this->db->lastInsertId();
	}	
	
}
?>
