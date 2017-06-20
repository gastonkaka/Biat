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
    $montant_lettre=$data['montant_lettre'];$devise=$data['devise'];
    $montant_chiffre=$data['montant_chiffre'];$motif_payement=$data['motif_payement'];
    $frais_commission_BIAT=$data['frais_commission_BIAT'];
    $frais_correspondant=$data['frais_correspondant'];$type_payement=$data['type_payement'];
    $observation=$data['observation'];
    $validation_entreprise=$data['validation_entreprise'];
    $titre_commerce_extrieurs=$data['titre_commerce_extrieurs'];
    $nom_donneur_dordre=$data['nom_donneur_d\'ordre'];
    $adresse_donneur_dordre=$data['adresse_donneur_d\'ordre'];
    $num_compte=$data['num_compte'];$code_devise=$data['code_devise'];
    $num_code_douane=$data['num_code_douane'];
    $num_registre_commerce=$data['num_registre_commerce'];
    $fournisseur=$data['fournisseur'];
    $date_validation=date("Y-m-d");
    $sql="INSERT INTO `reglement facture` (`statut`,`date_validation`,`montant lettre`,`montant chiffre`,`devise`,"
         ."`motif_payement`,`frais_commission_BIAT`,`frais_correspondant`,`type_payement`,`observation`,"
         ."`validation_entreprise`,`titre_commerce_extrieurs`,`nom_donneur_d'ordre`,`adresse_donneur_d'ordre`,"
         ."`num_compte`,`code_devise`,`num_code_douane`,`num_registre_commerce`,`fournisseur`) VALUES "
         ."('initiale','$date_validation','$montant_lettre','$montant_chiffre','$devise',"
         ."'$motif_payement','$frais_commission_BIAT','$frais_correspondant','$type_payement','$observation',"
         ."$validation_entreprise,1,'$nom_donneur_dordre','$adresse_donneur_dordre',"
         ."'$num_compte','$code_devise','$num_code_douane','$num_registre_commerce',1)";
    //var_dump($sql);
     $stmt = $conn->prepare($sql); 
     $stmt->execute();
     $last_id = $conn->lastInsertId();
     $sql="SELECT * FROM `reglement facture` WHERE id_reglement = $last_id";
     $stmt=$conn->prepare($sql);
     $stmt->execute();
     $result=$stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($result);
    echo json_encode($result,JSON_PRETTY_PRINT);
    }
    catch(PDOException $e)
    {
    echo json_encode(array('error'=>"Connection failed: " . $e->getMessage()),JSON_PRETTY_PRINT); 
    }
?>  




