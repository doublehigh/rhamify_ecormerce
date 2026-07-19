<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorProductDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function($query){
            $editBtn = "<a href='".route('vendor.products.edit', $query->id)."' class='vendor-product-action-btn vendor-product-action-btn--edit' title='Edit product' aria-label='Edit product'><i class='far fa-edit'></i></a>";
            $deleteBtn = "<a href='".route('vendor.products.destroy', $query->id)."' class='vendor-product-action-btn vendor-product-action-btn--delete delete-item' title='Delete product' aria-label='Delete product'><i class='far fa-trash-alt'></i></a>";

            $moreBtn = '<div class="btn-group dropstart vendor-product-more">
                <button type="button" class="vendor-product-action-btn vendor-product-action-btn--more dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" title="More product actions" aria-label="More product actions">
                <i class="fas fa-cog"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item has-icon" href="'.route('vendor.products-image-gallery.index', ['product' => $query->id]).'"><i class="far fa-images"></i> Image Gallery</a></li>
                    <li><a class="dropdown-item has-icon" href="'.route('vendor.products-variant.index', ['product' => $query->id]).'"><i class="fas fa-layer-group"></i> Variants</a></li>
                </ul>
            </div>';

            return '<div class="vendor-product-actions">'.$editBtn.$deleteBtn.$moreBtn.'</div>';
        })
        ->addColumn('image', function($query){
            return "<img class='vendor-product-table-img' src='".asset($query->thumb_image)."' alt='".e($query->name)."'>";
        })
        ->addColumn('type', function($query){
            switch ($query->product_type) {
                case 'new_arrival':
                    return '<i class="badge bg-success">New Arrival</i>';
                    break;
                case 'featured_product':
                    return '<i class="badge bg-warning">Featured Product</i>';
                    break;
                case 'top_product':
                    return '<i class="badge bg-info">Top Product</i>';
                    break;

                case 'best_product':
                    return '<i class="badge bg-danger">Top Product</i>';
                    break;

                default:
                    return '<i class="badge bg-dark">None</i>';
                    break;
            }
        })
        ->addColumn('status', function($query){
            $inputId = 'vendor-product-status-'.$query->id;
            $statusText = $query->status == 1 ? 'Active' : 'Inactive';
            $checked = $query->status == 1 ? 'checked' : '';
            if($query->status == 1){

                $button = '<label class="vendor-product-status-switch vendor-status-toggle" for="'.$inputId.'">
                <input '.$checked.' class="change-status vendor-status-toggle__input" type="checkbox" id="'.$inputId.'" data-id="'.$query->id.'"><span class="vendor-status-toggle__track" aria-hidden="true"></span><span class="vendor-status-toggle__text">'.$statusText.'</span></label>';
            }else {
                $button = '<label class="vendor-product-status-switch vendor-status-toggle" for="'.$inputId.'">
                <input '.$checked.' class="change-status vendor-status-toggle__input" type="checkbox" id="'.$inputId.'" data-id="'.$query->id.'"><span class="vendor-status-toggle__track" aria-hidden="true"></span><span class="vendor-status-toggle__text">'.$statusText.'</span></label>';
            }
            return $button;
        })
        ->addColumn('approved', function($query){
            if($query->is_approved === 1){
                return '<i class="badge bg-success">Approved</i>';
            }else {
                return '<i class="badge bg-warning">Pending</i>';
            }
        })
        ->rawColumns(['image', 'type', 'status', 'action', 'approved'])
        ->setRowId('id');

    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->where('vendor_id', Auth::user()->vendor->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('vendorproduct-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0)
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
            Column::make('image')->width(150),
            Column::make('name'),
            Column::make('price'),
            Column::make('approved'),
            Column::make('type')->width(150),
            Column::make('status'),
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
        return 'VendorProduct_' . date('YmdHis');
    }
}
