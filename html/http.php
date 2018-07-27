<?php
$context = stream_context_create(
    array(
        "http" => array(
            "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
        )
    )
);
$response = file_get_contents("https://api.github.com/user?access_token=1234", false, $context);
if ($response !== false) {
    var_dump($response);
}

?>
