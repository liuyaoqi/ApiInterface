<?php 
	//设置错误级别
	error_reporting('E_ALL & ~E_NOTICE');

	//接收客户端发来的请求 响应数据 json格式

	//处理业务逻辑异常
	try {
		if(empty($_POST['username'])){
			throw new Exception('缺失username必填参数');
		}

		if(empty($_POST['password'])){
			throw new Exception('缺失password必填参数'); 
		}
	} catch (Exception $e) {
		echo resp([],401,$e->getMessage());
		exit;
	}


	//处理服务器异常
	try {
		$pdo = new PDO('mysql:host=localhost;dbname=api;charset=utf8','root','');

		$stmt = $pdo->query('select * from user');

		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

	} catch (Exception $e) {
		echo resp($data,401,$e->getMessage());
		exit;
	}
	

	
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