<?php
header('Access-Control-Allow-Methods: PUT, POST, DELETE, OPTIONS');
header("Content-Type: application/json", true);

//========================================================================================================================
if (isset($_POST['id']) &&  isset($_POST['message']) )
{
    echo shell_exec("python /var/www/html/reddefilantropia.site/public_html/Botzilla/Conversation.py $_POST['id'] $_POST['message']");
}
else
{
    header("HTTP/1.1 400 Bad Request");
}
?>
