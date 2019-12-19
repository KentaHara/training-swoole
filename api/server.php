#!/usr/bin/env php
<?php

use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server;

$http = new Server("0.0.0.0", 80);

$http->set(
    [
        'worker_num'   => 4,
        'max_request'  => 10,
        'dispatch_mode'=> 3,
    ]
);

$http->on(
    "start",
    function (Server $http) {
        echo "Swoole HTTP server is started.\n";
    }
);
$http->on(
    "request",
    function (Request $request, Response $response) {
        sleep(1);
        $response->end("Hello, World! sleep 10!\n");
    }
);

$http->start();
