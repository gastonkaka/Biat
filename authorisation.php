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
    $id_auth=$data['id'];
    $id_reg=$data['reg'];
    $action=$data['action'];
    $sql="UPDATE `reglement facture` SET `authorisation_entreprise` = $id_auth ";
    if($action=="auth"){
        $date_authorisation=date("Y-m-d");
        $sql.=", `date_authorisation` = '$date_authorisation' "
            .", `statut` = 'authorise' ";
    }else{
        $sql.=", `statut` = 'non authorise' ";
    }
    $sql.="WHERE `id_reglement` = $id_reg";
    
    //var_dump($sql);
     $stmt = $conn->prepare($sql); 
     $result =$stmt->execute();
     // var_dump($result);
    echo json_encode($result,JSON_PRETTY_PRINT);
    }
    catch(PDOException $e)
    {
    echo json_encode(array('error'=>"Connection failed: " . $e->getMessage()),JSON_PRETTY_PRINT); 
    }
?>  




