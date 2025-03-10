<?php

namespace App\DataTables;

use App\Models\Consultation;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ConsultationsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $consults = Consultation::with(['pet', 'diseases', 'employee'])->select('health_consultation.*');

        return datatables()
            ->eloquent($consults)
            ->addColumn('edit', function ($row) {
                return "<a href=" . route('consult.edit', $row->consult_id) . " class=\"btn btn-info\">Edit</a>";
            })
            ->addColumn('delete', function ($row) {
                return "
                <form action=" . route('consult.destroy', $row->consult_id) . " method=\"POST\">" . csrf_field() .
                '<input name="_method" type="hidden" value="DELETE">
                <button class="btn btn-danger" type="submit">Delete</button>
                </form>';
            })
            ->addColumn('employee', function (Consultation $consults) {
                return $consults->employee->lname;
            })
            ->addColumn('pet', function (Consultation $consults) {
                return $consults->pet->pname;
            })
            ->addColumn('diseases', function (Consultation $consults) {
                return '<ul style="padding-left: 20px; list-style-type: disc;">' . 
                $consults->diseases->map(function ($disease) {
                return "<li>{$disease->disease_name}</li>";
            })->implode('') . 
            '</ul>';
            })

            ->rawColumns(['pet', 'employee', 'diseases', 'edit', 'delete']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Consultation $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Consultation $model)
    {
        return $model->newQuery()->with(['pet', 'diseases', 'employee']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('health_consultation-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(0)
            ->buttons(
                Button::make('excel'),
                Button::make('csv'),
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('consult_id'),
            Column::make('pet')->name('pet.pname')->title('Pets'),
            Column::make('diseases')->name('diseases.disease_name')->title('Diseases'),
            Column::make('employee')->name('employee.lname')->title('Veterinarian'),
            Column::make('observation')->title('Comment'),
            Column::make('consult_cost')->title('Cost'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('edit'),
            Column::computed('delete')
                ->exportable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Consultations_' . date('YmdHis');
    }
}
