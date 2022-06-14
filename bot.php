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

    if($message == "/cmds" || $message == "/cmds@Poseidon_chk_bot"){
        send_message($chat_id,$message_id, "
          /buscar <consulta> (Google search)
          \n/bin <bin> (Bin Data)
          \n/clima <nombre de tu pais> (Estado del tiempo actual)
          \n/dado <dado emoji>
          \n/fecha (Fecha actual)
          \n/dict <word> (Dictionary)
          \n/hora (Hora Nica) 
          \n/git <username> (Github User Info)
          \n/repodl <username/repo_name> (Download Github Repository)
          \n/list_crypto
          \n/rand (Random 1 a 10)
          \n/byt <consulta> (Buscar en Youtube)
          \n/info (User Info)
          ");
    }
      if($message == "/list_crypto" || $message == "/lista crypto"){
      
        send_message($chat_id,$message_id,"
   Use el comando para verificar las tasas criptográficas actuales
         \n/btcrate  Bitcoin rate
         \n/ethrate  Etherum rate
         \n/ltcrate  Litecoin rate
         ");
    }

    if($message == "/fecha"){
        $date = date("d/F/Y \n l");
        send_message($chat_id,$message_id, $date);
    }
   if($message == "/help"){
        $help = "Contacto @DanGel_Glr";
        send_message($chat_id,$message_id, $help);
    }
   if($message == "/hora"){
        $time = date("h:i A", time());
        send_message($chat_id,$message_id, "$time UTC");
    }

  if($message == "/sc" || $message == "/si" || $message == "/st" || $message == "/cs" || $message == "/ua" || $message == "/at"  ){
   $botdown = "Poseidon Esta Bajo mantenimiento";
        send_message($chat_id,$message_id, $botdown);
    }

if($message == "/dado"){
        sendDice($chat_id,$message_id, "🎲");
    }


    

if($message == "/rand"){
      $toss =array("1","2","3","4","5","6","7","8","9","10");
    $random_toss=array_rand($toss,10);
    $tossed = $toss[$random_toss[0]];
        send_message($chat_id,$message_id, "El ganador\n **$tossed** \nRandom By: @$username");
    }

     if($message == "/info"){
        send_message($chat_id,$message_id, "Informacion de Usuario \nName: $firstname\nID $id \n**Username: @$username");
    }




///Commands with text


    //Google Search
if (strpos($message, "/buscar") === 0) {
        $search = substr($message, 8);
         $search = preg_replace('/\s+/', '+', $search);
$googleSearch = "[ver resultado de busqueda](https://www.google.com/search?q=$search)";
    if ($googleSearch != null) {
     send_MDmessage($chat_id,$message_id, $googleSearch);
    }
  }

if (strpos($message, "/repodl") === 0) {
$gitdlurl = substr($message, 8);
$gitdlurl1 = "[Click Aqui](https://github.com/$gitdlurl/archive/master.zip)";
if ($gitdlurl != null) {
  send_MDmessage($chat_id,$message_id, "https://github.com/$gitdlurl/archive/main.zip
 \n⬇️RESULTADO DE BUSQUEDA⬇️ \n$gitdlurl1"  );
}
}

//Youtube Search
if (strpos($message, "/byt") === 0) {
$syt = substr($message, 5);
$syt = preg_replace('/\s+/', '+', $syt);
$yurl = "[Abrir Youtube](https://www.youtube.com/results?search_query=$syt)";
if ($syt != null) {
  send_MDmessage($chat_id,$message_id, $yurl);
}
}


///Channel BroadCast
if (strpos($message, "/broadcast") === 0) {
$broadcast = substr($message, 11);
if ($id == 1799882584 /*|| $id == 1478297206 || $id == 654455829 || $id == 638178378 || $id == 971532801*/ ) { // || uncomment for multiple admins
  send_Cmessage($channel_id, $broadcast);
}
else {
    send_message($chat_id,$message_id, "No estas Autorizado");
 // example
///send_message("-100xxxxxxxxxx",$message_id, "You are not authorized to use this command");
///send_message("@channel_username",$message_id, "You are not authorized to use this command");
/// You can add as many channel and chat you want use the above format (make sure bot is promoted as admin in chat and channel)
}

}


//Bin Lookup
if(strpos($message, "/bin") === 0){
    $bin = substr($message, 5);
    $curl = curl_init();
    curl_setopt_array($curl, [
    CURLOPT_URL => "https://bins-su-api.vercel.app/api/".$bin,
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
 $bank = $data['data']['bank'];
 $country = $data['data']['country'];
 $brand = $data['data']['vendor'];
 $level = $data['data']['level'];
 $type = $data['data']['type'];
$flag = $data['data']['countryInfo']['emoji'];
 $result1 = $data['result'];

    if ($result1 == true) {
    send_MDmessage($chat_id,$message_id, "
  ╔╦═• ✠ • ═ • ✠ •═╦╗
⚏★𝙱𝙸𝙽 𝙻𝙾𝙾𝙺𝚄𝙿★⚏
  ╚╩═• ✠ • ═ • ✠ •═╩╝

    ✅𝑩𝑰𝑵 𝑽𝑨𝑳𝑰𝑫𝑶✅
🔢𝗕𝗶𝗻: ```$bin```
💳𝗕𝗿𝗮𝗻𝗱: $brand
🏆𝗟𝗲𝘃𝗲𝗹: $level
🏦𝗕𝗮𝗻𝗸: $bank
🌐𝗖𝗼𝘂𝗻𝘁𝗿𝘆: $country $flag
📊𝗧𝘆𝗽𝗲: $type
👤𝗖𝗵𝗲𝗰𝗸𝗲𝗱 𝗕𝘆: @$username
👑𝗢𝘄𝗻𝗲𝗿 : @DanGel_Glr");
    }
else {
    send_MDmessage($chat_id,$message_id, "***Ponga un BIN valido***");
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
