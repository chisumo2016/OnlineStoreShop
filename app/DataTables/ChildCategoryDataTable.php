<?php

namespace App\DataTables;

use App\Models\ChildCategory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ChildCategoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
//            ->addColumn('action', 'childcategory.action')
            ->addColumn('action', function ($query){
                return "<div class='d-flex justify-content-end'>
                <a href='" . route('admin.child-category.edit', $query->id) . "' class='btn btn-primary btn-sm' style='margin-right: 5px;'>
                   <i class='far fa-edit'></i>
                </a>
                <a href='" . route('admin.child-category.destroy', $query->id) . "' class='btn btn-danger btn-sm delete-item'>
                    <i class='fas fa-trash'></i>
                </a>
            </div>";
            })

            ->addColumn('status', function ($query){
                if ($query->status ==1 ){
                    $button = '<label class="custom-switch mt-2">
                        <input type="checkbox"  checked name="custom-switch-checkbox" data-id="'.$query->id.'" class="custom-switch-input change-status">
                        <span class="custom-switch-indicator"></span>

                      </label>';

                }else{
                    $button = '<label class="custom-switch mt-2">
                        <input type="checkbox"   name="custom-switch-checkbox" data-id="'.$query->id.'" class="custom-switch-input change-status">
                        <span class="custom-switch-indicator"></span>

                      </label>';
                }

                return $button;
            })


            /*Custom Name*/
           ->addColumn('category',function ($query){
                /*Return the relationship*/
                return $query->category->name;
            })
            ->addColumn('sub_category',function ($query){
                /*Return the relationship*/
                return $query->subCategory->name;
            })

            /*Render the HTML*/
            ->rawColumns(['status','action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ChildCategory $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('childcategory-table')
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

            Column::make('id'),
            Column::make('name'),

            /*Register custom column*/
            Column::make('category'),//category_id
            Column::make('sub_category'), //sub_category_id
            Column::make('status'),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ChildCategory_' . date('YmdHis');
    }
}
