<?php  
	//客户端发起api请求 

	error_reporting(0);
	include './vendor/autoload.php';
	include './setsing.php';
	//定义密钥
	$token = 'test';

	//生成一个加密签名
	$sing = setsing($token);		


	$curl = new Curl\Curl();

	//请求的api地址

	$url = 'http://localhost/ApiInterface/server/server.php?sing='.$sing;

	
	$curl->post($url, array(
		'username'=>'lishaokun',
		'password'=>'123'
	));

	//是否成功
	if ($curl->error) {
	    echo $curl->error_code;
	}
	else {
	    echo $curl->response;
	}

?>