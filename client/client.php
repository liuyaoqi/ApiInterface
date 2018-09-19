<?php  
	//客户端发起api请求 
	include './vendor/autoload.php';

	$curl = new Curl\Curl();

	//请求的api地址

	$url = 'http://localhost/ApiInterface/server/server.php';
	
	$curl->get($url);

	//是否成功
	if ($curl->error) {
	    echo $curl->error_code;
	}
	else {
	    echo $curl->response;
	}

?>