<div>
    <div class="card">
        {{-- card-header - boostrap --}}
        <div class="card-header">

            <div class="py-1 px-1 grid grid-cols-4 lg:grid-cols-7 gap-2">

                {{-- Selecionar TIENDA --}}
                <div class="col-span-2">

                    {{-- El select esta sincronizado con la propiedad color --}}
                    <select wire:model.live="store_id" class="form-control w-full">
                        {{-- Este es el valor por default --}}
                        <option value="" selected disabled>Store</option>

                        @foreach ($stores as $store)
                            <option value="{{ $store->id }}">{{ $store->name }}</option>
                        @endforeach
                    </select>

                </div>

                {{-- LIVEWIRE --}}
                {{-- Boton para crear un usuario --}}
                <div class="col-span-2">
                    @livewire('admin.user.create-user')
                </div>

                {{-- MASTER CLASS --}}
                {{-- form-control - boostrap --}}
                {{-- wire:keydown="limpiar_page" - Miestras que se escribe en buscar, se ejecute este metodo
                va ayudar a facilitar la busqueda de un usuario atravez de todas las paginas de
                paginacion, el metodo limpiar_page vive en el componente --}}

                <div class="col-span-2">
                    <input wire:keydown="limpiar_page" wire:model="search" placeholder="Escriba un nombre..."
                        class="form-control w-full">
                </div>

                {{-- bUSCADO POR QR Barcode
                <div class="col-span-1">
                    <input wire:keydown.enter="findCustomer" wire:model="qrcode" placeholder="scan qrcode..."
                        class="form-control w-full" type="password">
                </div>  --}}

                {{-- IMPRIMIR LABEL
                <div class="col-span-1">
                    <button id="printButton"
                        class="bg-blue-400 hover:bg-blue-300 text-white font-bold py-2 px-4 rounded text-uppercase text-sm">
                        Print Label User
                    </button>
                </div>  --}}

                <div>
                    <input type="hidden" id="lbCase" name="tcase" wire:model="lbCase">
                    <input type="hidden" id="lbCode" name="code" wire:model="lbCode">
                    <input type="hidden" id="lbName" name="name" wire:model="lbName">
                    <input type="hidden" id="lbPhone" name="phone" wire:model="lbPhone">
                    <input type="hidden" id="lbStore" name="store" wire:model="lbStore">
                    <label for="">{{ $lbCode }} - {{ $lbName }}</label>
                </div>

            </div>
        </div>

        {{-- Resultado de borrar clientes --}}
        @if (session('users_deleted'))
            <div class="alert alert-info m-3 mb-0">{{ session('users_deleted') }}</div>
        @endif

        {{-- Borrar varios clientes basura a la vez --}}
        @can('User edit')
            @if (count($selected))
                <div class="m-3 mb-0 flex items-center gap-3">
                    <button type="button" class="btn btn-danger btn-sm"
                        wire:click="deleteSelected"
                        wire:confirm="¿Eliminar {{ count($selected) }} cliente(s) seleccionados? Esta acción no se puede deshacer.">
                        <i class="fas fa-trash"></i> Eliminar seleccionados ({{ count($selected) }})
                    </button>
                    <button type="button" class="btn btn-link btn-sm" wire:click="$set('selected', [])">Quitar selección</button>
                </div>
            @endif
        @endcan

        {{-- Si existe algun usario en: $users, muestra la tabla --}}
        @if ($users->count())

            {{-- METODO 1 Para pantalla grande --}}
            <div class="card-body hidden lg:block">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            @can('User edit')
                                <th width="10px" title="Seleccionar clientes vacíos para borrarlos juntos"><i class="fas fa-check-square"></i></th>
                            @endcan
                            <th>ID</th>
                            <th>Name</th>
                            <th>Phone, email</th>
                            <th>Addresss</th>
                            <th>Store</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            @php $blockers = \App\Livewire\Admin\User\UsersIndex::deletionBlockers($user); @endphp
                            <tr wire:key="usuarios-{{ $user->id }}"> {{-- SUPER IMPORTANTE --}}
                                @can('User edit')
                                    <td>
                                        @if (empty($blockers))
                                            <input type="checkbox" value="{{ $user->id }}" wire:model.live="selected">
                                        @endif
                                    </td>
                                @endcan
                                <td>{{ $user->id }}</td>
                                <td>
                                    <a class="font-bold"
                                        href="{{ route('admin.pos.index', $user) }}">{{ $user->name }}</a>
                                    @if (empty($user->store_id))
                                        <div class="text-indigo-600 hover:text-indigo-900">NOT definido</div>
                                    @else
                                        <div class="text-indigo-600 hover:text-indigo-900">{{ $user->store->name }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div>
                                        <span>
                                            {{ $user->phone }}
                                        </span>
                                    </div>
                                    <div>
                                        <span>
                                            {{ $user->email }}
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <span>
                                            {{ $user->address }}
                                        </span>
                                    </div>
                                    <div>
                                        <span>
                                            {{ $user->city }}
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-blue">
                                        @foreach ($user->ipxes as $ipx)
                                            {{ $ipx->ip }},
                                        @endforeach
                                    </div>
                                </td>

                                {{-- LIVEWIRE --}} {{-- BOTON - SI SIRVE PERO NO SE USA EN ESTE MOMENTO, PARA EDITAR CLIENTE --}}
                                <td class="py-1" width="10px">
                                    @livewire('admin.user.edit-user', ['user' => $user], key('edit-user-desktop-' . $user->id))
                                </td>

                                {{-- Crear contrato de renta con los datos de este cliente --}}
                                <td class="py-1" width="10px">
                                    <a class="btn btn-warning py-1 text-nowrap" title="Nuevo contrato"
                                        href="{{ route('admin.contracts.create', ['user' => $user->id]) }}">
                                        <i class="fas fa-file-signature"></i> Contrato
                                    </a>
                                </td>

                                {{-- Borrar cliente basura con un clic (solo si no tiene datos) --}}
                                @can('User edit')
                                    <td class="py-1" width="10px">
                                        @if (empty($blockers))
                                            <button type="button" class="btn btn-outline-danger py-1" title="Eliminar cliente"
                                                wire:click="deleteUser({{ $user->id }})" wire:loading.attr="disabled">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @else
                                            <span class="btn btn-outline-secondary py-1 disabled" style="pointer-events: auto; cursor: not-allowed"
                                                title="No se puede borrar: {{ implode(', ', $blockers) }}">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                        @endif
                                    </td>
                                @endcan

                                {{-- Aqui se agrega el ROLE a un usuario --}}
                                @can('User edit')
                                    <td width="10px">
                                        <a class="btn btn-primary py-1" href="{{ route('admin.users.edit', $user) }}">Roles</a>
                                    </td>
                                @endcan

                                <td class="py-4 cursor-pointer text-sm" wire:click="select_user({{ $user->id }})">
                                    <div class="text-indigo-600 hover:text-indigo-900">
                                        DYMO
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- METODO 2 Para pantalla pequeña --}}
            <div class="card-body block lg:hidden">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr wire:key="queso-{{ $user->id }}">
                                <td class="py-0">
                                    <a class="font-bold"
                                        href="{{ route('admin.pos.index', $user) }}">{{ $user->name }}</a>
                                    <div>
                                        <span>
                                            {{ $user->phone }}
                                        </span>
                                    </div>
                                </td>


                                {{-- LIVEWIRE --}} {{-- BOTON - SI SIRVE PERO NO SE USA EN ESTE MOMENTO, PARA EDITAR CLIENTE --}}
                                <td class="py-0" width="10px">
                                    @livewire('admin.user.edit-user', ['user' => $user], key('edit-user-mobile-' . $user->id))
                                </td>

                                <td class="py-0" width="10px">
                                    <a class="btn btn-warning py-0" title="Nuevo contrato"
                                        href="{{ route('admin.contracts.create', ['user' => $user->id]) }}">
                                        <i class="fas fa-file-signature"></i>
                                    </a>
                                </td>

                                @can('User edit')
                                    @php $mBlockers = \App\Livewire\Admin\User\UsersIndex::deletionBlockers($user); @endphp
                                    <td class="py-0" width="10px">
                                        @if (empty($mBlockers))
                                            <button type="button" class="btn btn-outline-danger py-0" title="Eliminar cliente"
                                                wire:click="deleteUser({{ $user->id }})" wire:loading.attr="disabled">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @else
                                            <span class="btn btn-outline-secondary py-0 disabled" title="No se puede borrar: {{ implode(', ', $mBlockers) }}">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                        @endif
                                    </td>
                                @endcan

                                @can('User edit')
                                    <td width="10px">
                                        <a class="btn btn-primary py-0"
                                            href="{{ route('admin.users.edit', $user) }}">Editar</a>
                                    </td>
                                @endcan

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- card-footer -  Esta es una clase de boostrap --}}
            <div class="card-footer">
                {{ $users->links() }}
            </div>
        @else
            <div class="card-body"><strong>No hay registros</strong></div>
        @endif
    </div>
</div>
