<?php

return array (
  'name' => '卤三国+',
  'beian' => '',
  'cdnurl' => '',
  'version' => '1.0.1',
  'timezone' => 'Asia/Shanghai',
  'forbiddenip' => '',
  'languages' => 
  array (
    'backend' => 'zh-cn',
    'frontend' => 'zh-cn',
  ),
  'fixedpage' => 'dashboard',
  'categorytype' => 
  array (
    'default' => 'Default',
    'page' => 'Page',
    'article' => 'Article',
    'test' => 'Test',
  ),
  'configgroup' => 
  array (
    'basic' => 'Basic',
    'email' => 'Email',
    'dictionary' => 'Dictionary',
    'user' => 'User',
    'example' => 'Example',
    'wxconfigure' => 'WxConfigure',
  ),
  'mail_type' => '1',
  'mail_smtp_host' => 'smtp.qq.com',
  'mail_smtp_port' => '465',
  'mail_smtp_user' => '10000',
  'mail_smtp_pass' => 'password',
  'mail_verify_type' => '2',
  'mail_from' => '10000@qq.com',
  'token_salt' => 'lsg',
  'app_id' => 'wxc7d000ebb8710d67',
  'app_secret' => '07cc5cdcea07ff9e821192fc970193ca',
  'login_url' => 'https://api.weixin.qq.com/sns/jscode2session?appid=%s&secret=%s&js_code=%s&grant_type=authorization_code',
  'access_token_url' => 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s',
  'expire_in' => '7200',
);