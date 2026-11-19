<?php

namespace App\Livewire\Admin\Contract;

use App\Models\Contract;
use Livewire\Component;
use Livewire\WithPagination;

class ContractsIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $status = '';          // Filtro por estado
    public $view = 'current';     // current | archived | all
    public $period = 'upcoming';  // upcoming | past | all

    public $deleteId = null;   // sin tipo: el modal lo pone en false al cerrarse

    public function updating($name)
    {
        if (in_array($name, ['search', 'status', 'view', 'period'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        $contracts = Contract::query()
            ->when($this->search, function ($q) {
                $q->where(function ($q) {
                    $q->where('code', 'like', '%' . $this->search . '%')
                        ->orWhere('client_name', 'like', '%' . $this->search . '%')
                        ->orWhere('client_email', 'like', '%' . $this->search . '%')
                        ->orWhere('client_phone', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status, fn ($q) => $q->where('status', $this->status))
            ->when($this->view === 'current', fn ($q) => $q->where('status', '!=', Contract::STATUS_ARCHIVED))
            ->when($this->view === 'archived', fn ($q) => $q->where('status', Contract::STATUS_ARCHIVED))
            ->when($this->period === 'upcoming', fn ($q) => $q->whereDate('event_date', '>=', today()))
            ->when($this->period === 'past', fn ($q) => $q->whereDate('event_date', '<', today()))
            ->orderBy('event_date', $this->period === 'past' ? 'desc' : 'asc')
            ->paginate(15);

        $counts = Contract::selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status');

        return view('livewire.admin.contract.contracts-index', compact('contracts', 'counts'));
    }

    public function confirmDelete(int $id)
    {
        $this->deleteId = $id;
    }

    public function cancelDelete()
    {
        $this->deleteId = null;
    }

    // Solo se pueden borrar borradores; los demás se cancelan o archivan
    public function delete()
    {
        Contract::whereKey($this->deleteId)->where('status', Contract::STATUS_DRAFT)->delete();
        $this->deleteId = null;
    }
}
