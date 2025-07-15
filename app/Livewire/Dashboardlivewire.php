<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Country;
use App\Models\Source;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Now;


class Dashboardlivewire extends Component
{
    public $countries;
    public $selectedCountry = '';
    public $search = '';
    public $sources = [];

    public function mount()
    {
        $this->countries = Country::orderBy('name')->get();
    }

    public function updatedSelectedCountry($countryId)
    {
        if ($countryId) {
            $this->sources = Source::where('country_id', $countryId)
                ->orderBy('name')
                ->get();
        } else {
            $this->sources = [];
        }
    }

    public function getHasAccessProperty()
    {
        $user = Auth::user();

        // return $user && $user->plan_id && $user->plan_expires_at && now()->lessThan($user->plan_expires_at);
        return $user;
    }

    public function render()
    {
        $filteredCountries = $this->countries;

        if ($this->search) {
            $filteredCountries = $this->countries->filter(function ($country) {
                return str_contains(strtolower($country->name), strtolower($this->search));
            });
        }
        return view('livewire.dashboardlivewire',[
        'countries' => $filteredCountries,
        'sources' => $this->sources,
        'hasAccess' => $this->hasAccess,
        ]);
    }
}
