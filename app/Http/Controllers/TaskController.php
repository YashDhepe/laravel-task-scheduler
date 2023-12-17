<?php

namespace App\Http\Controllers;

use App\DataTables\TaskDataTable;
use App\DataTables\TaskUserDataTable;
use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskAssignedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, TaskDataTable $dataTable)
    {
        $pageConfigs = ['has_table' => true, 'title' => 'Tasks', 'has_sweetAlert' => true];
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], [$pageConfigs['title'] => "javascript:void(0)", 'name' => $pageConfigs['title']]
        ];

        return $dataTable->render('content.tasks.index', compact('pageConfigs', 'breadcrumbs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required',
        ]);
        
        $record = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'created_by' => auth()->user()->id
        ]);

        return redirect()->route('tasks.index');
    }

    public function edit(Request $request)
    {
        $record = Task::find($request->id);
        return response()->json($record);
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required',
        ]);

        $record = Task::find($request->id);
        $record->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'created_by' => auth()->user()->id
        ]);

        return redirect()->route('tasks.index');
    }

    public function delete(Request $request)
    {
        $record = Task::find($request->id);
        return $record->delete();
    }

    public function restore(Request $request)
    {
        $record = Task::withTrashed()->find($request->id)->restore();
        return $record;
    }

}
