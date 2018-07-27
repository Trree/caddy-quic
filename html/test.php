<?php

if (isset($_GET['code'])) {
    echo $_GET['code'];
    $code = $_GET['code'];
} else {
    ;
}

if (isset($_GET['state'])) {
    echo $_GET['state'];
    $state = $_GET['state'];
} else {
    ;
}

$url = "https://github.com/login/oauth/access_token";
$data = array('code'=>$code, 
    'client_id'=>'6086dc8afc3f6cc9b5cf', 
    'client_secret'=>'8055ba62f2235e118a0de722c9b217c48a37d273', 
    'redirect_uri'=>'https://10.0.80.160:8686/github/callback');

$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

$convert_to_array = explode('&', $result);
for ($i = 0; $i < count($convert_to_array); $i++) {
    $key_value = explode('=', $convert_to_array[$i]);
    $end_array[$key_value[0]] = $key_value[1];
}

$context1 = stream_context_create(
    array(
        "http" => array(
            "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
        )
    )
);

$geturl = "https://api.github.com/user?access_token=".$end_array['access_token'];
$response = file_get_contents($geturl, false, $context1);

var_dump($result);
var_dump($response);

$redis = new Redis(); 
$redis->connect('127.0.0.1', 6379); 
$redis->set("aaaaaaa", $state);
$redis->hset($state, "token_body", $result);
$redis->hset($state, "token", $end_array['access_token']);
$redis->hset($state, "userinfo", $response);

header('Location: https://10.0.80.160:8686/');

?>
