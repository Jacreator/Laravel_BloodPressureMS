<?php

namespace App\Http\Livewire;

use App\Models\Patient;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class LivewireDatatables extends Component
{
    public function columns(): array
    {
        return [
            Column::make('Name')
            ->sortable()
                ->searchable(),
            Column::make('E-mail', 'email')
            ->sortable()
                ->searchable(),
            Column::make('Verified', 'email_verified_at')
            ->sortable(),
        ];
    }

    public function query(): Builder
    {
        return Patient::query();
    }
    
}
