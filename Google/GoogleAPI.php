<?php
/**
 * Created by PhpStorm.
 * User: nrayan
 * Date: 7/13/17
 * Time: 10:48 PM
 */

namespace Google;

use Database\ConnectToDatabase as DB;
use GuzzleHttp\Client;

class GoogleAPI
{
    public $connect;
    private $client;

    function __construct()
    {
        $this->connect = new DB("ebdb");
        $this->client = new Client();
    }

    function GetStadiumLocation ($place)
    {
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?address=';
        $address = $this->client->request('GET',$url . $place);
        $response = json_decode($address->getBody());

        return $response->results[0]->formatted_address;
    }
}