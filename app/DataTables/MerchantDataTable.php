<?php

namespace App\DataTables;

use App\Http\Traits\ActionButton;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MerchantDataTable extends DataTable
{
    use ActionButton;

    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (User $user) {
                return $this->buttons($user, 'merchant', false, false, false);
            })
            ->editColumn('status', function (User $user) {
                if ($user->status) {
                    return "<div class='form-check form-switch'><input class='form-check-input' type='checkbox' role='switch' data-id='$user->id' checked></div>";
                }

                return "<div class='form-check form-switch'><input class='form-check-input' type='checkbox' role='switch' data-id='$user->id'></div>";
            })
            ->setRowId('id')
            ->rawColumns(['action', 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery()->where('role_id', Role::MERCHANT)->orderBy('id', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('merchant-table')
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
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false),
            Column::make('status')
                ->sortable(false),
            Column::make('name'),
            Column::make('email'),
            Column::make('phone'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Merchant_' . date('YmdHis');
    }
}
