<div>
    {{-- PERMISO DE SEGURIDAD --}}
    {{-- @can('Permission index')  --}}

        <div class="card">
            <div class="card-body">
                <div class="flex">
                    <div class="text-lg mr-10 py-1">
                        <h1>Permissions</h1>
                    </div>
                    <div>
                        @can('Permission create')
                            @livewire('admin.permission.create-permission')
                        @endcan
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
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($permissions->count())
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>

                                    <td>
                                        {{-- @livewire('admin.permission.edit-permission', ['permission' => $permission],
                                        key($permission->id)) --}}
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
                    {{ $permissions->links() }}
                </div>

            </div>
        </div>
    {{-- @endcan --}}
</div>
