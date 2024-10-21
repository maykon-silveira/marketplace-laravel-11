<?php

namespace App\DataTables;

use App\Models\Produto;
use App\Models\ProdutoGaleriaImg;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProdutoGaleriasImgDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('editar', function($query){

            $delete = "<a href='".route('produtos-galerias-img.destroy', $query->id)."' class='btn btn-danger mb-2 ml-1 delete-item'><i class='far fa-trash-alt'></i></a>";

            return $delete;
            })
            ->addColumn('produto', function($query){
                return $query->produto ? $query->produto->nome : 'Vazio';
            })
            ->addColumn('imagem', function($query){
              $img = "<img src='". asset($query->imagem) ."' style='width: 50%; height:auto;'>";
             return $img;
            })
            ->rawColumns(['imagem', 'editar'])
            ->setRowId('id');

    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProdutoGaleriaImg $model): QueryBuilder
    {
        return $model->newQuery()->where('id_produto', request()->produto);

    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    //->setTableId('brasilTraducaoMsflix')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->language([
                      'url' => asset('backend/assets/traducao-datatable-brasil-ms/pt-BR.json')
                    ])
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
            Column::make('imagem'),
            Column::make('produto'),
            Column::computed('editar')
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
        return 'ProdutosGaleriasImg_' . date('YmdHis');
    }
}
