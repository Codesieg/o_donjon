<?php
require dirname( __DIR__ ) . '/vendor/autoload.php';

use React\Socket\Server;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use React\EventLoop\Factory;
use React\Socket\SecureServer;
use Ratchet\WebSocket\WsServer;
use App\Websocket\ServerHandler;

// $app = new HttpServer(
//     new WsServer(
//         new ServerHandler()
//     )
// );

// $loop = Factory::create();

// $secure_websockets = new Server(8000, $loop);
// $secure_websockets = new SecureServer($secure_websockets, $loop, [
//     'local_cert' => '/etc/letsencrypt/live/odonjon.fr/cert.pem',
//     'allow_self_signed' => true,
//     'verify_peer' => false
// ]);

// $secure_websockets_server = new IoServer($app, $secure_websockets, $loop);
// $secure_websockets_server->run();

        $port = 8000;
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
