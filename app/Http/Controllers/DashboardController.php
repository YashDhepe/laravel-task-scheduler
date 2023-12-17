<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskUser;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $userCount = User::count();
        $taskCount = Task::where('created_by', auth()->user()->id)->count();
        $assignedTaskCount = TaskUser::where('user_id', auth()->user()->id)->count();

        $todoTaskCount = TaskUser::where([['status','To-Do']])->filter($request)->count();
        $inProgreeTaskCount = TaskUser::where([['status','In-Progress']])->filter($request)->count();
        $readyForQaTaskCount = TaskUser::where([['status','Ready for QA']])->filter($request)->count();
        $readyForProductionTaskCount = TaskUser::where([['status','Ready for Production Push']])->filter($request)->count();

        $dashboardCards = [
            'dashboard_statistics' => [
                [
                    'card_title' => 'Total Users',
                    'card_value' => $userCount,
                    'card_route' => route('users.index')
                ],
                [
                    'card_title' => 'Total Tasks',
                    'card_value' => $taskCount,
                    'card_route' => route('tasks.index')
                ],
                [
                    'card_title' => 'Assigned Tasks',
                    'card_value' => $assignedTaskCount,
                    'card_route' => route('tasks.assign.index')
                ],
            ],
            'assigned_tasks_statistics' => [
                [
                    'card_title' => 'To-Do Tasks',
                    'card_value' => $todoTaskCount,
                    'card_route' => route('tasks.assign.to-do')
                ],
                [
                    'card_title' => 'In-Progress Tasks',
                    'card_value' => $inProgreeTaskCount,
                    'card_route' => route('tasks.assign.in-progress')
                ],
                [
                    'card_title' => 'Ready for QA Tasks',
                    'card_value' => $readyForQaTaskCount,
                    'card_route' => route('tasks.assign.ready-for-qa')
                ],
                [
                    'card_title' => 'Ready for Production Push',
                    'card_value' => $readyForProductionTaskCount,
                    'card_route' => route('tasks.assign.ready-for-production')
                ],
            ]
        ];

        return view('content.dashboard', compact('dashboardCards'));
    }
}
