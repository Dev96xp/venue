<div>
    {{-- PERMISO DE SEGURIDAD --}}
    {{-- @can('Permission index') --}}

    {{-- PACKAGE CONFIGURATION --}}

    <div class="grid grid-cols-6 gap-6">


        {{-- 1- LISTA DE PAQUETES --}}
        <div class="col-span-2">
            {{-- titulo --}}
            <div class="card">
                <div class="card-body">
                    <div class="flex">
                        <div class="text-lg mr-10 py-1">
                            Packages X
                        </div>
                        <div>
                            @livewire('admin.event.create-package')
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
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($packages->count())
                                @foreach ($packages as $package)
                                    <tr wire:key="paquete-{{ $package->id }}"> {{-- SUPER IMPORTANTE --}}
                                        <td>{{ $package->id }}</td>
                                        <td>{{ $package->code }}</td>

                                        <td class="py-1 cursor-pointer"
                                            wire:click="select_package({{ $package }})">
                                            <div class="font-bold">{{ $package->name }}</div>
                                        </td>

                                        <td>{{ $package->status }}</td>
                                        <td>
                                            @livewire('admin.event.package-edit', ['package' => $package],
                                            key($package->id))
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr colspan="4">No product found</tr>
                            @endif
                        </tbody>
                    </table>

                    {{-- card-footer -  Esta es una clase de boostrap --}}
                    <div class="card-footer">
                        {{ $packages->links() }}
                    </div>

                </div>
            </div>
        </div>



        {{-- 2- LISTA DE ELEMENTOS DE CADA PAQUETE --}}

        <div class="col-span-2">
            {{-- titulo --}}
            <div class="card">
                <div class="card-body">
                    <div class="flex">
                        <div class="text-lg mr-10 py-1">
                            <span class="text-gray-900">Package:</span> <span class="text-red-600">{{ $package_name }}</span>
                        </div>

                        <div class="right">
                            @livewire('admin.event.add-element')
                        </div>
                    </div>
                </div>

            </div>

            {{-- lista elemento por paquete --}}
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @if ($elements->count()) --}}
                            @foreach ($elements as $element)
                                <tr>
                                    <td>{{ $element->id }}</td>
                                    <td>{{ $element->code }}</td>
                                    <td>{{ $element->name }}</td>
                                    <td>{{ $element->status }}</td>
                                    {{-- <td>
                                            @livewire('admin.permission.edit-permission', ['permission' => $permission],
                                            key($permission->id))
                                        </td> --}}

                                    <td class="cursor-pointer whitespace-nowrap text-right"
                                        wire:click="delete_element({{ $element }})">
                                        <div class="text-red-600 hover:text-red-900">
                                            Delete
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                            {{-- @else
                                <tr colspan="4">No product found</tr>
                            @endif --}}
                        </tbody>
                    </table>

                    {{-- card-footer -  Esta es una clase de boostrap --}}
                    <div class="card-footer">
                        {{-- {{ $elements->links() }} --}}
                    </div>

                </div>
            </div>
        </div>


        {{-- 3- LISTA DE CADA ELEMENTO EXISTENTE --}}
        <div class="col-span-2">
            <div class="card">
                <div class="card-body">
                    <div class="flex">
                        <div class="text-lg mr-10 py-1">
                            All elements
                        </div>
                        <div>
                            {{-- xxx @livewire('admin.packages.create-element') --}}
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

            {{-- LISTA --}}
            <div class="card">
                <div class="card-body">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($all_elements->count())
                                @foreach ($all_elements as $elementx)
                                    <tr>
                                        <td>{{ $elementx->id }}</td>
                                        <td>{{ $elementx->code }}</td>
                                        <td>{{ $elementx->name }}</td>
                                        <td>
                                            {{-- xxx @livewire('admin.packages.edit-element', ['element' => $elementx], key($elementx->id)) --}}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr colspan="4">No product found</tr>
                            @endif
                        </tbody>
                    </table>

                    {{-- card-footer -  Esta es una clase de boostrap --}}
                    {{-- <div class="card-footer">
                        {{ $elements->links() }}
                    </div> --}}

                </div>
            </div>
        </div>



    </div>


    {{-- @endcan --}}
</div>
