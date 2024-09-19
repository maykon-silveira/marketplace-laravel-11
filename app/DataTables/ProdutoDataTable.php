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

class ProdutoDataTable extends DataTable
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
            $edit = "<a href='".route('produtos.edit', $query->id)."' class='btn btn-primary mb-2'><i class='far fa-edit'></i></a>";
            $delete = "<a href='".route('produtos.destroy', $query->id)."' class='btn btn-danger delete-item'><i class='far fa-trash-alt'></i></a>";
            return $edit.$delete;
            })
            ->addColumn('status', function($query){
                $ativo = '<i class="badge badge-success">Ativo</i>';
                $cancelado = '<i class="badge badge-danger">Cancelado</i>';
                if($query->status == 1){
                  return $ativo;
                }else{
                  return $cancelado;
                }
            })
            ->addColumn('ordem', function($query){
               return $query->ordem;
            })
            ->addColumn('banner', function($query){
             return $img = "<img src='". asset($query->banner) ."' style='width: 30%; height:auto;'>";
            })
            ->rawColumns(['banner', 'editar', 'status'])
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
            Column::make('banner'),
            Column::make('titulo'),
            Column::make('status'),
            Column::make('ordem'),
            Column::computed('editar')
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
        return 'Produto_' . date('YmdHis');
    }
}
