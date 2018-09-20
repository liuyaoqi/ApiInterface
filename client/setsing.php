<?php
	include  './aes.php';


	//加密签名
	function setsing($token){
		
		$token = $token.'/'.time();
		$sing = AES::encrypt($token, 'g87y65ki6e8p93av8zjdrtfdrtgdwetd');

		return $sing;
	}
?>