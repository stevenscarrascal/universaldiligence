<?php

namespace App\Livewire;

use App\Models\Country;
use Livewire\Component;
use App\Models\Source;
use Illuminate\Support\Facades\DB;

use Filament\Forms;
use Filament\Forms\Components\Section as Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Grid;

class EditSourcesLivewire extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public int $source_id;
    public string $source_name;

    public $name;
    public $description;
    public $category;
    public $type_info;
    public $type_risk;
    public $url;
    public $video_url;
    public $is_premium = 1;
    public $status = 1;

    public $source;

    public function mount(): void
    {
        $source = Source::find($this->source_id);
        $this->source = $source;

        $this->form->fill([
            'name'          => $source->name,
            'description'   => $source->description,
            'category'      => $source->category,
            'type_info'     => $source->type_info,
            'type_risk'     => $source->type_risk,
            'url'           => $source->url,
            'video_url'     => $source->video_url,
            'is_premium'    => $source->is_premium,
            'status'        => $source->status
        ]);
    }

    protected function getFormSchema(): array
    {
        return [


            Card::make('Nueva fuente')
                ->columns(1)
                ->extraAttributes(['class' => 'bg-white'])
                ->schema([
                    Grid::make(4)
                    ->schema([
                        TextInput::make('name')
                        ->label('nombre de la fuente')
                        ->required(),
                        TextInput::make('category')
                        ->label('Categoria')
                        ->required(),
                        TextInput::make('type_info')
                        ->label('Tipo de información')
                        ->required(),
                        TextInput::make('type_risk')
                        ->label('Tipo de riesgo')
                        ->required(),
                    ]),


                    Grid::make(2)
                    ->schema([

                        TextInput::make('url')
                        ->label('Link de la fuente')
                        ->required(),
                        TextInput::make('video_url')
                        ->label('Link de video'),
                    ]),

                ]),

            Card::make('Descripción de la fuente')
                ->columns(1)
                ->extraAttributes(['class' => 'bg-white'])
                ->schema([
                    Grid::make(2)
                        ->schema([
                            Select::make('status')
                            ->label('Estado')
                            ->reactive()
                            ->required()
                            ->options([
                                "1" => "Activo",
                                "0" => "Inactivo"
                            ])
                            ->default('1'),

                            Select::make('is_premium')
                            ->label('Contendio premium')
                            ->reactive()
                            ->required()
                            ->options([
                                "1" => "SI",
                                "0" => "NO"
                            ])
                            ->default('1'),
                        ]),
                    Grid::make(1)
                    ->schema([
                        TextInput::make('description')
                        ->label('Area')
                        ->required()
                    ])
                ]),

        ];
    }

    public function submit()
    {
        DB::beginTransaction();
        $this->form->getState();
        $this->save();
        DB::commit();
        $message = "Fuente creado con éxito.";

        $contry = Country::find($this->source->country_id);

        return redirect()->route('countries.show', ['id' => $this->source->country_id, 'name' => $contry->name])->with('success', $message);
    }

    private function save(): void
    {

        $this->source->update([
            'name'          => $this->name,
            'description'   => $this->description,
            'category'      => $this->category,
            'type_info'     => $this->type_info,
            'type_risk'     => $this->type_risk,
            'url'           => $this->url,
            'video_url'     => $this->video_url,
            'is_premium'    => $this->is_premium,
            'status'        => $this->status,
        ]);
    }

    public function render()
    {
        return view('livewire.edit-sources-livewire');
    }
}
