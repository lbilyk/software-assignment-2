<?php 
    class Node {
        private $currentFloor;
        private $validFlag;
        protected $floorNum;

        public function __construct($floor = 1){
            $this->floorNum = $floor;
        }

        public function getCurrentFloor(){
            try{
                $this->currentFloor = Queue::getCurrentFromDb();
                return $this->currentFloor;
            }
            catch(Exception $e){
                echo 'Error:' .$e->getMessage();
            }
        }

        protected function checkValid(){

            $current = $this->getCurrentFloor();

            if ($current != $this->floorNum){                
                $this->validFlag = true;
            }else{
                $this->validFlag = false;
            }
        }

        public function requestFloor(){

            $this->checkValid();

            if ($this->validFlag != true){
                throw new Exception("Floor call was invalid");
            }
                Queue::setRequestOnDb($this->floorNum);
                echo "Requested floor ". $this->floorNum . "</br>";
        }

        protected function setCurrentFloor(){
            Queue::setCurrentOnDb($this->floorNum);
        }

    }


?>