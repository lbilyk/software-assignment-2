<?php 
    class Node {
        private $currentFloor;
        private $validFlag;
        protected $floorNum;

        public function __construct($floor){
            $this->floorNum = $floor;
        }

        public function getCurrentFloor(){

            $this->currentFloor = Queue::getCurrentFromDb();
            echo $this->currentFloor;
            // $this->currentFloor = 2;

            /* return currentFloor */
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

               // Queue::requestFloorOnDb($this->floorNum);
                echo "Requested floor ". $this->floorNum . "</br>";

            }else{
                // throw error
            }
        }
    }


?>