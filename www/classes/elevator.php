<?php 
    class Elevator extends Node {
        private $nextFloor;

        public function __construct(){
            $this->nextFloor = 0;
        }

        public function moveElevator(){
            $this->nextFloor = Queue::getNextFloorFromDb();

            /* Make sure nextFloor != 0 */
            if ($this->nextFloor == 0){ 
                throw new Exception("Next floor call was 0");
            }
            Queue::setCurrentOnDb($this->nextFloor);
            Queue::removeFloorFromQueue();
        }

    }


?>