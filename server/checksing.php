<?php
	include  './aes.php';
	
	//检测秘钥
	try{
		if(empty($_GET['sing'])){
			throw new Exception('加密签名不存在');
		}

		check($_GET['sing']);

	}catch(Exception $e){
		echo resp([],401,$e->getMessage());exit;
	}		


	//校验签名
	function check($sing){
		
		
		$decrypt = AES::decrypt($sing, 'g87y65ki6e8p93av8zjdrtfdrtgdwetd');
		if($decrypt != Token){
			throw new Exception('加密签名不正确');
		}
		
	}	

?>