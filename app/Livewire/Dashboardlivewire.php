<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Country;

class Dashboardlivewire extends Component
{
    public $search = '';
    public $selectedCountry = null;

    public function selectCountry($countryId)
    {
        $this->selectedCountry = Country::find($countryId);

        // Emitir evento o lógica adicional
        $this->dispatch('countrySelected', $this->selectedCountry->id);
    }

    public function getCountriesProperty()
    {
        return Country::when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })->limit(10)->get();
    }

    public function render()
    {
        return view('livewire.dashboardlivewire');
    }
}
