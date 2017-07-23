<?php
/**
 * Created by PhpStorm.
 * User: nrayan
 * Date: 7/17/17
 * Time: 8:50 PM
 */

namespace Stadiums\StadiumManager;

use Database\ConnectToDatabase as DB;
use Google\GoogleAPI;


class StadiumManager
{
    public $connect;
    public $api;

    function __construct()
    {
        $this->connect = new DB("ebdb");
        $this->api = new GoogleAPI();
    }

    function InsertStadiumRecord($args)
    {
        $query = "INSERT INTO stadium (stadium_id, stadium_name, stadium_address) VALUES (?, ?, ?)";

        $insert = [

            $args['stadium_id'],
            $args['stadium'],
            $this->api->GetStadiumLocation($args['stadium'])
        ];

        $this->connect->query($query, $insert);
    }
}