<?php
/**
 * Created by PhpStorm.
 * User: nrayan
 * Date: 7/10/17
 * Time: 5:29 PM
 */

require __DIR__ . "/../vendor/autoload.php";

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Teams\TeamManager\TeamManager as TeamManager;
use Teams\TeamSelector\TeamSelector as TeamSelector;

$app = new \Slim\App;

// ------ Start API Calls ------
$app->post('/api/insertTeam', function (Request $request, Response $response) {

    header('Content-Type: application/json;charset=utf-8');
    $team = new TeamManager;
    $teamResponse = $team->InsertTeamRecord($request->getParsedBody());

    return $response->getBody()->write(json_encode($teamResponse));
});

$app->get('/api/team/{id}', function (Request $request, Response $response) {

    header('Content-Type: application/json;charset=utf-8');
    $id = $request->getAttribute('id');

    $team = new TeamSelector;
    $teamResponse = $team->GetTeamByID($id);

    $response->withHeader('Content-Type:', 'application/json');

    return $response->getBody()->write(json_encode($teamResponse));
});
// ------ End API Calls ------

$app->run();