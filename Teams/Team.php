<?php
/**
 * Created by PhpStorm.
 * User: nrayan
 * Date: 7/12/17
 * Time: 1:46 PM
 */

namespace Team;

use Database\ConnectToDatabase as DB;
use Stadiums\StadiumManager\StadiumManager;
use Google\GoogleAPI;

class Team
{
    public $connect;
    public $timestamp;
    public $stadium;
    public $api;

    public function __construct()
    {
        $this->connect = new DB("ebdb");
        $this->timestamp = new \DateTime();
        $this->stadium = new StadiumManager();
        $this->api = new GoogleAPI();
    }

    protected function CheckTeamExistsByName($teamName)
    {
        $query = "SELECT club_id, club_name FROM club WHERE club_name = ? LIMIT 1";
        $this->connect->query($query, $teamName);

        if ($this->connect->rowCount() != 0) {

            $result = $this->connect->fetch();
            return ["clubName" => $result['club_name']];
        } else {

            return false;
        }
    }

    protected function CheckTeamExistsByID($id)
    {
        $query = "SELECT club_id, club_name FROM club WHERE club_id = ? LIMIT 1";
        $this->connect->query($query, $id);

        if ($this->connect->rowCount() != 0) {

            $result = $this->connect->fetch();
            return ["clubName" => $result['club_name']];
        } else {

            return false;
        }
    }
}