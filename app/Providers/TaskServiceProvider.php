<?php

namespace App\Providers;

use App\Adapters\TaskGatewayEloquent;
use Hexagonal\Task\Adapter\TaskValitronValidator;
use Hexagonal\Task\TaskRepository;
use Hexagonal\Task\TaskService;
use Illuminate\Support\ServiceProvider;

class TaskServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Service\Task', function () {
            $gateway = new TaskGatewayEloquent;
            $repository = new TaskRepository($gateway);
            return new TaskService($repository, new TaskValitronValidator);
        });
    }
}
