# Training swoole

## setup phpcs

```sh
./vendor/bin/phpcs --config-set installed_paths `pwd -P`/vendor/phpcompatibility/php-compatibility
```

## restart server

```bash
$ docker exec -it docker_training-swoole-api_1 /bin/bash
```

```bash
supervisorctl
restart swoole
```


## 要調査

```zsh
$ ab -n 10000 -c 10 http://localhost/
```

```text
This is ApacheBench, Version 2.3 <$Revision: 1843412 $>
Copyright 1996 Adam Twiss, Zeus Technology Ltd, http://www.zeustech.net/
Licensed to The Apache Software Foundation, http://www.apache.org/

Benchmarking localhost (be patient)
Completed 1000 requests
Completed 2000 requests
Completed 3000 requests
Completed 4000 requests
Completed 5000 requests
Completed 6000 requests
Completed 7000 requests
Completed 8000 requests
apr_socket_recv: Operation timed out (60)
Total of 8192 requests completed
```

```log
training-swoole-api_1  | [2019-12-21 14:55:17 *67.5]    NOTICE  swFactoryProcess_finish (ERRNO 1005): connection[fd=26] does not exists
training-swoole-api_1  | [2019-12-21 14:55:17 *65.3]    NOTICE  swFactoryProcess_finish (ERRNO 1005): connection[fd=24] does not exists
training-swoole-api_1  | [2019-12-21 14:55:17 *71.9]    NOTICE  swFactoryProcess_finish (ERRNO 1005): connection[fd=20] does not exists
training-swoole-api_1  | [2019-12-21 14:55:17 #53.0]    NOTICE  swServer_master_send (ERRNO 1005): send event$[4] failed, session#551 does not exist
training-swoole-api_1  | [2019-12-21 14:55:17 *87.4]    NOTICE  swFactoryProcess_finish (ERRNO 1005): connection[fd=575] does not exists
training-swoole-api_1  | [2019-12-21 14:55:17 *91.7]    NOTICE  swFactoryProcess_finish (ERRNO 1005): connection[fd=588] does not exists
training-swoole-api_1  | [2019-12-21 14:55:18 *101.4]   NOTICE  swFactoryProcess_finish (ERRNO 1005): connection[fd=1116] does not exists
training-swoole-api_1  | [2019-12-21 14:55:18 #53.1]    NOTICE  swServer_master_send (ERRNO 1005): send event$[4] failed, session#1145 does not exist
training-swoole-api_1  | [2019-12-21 14:55:18 *116.6]   NOTICE  swFactoryProcess_finish (ERRNO 1005): connection[fd=1326] does not exists
training-swoole-api_1  | [2019-12-21 14:55:19 #53.0]    NOTICE  swServer_master_send (ERRNO 1005): send event$[4] failed, session#2567 does not exist
training-swoole-api_1  | [2019-12-21 14:55:24 *257.2]   NOTICE  swFactoryProcess_finish (ERRNO 1005): connection[fd=5823] does not exists
training-swoole-api_1  | [2019-12-21 14:55:27 *281.5]   NOTICE  swFactoryProcess_finish (ERRNO 1005): connection[fd=6686] does not exists
```
