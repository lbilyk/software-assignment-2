<?php 
    class Node {
        private $currentFloor;
        private $validFlag;
        protected $floorNum;

        public function __construct($floor = 1){
            $this->floorNum = $floor;
        }

        public function getCurrentFloor(){

            $this->currentFloor = Queue::getCurrentFromDb();

            return $this->currentFloor;
        }

        private function checkValid(){

            $current = $this->getCurrentFloor();

            if ($current != $this->floorNum){                
                $this->validFlag = true;
            }else{
                $this->validFlag = false;
            }
        }

        public function requestFloor(){

            $this->checkValid();

            if ($this->validFlag == true){

                Queue::setRequestOnDb($this->floorNum);
                echo "Requested floor ". $this->floorNum . "</br>";

            }else{
                // throw error
            }
        }

        public function setCurrentFloor(){
            Queue::setCurrentOnDb($this->floorNum);
        }

        public function moveElevator(){
            $nextFloor = Queue::getNextFloorFromDb();

            /* Make sure nextFloor != 0 */
            if ($nextFloor != 0){
                Queue::setCurrentOnDb($nextFloor);
                Queue::removeFloorFromQueue();
            } 

        }



    }


?>