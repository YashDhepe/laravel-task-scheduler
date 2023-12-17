<?php

namespace App\DataTables;

use App\Models\TaskUser as ModelsTaskUser;
use TaskUser;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class TaskUserDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable(QueryBuilder $query, Request $request): EloquentDataTable
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('user_name', function ($row) {
                return $row->user->name;
            })
            ->addColumn('user_email', function ($row) {
                return $row->user->email;
            })
            ->addColumn('task_title', function ($row) {
                return $row->task->title;
            })
            ->addColumn('task_description', function ($row) {
                return '<button data-bs-toggle="modal" data-bs-target="#view-modal" data-description="'.$row->task->description.'" data-id="' . $row->id . '" class="btn btn-sm btn-outline-primary viewRecordDescription">View</button>';
            })
            ->addColumn('task_status', function ($row) {
                return $row->status;
            })
            ->addColumn('assigned_by', function ($row) {
                return $row->assignedByUser->name;
            })
            ->addColumn('edit', function ($row) {
                return '<button data-bs-toggle="modal" data-bs-target="#edit-modal"  data-id="' . $row->id . '" class="btn btn-sm btn-outline-primary editRecord">Edit</button>';
            })
            ->addColumn('status', function ($row) {
                return '<button data-bs-toggle="modal" data-bs-target="#status-modal"  data-id="' . $row->id . '" class="btn btn-sm btn-outline-primary changeRecordStatus">Chnage</button>';
            })
            ->editColumn('created_at', function ($row) {
                return  '<span class="badge badge-info text-dark">' . date("j F, Y, g:i a", strtotime($row->created_at)) . '</span>';
            })
            ->editColumn('updated_at', function ($row) {
                return  '<span class="badge badge-info text-dark">' . date("j F, Y, g:i a", strtotime($row->updated_at)) . '</span>';
            })
            ->rawColumns(['status','edit','task_description','task_status', 'created_at', 'updated_at'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \TaskUser $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ModelsTaskUser $model, Request $request)
    {
        return $model->newQuery()->with(['task', 'user'])->select('task_user.*')
        // ->where('user_id',auth()->user()->id)
        // ->orWhere('assigned_by',auth()->user()->id)
        ->when(strpos($request->route()->getName(), 'my-tasks'), function ($q) {
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

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('taskuserdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('status'),
            Column::make('user_name'),
            Column::make('user_email'),
            Column::make('task_title'),
            Column::make('task_status'),
            Column::make('task_description'),
            Column::make('assigned_by'),
            Column::make('created_at'),
            Column::make('updated_at'),
            // Column::make('edit'),
            // Column::make('status')
            //     ->exportable(false)
            //     ->printable(false),
            // Column::make('action')
            //     ->exportable(false)
            //     ->printable(false)
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'TaskUser_' . date('YmdHis');
    }
}
