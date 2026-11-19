@php
    $es = ($lang ?? 'en') === 'es';
    $venue = $business->name ?? config('app.name');
    $t = $es
        ? [
            'title' => 'Contrato de Renta del Salón',
            'initials' => 'Iniciales del cliente',
            'client_sig' => 'Firma del cliente',
            'date' => 'Fecha',
            'printed' => 'Nombre del cliente',
            'rep' => 'Representante autorizado',
            'draft' => 'BORRADOR', 'cancelled' => 'CANCELADO', 'expired' => 'EXPIRADO',
        ]
        : [
            'title' => 'Venue Rental Agreement',
            'initials' => 'Client initials',
            'client_sig' => 'Client signature',
            'date' => 'Date',
            'printed' => 'Client printed name',
            'rep' => 'Authorized representative',
            'draft' => 'DRAFT', 'cancelled' => 'CANCELLED', 'expired' => 'EXPIRED',
        ];
    $eventDate = $es
        ? $contract->event_date->locale('es')->translatedFormat('j M Y')
        : $contract->event_date->format('M j, Y');
@endphp
<!DOCTYPE html>
<html lang="{{ $es ? 'es' : 'en' }}">
<head>
    <meta charset="UTF-8">
    <title>{{ $contract->code }}</title>
    <style>
        @page { margin: 70px 60px 80px 60px; }
        @php
            // Tamaño de letra elegido en pantalla: A (11px), A+ (13.75px), A++ (16.5px)
            $base = [1 => 11, 2 => 13.75, 3 => 16.5][$size ?? 1] ?? 11;
        @endphp
        body { font-family: DejaVu Serif, serif; font-size: {{ $base }}px; line-height: {{ ($size ?? 1) === 3 ? 1.55 : 1.45 }}; color: #111; }
        header { position: fixed; top: -50px; left: 0; right: 0; font-size: 9px; color: #555; border-bottom: 1px solid #ccc; padding-bottom: 4px; }
        footer { position: fixed; bottom: -55px; left: 0; right: 0; font-size: 9px; color: #555; border-top: 1px solid #ccc; padding-top: 4px; }
        footer .initials { float: right; }
        h1 { font-size: 1.55em; text-align: center; margin: 0 0 12px; letter-spacing: 1px; }
        h2 { font-size: 1.1em; margin: 14px 0 4px; text-transform: uppercase; }
        p { margin: 0 0 7px; text-align: justify; }
        ul { margin: 0 0 7px; padding-left: 18px; }
        li { margin-bottom: 2px; }
        blockquote { margin: 0 0 8px; padding: 5px 8px; border-left: 3px solid #b45309; background: #fef3c7; }
        blockquote p { margin: 0; }
        .watermark { position: fixed; top: 38%; left: 8%; font-size: 100px; color: rgba(200, 0, 0, 0.08); transform: rotate(-35deg); font-weight: bold; }
        .signatures { margin-top: 30px; page-break-inside: avoid; }
        .signatures table { width: 100%; border-collapse: collapse; }
        .signatures td { width: 50%; vertical-align: bottom; padding: 26px 16px 0 0; }
        .line { border-top: 1px solid #000; padding-top: 3px; font-size: .9em; }
    </style>
</head>
<body>
    <header>
        {{ $venue }} — {{ $t['title'] }} {{ $contract->code }}
    </header>

    <footer>
        {{ $contract->client_name }} · {{ $eventDate }}
        <span class="initials">{{ $t['initials'] }}: ________</span>
    </footer>

    @if (in_array($contract->status, [\App\Models\Contract::STATUS_DRAFT, \App\Models\Contract::STATUS_CANCELLED, \App\Models\Contract::STATUS_EXPIRED]))
        <div class="watermark">{{ $t[$contract->status] }}</div>
    @endif

    {!! $contract->contractHtml($es ? 'es' : 'en') !!}

    <div class="signatures">
        <table>
            <tr>
                <td><div class="line">{{ $t['client_sig'] }}</div></td>
                <td><div class="line">{{ $t['date'] }}</div></td>
            </tr>
            <tr>
                <td><div class="line">{{ $t['printed'] }}: {{ $contract->client_name }}</div></td>
                <td></td>
            </tr>
            <tr>
                <td><div class="line">{{ $t['rep'] }}, {{ $venue }}</div></td>
                <td><div class="line">{{ $t['date'] }}</div></td>
            </tr>
        </table>
    </div>
</body>
</html>
