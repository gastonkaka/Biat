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
    $table=$data['table'];$nom_id=$data['nom_id'];$id=$data['id'];
    $nom=$data['nom'];$departement=$data['departement'];
    $prenom=$data['prenom'];$login=$data['login'];$mdp=$data['mdp'];
    $sql="UPDATE  $table  SET `nom` = '$nom',`prenom`='$prenom',`login`='$login',`mdp`='$mdp' "
         ."WHERE $nom_id = $id";
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




