<?php

declare(strict_types=1);

use Temporal\Testing\Environment;

require __DIR__ . '/../vendor/autoload.php';

$environment = Environment::create();

$environment->startTemporalTestServer();
$environment->startRoadRunner(
    rrCommand: './rr serve -c .rr.tests.yaml -w tests',
    commandTimeout: 5
);

register_shutdown_function(
    static function () use ($environment): void {
        $environment->stop();
    },
);
