<?php
class Db
{
    // Database connection variable
    protected static $connection;

    // Connection initialization function
    public function connect()
    {
        if (!isset(self::$connection)) {
            self::$connection = new mysqli("localhost", "root", "", "demo_lap3");
            mysqli_set_charset(self::$connection, 'utf8');

            // Check connection
            if (mysqli_connect_errno()) {
                echo "Database connection failed: " . mysqli_connect_error();
                exit;
            }
        }
        return self::$connection;
    }

    // The function executes the query statement
    public function query_execute($queryString)
    {
        // Initiate connection
        $connection = $this->connect();
        // Execute query execution, query is a function of mysqli library
        $result = $connection->query($queryString);
        return $result;
    }

    // The implementation function returns an array of result lists
    public function select_to_array($queryString)
    {
        $rows = [];
        $result = $this->query_execute($queryString);
        if ($result == false) return false;
        // while loop is used to output the data array to each element
        while ($item = $result->fetch_assoc()) {
            $rows[] = $item;
        }
        return $rows;
    }
}
