<?php
require("../config.php");
//calling userRegistration model in model folder
$userObj = new userRegistration();
$getallusers = $userObj->getAllUsers();

$messageVar = 'message';
if(isset($_POST['formsavedata']) && $_POST['formsavedata'] == 'formsavedata' )
{
	
	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$commonObj->rdirctErrorSessMsgLink("<strong>Error! </strong> Please check Your email address  ",$_SERVER['HTTP_REFERER'],$messageVar);
    }
	
	//Check email exists
	$userObj->variables = array();
	$userObj->email_address = $_POST['email'];
	$checkemailExists = $userObj->FindDetailsByColumn();
	
	if(!empty($checkemailExists)){
		$commonObj->rdirctErrorSessMsgLink("<strong>Error! </strong> Email '".$_POST['email']."' already exists.",$_SERVER['HTTP_REFERER'],$messageVar);	
	}
	
	$userObj->user_name = $_POST['name'];
	$userObj->email_address = $_POST['email'];
	$userObj->mobile_no = $_POST['number'];
	
	$userObj->Create();	
	$user_id = $userObj->lastInsertId();
	$commonObj->rdirctSuccessSessMsgLink("Inserted Succefully",$CONFIG_SERVER_ROOT,$messageVar);
	
}else if(isset($_GET['action']) && $_GET['action']=='delete')
	{
		
		$userObj->user_id=$_GET['id'];
		$userObj->Delete();
		//header('Location:'.$_SERVER['HTTP_REFERER'].'');
		$commonObj->rdirctSuccessSessMsgLink("Removed Successfully.",$CONFIG_SERVER_ROOT.'mylist/','message');
	}
	else if(isset($_POST['formeditdata']) && $_POST['formeditdata'] == 'formeditdata' )
{
	
	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$commonObj->rdirctErrorSessMsgLink("<strong>Error! </strong> Please check Your email address  ",$_SERVER['HTTP_REFERER'],$messageVar);
    }
	
	//Check email exists
	$id=$_POST['userid'];
	$userObj->variables = array();
	
	$checkemailExists = $userObj->getcheckemailexist($_POST['email'],$id);
	
	if(!empty($checkemailExists)){
		$commonObj->rdirctErrorSessMsgLink("<strong>Error! </strong> Email '".$_POST['email']."' already exists.",$_SERVER['HTTP_REFERER'],$messageVar);	
	}
	$userObj->email_address = $_POST['email'];
	$userObj->user_name = $_POST['name'];
	$userObj->email_address = $_POST['email'];
	$userObj->mobile_no = $_POST['number'];	
	$userObj->user_id = $id;
	$userObj->Save();
	$commonObj->rdirctSuccessSessMsgLink("Updated Succefully",$CONFIG_SERVER_ROOT.'/index/edit/'.$id.'',$messageVar);
	
	
}
?>