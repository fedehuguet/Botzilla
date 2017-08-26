<?php
echo "whatsup bitches";
$access_token = "EAADhEjnSxg8BAB7pchOnUF2UW0yeFkwQ9UIw0rwMyDDiIZAZArzPiPZB4xXgTsWi3eCZBafYvEe8EfhXMlxZA4OCSnZBK4G4X7J0bs24gM0kmGLo0xQabOAMl5ixZBpwwymTpKWNDYeVLE5UZAqfYAHYVaJmMgJiIi9kXhibZCegafQZDZD";
$verify_token = "botTok";
$hub_verify_token = null;
if(isset($_REQUEST['hub_challenge'])) {
    $challenge = $_REQUEST['hub_challenge'];
    $hub_verify_token = $_REQUEST['hub_verify_token'];
}
if ($hub_verify_token === $verify_token) {
    echo $challenge;
}
$input = json_decode(file_get_contents('php://input'), true);
$sender = $input['entry'][0]['messaging'][0]['sender']['id'];
$message = $input['entry'][0]['messaging'][0]['message']['text'];
$message_to_reply = 'perritas';
/**
 * Some Basic rules to validate incoming messages
 */
// if(preg_match('[time|current time|now]', strtolower($message))) {
//     // Make request to Time API
//     ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 6.0)');
//     $result = file_get_contents("http://www.timeapi.org/utc/now?format=%25a%20%25b%20%25d%20%25I:%25M:%25S%20%25Y");
//     if($result != '') {
//         $message_to_reply = $result;
//     }
// } else {
//     $message_to_reply = 'Huh! what do you mean?';
// }
//API Url
$url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$access_token;
//Initiate cURL.
$ch = curl_init($url);
//The JSON data.
$jsonData = '{
    "recipient":{
        "id":"'.$sender.'"
    },
    "message":{
        "text":"'.$message_to_reply.'"
    }
}';
//Encode the array into JSON.
$jsonDataEncoded = $jsonData;
//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, 1);
//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
//Execute the request
if(!empty($input['entry'][0]['messaging'][0]['message'])){
    $result = curl_exec($ch);
}
// $input = json_decode(file_get_contents('php://input'), true);
// file_put_contents('fb_response.txt', file_get_contents("php://input") . PHP_EOL, FILE_APPEND);

//print_r($_GET["hub_challenge"]);
//file_put_contents("fb.txt", file_get_contents("php://input"));
// print("entro");
// $fb = file_get_contents("php://input");
//shell_exec("sudo touch perra.txt");
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