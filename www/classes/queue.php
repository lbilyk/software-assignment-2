<?php 
    class Queue 
    {
            public function getNextFloor(){
                global $mysqli;
                /* Fix query  */
                $query = "SELECT requestedFloor FROM elevatorNetwork";
                $statement = $mysqli->prepare($query);
                $statement->execute();

                $result = $statement->get_result();

                return $result;
            }

            public function getCurrentFromDb(){
                global $mysqli;
                /* Fix query  */
                $query = "SELECT currentFloor FROM elevatorNetwork";
                //$statement = $mysqli->prepare($query);
                $statement->execute();

                $result = $statement->get_result();

                return $result;
            }

            public function setCurrentOnDb(){
                global $mysqli;
                /* Fix query */
                $query = "UPDATE elevatorNetwork SET currentFloor = ?";
                $statement = $mysqli->prepare($query);
                // $statement->bind_param("i",$floor);
                $result = $statement->execute();
                // return $result;
        }
    }
?>