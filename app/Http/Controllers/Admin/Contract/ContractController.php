<?php

namespace App\Http\Controllers\Admin\Contract;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Contract;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index()
    {
        return view('admin.contracts.index');
    }

    // admin/contracts/create?user=ID  -> llena el contrato con los datos del cliente
    public function create(Request $request)
    {
        $user = $request->filled('user') ? User::findOrFail($request->query('user')) : null;

        return view('admin.contracts.form', ['contract' => null, 'user' => $user]);
    }

    public function show(Contract $contract)
    {
        return view('admin.contracts.show', compact('contract'));
    }

    public function edit(Contract $contract)
    {
        if (! $contract->isEditable()) {
            return redirect()->route('admin.contracts.show', $contract)
                ->with('info', 'Solo los contratos en borrador se pueden editar.');
        }

        return view('admin.contracts.form', ['contract' => $contract, 'user' => $contract->user]);
    }

    // admin/contracts/{id}/pdf?lang=es
    public function pdf(Request $request, Contract $contract)
    {
        $business = Business::first();
        $lang = $request->query('lang') === 'es' && $contract->hasSpanish() ? 'es' : 'en';
        $size = in_array((int) $request->query('size'), [1, 2, 3]) ? (int) $request->query('size') : 1; // A, A+, A++

        $pdf = Pdf::loadView('admin.contracts.pdf', compact('contract', 'business', 'lang', 'size'))
            ->setPaper('letter');

        // Número de página en cada hoja
        $pdf->render();
        $dompdf = $pdf->getDomPDF();
        $canvas = $dompdf->getCanvas();
        $font = $dompdf->getFontMetrics()->getFont('DejaVu Serif');
        $canvas->page_text($canvas->get_width() / 2 - 25, $canvas->get_height() - 40,
            ($lang === 'es' ? 'Página {PAGE_NUM} de {PAGE_COUNT}' : 'Page {PAGE_NUM} of {PAGE_COUNT}'),
            $font, 8, [0.35, 0.35, 0.35]);

        return response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $contract->code . '-' . strtoupper($lang) . '.pdf"',
        ]);
    }

    public function templates()
    {
        return view('admin.contracts.templates');
    }
}
