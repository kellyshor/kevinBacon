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
    select distinct m.name from movies m
    JOIN roles r1 ON r1.movie_id=m.id
    JOIN actors kevin ON r1.actor_id=kevin.id
    JOIN roles r2 ON r2.movie_id=m.id
    JOIN actors other ON r2.actor_id=other.id
    WHERE kevin.last_name = 'Bacon'
    AND kevin.first_name = 'Kevin'
    WHERE other.last_name = '{$lastname}'
    AND other.first_name = '{$firstname}'");
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
