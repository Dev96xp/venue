<div>
    {{-- Button --}}
    <div>
        <x-danger-button wire:click="$set('open', true)">
            Create customer
        </x-danger-button>
    </div>


    {{-- Modal --}}
    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Create customer
            {{-- {{ $section->name }} --}}
        </x-slot>

        <x-slot name="content">

            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <x-label value="Name" />
                    <x-input type="text" class="w-full" wire:model.defer="name" />
                    <x-input-error for="name" />

                </div>
                <div class="mb-4">
                    <x-label value="E-mail" />
                    <x-input type="text" class="w-full" wire:model.defer="email" />
                    <x-input-error for="email" />
                </div>
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-1 mb-4">
                    <x-label value="Phone" />
                    <x-input type="text" class="w-full" wire:model.defer="phone" onkeydown="phoneNumberFormatter()"
                        id="phone-number" />
                    <x-input-error for="phone" />
                </div>

                <div class="col-span-2 mb-4">
                    <x-label value="Company [OPTIONAL]" />
                    <x-input type="text" class="w-full" wire:model.defer="company" />
                    <x-input-error for="company" />
                </div>
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-2 mb-4">
                    <x-label value="Address" />
                    <x-input type="text" class="w-full" wire:model.defer="address" />
                    <x-input-error for="address" />

                </div>

                <div class="col-span-1 mb-4">
                    <x-label value="City" />
                    <x-input type="text" class="w-full" wire:model.defer="city" />
                    <x-input-error for="city" />

                </div>
            </div>
            <div class="grid grid-cols-4 gap-4">
                <div class="col-span-1 mb-4">
                    <x-label value="State" />
                    <x-input type="text" class="w-full" wire:model.defer="state" />
                    <x-input-error for="state" />
                </div>

                <div class="col-span-1 mb-4">
                    <x-label value="Zip" />
                    <x-input type="text" class="w-full" wire:model.defer="zip" />
                    <x-input-error for="zip" />
                </div>
                {{-- Selecionar TIENDA --}}
                <div class="col-span-1 mb-4">
                    <x-label value="Store" />
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
            <x-secondary-button class="mr-4" wire:click="$set('open', false)">
                Cancelar
            </x-secondary-button>

            <x-danger-button wire:click="save">
                Create
            </x-danger-button>
        </x-slot>

    </x-dialog-modal>


    {{-- MASTER CLASS - Para que se ejecute el codigo de javascript de un componente de LIVEWIRE,
        hay que encerrarlo con las directivas de PUSH, @push('script') y que este lo envie a la
        plantilla pricipal, esta lo recibira travez de la directiva @stack('script') y listo  --}}
    @push('script')
        <script>
            // Formatea EL PHONE NUMBER

            function formatPhoneNumber(value) {
                if (!value) return value;
                const phoneNumber = value.replace(/[^\d]/g, '');
                const phoneNumberLength = phoneNumber.length;
                if (phoneNumberLength < 4) return phoneNumber;
                if (phoneNumberLength < 7) {
                    // return `(${phoneNumber.slice(0, 3)}) ${phoneNumber.slice(3)}`;    ORIGINAL
                    return `${phoneNumber.slice(0, 3)}-${phoneNumber.slice(3)}`; //NEW
                }
                // return `(${phoneNumber.slice(0, 3)}) ${phoneNumber.slice(      ORIGINAL
        //                 3,
        //                 6
        //               )}-${phoneNumber.slice(6, 9)}`;

                return `${phoneNumber.slice(0, 3)}-${phoneNumber.slice(
                        3,
                        6
                        )}-${phoneNumber.slice(6, 9)}`;
            }

            function phoneNumberFormatter() {
                const inputField = document.getElementById('phone-number');
                const formattedInputValue = formatPhoneNumber(inputField.value);
                inputField.value = formattedInputValue;
            }
        </script>
    @endpush

</div>
