<?php

//print_r($_GET["hub_challenge"]);
file_put_contents("fb.txt", file_get_contents("php://input"));
$fb = file_get_contents("fb.txt");

echo "<pre>";
$fb = json_decode($fb);
print_r($fb);
// $recipientId = $fb->entry[0]->messaging[0]->sender->id;
// //$message = $fb->entry[0]->messaging[0]->message->text;

// //exec(,$message, -1);

// $token="EAADhEjnSxg8BAPi3bOvFyjEKBed9GpugiEI5nsSojB1jNHJh2KZA1Syti1tXQ1LTBwgVZCIqRZC68byp82SpJ8h0hgCZA0ZAdDh2elHyNhqjdG0gZAPWZBRUIAkeYvpjKUwhpHhbZBOz4Az8sfuD31sZCZAxxhliqr4otp7XmLUUZAPeQZDZD";

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