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
    $nom_entreprise=$data['nom_entreprise'];$adresse=$data['adresse'];
    
    $sql="INSERT INTO `entreprise` (`nom_entreprise`,`adresse`) VALUES "
         ."('$nom_entreprise','$adresse')";
    //var_dump($sql);
     $stmt = $conn->prepare($sql); 
     $stmt->execute();
     $last_id = $conn->lastInsertId();
    $nom=$data['nom'];$prenom=$data['prenom'];$login=$data['login'];;$mdp=$data['mdp'];
    $sql="INSERT INTO `administrateur` (`nom`,`prenom`,`entreprise`,`login`,`mdp`) VALUES "
         ."('$nom','$prenom',$last_id,'$login','$mdp')";
     $stmt=$conn->prepare($sql);
      $result=$stmt->execute();
    // var_dump($result);
    echo json_encode($result,JSON_PRETTY_PRINT);
    }
    catch(PDOException $e)
    {
    echo json_encode(array('error'=>"Connection failed: " . $e->getMessage()),JSON_PRETTY_PRINT); 
    }
?>  




