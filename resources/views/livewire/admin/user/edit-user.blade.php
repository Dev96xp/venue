<div class="mt-2">
    {{-- Button --}}
    <div>
        <x-button wire:click="$set('open', true)">
            Edit
        </x-button>
        {{-- <div wire:click="$set('open', true)" class="text-sm font-bold text-blue-700">
            {{ $product->name }}
        </div> --}}
    </div>

    {{-- Modal --}}
    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Edit product
            {{-- {{ $section->name }} --}}
        </x-slot>

        <x-slot name="content">

            <div class="grid grid-cols-7 gap-2 mb-3">
                <div class="col-span-5">
                    <x-label value="Name" class="mb-1" />
                    <x-input type="text" class="w-full text-blue-800 font-bold" wire:model.live="name"
                        id="" />
                    <x-input-error for="name" />
                </div>
                <div class="col-span-2">
                    <x-label value="Phone" class="mb-1" />
                    <x-input type="text" class="w-full text-blue-800 font-bold" wire:model.live="phone"
                        id="" />
                    <x-input-error for="phone" />
                </div>
            </div>
            <div class="grid grid-cols-4 gap-4 mb-3">
                <div class="col-span-2">
                    <x-label value="Address" class="mb-1" />
                    <x-input type="text" class="w-full text-blue-800 font-bold" wire:model.live="address"
                        id="" />
                    <x-input-error for="address" />
                </div>
                <div class="col-span-1">
                    <x-label value="City" class="mb-1" />
                    <x-input type="text" class="w-full text-blue-800 font-bold" wire:model.live="city"
                        id="" />
                    <x-input-error for="city" />
                </div>
                <div class="col-span-1">
                    <x-label value="Zip" class="mb-1" />
                    <x-input type="text" class="w-full text-blue-800 font-bold" wire:model.live="zip"
                        id="" />
                    <x-input-error for="zip" />
                </div>

            </div>
            <div class="grid grid-cols-4 gap-4 mb-3">
                <div class="col-span-1">
                    <x-label value="State" class="mb-1" />
                    <x-input type="text" class="w-full text-blue-800 font-bold" wire:model.live="state"
                        id="" />
                    <x-input-error for="state" />
                </div>

                <div class="col-span-2">
                    <x-label value="Email" class="mb-1" />
                    <x-input type="text" class="w-full text-blue-800 font-bold" wire:model.live="email"
                        id="" />
                    <x-input-error for="email" />
                </div>

                {{-- Selecionar Store --}}
                <div class="col-span-1">
                    <x-label value="Store" class="mb-1" />
                    {{-- El select esta sincronizado con la propiedad color --}}
                    <select wire:model.live="store_id" class="form-control w-full">
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
            <x-secondary-button class="mr-4" wire:click="$set('open', false)">
                Cancelar
            </x-secondary-button>

            <x-danger-button wire:click="update">
                Update
            </x-danger-button>
        </x-slot>

    </x-dialog-modal>


    {{-- MASTER CLASS - Para que se ejecute el codigo de javascript de un componente de LIVEWIRE,
        hay que encerrarlo con las directivas de PUSH, @push('script') y que este lo envie a la
        plantilla pricipal, esta lo recibira travez de la directiva @stack('script') y listo  --}}
    @push('script')
        {{-- Nada de codigo de javascript por el momento --}}
    @endpush

</div>
