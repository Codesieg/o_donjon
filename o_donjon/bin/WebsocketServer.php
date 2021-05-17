<?php
require dirname( __DIR__ ) . '/vendor/autoload.php';

use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use App\Websocket\ServerHandler;


        $port = 8000;
        // $output->writeln("Starting server on port " . $port);
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new ServerHandler()
                )
            ),
            $port
        );
        echo ("Websocket server is running");
        $server->run();
        return 0;
    
