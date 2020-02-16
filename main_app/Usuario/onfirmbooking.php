<?php

require('../conexion.php');

$mysqli->set_charset('utf8');

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$query = "INSERT INTO `dbhamsecon`.`booking` (`userid`, `product`, `capacity`, `turn`, `date`) VALUES ('$request->userid','$request->product', '$request->capacity', '$request->turn', '$request->date')";

if ($mysqli->query($query) === TRUE) {
    print_r($query);
    echo json_encode(array('error'=>false));
} else {
    echo "Error: <br>" . $mysqli->error;
    echo json_encode(array('error'=>true));
}

$mysqli->close();
?>