<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Task;

use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    
    /**
     * The task repository instance.
     *
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * Create a new controller instance.
     *
     * @param  TaskRepository  $tasks
     * @return void
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }



	 /**
	 * Display a list of all of the user's task.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function index(Request $request)
	{
	    // $tasks = Task::all();
		// $tasks = Task::where('user_id', $request->user()->id)->get();
		$tasks = $this->tasks->forUser($request->user());

	    return view('tasks.index', [
	        'tasks' => $tasks
	    ]);
	}



	/** * Create a new task. 
	* 
	* @param Request $request 
	* @return Response 
	*/ 
	public function save(Request $request) { 
	    $this->validate($request, [
	      'name' => 'required|max:255',

	    ]);

	    // $task = new Task; 
	    // $task->name = $request->name; 
	    // $task->save();

	    $request->user()->tasks()->create([
	        'name' => $request->name,
	    ]);

	    return redirect('/tasks'); 
	}


	/**
	 * Destroy the given task.
	 *
	 * @param  Request  $request
	 * @param  Task  $task
	 * @return Response
	 */
	public function delete(Request $request, Task $task)
	{
	    $this->authorize('destroy', $task);

	    $task->delete();

	    return redirect('/tasks');
	}

}
