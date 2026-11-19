<?php

namespace App\Livewire\Admin\Contract;

use App\Models\Contract;
use InvalidArgumentException;
use Livewire\Attributes\Url;
use Livewire\Component;

class ContractShow extends Component
{
    public Contract $contract;

    // Idioma en que se muestra el contrato (se guarda en la URL: ?lang=es)
    #[Url]
    public $lang = 'en';

    public function setLang($lang)
    {
        $this->lang = array_key_exists($lang, Contract::LANGUAGES) ? $lang : 'en';
    }

    // Modal de cambio de estado
    public $newStatus = null;   // sin tipo: el modal lo pone en false al cerrarse
    public $note = '';

    // Resolución del depósito por daños
    public $refund_amount = '';
    public $refund_notes = '';

    public function mount(Contract $contract)
    {
        $this->contract = $contract;
        $this->refund_amount = $contract->security_deposit_refunded ?? $contract->security_deposit;
        $this->refund_notes = $contract->security_deposit_notes ?? '';
    }

    public function askTransition(string $status)
    {
        $this->resetErrorBag();
        $this->newStatus = $status;
        $this->note = '';
    }

    public function cancelTransition()
    {
        $this->newStatus = null;
    }

    public function transition()
    {
        if (! $this->newStatus) {
            return;
        }

        if ($this->newStatus === Contract::STATUS_ARCHIVED && $this->depositPending()) {
            $this->addError('note', 'Primero registra la devolución del depósito por daños.');
            return;
        }

        if ($this->newStatus === Contract::STATUS_CANCELLED) {
            $this->validate(['note' => 'required|min:5|max:2000'], [
                'note.required' => 'Escribe el motivo de la cancelación.',
            ]);
        }

        try {
            $this->contract->transitionTo($this->newStatus, $this->note ?: null);
        } catch (InvalidArgumentException $e) {
            $this->addError('note', $e->getMessage());
            return;
        }

        $this->newStatus = null;
        $this->contract->refresh();
        session()->flash('info', 'Estado actualizado a: ' . $this->contract->statusLabel());
    }

    public function depositPending(): bool
    {
        return $this->contract->status === Contract::STATUS_COMPLETED
            && $this->contract->security_deposit > 0
            && $this->contract->security_deposit_refunded === null;
    }

    public function saveDeposit()
    {
        $this->validate([
            'refund_amount' => 'required|numeric|min:0|max:' . $this->contract->security_deposit,
            'refund_notes' => 'required_unless:refund_amount,' . $this->contract->security_deposit . '|max:2000',
        ], [
            'refund_notes.required_unless' => 'Si retienes parte del depósito, explica el motivo (daños, limpieza, horas extra...).',
        ]);

        $this->contract->update([
            'security_deposit_refunded' => $this->refund_amount,
            'security_deposit_notes' => $this->refund_notes ?: null,
        ]);

        $this->contract->statusLogs()->create([
            'from_status' => $this->contract->status,
            'to_status' => $this->contract->status,
            'user_id' => auth()->id(),
            'note' => 'Depósito por daños: se devuelven $' . number_format($this->refund_amount, 2)
                . ' de $' . number_format($this->contract->security_deposit, 2)
                . ($this->refund_notes ? ' — ' . $this->refund_notes : ''),
        ]);

        session()->flash('info', 'Depósito por daños registrado.');
    }

    public function render()
    {
        if (! array_key_exists($this->lang, Contract::LANGUAGES)) {
            $this->lang = 'en';
        }

        return view('livewire.admin.contract.contract-show', [
            'logs' => $this->contract->statusLogs()->with('user')->get(),
        ]);
    }
}
