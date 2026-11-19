<div class="contracts-module px-4 sm:px-6 lg:px-8 pb-8">

    @if (session('info'))
        <div class="alert alert-success">{{ session('info') }}</div>
    @endif

    <div class="alert alert-warning">
        <i class="fas fa-balance-scale"></i>
        La plantilla incluida es un punto de partida. Haz que un abogado con licencia en Nebraska la revise antes de usarla con clientes.
    </div>

    @if (! $editingId)
        <div class="flex justify-between mb-3">
            <a href="{{ route('admin.contracts.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Contratos</a>
            <button type="button" wire:click="create" class="btn btn-danger btn-sm"><i class="fas fa-plus"></i> Nueva plantilla</button>
        </div>

        <x-table-responsive>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Version</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Idiomas</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Contratos</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Updated</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($templates as $template)
                        <tr wire:key="tpl-{{ $template->id }}">
                            <td class="px-4 py-3 text-sm font-bold">{{ $template->name }}</td>
                            <td class="px-4 py-3 text-sm">v{{ $template->version }}</td>
                            <td class="px-4 py-3 text-sm">EN{{ filled($template->body_es) ? ' · ES' : '' }}</td>
                            <td class="px-4 py-3 text-sm">{{ $template->contracts_count }}</td>
                            <td class="px-4 py-3 text-sm">
                                <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-medium {{ $template->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $template->is_active ? 'Activa' : 'Inactiva' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-500">{{ $template->updated_at->format('M j, Y') }}</td>
                            <td class="px-4 py-3 text-sm text-right">
                                <span class="text-blue-600 cursor-pointer mr-3" wire:click="edit({{ $template->id }})">Editar</span>
                                <span class="text-gray-600 cursor-pointer" wire:click="toggleActive({{ $template->id }})">
                                    {{ $template->is_active ? 'Desactivar' : 'Activar' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-3 text-sm">
                                No hay plantillas. Ejecuta <code>php artisan db:seed --class=ContractTemplateSeeder</code> para cargar la plantilla base.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </x-table-responsive>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
            <div class="lg:col-span-3">
                <div class="card">
                    <div class="card-body">
                        <x-label value="Nombre de la plantilla" class="mb-1" />
                        <x-input type="text" class="w-full mb-1" wire:model="name" />
                        <x-input-error for="name" />

                        <div class="flex flex-wrap justify-between gap-2 my-3">
                            {{-- Idioma: ambos textos viven en la MISMA plantilla --}}
                            <div class="btn-group">
                                <button type="button" wire:click="$set('lang', 'en')" class="btn btn-sm {{ $lang === 'en' ? 'btn-primary' : 'btn-outline-primary' }}">English</button>
                                <button type="button" wire:click="$set('lang', 'es')" class="btn btn-sm {{ $lang === 'es' ? 'btn-primary' : 'btn-outline-primary' }}">
                                    Español @if (blank($body_es)) <span class="badge badge-warning">vacío</span> @endif
                                </button>
                            </div>
                            <div class="flex gap-2">
                                <button type="button" wire:click="$set('preview', false)" class="btn btn-sm {{ $preview ? 'btn-outline-secondary' : 'btn-secondary' }}">Editar texto</button>
                                <button type="button" wire:click="$set('preview', true)" class="btn btn-sm {{ $preview ? 'btn-secondary' : 'btn-outline-secondary' }}">Vista previa</button>
                            </div>
                        </div>

                        @php $currentText = $lang === 'es' ? $body_es : $body; @endphp

                        @if ($preview)
                            <div class="border rounded p-4 contract-body">
                                {!! \Illuminate\Support\Str::markdown($currentText ?? '', ['html_input' => 'strip', 'allow_unsafe_links' => false]) !!}
                            </div>
                        @else
                            @if ($lang === 'es')
                                <textarea wire:model="body_es" rows="30" class="form-control font-mono text-sm" wire:key="ta-es"
                                    placeholder="Versión en español del contrato (opcional)"></textarea>
                                <x-input-error for="body_es" />
                                <p class="text-xs text-gray-500 mt-1">
                                    Usa las mismas variables que en inglés. Si se deja vacío, el contrato solo estará en inglés.
                                </p>
                            @else
                                <textarea wire:model="body" rows="30" class="form-control font-mono text-sm" wire:key="ta-en"></textarea>
                                <x-input-error for="body" />
                            @endif
                            <p class="text-xs text-gray-500 mt-1">
                                Formato Markdown: <code># Título</code>, <code>## Sección</code>, <code>**negrita**</code>, <code>- lista</code>, <code>&gt; nota</code>.
                            </p>
                        @endif
                        @error('body') @if ($lang === 'es') <div class="text-red-600 text-sm mt-1">Revisa la pestaña English: {{ $message }}</div> @endif @enderror
                        @error('body_es') @if ($lang === 'en') <div class="text-red-600 text-sm mt-1">Revisa la pestaña Español: {{ $message }}</div> @endif @enderror

                        @if ($editingId !== 'new' && \App\Models\ContractTemplate::find($editingId)?->contracts()->exists())
                            <div class="alert alert-info mt-3 mb-0 text-sm">
                                Esta plantilla ya se usó en contratos. Al guardar se creará una <strong>nueva versión</strong>
                                y los contratos anteriores conservarán su texto original.
                            </div>
                        @endif

                        <div class="flex justify-end gap-2 mt-3">
                            <button type="button" wire:click="close" class="btn btn-secondary">Cancelar</button>
                            <button type="button" wire:click="save" class="btn btn-danger">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="card">
                    <div class="card-header font-bold">Variables disponibles</div>
                    <div class="card-body text-xs">
                        <p class="text-gray-500 mb-2">Se reemplazan con los datos de cada contrato.</p>
                        @foreach (\App\Models\ContractTemplate::PLACEHOLDERS as $key => $label)
                            <div class="mb-1">
                                <code>{{ '{' . $key . '}' }}</code>
                                <div class="text-gray-500">{{ $label }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
