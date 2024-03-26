<div>
    {{-- Packages Locations --}}
    <div class="card">
        <div class="card-body">

            <div class="flex gap-4">

                <div class="mr-10 py-1">
                    <h2 class="text-lg text-blue-500">Packages Locations</h2>
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


                <div>
                    {{-- xxx @livewire('admin.packages.location-create') --}}
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
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($package_locations as $package_location)
                        <tr>
                            <td>{{ $package_location->id }}</td>

                            <td class="GITcursor-pointer" wire:click="">
                                <div class="font-bold">{{ $package_location->name }}</div>
                            </td>

                            <td>{{ $package_location->status }}</td>

                            {{-- xxx <td>@livewire('admin.packages.edit-location', ['package_location' => $package_location], key($package_location->id))</td> --}}
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

