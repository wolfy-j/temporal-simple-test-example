<?php

declare(strict_types=1);

namespace App\Workflow;

use Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;

#[WorkflowInterface]
interface GreetingWorkflowInterface
{
    #[WorkflowMethod(name: "SimpleActivity.greet")]
    public function greet(string $name);
}
