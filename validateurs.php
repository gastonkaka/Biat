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
    $entreprise=$data['entreprise'];
    $sql0="SELECT `id_departement` FROM `departement entreprise` WHERE `entreprise` = $entreprise";
    $sql="SELECT * FROM `validateur entreprise` WHERE  `departement` IN ( $sql0 ) ";
    //var_dump($sql);
     $stmt = $conn->prepare($sql); 
     $stmt->execute();
     $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
     $result=$data;
     foreach ($data as $key => $value) {
         $departement=$value['departement'];
         $sql="SELECT * FROM `departement entreprise` WHERE `id_departement`=$departement";
         $stmt = $conn->prepare($sql);$stmt->execute();
         $result[$key]['departement']=$stmt->fetch(PDO::FETCH_ASSOC);
         
     }
    // var_dump($result);
    echo json_encode($result,JSON_PRETTY_PRINT);
    }
    catch(PDOException $e)
    {
    echo json_encode(array('error'=>"Connection failed: " . $e->getMessage()),JSON_PRETTY_PRINT); 
    }
?>  




