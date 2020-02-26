<?php

require('../conexion.php');

$mysqli->set_charset('utf8');

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);


$sql = "SELECT product,capacity, turn, date, id FROM dbhamsecon.booking where userid= '$request->userid' and status = 'pending' and bookrowid = '$request->bookrowid' ORDER BY date" ;
$result = $mysqli -> query($sql);
if($result->num_rows == 0){
    echo json_encode(array('data'=>[]));
}
else {
    $data = [];
    while ($row = $result -> fetch_row()) {
        array_push($data, $row);
    }
    echo json_encode(array('data'=>$data));
    $result -> free_result();
}

$mysqli->close();
?> 