<?php
$worker =new GearmanWorker();
$worker->addServer();
    $worker->addFunction('syncToRedis','syncToRedis');
    $worker->addFunction('updateToRedis','updateToRedis');
    $worker->addFunction('delToRedis','delToRedis');
   $redis =new Redis();
    $redis->connect('127.0.0.1',6379);
    while($worker->work());
    function syncToRedis($job)
    {
        global $redis;
        $workString = $job->workload();
        $work = json_decode($workString);
        $redis->hSet('age',$work->name,$work->age);
    }

    function updateToRedis($job)
    {
        global $redis;
        $workString = $job->workload();
        $work = json_decode($workString);
        $redis->hDel('age',$work->oldname);
        $redis->hSet('age',$work->name,$work->age);
    }

    function delToRedis($job)
    {
        global $redis;
        $workString = $job->workload();
        $work = json_decode($workString);
        $redis->hDel('age',$work->oldname);
    }

?>
