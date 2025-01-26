<?php

namespace App\DataTables;

use App\Models\CustomField;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Log;
use App\Services\CustomFieldService;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class CustomFieldsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('check_box', function (CustomField $customField) {
                return view(
                    'layouts.components._datatable-checkbox',
                    ['name' => "customFields[]", 'value' => $customField->id]
                );
            })
            ->addColumn('action', function (CustomField $customField) {
                return view(
                    'layouts.dashboard.customField.components._actions',
                    ['model' => $customField, 'url' => route('custom-fields.destroy', $customField->id)]
                );
            })
            ->setRowId('id');
    }
     /**
     * Get the query source of dataTable.
     */
    public function query(CustomFieldService $customFieldService): QueryBuilder
    {
        return  $customFieldService->datatable([], []);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('customFields-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }
    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('check_box')->title('<label class="custom-control custom-checkbox custom-control-md">
            <input type="checkbox" class="custom-control-input checkAll">
            <span class="custom-control-label custom-control-label-md  tx-17"></span></label>')->searchable(false)->orderable(false),
            Column::make('id'),
            Column::make('name'),
            Column::make('type'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'customFields' . date('YmdHis');
    }

}
