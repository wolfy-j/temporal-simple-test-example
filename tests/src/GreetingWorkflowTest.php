<?php

namespace App\Tests;

use App\Workflow\GreetingWorkflowInterface;
use PHPUnit\Framework\TestCase;
use Temporal\Client\GRPC\ServiceClient;
use Temporal\Client\WorkflowClient;
use Temporal\Client\WorkflowOptions;
use Temporal\Testing\ActivityMocker;

class GreetingWorkflowTest extends TestCase
{
    private WorkflowClient $workflowClient;
    private ActivityMocker $activityMocks;

    protected function setUp(): void
    {
        $this->workflowClient = new WorkflowClient(
            ServiceClient::create(getenv('TEMPORAL_ADDRESS')),
        );

        $this->activityMocks = new ActivityMocker();

        parent::setUp();
    }

    protected function tearDown(): void
    {
        $this->activityMocks->clear();
        parent::tearDown();
    }

    public function testWorkflowReturnsUpperCasedInput(): void
    {
        $this->activityMocks->expectCompletion(
            'SimpleActivity.ComposeGreeting',
            'mocked response',
        );

        $workflow = $this->workflowClient
            ->newWorkflowStub(
                GreetingWorkflowInterface::class,
                WorkflowOptions::new()->withTaskQueue('tests'),
            );

        $run = $this->workflowClient->start($workflow, 'abc');

        $this->assertSame('mocked response', $run->getResult('string'));
    }
}
