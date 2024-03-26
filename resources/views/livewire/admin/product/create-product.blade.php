<div>
    {{-- Button --}}
    <div>
        <x-danger-button wire:click="$set('open', true)">
            Create product
        </x-danger-button>
    </div>


    {{-- Modal --}}
    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Create product
            {{-- {{ $section->name }} --}}
        </x-slot>

        <x-slot name="content">

            <div class="grid grid-cols-3 gap-4 mb-3">
                <div class="col-span-1">
                    <x-label value="Model" class="mb-1" />
                    <x-input type="text" class="w-full" wire:model.defer="model" id="model"/>
                    <x-input-error for="model" />

                </div>
                {{-- Selecionar BRAND --}}
                <div class="col-span-1">
                    <x-label value="Brand" class="mb-1" />
                    {{-- El select esta sincronizado con la propiedad color --}}
                    <select wire:model.live="brand_id" class="form-control w-full">
                        {{-- Este es el valor por default --}}
                        <option value="" selected disabled>Brand</option>

                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="brand_id" />

                </div>
                <div class="col-span-1">
                    <x-label value="Sku" class="mb-1" />
                    <x-input readonly type="text" class="w-full bg-gray-100" wire:model.defer="sku" id="sku" />
                    <x-input-error for="sku" />
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4 mb-3">
                {{-- Selecionar CATEGORY --}}
                <div class="col-span-1">
                    <x-label value="Category" class="mb-1" />
                    {{-- El select esta sincronizado con la propiedad color --}}
                    <select wire:model.live="category_id" class="form-control w-full">
                        {{-- Este es el valor por default --}}
                        <option value="" selected disabled>Category</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="category_id" />

                </div>
                {{-- Selecionar SUBCATEGORY --}}
                <div class="col-span-1">
                    <x-label value="Subcategory" class="mb-1" />
                    {{-- El select esta sincronizado con la propiedad color --}}
                    <select wire:model.live="subcategory_id" class="form-control w-full">
                        {{-- Este es el valor por default --}}
                        <option value="" selected disabled>Subcategories</option>

                        @foreach ($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="brand_id" />

                </div>
                <div class="col-span-1">
                    <x-label value="Style(OPTIONAL)" class="mb-1" />
                    <x-input type="text" class="w-full" wire:model.defer="style" id="style" />
                    <x-input-error for="style" />
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-3">
                <div class="col-span-1">
                    <x-label value="Product Name" class="mb-1" />
                    <x-input type="text" class="w-full" wire:keyup='generateSlug' wire:model.defer="name" id="" />
                    <x-input-error for="name" />
                </div>

                <div class="col-span-1">
                    <x-label value="Slug" class="mb-1" />
                    <x-input readonly type="text" class="w-full bg-gray-100" wire:model.defer="slug" id="" />
                    <x-input-error for="slug" />
                </div>
            </div>

            <div class="grid grid-cols-4 gap-4 mb-3">
                <div class="col-span-1">
                    <x-label value="R Price USD" class="mb-1" />
                    <x-input type="text" class="w-full" wire:model.live="price" id="price" />
                    <x-input-error for="price" />
                </div>
                <div class="col-span-1">
                    <x-label value="Online USD" class="mb-1" />
                    <x-input type="text" class="w-full" wire:model.defer="webprice" id="webprice" />
                    <x-input-error for="webprice" />
                </div>
                <div class="col-span-1">
                    <x-label value="Wholesale USD" class="mb-1" />
                    <x-input type="text" class="w-full" wire:model.defer="wholesaleprice" id="wholesaleprice" />
                    <x-input-error for="wholesaleprice" />
                </div>
                <div class="col-span-1">
                    <x-label value="Suggeted USD" class="mb-1" />
                    <x-input type="text" class="w-full" wire:model.defer="suggestedprice" id="suggestedprice" />
                    <x-input-error for="suggestedprice" />
                </div>
            </div>
            <div class="grid grid-cols-3 gap-4 mb-3">
                <div class="col-span-1">
                    <x-label value="Discount %" class="mb-1" />
                    <x-input type="text" class="w-full" wire:model.defer="discount" id="discount" />
                    <x-input-error for="discount" />
                </div>

                {{-- Selecionar STATUS --}}
                <div class="col-span-1">
                    <x-label value="Status" class="mb-1" />
                    {{-- El select esta sincronizado con la propiedad color --}}
                    <select wire:model.live="status_product_id" class="form-control w-full">
                        {{-- Este es el valor por default --}}
                        <option value="" selected disabled>Status</option>

                        @foreach ($statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="status_product_id" />

                </div>
            </div>

            <div class="grid grid-cols-3 gap-4 mb-3">
                <div class="col-span-2">
                    <x-label value="Description" class="mb-1" />
                    <textarea wire:model.defer="description" class="w-full form-control" rows="4"></textarea>
                    <x-input-error for="description" />
                </div>

                <div class="col-span-1">

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
        {{-- Nada de codigo de javascript por el momento --}}
    @endpush

</div>
