<?php

namespace App\DataTables;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SliderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query)) //query - model
            ->addColumn('action', function ($query){
            return "<div class='d-flex justify-content-end'>
                <a href='" . route('admin.slider.edit', $query->id) . "' class='btn btn-primary btn-sm' style='margin-right: 5px;'>
                   <i class='far fa-edit'></i>
                </a>
                <a href='" . route('admin.slider.destroy', $query->id) . "' class='btn btn-danger btn-sm delete-item'>
                    <i class='fas fa-trash'></i>
                </a>
            </div>";
            })
            ->addColumn('banner', function ($query){
                return "<img src='" . asset($query->banner) . "' alt='Banner Image' width='100'/>";
            })
            ->addColumn('status' , function ($query){
                $active = '<i class="badge badge-success"> Active</i>';
                $inactive = '<i class="badge badge-danger"> Inactive</i>';
                if ($query->status == 1){
                    return  $active;
                }else{
                    return  $inactive;
                }

            })
            ->rawColumns(['banner','action','status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Slider $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('slider-table')
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
            /**Data base column name */
            Column::make('id')->width(100),
            Column::make('banner')->width(200),
            Column::make('title'),
            Column::make('serial'),
            Column::make('status'),
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
        return 'Slider_' . date('YmdHis');
    }
}



