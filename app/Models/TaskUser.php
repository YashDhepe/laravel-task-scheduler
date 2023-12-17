<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Request;

class TaskUser extends Pivot
{
    use HasFactory;
    protected $fillable = ['status'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedByUser()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function scopeFilter($q,$request){
        return $q->when(strpos($request->route()->getName(), 'my-tasks'), function ($q) {
            $q->where('user_id',auth()->user()->id);
        })
        ->when(strpos($request->route()->getName(), 'index'), function ($q) {
            $q->where('assigned_by',auth()->user()->id);
        })
        ->when(strpos($request->route()->getName(), 'to-do'), function ($q) {
            $q->where('status','To-Do');
        })
        ->when(strpos($request->route()->getName(), 'in-progress'), function ($q) {
            $q->where('status','In-Progress');
        })
        ->when(strpos($request->route()->getName(), 'ready-for-qa'), function ($q) {
            $q->where('status','Ready for QA');
        })
        ->when(strpos($request->route()->getName(), 'ready-for-production'), function ($q) {
            $q->where('status','Ready for Production Push');
        });
    }
}
