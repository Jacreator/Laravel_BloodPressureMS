<?php

namespace App\Http\Livewire;

use App\Models\Patient;
use App\Exports\PatientsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class PatientTable extends DataTableComponent
{
    public function exportSelected()
    {
        ini_set('memory_limit', '2048M');
        if ($this->selectedRowsQuery->count() > 0) {
            return Excel::download($this->selectedRowsQuery, 'patient_records.xlsx');
        }
        return Excel::download(new PatientsExport, 'patient_records.xlsx');
    }
    public function columns(): array
    {
        return [
            Column::make('First Name', 'first_name')
                ->sortable(function (Builder $query, $direction) {
                    return $query->orderBy(Patient::select('first_name')->whereColumn('first_name', 'users.id'), 'desc');
                })
                ->searchable(),
            Column::make('last Name', 'last_name')
                ->sortable()
                ->searchable(),
            Column::make('E-mail', 'email')
                ->sortable()
                ->searchable(),
            Column::make('age')
                ->sortable()
                ->searchable(),
            Column::make('gender')
                ->sortable()
                ->searchable(),
            
        ];
    }

    public function query(): Builder
    {
        return Patient::query()
            ->when($this->getFilter('search'), fn ($query, $search) => $query->search($search));
    }

    // public function rowView(): string
    // {
    //     return 'livewire.row';
    // }

}
