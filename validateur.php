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
    $nom=$data['nom'];$departement=$data['departement'];
    $prenom=$data['prenom'];$login=$data['login'];$mdp=$data['mdp'];
    $sql="INSERT INTO `validateur entreprise` (`nom`,`prenom`,`login`,`mdp`,`departement`) VALUES "
         ."('$nom','$prenom','$login','$mdp',$departement)";
    //var_dump($sql);
     $stmt = $conn->prepare($sql); 
     $result=$stmt->execute();
    // var_dump($result);
    echo json_encode($result,JSON_PRETTY_PRINT);
    }
    catch(PDOException $e)
    {
    echo json_encode(array('error'=>"Connection failed: " . $e->getMessage()),JSON_PRETTY_PRINT); 
    }
?>  




