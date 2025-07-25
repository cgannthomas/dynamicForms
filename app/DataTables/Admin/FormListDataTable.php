<?php

namespace App\DataTables\Admin;

use App\Models\Form;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class FormListDataTable extends DataTable
{

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function (Form $form) {
                return view('components.datatable_actions', ['id' => $form->id, 'path' => 'admin.forms']);
            })
            ->editColumn('status', function ($row) {
                $class = 'danger';
                $viewText = 'In-Active';
                if($row->is_active == 1) {
                    $class = 'success';
                    $viewText = 'Active';
                }
                return '<span class="badge badge-light-'. $class .' fs-7 fw-bolder">'. $viewText .'</span>';
            })
            ->addIndexColumn()
            ->rawColumns(['status']);
    }

     /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Admin $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Form $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('form-list-table')
            ->columns($this->getColumns())
            ->minifiedAjax();
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')
                ->title('#')
                ->searchable(false)
                ->orderable(false),
            Column::make('form_name'),
            Column::make('status')->searchable(false),
            Column::computed('action')
                ->width(60)
                ->addClass('text-center'),
        ];
    }

}