<?php
/**
 * Created by PhpStorm.
 * User: nrayan
 * Date: 7/10/17
 * Time: 6:26 PM
 */

namespace Database;

use PDO;
use PDOException;

class ConnectToDatabase
{
    public $db;
    public $query;

    function __construct($database)
    {
        $host = SQLConfig::$dev == 1 ? SQLConfig::$devhost : SQLConfig::$host;
        $username = SQLConfig::$dev == 1 ? SQLConfig::$devusername : SQLConfig::$username;
        $password = SQLConfig::$dev == 1 ? SQLConfig::$devpassword : SQLConfig::$password;

        try {

            $this->db = new PDO("mysql:host=$host;dbname=$database", $username, $password);
            // set the PDO error mode to exception
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {

            echo "Connection failed: " . $e->getMessage();
        }
    }

    function query($query, $args = '')
    {
        $count = ($args == "") && ($args != 0) ? 0 : count($args);

        $x = 1;
            if ($count > 1) {
                $this->query = $this->db->prepare($query);
                while ($x <= $count) {
                    $this->query->bindValue($x, $args[$x - 1], PDO::PARAM_STR);
                    $x++;
                }
                $this->query->execute();

            } else if ($count == 1) {

                $this->query = $this->db->prepare($query);
                $this->query->bindValue(1, $args, PDO::PARAM_STR);
                $this->query->execute();

            } else if ($count == 0) {
                //
                $this->query = $this->db->query($query);
            }
    }

    function rowCount()
    {
        // Returns the total count of the rows matching the query.
        return $this->query->rowCount();
    }

    function fetchCount()
    {
        // Fetches the first column that matches query.
        return $this->query->fetchColumn();
    }

    function fetch()
    {
        // Fetches the first row matching the query
        return $this->query->fetch(PDO::FETCH_ASSOC);
    }

    function fetchAll()
    {
        // Fetches all rows matching the query.
        return $this->query->fetchAll();
    }

    function last_id()
    {
        // Gets the last inserted ID.
        return $this->db->lastInsertId();
    }
}