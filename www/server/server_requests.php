<?php
require_once 'dbconfig.php';

require_once '../classes/queue.php';
require_once '../classes/node.php';
require_once '../classes/floorNode.php';
require_once '../classes/elevator.php';

$action = filter_input(INPUT_POST, 'action');
switch ($action) {
    case 'getCurrentFloor':
        try{
            $newNode = new FloorNode(); 
            echo $newNode->getCurrentFloor();
        }
        catch (Exception $e)
        {
            echo 'Error: ' .$e->getMessage();
        }
        break;
    case 'moveElevator':
        try{
            $elevatorObj = new Elevator();
            $elevatorObj->moveElevator();
        }
        catch (Exception $e)
        {
            echo 'Error: ' .$e->getMessage();
        }
        break;
    case 'addToQueue':
        $floor = filter_input(INPUT_POST, 'floor');
        try{
            $newNode = new FloorNode($floor);
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