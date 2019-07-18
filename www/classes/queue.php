<?php

class Queue
{
    public function setRequestOnDb($floor)
    {
        try {
            global $mysqli;
            mysqli_begin_transaction($mysqli);
            $query = "INSERT INTO `floorqueue`(nodeID) VALUES (?);";
            $statement = $mysqli->prepare($query);
            $statement->bind_param("i", $floor);
            $statement->execute();
            $mysqli->commit();
        } catch (Exception $exception) {
            $mysqli->rollback();
        }
    }

    public function getCurrentFromDb()
    {
        try {
            global $mysqli;
            mysqli_begin_transaction($mysqli);

            $query = "SELECT currentFloor FROM elevatornetwork WHERE nodeID = 1";
            $statement = $mysqli->prepare($query);
            $statement->execute();
            $mysqli->commit();
            $result = $statement->get_result();
            $row = mysqli_fetch_row($result);

            if ($row[0] === NULL || $row[0] === NAN) {
                throw new Exception("No value was grabbed from the database");
            }

            if ($row[0] > 3 || $row[0] < 1) {
                throw new Exception("Value grabbed was outside of range for values");
            }
            return $row[0];
        } catch (Exception $exception) {
            $mysqli->rollback();
            return $exception;
        }

    }

    public function setCurrentOnDb($floor)
    {
        try {
            global $mysqli;
            mysqli_begin_transaction($mysqli);

            $query = "UPDATE elevatornetwork SET currentFloor = ?";
            $statement = $mysqli->prepare($query);
            $statement->bind_param("i", $floor);
            $statement->execute();
            $mysqli->commit();
        } catch (Exception $exception) {
            $mysqli->rollback();
            return $exception;
        }
    }

    public function getNextFloorFromDb()
    {
        try {
            global $mysqli;
            mysqli_begin_transaction($mysqli);

            $query = "SELECT nodeID FROM floorqueue LIMIT 1";
            $statement = $mysqli->prepare($query);
            $statement->execute();
            $mysqli->commit();

            $result = $statement->get_result();
            $row = mysqli_fetch_row($result);
            return $row[0];
        } catch (Exception $exception) {
            $mysqli->rollback();
            return $exception;
        }
    }

    public function removeFloorFromQueue()
    {
        try {
            global $mysqli;
            mysqli_begin_transaction($mysqli);

            $query = "DELETE FROM floorqueue LIMIT 1";
            $statement = $mysqli->prepare($query);
            $statement->execute();
            $mysqli->commit();

        } catch (Exception $exception) {
            $mysqli->rollback();
        }
    }

    public function removeFloorFromQueueById($id)
    {
        try {
            global $mysqli;
            mysqli_begin_transaction($mysqli);

            $query = "DELETE FROM floorqueue WHERE id = ?";
            $statement = $mysqli->prepare($query);
            $statement->bind_param("i", $id);
            $statement->execute();
            $mysqli->commit();

        } catch (Exception $exception) {
            $mysqli->rollback();
        }
    }

    public function getQueueFromDb()
    {
        try {
            global $mysqli;
            mysqli_begin_transaction($mysqli);

            $query = "SELECT * FROM floorqueue";
            $entries = array();
            $statement = $mysqli->prepare($query);
            $statement->execute();
            $mysqli->commit();
            $result = $statement->get_result();
            while ($row = mysqli_fetch_assoc($result)) {
                $entries[] = $row;
            }
            if ($entries === NULL) {
                throw new Exception("No array found in database");
            }

            return json_encode($entries);
        }
        catch (Exception $exception) {
            $mysqli->rollback();
            return $exception;
        }
    }
}

?>