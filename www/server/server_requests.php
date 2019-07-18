<?php
require_once 'functions.php';
require_once 'dbconfig.php';
require_once '../classes/queue.php';
require_once '../classes/node.php';

$action = filter_input(INPUT_POST, 'action');
switch ($action) {
    // case 'updateRequest':
    //     $floor = filter_input(INPUT_POST, 'floor');
    //     $success = updateFloor($floor);
    //     echo $success;
    //     break;
    case 'getCurrentFloor':
        $newNode = new Node();
        echo $newNode->getCurrentFloor();
        break;
    case 'moveElevator':
        Node::moveElevator();
        break;
    case 'addToQueue':
        $floor = filter_input(INPUT_POST, 'floor');
        $newNode = new Node($floor);
        $newNode->requestFloor();
        break;
    case 'getQueue':
        echo Queue::getQueueFromDb();
        break;
    case 'deleteFromQueue':
        $id = filter_input(INPUT_POST, 'id');
        Queue::removeFloorFromQueueById($id);
        break;
    default:
        echo null;
        break;
}