<?php

namespace App\Livewire\Admin\Event;

use App\Models\PackageLocation;
use Livewire\Component;

class LocationIndex extends Component
{

    protected $listeners = ['render'];

    public function render()
    {

        $package_locations = PackageLocation::all();

        return view('livewire.admin.event.location-index', compact('package_locations'));
    }
}
