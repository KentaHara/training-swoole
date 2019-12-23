#!/usr/bin/env php
<?php

/**
 * - mode
 *   SWOOLE_PROCESS
 *     multiple process mode, the business logic is running in child processes, the default running mode of server
 *   SWOOLE_BASE
 *     reactor based mode, the business logic is running in the reactor
 */
// $http = new swoole_http_server("0.0.0.0", 80, SWOOLE_BASE, SWOOLE_SOCK_TCP);
$http = new swoole_http_server("0.0.0.0", 80, SWOOLE_PROCESS, SWOOLE_SOCK_TCP);

$http->set(
    [
        'worker_num'      => 50,
            // 'max_request'     => 50,
        // no limit
        'max_request'     => 0,
        'reload_async'    => true,
        'debug_mode'      => 1,
        /**
         * 1: round robin assignment
         * 2: assignment by mod
         * 3: preemptive assignment
         */
        'dispatch_mode'   => 3,
    ]
);

$http->on("Request", function ($request, $response) {
    $uri = $request->server['request_uri'];
    // echo '[Request]' . PHP_EOL;
    // usleep(1000000);
    $response->header("Content-Type", "text/plain");
    $response->end("Hello Worlds\n");
});

$http->on('Start', function ($server) {
    echo "Swoole http server is started at http://127.0.0.1:80\n";
    // echo '[Start]' . PHP_EOL;
});
$http->on('Shutdown', function (swoole_server $server) {
    echo '[Shutdown]' . PHP_EOL;
});


/**
 * Worker: request単位で実行
 * - worker start: worker起動時に起動
 * - worker stop: requestを処理した段階でworkerがstopして、worker startが走る
 */
$http->on('WorkerStart', function ($serv, $worker_id) {
    echo '[WorkerStart]' . $worker_id . ' ' . $serv->setting['worker_num'] . PHP_EOL;
});
$http->on('WorkerStop', function ($serv, $worker_id) {
    echo '[WorkerStop]' . $worker_id . ' ' . $serv->setting['worker_num'] . PHP_EOL;
});

$http->start();
