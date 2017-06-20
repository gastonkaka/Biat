<?php  
    header('Access-Control-Allow-Origin: *'); 
    header('Content-type: application/json');      
        $d=$_GET['data'] ;
        $data=(array)json_decode($d);
       // var_dump($data);
        $servername = "localhost";
        $username = "root";
        $password = "";
try {
    $conn = new PDO("mysql:host=$servername;dbname=mydb", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql="SELECT * FROM ".$data['table']." WHERE login LIKE '".$data['login']."' AND mdp LIKE '"
    .$data['pwd']."' ";
    //var_dump($sql);
     $stmt = $conn->prepare($sql); 
     $stmt->execute();
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($result);
    echo json_encode($result,JSON_PRETTY_PRINT);
    }
    catch(PDOException $e)
    {
    echo json_encode(array('error'=>"Connection failed: " . $e->getMessage()),JSON_PRETTY_PRINT); 
    }
?>  




