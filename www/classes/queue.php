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
                $query = "SELECT currentFloor FROM elevatornetwork";
                $statement = $mysqli->prepare($query);
                $statement->execute();
                $result = $statement->get_result();
                $row = mysqli_fetch_row($result);
                return $row[0];
            }

            public function setCurrentOnDb(){
                global $mysqli;
                /* Fix query */
                $query = "INSERT elevatorNetwork SET currentFloor = ?";
                $statement = $mysqli->prepare($query);
                // $statement->bind_param("i",$floor);
                $result = $statement->execute();
                // return $result;
            }

            public function requestFloorOnDb($floor){

            }
    }
?>