<?php

declare(strict_types=1);

use Temporal\Testing\WorkerFactory;

ini_set('display_errors', 'stderr');

require __DIR__ . '/../vendor/autoload.php';

$workerFactory = WorkerFactory::create();

$worker = $workerFactory->newWorker(taskQueue: 'tests');

// make sure to register concrete workflow implementations
$worker->registerWorkflowTypes(\App\Workflow\GreetingWorkflow::class);
$worker->registerActivity(
    \App\Activity\GreetingActivity::class,
    fn() => new \App\Activity\GreetingActivity(),
);

$workerFactory->run();
