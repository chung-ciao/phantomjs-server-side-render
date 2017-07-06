<?php
$ssrHost = 'https://your-server-side-render-host';

$host = $_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["SERVER_NAME"];
$user_agent = urlencode($_SERVER['HTTP_USER_AGENT']);
$port = '';

if($_SERVER["REQUEST_SCHEME"] == 'http' && $_SERVER["SERVER_PORT"] != 80){
  $port = ':'.$_SERVER["SERVER_PORT"];
}

if($_SERVER["REQUEST_SCHEME"] == 'https' && $_SERVER["SERVER_PORT"] != 443){
  $port = ':'.$_SERVER["SERVER_PORT"];
}

$requestUrl = urlencode($host.$port.$_SERVER['REQUEST_URI']);
$result = json_decode(file_get_contents($url = "{$ssrHost}/api/seo/?url=$requestUrl&user_agent=$user_agent"), true);

if($result == null || $result['status'] != 200){
  header("HTTP/1.0 404 Not Found");
  die;
}

echo $result['content'];
