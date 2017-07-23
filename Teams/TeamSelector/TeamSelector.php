<?php
/**
 * Created by PhpStorm.
 * User: nrayan
 * Date: 7/13/17
 * Time: 4:02 PM
 */

namespace Teams\TeamSelector;


use Team\Team;

class TeamSelector extends Team
{
    function GetTeamByID($id)
    {
        if (self::CheckTeamExistsByID($id)) {

            $query = "SELECT * FROM club WHERE club_id = ? LIMIT 1";
            $this->connect->query($query, $id);

            if ($this->connect->rowCount() != 0) {

                return $this->connect->fetch();
            }
        } else {

            return ["success" => false, "message" => "No club with that ID has been found."];
        }
    }
}