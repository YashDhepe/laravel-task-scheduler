<?php

// App\Jobs\SendOverdueTaskNotifications.php

namespace App\Jobs;

use App\Models\Task;
use App\Models\TaskUser;
use App\Models\User;
use App\Notifications\SendOverdueTaskNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendOverdueTaskJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $userTasks = TaskUser::with(['task', 'user'])
            ->whereHas('task', function ($query) {
                $query->where('due_date', '<', now());
            })
            ->where('status','!=','Ready for Production Push')
            ->get();

            foreach ($userTasks as $userTask) {
                $task = Task::find($userTask->task->id);
                $assignedUser = User::find($userTask->user->id);
    
                // $assignedUser->notify(new \App\Notifications\SendOverdueTaskNotification($task));
                $assignedUser->notify(new SendOverdueTaskNotification($task));
            }
    }
}
