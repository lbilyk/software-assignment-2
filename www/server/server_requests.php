<?php
require_once 'functions.php';
require_once 'dbconfig.php';

$action = filter_input(INPUT_POST, 'action');

switch ($action) {
    case 'updateRequest':
        $floor = filter_input(INPUT_POST, 'floor');
        $success = updateFloor($floor);
        echo $success;
        break;
    case 'getCurrentFloor':
        echo getCurrentFloor();
        break;
    case 'moveElevator':
        $floor = filter_input(INPUT_POST, 'floor');
        moveElevator($floor);
        break;
    default:
        echo null;
        break;
}