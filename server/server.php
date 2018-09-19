<?php 
	//接收客户端发来的请求 响应数据 json格式
	
	$pdo = new PDO('mysql:host=localhost;dbname=api;charset=utf8','root','');

	$stmt = $pdo->query('select * from user');

	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

	
	//定义标准化的数据格式
	function resp($data,$status,$message){
		
		$res = [
			'status'=>$status,//服务器响应状态码 200 401 404
			'message'=>$message,//此次api请求的描述
			'data'=>$data,
		];

		return json_encode($res,JSON_UNESCAPED_UNICODE);
	}	

	echo resp($data,200,'pk');

	

	
?>