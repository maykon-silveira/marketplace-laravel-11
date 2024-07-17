<?php

namespace App\DataTables;

use App\Models\CategoriaFilho;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoriaFilhoDataTable extends DataTable
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
              $editar = "<a href='".route('categoria-filho.edit', $query->id)."' class='btn btn-primary mr-2'><i class='far fa-edit'></i></a>";
              $excluir = "<a href='".route('categoria-filho.destroy', $query->id)."' class='btn btn-danger delete-item'><i class='far fa-trash-alt'></i></a>";
              return $editar.$excluir;
            })
            ->addColumn('categoria', function($query){
                return $query->categoria ? $query->categoria->nome : null;
            })
            ->addColumn('subcategoria', function($query){
                return $query->subcategoria ? $query->subcategoria->nome : null;
            })
            ->addColumn('status', function($query){
              if($query->status == 1){
              $botao = '<label class="custom-switch mt-2">
              <input type="checkbox" checked name="custom-switch-checkbox" data-id="'.$query->id.'" class="custom-switch-input muda-status">
              <span class="custom-switch-indicator"></span>
              </label>';
              }else{
              $botao = '<label class="custom-switch mt-2">
              <input type="checkbox" name="custom-switch-checkbox" data-id="'.$query->id.'" class="custom-switch-input muda-status">
              <span class="custom-switch-indicator"></span>
              </label>';
              }
                return $botao;

            })
            ->rawColumns(['status', 'editar'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(CategoriaFilho $model): QueryBuilder
    {
        return $model->newQuery();
        //return $model->newQuery()->with('categoria');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    //->setTableId('categoria-table')
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
            Column::make('nome'),
            Column::make('categoria'),
            Column::make('subcategoria'),
            Column::make('status'),
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
        return 'CategoriaFilho_' . date('YmdHis');
    }
}
