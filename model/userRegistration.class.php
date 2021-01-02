<?php
require_once("EasyCRUD.class.php");
class userRegistration Extends Crud {
	private $db;
	#  Table name 
	protected $table = 'users';
	
	# Primary Key of the Table
	protected $pk	 = 'user_id';
	protected $fields = array('user_name','email_address','mobile_no');
	
	
	public function checkEmailExists($email)
	{
		$DB =  new DB();		
		$details = $DB->query("SELECT * FROM " . $this->table. " WHERE email_address = '".$email."'");
		return $details;
	}
	public function getcheckemailexist($email,$id)
	{
		$DB =  new DB();		
		$details = $DB->query("SELECT * FROM " . $this->table. " WHERE email_address = '".$email."' and user_id!='".$id."'");
		return $details;
	}
	
	public function getAllUsers(){
		$DB =  new DB();
		return $DB->query("SELECT * FROM " . $this->table. "  ORDER BY user_id ASC");
	}
	public function getUsersById($id){
		$DB =  new DB();
		return $DB->query("SELECT * FROM " . $this->table. "  WHERE user_id = '".$id."'");
	}
	
}

?>