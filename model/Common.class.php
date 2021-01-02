<?php

class Common{

	public function rdirctErrorSessMsgLink($msg,$url,$sessMsgVar){
		$_SESSION[$sessMsgVar] = '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><i class="icon-remove-sign"></i>'.$msg.'</div>';
		header('Location: '.$url);
		exit(0);
	}
	public function rdirctSuccessSessMsgLink($msg,$url,$sessMsgVar)
	{
		$_SESSION[$sessMsgVar] = '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><i class="icon-ok-sign"></i>'.$msg.'</div>';
		header('Location: '.$url);
		exit(0);
	}
	
	public function rdirctWarningSessMsgLink($msg,$url,$sessMsgVar)
	{
		$_SESSION[$sessMsgVar] = '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert">&times;</a><i class="icon-exclamation-sign"></i>'.$msg.'</div>';
		header('Location: '.$url);
		exit(0);
	}
	public function rdirctPlainSessMsgLink($msg,$url,$sessMsgVar)
	{
		$_SESSION[$sessMsgVar] = $msg;
		header('Location: '.$url);
		exit(0);
	}
	
	static public function redirect($url, $baseUri = '')
	{
		if (isset($_SERVER['HTTP_REFERER']) AND ($url == $_SERVER['HTTP_REFERER']))
			header('Location: '.$_SERVER['HTTP_REFERER']);
		else
			header('Location: '.$baseUri.$url);
		exit;
	}
	public function displaySessionMessage($sesVariable = 'message',$clear = 'Yes'){
		if(isset($_SESSION[$sesVariable]) && !empty($_SESSION[$sesVariable])){ 
			$msg = $_SESSION[$sesVariable];
			if($clear == 'Yes'){
				unset($_SESSION[$sesVariable]);
			}
			return $msg;
		}
	}

	
}// class end.
?>