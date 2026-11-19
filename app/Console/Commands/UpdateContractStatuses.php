<?php

namespace App\Console\Commands;

use App\Models\Contract;
use Illuminate\Console\Command;

class UpdateContractStatuses extends Command
{
    protected $signature = 'contracts:update-statuses {--expire-days=14 : Días sin firmar antes de expirar un contrato enviado}';

    protected $description = 'Marca como completados los contratos cuyo evento ya pasó y expira los enviados que nunca se firmaron';

    public function handle(): void
    {
        // 1. Evento ya pasó -> Completado (queda pendiente resolver el depósito y archivar)
        $completed = 0;
        Contract::whereIn('status', [Contract::STATUS_ACTIVE, Contract::STATUS_PAID])
            ->whereDate('event_date', '<', today())
            ->each(function (Contract $contract) use (&$completed) {
                $contract->transitionTo(Contract::STATUS_COMPLETED, 'Automático: la fecha del evento ya pasó.');
                $completed++;
            });

        // 2. Enviado y sin firmar por X días (o el evento ya pasó) -> Expirado, libera la fecha
        $days = (int) $this->option('expire-days');
        $expired = 0;
        Contract::where('status', Contract::STATUS_SENT)
            ->where(function ($q) use ($days) {
                $q->where('sent_at', '<', now()->subDays($days))
                    ->orWhereDate('event_date', '<', today());
            })
            ->each(function (Contract $contract) use (&$expired, $days) {
                $contract->transitionTo(Contract::STATUS_EXPIRED, "Automático: no se firmó en {$days} días.");
                $expired++;
            });

        $this->info("Completados: {$completed} · Expirados: {$expired}");
    }
}
