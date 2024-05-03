<?php

declare(strict_types=1);

namespace App\Activity;

use Temporal\Activity\ActivityInterface;
use Temporal\Activity\ActivityMethod;

#[ActivityInterface(prefix: 'SimpleActivity.')]
interface GreetingActivityInterface
{
    #[ActivityMethod(name: "ComposeGreeting")]
    public function composeGreeting(
        string $greeting,
        string $name,
    ): string;
}
