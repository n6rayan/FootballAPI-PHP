<?php
/**
 * Created by PhpStorm.
 * User: nrayan
 * Date: 7/10/17
 * Time: 5:49 PM
 */

namespace Database;


class SQLConfig
{
    // Whether dev environment is active or not... 1 is yes, 0 is no
    static $dev = 0;

    // Dev Environment Details
    static $devhost = 'localhost';
    static $devusername = 'root';
    static $devpassword = '';

    // Live Environment Details
    static $host = 'aa1bcub81fhlhqj.cs0l0tazw3io.eu-west-2.rds.amazonaws.com';
    static $username = 'root';
    static $password = 'Mercurial666Nour';
}