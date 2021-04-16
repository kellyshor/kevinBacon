<?php
include("common.php");
echo '<link href="bacon.css" type="text/css" rel="stylesheet" />';
banner();


  $firstname = $_GET['firstname'];
  $lastname = $_GET['lastname'];
  echo "Results for " . $firstname . " " . $lastname " and Kevin Bacon";

  $servername = "www.watzekdi.net";
  $username = "watzekdi_cs293";
  $password = "KevinBac0n";
  $database = "watzekdi_imdb_small";
  $dbport = 3306;

  /****** connect to database **************/
  try {
    $db = new PDO("mysql:host=$servername;dbname=$database;charset=utf8;port=$dbport", $username, $password);
  }
  catch(PDOException $e) {
    echo $e->getMessage();
  }
  try {
    $stmt = $db->prepare("
    select * from movies m
    JOIN roles r ON r.movie_id=m.id
    JOIN actors a ON a.id=r.actor_id
    WHERE a.last_name = '{$lastname}'
    AND a.first_name = '{$firstname}'");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    /** see the resulting array **/
  //  var_dump($rows);

  table($rows);
  searchAll();
  searchKevin();

  }
  catch (Exception $e) {
    echo $e;
  }
  footer();

 ?>
