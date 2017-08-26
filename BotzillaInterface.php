<?php

if (isset($_POST['start']))
{
    if ($_POST['start'] == 1)
    {
        echo shell_exec("python /var/www/html/reddefilantropia.site/public_html/Botzilla/StartConversation.py");
    }
    else {
        echo -1;
    }
}
else
{
    if (isset($_POST['id']) &&  isset($_POST['message']) )
    {
        echo shell_exec('python /var/www/html/reddefilantropia.site/public_html/Botzilla/Conversation.py $_POST["id"] $_POST["message"]');
    }
    else
    {
        header("HTTP/1.1 400 Bad Request");
    }
}
?>
