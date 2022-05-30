
<?php
include('conection.php');

$query = "SELECT * FROM products ";

$statement = $db->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row){

    echo $row["name"]."</br>";
}