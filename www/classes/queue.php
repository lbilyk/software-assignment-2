<?php 
    class Queue 
    {
            public function setRequestOnDb($floor){
                global $mysqli;
                $query = "INSERT INTO `floorqueue`(nodeID) VALUES (?);";
                $statement = $mysqli->prepare($query);
                $statement->bind_param("i",$floor);
                $statement->execute();

                // $result = $statement->get_result();

                // return $result;
            }

            public function getCurrentFromDb(){
                global $mysqli;
                $query = "SELECT currentFloor FROM elevatornetwork WHERE nodeID = 1";
                $statement = $mysqli->prepare($query);
                $statement->execute();
                $result = $statement->get_result();
                $row = mysqli_fetch_row($result);

                return $row[0];
            }

            public function setCurrentOnDb($floor){
                global $mysqli;
                $query = "UPDATE elevatornetwork SET currentFloor = ?";
                $statement = $mysqli->prepare($query);
                $statement->bind_param("i",$floor);
                $result = $statement->execute();
            }

            public function getNextFloorFromDb(){
                global $mysqli;
                $query = "SELECT nodeID FROM floorqueue LIMIT 1";
                $statement = $mysqli->prepare($query);
                $statement->execute();
                $result = $statement->get_result();
                $row = mysqli_fetch_row($result);
                return $row[0];
            }

            public function removeFloorFromQueue(){
                global $mysqli;
                $query = "DELETE FROM floorqueue LIMIT 1";
                $statement = $mysqli->prepare($query);
                $statement->execute();
                // $result = $statement->get_result();
                // $row = mysqli_fetch_row($result);
                // return $row[0];
            }

            public function removeFloorFromQueueById($id){
                global $mysqli;
                $query = "DELETE FROM floorqueue WHERE id = ?";
                $statement = $mysqli->prepare($query);
                $statement->bind_param("i",$id);
                $statement->execute();
            }

            public function getQueueFromDb(){
                global $mysqli;
                $query = "SELECT * FROM floorqueue";
                $entries = array();
                $statement = $mysqli->prepare($query);
                $statement->execute();
                $result = $statement->get_result();
                while($row = mysqli_fetch_assoc($result)) {
                    $entries[] = $row;
                }
                return json_encode($entries);
            }

    }
?>