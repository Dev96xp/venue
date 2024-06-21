<div>

    <div class="flex items-center">

        <div class="mr-4">

            <x-danger-button class="py-2" wire:click="$set('open', true)">
                Editar
            </x-danger-button>

        </div>

    </div>


    <x-dialog-modal wire:model="open">

        <x-slot name="title">
            EDITAR CLIENTE
        </x-slot>

        <x-slot name="content">

            {{-- Grid con 3 columnas --}}
            <div class="grid grid-cols-4 gap-4">

                <div class="col-span-2 mb-4">
                    <x-label value="Nombre del cliente" />
                    <x-input wire:model.defer="name" type="text" class="w-full" />
                    {{-- Revisa por alhun error de validacion --}}
                    <x-input-error for="name" />
                </div>

                <div class="col-span-1 mb-4">
                    <x-label value="Phone" />
                    <x-input wire:model.defer="phone" type="text" class="w-full"
                        onkeydown="phoneNumberFormatter()" id="phone-number"/>
                    <x-input-error for="phone" />
                </div>

                <div class="col-span-1 mb-4">
                    <x-label value="Phone 2  (Optional)" />
                    <x-input wire:model.defer="phone2" type="text" class="w-full"
                        onkeydown="phoneNumberFormatter2()" id="phone-number2"/>
                    <x-input-error for="phone2" />
                </div>

            </div>
            {{-- Grid con 6 columnas --}}
            <div class="grid grid-cols-6 gap-4">

                <div class="col-span-3 mb-4">
                    <x-label value="Address" />
                    <x-input wire:model.defer="address" type="text" class="w-full" />
                    <x-input-error for=".address" />
                </div>

                <div class="col-span-2 mb-4">
                    <x-label value="City" />
                    <x-input wire:model.defer="city" type="text" class="w-full" />
                    <x-input-error for="city" />
                </div>

                <div class="col-span-1 mb-4">
                    <x-label value="State" />
                    <x-input wire:model.defer="state" type="text" class="w-full" />
                    <x-input-error for="state" />
                </div>
            </div>

            {{-- Grid con 6 columnas --}}
            <div class="grid grid-cols-6 gap-4">

                <div class="col-span-1 mb-4">
                    <x-label value="Zip" />
                    <x-input wire:model.defer="zip" type="text" class="w-full" />
                    <x-input-error for="zip" />
                </div>


            </div>

            {{-- Grid con 6 columnas --}}
            <div class="grid grid-cols-6 gap-4">

                <div class="col-span-3 mb-4">
                    <x-label value="email" />
                    <x-input wire:model.defer="email" type="text" class="w-full" />
                    <x-input-error for="email" />
                </div>

                <div class="col-span-3 mb-4">
                    <h1 class="mb-2 font-bold">Stores</h1>
                    {{-- El select esta sincronizado con la propiedad color --}}
                    <select wire:model="store_id" class="form-control w-full">
                        {{-- Este es el valor por default --}}
                        <option value="" selected disabled>Store</option>

                        @foreach ($stores as $store)
                            <option value="{{ $store->id }}">{{ $store->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="store_id" />
                </div>

            </div>



        </x-slot>

        <x-slot name="footer">

            <x-secondary-button wire:click="$set('open', false)" class="mr-2">
                Cancelar
            </x-secondary-button>

            @switch($botton_type)
                @case('nada')
                    {{-- nada --}}
                @break

                @case('create')
                    <x-danger-button wire:click="save">
                        Crear User
                    </x-danger-button>
                @break

                @case('edit')
                    <x-danger-button wire:click="update('{{ $user }}')">
                        Update User
                    </x-danger-button>
                @break

                @default
            @endswitch
        </x-slot>

    </x-dialog-modal>

</div>
