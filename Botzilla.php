<?php

$input = json_decode(file_get_contents('php://input'), true);
file_put_contents('fb_response.txt', file_get_contents("php://input") . PHP_EOL, FILE_APPEND);

//print_r($_GET["hub_challenge"]);
//file_put_contents("fb.txt", file_get_contents("php://input"));
// print("entro");
// $fb = file_get_contents("php://input");
shell_exec("sudo touch perra.txt")
// echo "<pre>";
// $fb = json_decode($fb);
// print_r($fb);
// print("salio");
//echo "<pre>";
// $fb = json_decode($fb);
// $recipientId = $fb->entry[0]->messaging[0]->sender->id;
//$message = $fb->entry[0]->messaging[0]->message->text;

//exec(,$message, -1);

// $token="EAADhEjnSxg8BAB7pchOnUF2UW0yeFkwQ9UIw0rwMyDDiIZAZArzPiPZB4xXgTsWi3eCZBafYvEe8EfhXMlxZA4OCSnZBK4G4X7J0bs24gM0kmGLo0xQabOAMl5ixZBpwwymTpKWNDYeVLE5UZAqfYAHYVaJmMgJiIi9kXhibZCegafQZDZD";

// $data = array(
// 	'recipient' => array('id' =>"$recipientId"),
// 	'message' => array('text' =>"perritas"),
// 	);

// $options = $options = array(
//     'http' => array(
//     	'method'  => 'POST',
//     	'content' => json_encode($data),
//         'header'  => "Content-type: application/json\n"
//     )
// );

// $context = stream_context_create($options);

// $file_get_contents("https://graph.facebook.com/v2.6/me/messages?access_token=PAGE_ACCESS_TOKEN", false, $context);
?>