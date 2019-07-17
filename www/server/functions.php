<?php
require_once 'server_requests.php';
require_once 'dbconfig.php';

function updateFloor($floor) {

    global $mysqli;
    $query = "UPDATE elevatornetwork SET requestedFloor = ? WHERE nodeID = 1";
    $statement = $mysqli->prepare($query);
    $statement->bind_param("i",$floor);
    $result = $statement->execute();
    return $result;
}

function getCurrentFloor() {

    global $mysqli;
    $query = "SELECT currentFloor FROM elevatornetwork WHERE nodeID = 1";
    $statement = $mysqli->prepare($query);
    $statement->execute();
    $result = $statement->get_result();
    $row = mysqli_fetch_row($result);
    return $row[0];

}