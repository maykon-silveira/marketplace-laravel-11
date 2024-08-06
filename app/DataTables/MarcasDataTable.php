<?php

namespace App\DataTables;

use App\Models\Marca;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MarcasDataTable extends DataTable
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
              $editar = "<a href='".route('marcas.edit', $query->id)."' class='btn btn-primary mr-2'><i class='far fa-edit'></i></a>";
              $excluir = "<a href='".route('marcas.destroy', $query->id)."' class='btn btn-danger delete-item'><i class='far fa-trash-alt'></i></a>";
              return $editar.$excluir;
            })
            ->addColumn('destacada', function($query){
              $sim = "<button class='btn btn-success'>Sim</button>";
              $nao = "<button class='btn btn-danger'>Não</button>";
              if($query->destacada == 1){
                return $sim;
              }else{
                return $nao;
              }

            })
            ->addColumn('logo', function($query){
              $logo = "<img src='".asset($query->logo)."' style='width:100px;'>";
              return $logo;
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
            ->rawColumns(['logo', 'destacada', 'status', 'editar'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Marca $model): QueryBuilder
    {
        return $model->newQuery();
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
            Column::make('logo'),
            Column::make('nome'),
            Column::make('destacada'),
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
        return 'Marca_' . date('YmdHis');
    }
}
