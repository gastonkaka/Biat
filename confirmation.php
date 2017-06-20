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
    $id_agent=$data['id'];
    $id_reg=$data['reg'];
    $action=$data['action'];
    $sql="UPDATE `reglement facture` SET `agent` = $id_agent ";
    if($action=="confirm"){
        $date_authorisation=date("Y-m-d");
        $sql.=", `date_confirmation_agence` = '$date_authorisation' "
            .", `statut` = 'confirme' ";
    }else{
        $sql.=", `statut` = 'rejete' ";
        $motif_rejet=$data['motif_rejet'];
        $sql2="INSERT INTO `rejet` (`motif_rejet`,`agent`,`reglement`) VALUES"
             ."('$motif_rejet',$id_agent,$id_reg)";
        $stmt = $conn->prepare($sql2); 
        $result =$stmt->execute();     
    }
     $sql.="WHERE `id_reglement` = $id_reg";
     $stmt = $conn->prepare($sql); 
     $result =$stmt->execute();
    echo json_encode($result,JSON_PRETTY_PRINT);
    }
    catch(PDOException $e)
    {
    echo json_encode(array('error'=>"Connection failed: " . $e->getMessage()),JSON_PRETTY_PRINT); 
    }
?>  




