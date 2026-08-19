<?php

namespace App\Livewire\Admin\Location;

use App\Models\Location;
use Livewire\Component;

class EditLocation extends Component
{
    public $open = false;
    public Location $location;

    public $name = '';
    public $latitude = '';
    public $longitude = '';
    public $radius_feet = 100;

    public function mount(Location $location)
    {
        $this->location = $location;
        $this->name = $location->name;
        $this->latitude = $location->latitude;
        $this->longitude = $location->longitude;
        $this->radius_feet = $location->radius_feet;
    }

    protected function rules()
    {
        return [
            'name' => 'required|max:255|unique:locations,name,'.$this->location->id,
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'radius_feet' => 'required|integer|min:10|max:5000',
        ];
    }

    public function render()
    {
        return view('livewire.admin.location.edit-location');
    }

    public function useCurrentLocation($lat, $lng)
    {
        $this->latitude = number_format((float) $lat, 7, '.', '');
        $this->longitude = number_format((float) $lng, 7, '.', '');
    }

    public function update()
    {
        $this->validate();

        $this->location->update([
            'name' => $this->name,
            'latitude' => $this->latitude !== '' ? $this->latitude : null,
            'longitude' => $this->longitude !== '' ? $this->longitude : null,
            'radius_feet' => $this->radius_feet,
        ]);

        $this->reset(['open']);
        $this->dispatch('render-locations');
    }
}
