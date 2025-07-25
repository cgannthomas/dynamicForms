<?php

namespace App\DataTables\Admin;

use App\Models\Form;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

use App\Models\FormSubmittedData;

class SubmittedDataListDataTable extends DataTable
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
            ->addColumn('action', function ($row) {
                return view('components.datatable_actions', ['id' => $row->id, 'path' => 'admin.users', 'view_delete_only' => true]);
            })
            ->addColumn('form_title', function ($row) {
                return $row->form->form_name;
            })
            ->filterColumn('form_title', function($query, $keyword) {
                $query->whereHas('form', function($q) use ($keyword) {
                    $q->where('form_name', 'like', "%{$keyword}%");
                });
            })
            ->orderColumn('form_title', function ($query, $order) {
                $query->join('forms', 'form_submitted_data.form_id', '=', 'forms.id')
                    ->orderBy('forms.form_name', $order);
            })
            ->addIndexColumn();
    }

     /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Admin $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(FormSubmittedData $model)
    {
        return $model->newQuery()->with('form');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('list-table')
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
            Column::make('form_title'),
            Column::make('submitted_data')->searchable(false)->orderable(false),
            Column::computed('action')
                ->width(60)
                ->addClass('text-center'),
        ];
    }

}