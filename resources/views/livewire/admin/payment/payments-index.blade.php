<div>

    {{-- @can('Permission index')    PERMISO DE SEGURIDAD --}}

    <div class="card">
        <div class="card-body">
            <div class="flex">
                <div class="text-lg mr-10 py-1">
                    <h1>Type of Payments</h1>
                </div>
                <div>
                    {{-- @can('Payments index') --}}
                    @livewire('admin.payment.payments-create')
                    {{-- @endcan --}}
                </div>

                <div>
                    <select wire:model="numbers" name="numbers" id="numbers">
                        <option value="6">6 records</option>
                        <option value="16">16 records</option>
                        <option value="25">25 records</option>
                        <option value="50">50 records</option>
                        <option value="100">100 records</option>
                    </select>
                </div>

            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">


            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($payments->count())
                        @foreach ($payments as $payment)
                            <tr wire:key="pagos-{{ $payment->id }}">
                                <td>{{ $payment->id }}</td>
                                <td>{{ $payment->code }}</td>
                                <td>{{ $payment->name }}</td>
                                <td>{{ $payment->signo }}</td>
                                <td>
                                    @livewire('admin.payment.payments-edit', ['payment' => $payment], key($payment->id))
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr colspan="4">No product item</tr>
                    @endif
                </tbody>
            </table>

            {{-- card-footer -  Esta es una clase de boostrap --}}
            <div class="card-footer">
                {{ $payments->links() }}
            </div>

        </div>


        <div class="mb-2 ml-2">
            <p>Type: 0 - Pago, 1 - NO USAR, 2 - Descuento especial, 3 - Cargo Variante</p>
        </div>
    </div>
    {{-- @endcan --}}

</div>
