<?php
    
    //检测多次请求
    try{
        $count = requests();

        if($count > 3){
            throw new Exception('恶意捣乱,禁止访问'); 
        }
    }catch(Exception $e){
        echo resp([],401,$e->getMessage());exit;
    }   

    

    // $stmt = $pdo->query('select * from user');

    // $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
    
    function requests(){
        
        //今天凌晨时间
        $todaytime = strtotime(date("Y-m-d"));

        $pdo = new PDO('mysql:host=localhost;dbname=api;charset=utf8','root','');
      
        
        $sql='select count(*) from smscode where username = ? and sendtime > ? ';
        $res = $pdo->prepare($sql);
        $username = $_POST['username'];
        $sendtime = $todaytime;
        $exeres = $res->execute(array($username,$sendtime));

        
        $con = $res->fetchColumn();

        if($con <= 3){
            
            addrequest();
        }
        return $con;
    }

    function addrequest(){
        $pdo = new PDO('mysql:host=localhost;dbname=api;charset=utf8','root','');
      
        
        $sql = "insert into smscode(username,sendtime)
         values(:username,:sendtime)";
        $query = $pdo->prepare($sql);

        $result = $query->execute(array(
            ':username' => $_POST['username'],
            ':sendtime' => time()
        ));
        return 'ok';
    }
