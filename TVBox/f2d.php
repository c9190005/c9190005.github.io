<?php
error_reporting(0);
header("Content-type:text/html;charset=utf-8");
header('Content-type: text/xml'); 
$text = get_content_url('http://f2dcj6.com/sapi/?ac=videolist');
echo compress_html($text);

function get_content_url($url) {
$curl = curl_init();
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36'
    ));
curl_setopt($curl,  CURLOPT_URL,$url);
curl_setopt($curl, CURLOPT_HEADER, 0);  //0表示不输出Header，1表示输出
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_ENCODING, '');
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
$string=curl_exec($curl);
    return $string;
}
function compress_html($string) {
$string = str_replace("\r\n", '', $string); //清除换行符
$string = str_replace("\n", '', $string); //清除换行符
$string = str_replace("\t", '', $string); //清除制表符
$pattern = array (
"/> *([^ ]*) *</", //去掉注释标记
"/[\s]+/",
"/<!--[^!]*-->/",
"/\" /",
"/ \"/",
"'/\*[^*]*\*/'"
);
$replace = array (
">\\1<",
" ",
"",
"\"",
"\"",
""
);
return preg_replace($pattern, $replace, $string);
}