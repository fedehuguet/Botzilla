<?php
header('Access-Control-Allow-Methods: PUT, POST, DELETE, OPTIONS');
header("Content-Type: application/json", true);

if (isset($_GET['start']))
{
    if ($_GET['start'] == 1)
    {
        echo shell_exec("python /var/www/html/Botzilla/StartConversation.py");
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
        $output =  shell_exec('python /var/www/html/Botzilla/Conversation.py '.$id.' '.$message);
        echo $output;
    }
    else
    {
        header("HTTP/1.1 400 Bad Request");
    }
}
?>
