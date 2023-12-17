<?php

namespace App\DataTables;

use App\Models\Task as ModelsTask;
use Task;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class TaskDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable(QueryBuilder $query, Request $request): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('description', function ($row) {
                return '<button data-bs-toggle="modal" data-bs-target="#view-modal" data-description="'.$row->description.'" data-id="' . $row->id . '" class="btn btn-sm btn-outline-primary viewRecordDescription">View</button>';
            })
            ->addColumn('edit', function ($row) {
                return '<button data-bs-toggle="modal" data-bs-target="#edit-modal"  data-id="' . $row->id . '" class="btn btn-sm btn-outline-primary editRecord">Edit</button>';
            })
            ->addColumn('action', function ($row) use ($request) {
                if (strpos($request->route()->getName(), 'deleted')) {
                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Restore" class="btn btn-outline-warning btn-sm restoreRecord">Restore</a>';
                } else {
                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-outline-danger btn-sm deleteRecord">Delete</a>';
                }
                return $btn;
            })
            ->editColumn('due_date', function ($data) {
                return  '<span class="badge bg-warning text-dark">' . date("j F, Y", strtotime($data->due_date)) . '</span>';
            })
            ->editColumn('created_at', function ($data) {
                return  '<span class="badge badge-info text-dark">' . date("j F, Y, g:i a", strtotime($data->created_at)) . '</span>';
            })
            ->editColumn('updated_at', function ($data) {
                return  '<span class="badge badge-info text-dark">' . date("j F, Y, g:i a", strtotime($data->updated_at)) . '</span>';
            })
            ->rawColumns(['description','due_date','edit', 'action', 'created_at', 'updated_at'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Task $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ModelsTask $model, Request $request): QueryBuilder
    {
        return $model->where('created_by',auth()->user()->id)->when(strpos($request->route()->getName(), 'deleted'), function ($q) {
            $q->onlyTrashed();
        });
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {

        $buttons = [
            ['extend' => 'csv', 'className' => 'btn btn-primary btn-sm', 'text' => '<span><i class="fa fa-download"></i> Csv&nbsp;<span class="caret"></span></span>'],
            ['extend' => 'excel', 'className' => 'btn btn-primary btn-sm', 'text' => '<span><i class="fa fa-download"></i> Excel&nbsp;<span class="caret"></span></span>'],
            ['extend' => 'print', 'className' => 'btn btn-primary btn-sm', 'text' => '<span><i class="fa fa-print"></i> Print</span>'],
            ['extend' => 'reload', 'className' => 'btn btn-primary btn-sm d-none reload', 'text' => '<span><i class="fa fa-refresh"></i> Refresh </span>'],
            ['extend' => 'pageLength', 'className' => 'btn btn-primary btn-sm'],
            ['text' => 'Add', 'className' => 'btn btn-primary btn-sm add-btn', 'text' => '<span><i class="fa fa-plus"></i> Add</span>']
        ];

        return $this->builder()
            ->setTableId('unit-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(0)
            ->parameters([
                'scrollX' => true,
                'paging' => true,
                'dom'  => 'Bfrtip',
                'lengthMenu' => [
                    [10, 25, 50, -1],
                    ['10 rows', '25 rows', '50 rows', 'Show all']
                ],
                'buttons'   => $buttons,
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('title'),
            Column::make('description'),
            Column::make('due_date'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::make('edit')
                ->exportable(false)
                ->printable(false),
            Column::make('action')
                ->exportable(false)
                ->printable(false)
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Task_' . date('YmdHis');
    }
}
