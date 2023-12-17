<?php

namespace App\Http\Controllers;

use App\DataTables\TaskUserDataTable;
use App\Models\Task;
use App\Models\TaskUser;
use App\Models\User;
use App\Notifications\TaskAssignedNotification;
use App\Notifications\TaskCreatedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class TaskUserController extends Controller
{

    public $statusList = [];
    public function __construct()
    {
        $this->middleware('auth');
        $this->statusList = [
            ['name' => 'To-Do'],
            ['name' => 'In-Progress'],
            ['name' => 'Ready for QA'],
            ['name' => 'Ready for Production Push'],
        ];
    }
    
    public function index(Request $request, TaskUserDataTable $dataTable,$taskId = NULL)
    {
        $pageConfigs = ['has_table' => true, 'title' => 'Assign Tasks', 'has_sweetAlert' => true];
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], [$pageConfigs['title'] => "javascript:void(0)", 'name' => $pageConfigs['title']]
        ];

        $tasks = Task::where('created_by',auth()->user()->id)->get();
        $users = User::where('id','!=',auth()->user()->id)->get();
        $statusList = $this->statusList;

        return $dataTable->render('content.tasks.assign', compact('pageConfigs', 'breadcrumbs','tasks', 'users','statusList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'task_id' => 'required|exists:tasks,id',
        ]);

        $task = Task::findOrFail($request->task_id);
        $user = User::findOrFail($request->user_id);
        $task->users()->attach($user,['assigned_by' => '1']);

        // Notify User
        $user->notify(new TaskAssignedNotification($task));
        
        // Notify 
        $loggedInUser = User::findOrFail(auth()->user()->id);
        $loggedInUser->notify(new TaskCreatedNotification($task));


        return redirect()->route('tasks.assign.index');
    }

    public function edit(Request $request)
    {
        $record = TaskUser::with(['task', 'user'])->find($request->id);
        return response()->json($record);
    }

    public function update_status(Request $request)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $record = TaskUser::find($request->id);
        $record->update([
            'status' => $request->status,
        ]);

        return redirect()->route('tasks.assign.index');
    }

    // public function update(Request $request)
    // {
    //     $request->validate([
    //         'user_id' => 'required|exists:users,id',
    //         'task_id' => 'required|exists:tasks,id',
    //     ]);

    //     $record = TaskUser::find($request->id);
    //     $record->update([
    //         'title' => $request->title,
    //         'description' => $request->description,
    //         'due_date' => $request->due_date,
    //     ]);

    //     return redirect()->route('tasks.index');
    // }

    public function delete(Request $request)
    {
        $record = Task::find($request->id);
        return $record->delete();
    }


    public function view_assigned_tasks($taskId){
        
        abort_unless(URL::hasValidSignature(request()), 403, 'Unauthorized action.');
        return redirect()->route('tasks.assign.index',['taskId' => $taskId]);
    }
}
