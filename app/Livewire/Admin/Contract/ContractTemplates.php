<?php

namespace App\Livewire\Admin\Contract;

use App\Models\ContractTemplate;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ContractTemplates extends Component
{
    public $editingId = null;   // id de la plantilla en edición, 'new' para una nueva
    public $name = '';
    public $body = '';          // Texto en inglés
    public $body_es = '';       // Texto en español (misma plantilla)
    public $lang = 'en';        // Pestaña de idioma que se está editando
    public $preview = false;

    public function edit($id)
    {
        $template = ContractTemplate::findOrFail($id);
        $this->editingId = $template->id;
        $this->name = $template->name;
        $this->body = $template->body;
        $this->body_es = $template->body_es ?? '';
        $this->lang = 'en';
        $this->preview = false;
        $this->resetErrorBag();
    }

    public function create()
    {
        $this->editingId = 'new';
        $this->name = '';
        $this->body = "# CONTRACT TITLE\n\n**Contract No.:** {contract_code}\n\n...";
        $this->body_es = "# TÍTULO DEL CONTRATO\n\n**Contrato No.:** {contract_code}\n\n...";
        $this->lang = 'en';
        $this->preview = false;
        $this->resetErrorBag();
    }

    public function close()
    {
        $this->reset(['editingId', 'name', 'body', 'body_es', 'lang', 'preview']);
    }

    /**
     * Si la plantilla ya se usó en algún contrato, se guarda como una
     * NUEVA VERSIÓN y la anterior se desactiva. Así los contratos viejos
     * conservan su referencia a la versión con la que se hicieron.
     */
    public function save()
    {
        $this->validate([
            'name' => 'required|max:255',
            'body' => 'required|min:50',
            'body_es' => 'nullable|min:50',
        ], [
            'body.required' => 'El texto en inglés es obligatorio.',
            'body_es.min' => 'El texto en español es muy corto.',
        ]);

        $data = [
            'name' => $this->name,
            'body' => $this->body,
            'body_es' => filled($this->body_es) ? $this->body_es : null,
        ];

        DB::transaction(function () use ($data) {
            if ($this->editingId === 'new') {
                ContractTemplate::create($data + ['version' => 1, 'is_active' => true]);
                return;
            }

            $template = ContractTemplate::findOrFail($this->editingId);

            if ($template->contracts()->exists()) {
                $template->update(['is_active' => false]);
                ContractTemplate::create($data + ['version' => $template->version + 1, 'is_active' => true]);
            } else {
                $template->update($data);
            }
        });

        $this->close();
        session()->flash('info', 'Plantilla guardada.');
    }

    public function toggleActive($id)
    {
        $template = ContractTemplate::findOrFail($id);
        $template->update(['is_active' => ! $template->is_active]);
    }

    public function render()
    {
        return view('livewire.admin.contract.contract-templates', [
            'templates' => ContractTemplate::withCount('contracts')->orderBy('name')->orderByDesc('version')->get(),
        ]);
    }
}
