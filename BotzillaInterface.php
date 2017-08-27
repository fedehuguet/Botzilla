<?php
include "Tools.php";
header('Content-Type: text/html; charset=utf-8');
header('Access-Control-Allow-Methods: PUT, POST, DELETE, OPTIONS');
header("Content-Type: application/json", true);

if (isset($_GET['start']) && isset($_GET['chat_id']))
{
    if ($_GET['start'] == 1)
    {
        $paramtypes = 's';
		$params = array();
        array_push($params,"start=[". $_GET['start'] ."] chat_id=[". $_GET['chat_id'] ."]" );
	Tools::CallStoredProcedure("SP_AddLog",$paramtypes, $params);
        echo shell_exec("python /var/www/html/Botzilla/StartConversation.py ". $_GET['chat_id'] );
    }
    else {
        echo -1;
    }
}
else
{
    if (isset($_GET['id']) &&  isset($_GET['message']) )
    {
        
        $id = $_GET["id"];
        $message = $_GET["message"];
	    
	$ex = 'python /var/www/html/Botzilla/Conversation.py '.$id.' \"'.$message.'\"';
	$paramtypes = 's';
	$params = array();
        array_push($params,"id=[". $_GET['id'] ."] message=[". $_GET['message'] ."] ex=[". $ex. "]" );
	Tools::CallStoredProcedure("SP_AddLog",$paramtypes, $params);
        $output =  shell_exec($ex);
        echo $output . $ex;
    }
    else
    {
        header("HTTP/1.1 400 Bad Request");
    }
}
?>
