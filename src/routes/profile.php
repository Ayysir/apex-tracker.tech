<?php 
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

// get by gamertag customers 
$app->get('/api/{platform}/{profile}', function(Request $request, Response $response){

    require '../config.php';

    $platform = $request->getAttribute('platform');
    $gamertag = $request->getAttribute('profile');

    //check if params are set
    if (isset($platform) && isset($gamertag)) {

        try {
            //store GET response
            $gResponse = $client->get($platform.'/'.$gamertag, ['headers' => headers
            ]);

            $response->getBody()->write($gResponse->getBody());
            
            return $response;
         
        } catch (\Throwable $th) {
            //set the response body
            $responseBody = $exception->getResponse()->getBody(true);

            return $responseBody;
        }

    } else {
        $response->getBody()->write('request parameters not set');
        echo 'request parameters not set';
        return $response;
    }
    
});



