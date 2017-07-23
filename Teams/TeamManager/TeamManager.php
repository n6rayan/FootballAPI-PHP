<?php
/**
 * Created by PhpStorm.
 * User: nrayan
 * Date: 7/10/17
 * Time: 6:55 PM
 */

namespace Teams\TeamManager;

use Team\Team;
use \Firebase\JWT\JWT;

class TeamManager extends Team
{
    function InsertTeamRecord($args)
    {

        if (self::CheckTeamExistsByName($args['club_name'])) {

            return ["success" => false, "message" => "The team with name: " . $args['club_name'] . " already exists."];
        } else {

            $query = "INSERT INTO club (club_id, club_name, location, league, manager, created_by, created_at, stadium_id)
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $club_id = self::CreateUniqueID($args['club_name']);
            $stadium_id = self::CreateUniqueID($args['stadium']);
            $insert = [

                $club_id,
                $args['club_name'],
                $args['location'],
                $args['league'],
                $args['manager'],
                $args['created_by'],
                time(),
                $stadium_id
            ];
            $this->stadium->InsertStadiumRecord(['stadium_id' => $stadium_id, 'stadium' => $args['stadium']]);
            $this->connect->query($query, $insert);

            if ($this->connect->rowCount() != 0) {

                return ["success" => true, "message" => "The team has successfully been inserted to the database."];
            } else {

                return ["success" => false, "message" => "Something went wrong."];
            }
        }
    }

    function CreateUniqueID($key)
    {
        $min = $this->timestamp->getTimestamp();
        $max = $min + 1234567890;
        $id = rand($min, $max);
        $token = [

            "iss" => "football-api.dev",
            "aud" => "football-api.co.uk",
            "iat" => $id,
            "nbf" => $id,
        ];
        $jwt = JWT::encode($token, $key);
        $unique_id = substr(hash('md5', $jwt), 0, 20);

        return $unique_id;
    }
}