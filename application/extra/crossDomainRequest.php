<?php
//  指定允许其他域名访问
// 响应类型
// 响应头设置
return [
    'header'=>[
        header('Access-Control-Allow-Origin: *'),
        header("Content-type: application/json"),
//跨域
        header("Access-Control-Allow-Credentials: true"),

//CORS
header("Access-Control-Request-Methods:GET, POST, PUT, DELETE, OPTIONS"),
header('Access-Control-Allow-Headers:x-requested-with,content-type,test-token,test-sessid'),
    ]
];

