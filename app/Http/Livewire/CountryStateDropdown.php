<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Country;
use App\Models\StateProvince;

class CountryStateDropdown extends Component
{
    public $countries;
    public $states = [];
    public $country_id = '';
    public $state_id = '';

    public function mount()
    {
        $this->countries = Country::orderBy('name')->get();
        $this->states = collect();
    }

    public function updatedCountryId($value)
    {
        $this->states = $value
            ? StateProvince::where('country_id', $value)->orderBy('name')->get()
            : collect();
        $this->state_id = '';
    }

    public function render()
    {
        return view('livewire.country-state-dropdown');
    }
}
