<?php
include "WeChat.php";
//token数据
define("TOKEN","yirantianshi");
//appid和appsecret的数据
$appid = "wx2525ccd5ac0abcbf";
$appsecret = "289d1a2b966723e8b403cf0889c17f42";

//菜单数据
$data = '{
     "button":[
                   {
                "type":"view",
                 "name":"首页",
                 "url":"http://m.yirantianshi.com"
              } 
     ]
 }';
if(isset($_GET['echostr'])) {
    //token验证
    (new WeChat())->valid();
}else {
    //开始微信功能的操作
    var_dump((new WeChat($appid,$appsecret))->menu_create($data));
}



?>
