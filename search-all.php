<?php
echo 'hello word';
$submit= $_GET['submit'];
echo $submit;
if ( isset( $_GET['submit'] ) ) { // retrieve the form data by using the element's name attributes value as key
  $firstname = $_GET['firstname'];
  $lastname = $_GET['lastname']; // display the results
   echo 'Your name is ' . $lastname . ' ' . $firstname;
}
if ( !isset( $_GET['submit'] ) ){
  echo 'Actor ' . $firstname . ' ' . $lastname . ' not found';
}
/*** connection credentials *******/
  $servername = "www.watzekdi.net";
  $username = "watzekdi_cs293";
  $password = "KevinBac0n";
  $database = "watzekdi_imdb_small";
  $dbport = 3306;

  /****** connect to database **************/

  function getActorByName($database, $firstName, $lastName){

      try {
        $stmt = $database->prepare("SELECT * FROM actors WHERE first_name=:firstName and last_name=:lastName");
        $data=array(":firstName"=>$firstName, ":lastName"=>$lastName);
        $stmt->execute($data);
        rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;

      }
      catch (Exception $e) {
        return false;
       }

    }


    /*****  call the function above *****/

    if ($rows=getActorByName($db, "Kevin", "Bacon")){
       var_dump($rows);
    }
    else{
       echo "no results";
    }
?>
