<?php
header('Content-Type: text/html; charset=utf-8');
header('Access-Control-Allow-Methods: PUT, POST, DELETE, OPTIONS');
header("Content-Type: application/json", true);

if (isset($_POST['start']) && isset($_POST['chat_id']))
{
    if ($_POST['start'] == 1)
    {
        echo shell_exec("python /var/www/html/Botzilla/StartConversation.py ". $_POST['chat_id'] );
    }
    else {
        echo -1;
    }
}
else
{
    if (isset($_POST['id']) &&  isset($_POST['message']) )
    {
        $id = $_POST["id"];
        $message = $_POST["message"];
        $output =  shell_exec('python /var/www/html/Botzilla/Conversation.py '.$id.' '.urldecode ($message));
        echo $output;
    }
    else
    {
        header("HTTP/1.1 400 Bad Request");
    }
}
?>
