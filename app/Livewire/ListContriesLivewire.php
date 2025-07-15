<?php

namespace App\Livewire;

use App\Models\Country;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Filters\SelectFilter;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Select;

class ListContriesLivewire extends Component implements HasForms, HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use InteractsWithTable;
    use InteractsWithForms;

    protected function getTableQuery(): Builder
    {
        return Country::query();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getTableQuery())
            ->heading('LISTADO DE PAISES')
            ->poll('10s')
            ->defaultSort('name', 'asc')
            ->columns(
                [
                    TextColumn::make('id')->label('No.')->sortable()->searchable()->toggleable(isToggledHiddenByDefault: true),
                    TextColumn::make('iso_code')->label('Code.')->sortable()->searchable()->toggleable(),
                    TextColumn::make('name')->label('Pais.')->sortable()->searchable()->toggleable(),
                    TextColumn::make('sources_count')->counts('sources')->label('Fuentes')->sortable()->searchable()->toggleable(),

                ]
            )
            ->actions([
                Action::make('suplantar')
                ->label('Agregar fuentes')
                ->icon('heroicon-o-folder-plus')
                ->url(fn($record): string => route('countries.show',['id' => $record->id,'name' => $record->name])),

                
                Action::make('delete')
                ->label('Eliminar')
                ->icon('heroicon-o-trash')
                ->requiresConfirmation()
                ->color('danger')
                ->modalHeading('Eliminar Pais')
                ->modalDescription('Estas seguro de eliminar el pais y todo su contendio')
                ->modalSubmitActionLabel('Si, Eliminalo')
                ->action(function ($record) {
                    $record->delete();
                    $this->dispatch('alert', [
                        'title' => 'Borrado con éxito!',
                        'text'  => 'Se ha eliminado el pais correctamente.',
                        'icon'  => 'success'
                    ]);
                })
            ]);
    }

    /**
     * Define las opciones de la barra de búsqueda.
     *
     * @return array
     */
    protected $queryString = [
        'tableFilters',
        'tableSortColumn'       => ['default' => 'created_at'],
        'tableSortDirection'    => ['default' => 'asc'],
        'tableSearchQuery'      => ['except' => ''],
    ];


    /**
     * Indica si la tabla es buscable.
     *
     * @return bool
     */
    public function isTableSearchable(): bool
    {
        return true;
    }


    public function render()
    {
        return view('livewire.list-contries-livewire');
    }
}
