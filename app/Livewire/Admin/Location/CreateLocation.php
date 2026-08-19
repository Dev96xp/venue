<?php

namespace App\Livewire\Admin\Location;

use App\Models\Location;
use Livewire\Component;

class CreateLocation extends Component
{
    public $open = false;

    public $name = '';
    public $latitude = '';
    public $longitude = '';
    public $radius_feet = 100;

    protected $rules = [
        'name' => 'required|max:255|unique:locations,name',
        'latitude' => 'nullable|numeric|between:-90,90',
        'longitude' => 'nullable|numeric|between:-180,180',
        'radius_feet' => 'required|integer|min:10|max:5000',
    ];

    public function render()
    {
        return view('livewire.admin.location.create-location');
    }

    public function useCurrentLocation($lat, $lng)
    {
        $this->latitude = number_format((float) $lat, 7, '.', '');
        $this->longitude = number_format((float) $lng, 7, '.', '');
    }

    public function save()
    {
        $this->validate();

        Location::create([
            'name' => $this->name,
            'latitude' => $this->latitude !== '' ? $this->latitude : null,
            'longitude' => $this->longitude !== '' ? $this->longitude : null,
            'radius_feet' => $this->radius_feet,
        ]);

        $this->reset(['open', 'name', 'latitude', 'longitude']);
        $this->radius_feet = 100;

        $this->dispatch('render-locations');
    }
}
