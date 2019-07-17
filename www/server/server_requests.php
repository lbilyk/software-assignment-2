<?php
require_once 'functions.php';
require_once 'dbconfig.php';

$action = filter_input(INPUT_POST, 'action');

switch ($action) {
    case 'moveElevator':
        $floor = filter_input(INPUT_POST, 'floor');
        echo updateFloor($floor);
        break;
    case 'getCurrentFloor':
        echo getCurrentFloor();
        break;
    default:
        echo null;
        break;
}