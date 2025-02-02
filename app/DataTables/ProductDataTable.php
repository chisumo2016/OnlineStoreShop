<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $editBtn = "<a href='" . route('admin.product.edit', $query->id) . "' class='btn btn-primary btn-sm' style='margin-right: 5px;'>
                   <i class='far fa-edit'></i></a>";

                $deleteBtn = "<a href='" . route('admin.product.destroy', $query->id) . "' class='btn btn-danger btn-sm delete-item' style='margin-right: 5px;'>
                    <i class='fas fa-trash'></i></a>";

                $moreBtn = '<div class="dropdown dropleft show">
                  <button class="btn btn-primary dropdown-toggle ml-1" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="fas fa-cog"></i>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                    <a class="dropdown-item has-icon" href="'.route('admin.product-image-gallery.index',['product' => $query->id]).'"><i class="far fa-heart"></i>Image Gallery</a>
                    <a class="dropdown-item has-icon" href="'.route('admin.variant.index').'"><i class="far fa-file"></i>variants</a>
                    <a class="dropdown-item has-icon" href="#"><i class="far fa-clock"></i> Something else here</a>
                  </div>
                </div>';

                // Wrap buttons in a flex container
                return "<div class='d-flex align-items-center'>".$editBtn.$deleteBtn.$moreBtn."</div>";
            })

            ->addColumn('image', function ($query){
                return "<img src='" . asset($query->thumb_image) . "' alt='Banner Image' width='70'/>";
            })
            ->addColumn('type', function ($query){
                switch ($query->product_type){
                    case 'new_arrival':
                        return '<i class="badge badge-success">New Arrival</i>';
                        break;
                    case 'featured_product':
                        return '<i class="badge badge-warning">Featured Product</i>';
                        break;

                    case 'top_product':
                        return '<i class="badge badge-info">Top Product</i>';
                        break;

                    case 'best_product':
                        return '<i class="badge badge-danger">Best Product</i>';
                        break;

                    default:
                        return '<i class="badge badge-dark">None</i>';
                        break;
                }
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
            ->rawColumns(['image','type','status','action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('product-table')
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
            Column::make('image'),
            Column::make('name'),
            Column::make('price'),
            Column::make('type')->width(150),
            Column::make('status'),
            Column::make('created_at'),
            Column::make('updated_at'),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Product_' . date('YmdHis');
    }
}
