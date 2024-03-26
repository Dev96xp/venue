<div>
    {{-- lista --}}

    <div class="card">
        <h1 class="text-2xl ml-4 mt-4">Partes de la Seccion: <span class="text-blue-700">{{ $section->name }}</span></h1>

        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Part name</th>
                        <th>Description</th>
                        <th>Image</th>
                        {{-- Contiene 2 columnas --}}
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody wire:sortable="updatePartsOrder"> {{-- Livewire Sortable - Parte 3/5 --}}
                    @forelse ($parts as $part)
                        <tr wire:sortable.item="{{ $part->id }}" wire:key="part-{{ $part->id }}" wire:sortable.handle>   {{-- Livewire Sortable - Parte 2/5 --}}
                            <td>{{ $part->id }}</td>
                            <td>
                                <div>
                                    <div class="text-bold">{{ $part->name }}</div>
                                </div>
                            </td>
                            <td>{{ $part->description }}</td>
                            <td>{{ $part->url }}</td>

                            {{-- PERMISO DE SEGURIDAD --}}
                            <td>
                                <x-danger-button wire:click="delete_part('{{ $part->id }}')">
                                    delete
                                </x-danger-button>
                            </td>

                            <td>
                                @livewire('admin.sections.edit-part', ['part' => $part], key($part->id))
                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="4">No hay ningun role registrado</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>

