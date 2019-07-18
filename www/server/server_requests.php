<?php
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
        try{
            $newNode = new Node();
            echo $newNode->getCurrentFloor();
        }
        catch (Exception $e)
        {
            echo 'Error: ' .$e->getMessage();
        }
        break;
    case 'moveElevator':
        try{
            Node::moveElevator();
        }
        catch (Exception $e)
        {
            echo 'Error: ' .$e->getMessage();
        }
        break;
    case 'addToQueue':
        $floor = filter_input(INPUT_POST, 'floor');
        try{
            $newNode = new Node($floor);
            $newNode->requestFloor();
        }
        catch (Exception $e)
        {
            echo 'Error: ' .$e->getMessage();
        }
        break;
    case 'getQueue':
        try{
            echo Queue::getQueueFromDb();}
        catch (Exception $e)
        {
            echo 'Error: ' .$e->getMessage();
        }
        break;
    case 'deleteFromQueue':
        $id = filter_input(INPUT_POST, 'id');
        Queue::removeFloorFromQueueById($id);
        break;
    default:
        echo null;
        break;
}