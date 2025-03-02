<?php

namespace App\DataTables;

use App\Models\Pet;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PetsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $pets = Pet::leftJoin('customers', 'pets.customer_id', '=', 'customers.customer_id')
            ->leftJoin('pet_breed', 'pets.petb_id', '=', 'pet_breed.petb_id')
            ->select([
                'pets.*', 
                'customers.fname as owner_fname',
                'customers.lname as owner_lname',
                'pet_breed.pbreed as breed_name'
            ]);

        return datatables()
            ->eloquent($pets)
            // ->addColumn('action', function ($row) {
            //     return "<a href=" . route('pet.edit', $row->pet_id) . " class=\"btn btn-warning\">Edit</a>
            //     <form action=" . route('pet.destroy', $row->pet_id) . " method=\"POST\" style=\"display:inline;\">" . csrf_field() . 
            //     '<input name="_method" type="hidden" value="DELETE">
            //     <button class="btn btn-danger" type="submit">Delete</button>
            //     </form>';
            // })
             ->addColumn('edit', function ($row) {
                return "<a href=" . route('pet.edit', $row->pet_id) . " class=\"btn btn-info\">Edit</a>";
            })
            ->addColumn('delete', function ($row) {
                return "
                <form action=" . route('pet.destroy', $row->pet_id) . " method=\"POST\">" . csrf_field() .
                '<input name="_method" type="hidden" value="DELETE">
                <button class="btn btn-danger" type="submit">Delete</button>
                </form>';
            })
            ->addColumn('owner', function ($pet) {
                return $pet->owner_fname ? $pet->owner_fname . ' ' . $pet->owner_lname : 'No Owner';
            })
            ->addColumn('breed', function ($pet) {
                return $pet->breed_name ?? 'Unknown Breed';
            })
            ->addColumn('img_path', function ($pet) {
                if ($pet->img_path) {
                    $url = asset('images/' . $pet->img_path);
                    return '<img src="' . $url . '" border="0" width="90" height="90" align="center">';
                }
                return 'No Image';
            })
            ->rawColumns(['img_path', 'owner', 'breed', 'edit', 'delete']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Pet $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Pet $model)
    {
        return $model->newQuery()->orderBy('pet_id', 'DESC');
    }

    /**
     * Optional method if you want to use HTML builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('pets-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(0,'desc')
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
            Column::make('pet_id')->title('ID'),
            Column::computed('owner')->title('Owner'),
            Column::make('pname')->title('Pet Name'),
            Column::computed('breed')->title('Breed'),
            Column::make('gender')->title('Gender'),
            Column::make('age')->title('Age'),
            Column::computed('img_path')->title('Image'),
            Column::make('created_at')->title('Created At'),
            Column::make('updated_at')->title('Updated At'),
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
        return 'Pets_' . date('YmdHis');
    }
}
