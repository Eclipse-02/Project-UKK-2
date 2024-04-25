<?php

namespace App\DataTables;

use App\Models\Borrowing;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BorrowingsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($q) {
                $data = $q;
                return view('scaffolds.borrowings.action', compact('data'));
            })
            ->addColumn('borrower', function($q) {
                return $q->user->name;
            })
            ->addColumn('book_name', function($q) {
                return $q->book->title;
            })
            ->addColumn('borrow_date', function($q) {
                return Carbon::parse($q->borrow_date)->isoFormat('D MMMM Y');
            })
            ->addColumn('return_date', function($q) {
                return Carbon::parse($q->return_date)->isoFormat('D MMMM Y');
            })
            ->addColumn('status', function($q) {
                if ($q->status == 'B') {
                    return 'Borrowed';
                } else {
                    return 'Returned';
                }
                
            })
            ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Borrowing $model): QueryBuilder
    {
        return $model->with(['book', 'user'])->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('borrowings-table')
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
            Column::make('DT_RowIndex')
                  ->searchable(false)
                  ->title('No')
                  ->addClass('w-50px text-center'),
            Column::make('borrower')->addClass('min-w-100px'),
            Column::make('book_name')->addClass('min-w-100px'),
            Column::make('borrow_date')->addClass('min-w-100px'),
            Column::make('return_date')->addClass('min-w-100px'),
            Column::make('status')->addClass('min-w-100px'),
            Column::computed('action')
                  ->searchable(false)
                  ->exportable(false)
                  ->printable(false)
                  ->addClass('w-150px text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Borrowings_' . date('YmdHis');
    }
}
