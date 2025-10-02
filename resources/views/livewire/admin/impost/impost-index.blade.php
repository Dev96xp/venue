<div>
    <div class="flex">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Impuestos</h1>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    {{-- @livewire('component', ['user' => $user], key($user->id)) --}}
                </div>
            </div>
            <div class="mt-4 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-3 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                        Imposts</th>

                                    <th class="text-left text-sm font-semibold">Total tax</th>
                                </tr>

                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">

                                @foreach ($imposts as $impost)
                                    <tr wire:key="impost-{{ $impost->id }}"> {{-- SUPER IMPORTANTE --}}

                                        <td wire:click="select_impost({{ $impost }})"
                                            class="whitespace-nowrap px-3 py-1 text-sm text-gray-500">
                                            <div class="text-gray-900 font-bold">{{ $impost->name }}</div>

                                            <div class="text-blue">
                                                @foreach ($impost->taxes as $tax)
                                                    {{ $tax->name }},
                                                @endforeach
                                            </div>

                                        </td>

                                        <td class="whitespace-nowrap px-3 py-1 text-sm text-gray-500">
                                            <div class="text-blue">
                                                @php
                                                    $total_tax = 0;
                                                @endphp
                                                @foreach ($impost->taxes as $tax)
                                                    @php
                                                        $total_tax = $total_tax + $tax->tax;
                                                    @endphp
                                                @endforeach
                                            </div>
                                            <div class="text-gray-900 font-bold">{{ $total_tax }} %</div>
                                        </td>

                                        <td wire:click="del_impost({{ $impost }})"
                                            class="relative text-red-600 hover:text-red-900 whitespace-nowrap py-1 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                            Delete
                                        </td>

                                        <td class="whitespace-nowrap px-3 py-1 text-sm text-gray-500">
                                            @livewire('admin.impost.edit-impost', ['impost' => $impost], key($impost->id))
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
