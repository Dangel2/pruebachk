<?php

    date_default_timezone_set("America/Managua");
    //Data From Webhook
    $content = file_get_contents("php://input");
    $update = json_decode($content, true);
    $chat_id = $update["message"]["chat"]["id"];
    $message = $update["message"]["text"];
    $message_id = $update["message"]["message_id"];
    $id = $update["message"]["from"]["id"];
    $username = $update["message"]["from"]["username"];
    $firstname = $update["message"]["from"]["first_name"];
    $chatname = $_ENV['CHAT']; 
 /// for broadcasting in Channel
$channel_id = "-100xxxxxxxxxx";

/////////////////////////

    //Extact match Commands
    if($message == "/start"){
        send_message($chat_id,$message_id, "◦•●◉𖡝 B͎I͎E͎N͎V͎E͎N͎I͎D͎O͎ 𖡝◉●•◦
        𝚂𝚘𝚢 𝚙𝚘𝚜𝚎𝚒𝚍𝚘𝚗 𝚙𝚞𝚎𝚍𝚎𝚜 𝚞𝚝𝚒𝚕𝚒𝚣𝚊𝚛 \n/cmds  𝚙𝚊𝚛𝚊 𝚟𝚎𝚛 𝚖𝚒𝚜 𝚏𝚞𝚗𝚌𝚒𝚘𝚗𝚎𝚜 𝚍𝚒𝚜𝚙𝚘𝚗𝚒𝚋𝚕𝚎 𝚊𝚌𝚝𝚞𝚊𝚕𝚖𝚎𝚗𝚝𝚎.");
    }
    
//Bin Lookup
if(strpos($message, "/url") === 0){
    $url = substr($message, 5);
    $curl = curl_init();
    curl_setopt_array($curl, [
    CURLOPT_URL => "https://www.threatcrowd.org/searchApi/v2/domain/report/?domain=".$url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
    "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
    "accept-language: en-GB,en-US;q=0.9,en;q=0.8,hi;q=0.7",
    "sec-fetch-dest: document",
    "sec-fetch-site: none",
    "user-agent: Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1"
   ],
   ]);

 $result = curl_exec($curl);
 curl_close($curl);
 $data = json_decode($result, true);

    if ($result1 == true) {
    send_MDmessage($chat_id,$message_id, "$data");
    }
else {
    send_MDmessage($chat_id,$message_id, "***Coloque un URL valido***");
}
}

///Send Message (Global)
    function send_message($chat_id,$message_id, $message){
        $text = urlencode($message);
        $apiToken = $_ENV['API_TOKEN'];  
        file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?chat_id=$chat_id&reply_to_message_id=$message_id&text=$text");
    }
    
//Send Messages with Markdown (Global)
      function send_MDmessage($chat_id,$message_id, $message){
        $text = urlencode($message);
        $apiToken = $_ENV['API_TOKEN'];  
        file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?chat_id=$chat_id&reply_to_message_id=$message_id&text=$text&parse_mode=Markdown");
    }
///Send Message to Channel
      function send_Cmessage($channel_id, $message){
        $text = urlencode($message);
        $apiToken = $_ENV['API_TOKEN'];
        file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?chat_id=$channel_id&text=$text");
    }

//Send Dice (dynamic emoji)
function sendDice($chat_id,$message_id, $message){
        $apiToken = $_ENV['API_TOKEN'];  
        file_get_contents("https://api.telegram.org/bot$apiToken/sendDice?chat_id=$chat_id&reply_to_message_id=$message_id&text=$message");
    }


?>
