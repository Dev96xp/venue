<?php

namespace App\Livewire\Admin\Location;

use App\Models\Location;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class LocationsIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public ?int $deleteId = null;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[On('render-locations')]
    public function render()
    {
        $locations = Location::where('name', 'LIKE', '%'.$this->search.'%')
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.admin.location.locations-index', compact('locations'));
    }

    public function confirmDelete(int $locationId)
    {
        $this->deleteId = $locationId;
    }

    public function cancelDelete()
    {
        $this->deleteId = null;
    }

    public function delete()
    {
        Location::whereKey($this->deleteId)->delete();
        $this->deleteId = null;
        $this->dispatch('render-locations');
    }
}
