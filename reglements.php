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
    $sql="SELECT * FROM `reglement facture`";
    if($data['type']=="val"){
        $val_id=$data['id'];
        $sql="SELECT * FROM `reglement facture` WHERE `validation_entreprise` = $val_id";
    }else if($data['type']=="auth"){
        $auth_id=$data['id'];
        $departement=$data['dep'];
        $select="SELECT `id_val` FROM `validateur entreprise` WHERE `departement` = $departement";
        $sql="SELECT * FROM `reglement facture` WHERE `validation_entreprise` IN ($select) AND "
        ."`authorisation_entreprise` IS NULL AND `statut` LIKE 'initiale'";
    }else if($data['type']=="agent"){
        $sql="SELECT * FROM `reglement facture` WHERE "
        ."`statut` LIKE 'authorise' AND `date_confirmation_agence` IS NULL";
    }else if($data['type']=="superagent"){
        $sql="SELECT * FROM `reglement facture`  "
        ;
    }
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




