<?php

namespace App\DataTables;

use App\Models\Bookshelf;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BookshelvesDataTable extends DataTable
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
                if ($q->status == 'L') {
                    return view('scaffolds.bookshelves.actions.later')->with('id', $q->id);
                } else if ($q->status == 'R') {
                    return view('scaffolds.bookshelves.actions.read')->with('id', $q->book->id);
                } else {
                    return view('scaffolds.bookshelves.actions.finish')->with('id', $q->book->id);
                }
            })
            ->addColumn('book_name', function($q) {
                return $q->book->title;
            })
            ->addColumn('status', function($q) {
                if ($q->status== 'R') {
                    return "Reading";
                } else if ($q->status == 'L') {
                    return "Read Later";
                } else {
                    return "Finished";
                }
            })
            ->editColumn('book_id', function($q) {
                return "<img src='" . asset('storage/storage/covers/' . $q->book->cover) . "' class='card-img-top w-250px mb-3' alt='" . $q->book->title  . "'>";
            })
            ->rawColumns(['book_id', 'action'])
            ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Bookshelf $model): QueryBuilder
    {
        return $model->where('user_id', auth()->user()->id)->with('book')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('bookshelves-table')
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
            Column::make('book_id')->title('Book Cover'),
            Column::make('book_name'),
            Column::make('status'),
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
        return 'Bookshelves_' . date('YmdHis');
    }
}
