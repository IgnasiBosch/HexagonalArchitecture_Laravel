<?php

namespace App\Http\Controllers;

use Hexagonal\Common\ValidationException;
use Hexagonal\Task\TaskService;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\App;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var TaskService
     */
    private $taskService;

    public function __construct()
    {
        $app = App::getFacadeRoot();
        $this->taskService = $app->make('Service\Task');
    }

    public function index()
    {
        $tasks = $this->taskService->findAll();
        return view('tasks', ['tasks' => $tasks]);
    }

    public function save(Request $request)
    {
        try {
            $this->taskService->saveFromAssoc($request->all());
        } catch (ValidationException $ex) {
            return back()->withErrors(collect($ex->getErrors()['description']));
        }
        return redirect()->route('tasks_index');

    }
}
