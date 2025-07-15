<?php

namespace App\Livewire;

use App\Models\Source;
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

class ListSourcesLivewire extends Component implements HasForms, HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use InteractsWithTable;
    use InteractsWithForms;

    public int $source_id;
    public string $source_name;

    protected function getTableQuery(): Builder
    {
        return Source::query()->where('country_id', $this->source_id);
    }


    public function table(Table $table): Table
    {
        return $table
            ->query($this->getTableQuery())
            ->heading('LISTADO DE FUENTES DE '.strtoupper($this->source_name))
            ->poll('10s')
            ->defaultSort('name', 'asc')
            ->columns(
                [
                    TextColumn::make('id')->label('No.')->sortable()->searchable()->toggleable(),
                    TextColumn::make('name')->label('nombre de fuente.')->sortable()->searchable()->toggleable(),
                    TextColumn::make('category')->label('Categoria.')->sortable()->searchable()->toggleable(),
                    TextColumn::make('type_info')->label('Tipo de información.')->sortable()->searchable()->toggleable(),
                    TextColumn::make('type_risk')->label('Tipo de riesgo.')->sortable()->searchable()->toggleable(),
                    TextColumn::make('description')->label('Descripción.')->sortable()->searchable()->toggleable(isToggledHiddenByDefault: true),
                    IconColumn::make('is_premium')
                    ->label('Premium')
                    ->icon(fn($state): string => match ($state) {
                        1 => 'heroicon-o-check',
                        0 => 'heroicon-o-x-circle'
                    })
                    ->color(fn ($state): string => match ($state) {
                        1 => 'success',
                        0 => 'danger',
                        default => 'gray',
                    }),
                    TextColumn::make('url')->label('URL.')
                    ->formatStateUsing(fn ($record) => "Link fuente")
                    ->url(fn ($record) => $record->url)
                    ->openUrlInNewTab()->sortable()->searchable()->toggleable(),
                    TextColumn::make('vide_url')->label('Link video.')->formatStateUsing(fn ($record) => "Link video")
                    ->url(fn ($record) => $record->url)
                    ->openUrlInNewTab()->sortable()->searchable()->toggleable(),
                    TextColumn::make('status')
                        ->formatStateUsing(fn (string $state): string => match ($state) {
                            '0' => 'Inactivo',
                            '1' => 'Activo',
                            '2' => 'Bloqueado',
                            default => 'Inactivo',
                        })
                        ->badge()
                        ->label('Estado')->badge()->sortable()->searchable()->toggleable(isToggledHiddenByDefault: true)
                        ->color(fn (string $state): string => match ($state) {
                            '0'                         => 'warning',
                            '1'                         => 'success',
                            '2'                        => 'danger',
                        }),

                ]
            )
            ->actions([
                Action::make('suplantar')
                ->label('Editar')
                ->color('info')
                ->icon('heroicon-o-pencil-square')
                ->url(fn($record): string => route('sources.edit',['id' => $record->id, 'name' => $record->name])),

                
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
        return view('livewire.list-sources-livewire');
    }
}
