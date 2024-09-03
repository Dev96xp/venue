<div class="mt-8 lg:col-span-5">
    {{-- USO: DETALLES SOBRE UN PRODUCTO, aqui se controla los valores que los usuarios proporcionaron
     sobre un especifico producto como color, talla, etc --}}
    <form>
        <!-- Color picker -->
        <div>
            <h2 class="text-sm font-medium text-gray-900">Color</h2>

            <fieldset aria-label="Choose a color" class="mt-2">
                <div class="flex items-center space-x-3">
                    <!-- Active and Checked: "ring ring-offset-1" -->
                    <label aria-label="Black"
                        class="relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 ring-gray-900 focus:outline-none">
                        <input type="radio" name="color-choice" value="Black" class="sr-only">
                        <span aria-hidden="true"
                            class="h-8 w-8 rounded-full border border-black border-opacity-10 bg-gray-900"></span>
                    </label>
                    <!-- Active and Checked: "ring ring-offset-1" -->
                    <label aria-label="Heather Grey"
                        class="relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 ring-gray-400 focus:outline-none">
                        <input type="radio" name="color-choice" value="Heather Grey" class="sr-only">
                        <span aria-hidden="true"
                            class="h-8 w-8 rounded-full border border-black border-opacity-10 bg-gray-400"></span>
                    </label>
                </div>
            </fieldset>
        </div>

        <!-- Color picker MIO-->
        <div class="mt-4">
            <select wire:model="color_id" class="form-control w-full">

                {{-- Este es el valor por default --}}
                <option value="" selected disabled>Color</option>

                @foreach ($product->colors as $color)
                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                @endforeach
            </select>
            <x-input-error for="color_id" />
        </div>


        <!-- Size picker -->
        <div class="mt-8">
            <div class="flex items-center justify-between">
                <h2 class="text-sm font-medium text-gray-900">Size</h2>
                <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">See sizing
                    chart</a>
            </div>

            <!-- Size picker 2 MIO-->
            <div class="mt-4">
                <select wire:model="size_id" class="form-control w-full">
                    <option value="" selected disabled>Size</option>

                    {{-- @foreach ($product->dimensions_group->dimensions as $size) --}}
                    @foreach ($product->group->sizes as $size)
                        <option value="{{ $size->id }}">{{ $size->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="size_id" />
            </div>

        </div>

        {{-- <button type="submit"    NO SE USA ESTE BOTON
                class="mt-8 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Add
                to cart</button> --}}
    </form>

    <button wire:click="addItem('{{ $product->id }}')"
        class="mt-8 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Add
        to cart</button>

    <!-- Product details -->
    <div class="mt-10">
        <h2 class="text-sm font-medium text-gray-900">Description</h2>

        <div class="prose prose-sm mt-4 text-gray-500">
            <p>The Basic tee is an honest new take on a classic. The tee uses super soft, pre-shrunk
                cotton for true comfort and a dependable fit. They are hand cut and sewn locally, with a
                special dye technique that gives each tee it's own look.</p>
            <p>Looking to stock your closet? The Basic tee also comes in a 3-pack or 5-pack at a bundle
                discount.</p>
        </div>
    </div>

    <div class="mt-8 border-t border-gray-200 pt-8">
        <h2 class="text-sm font-medium text-gray-900">Fabric &amp; Care</h2>

        <div class="prose prose-sm mt-4 text-gray-500">
            <ul role="list">
                <li>Only the best materials</li>
                <li>Ethically and locally made</li>
                <li>Pre-washed and pre-shrunk</li>
                <li>Machine wash cold with similar colors</li>
            </ul>
        </div>
    </div>

    <!-- Policies -->
    <section aria-labelledby="policies-heading" class="mt-10">
        <h2 id="policies-heading" class="sr-only">Our Policies</h2>

        <dl class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2">
            <div class="rounded-lg border border-gray-200 bg-gray-50 p-6 text-center">
                <dt>
                    <svg class="mx-auto h-6 w-6 flex-shrink-0 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.115 5.19l.319 1.913A6 6 0 008.11 10.36L9.75 12l-.387.775c-.217.433-.132.956.21 1.298l1.348 1.348c.21.21.329.497.329.795v1.089c0 .426.24.815.622 1.006l.153.076c.433.217.956.132 1.298-.21l.723-.723a8.7 8.7 0 002.288-4.042 1.087 1.087 0 00-.358-1.099l-1.33-1.108c-.251-.21-.582-.299-.905-.245l-1.17.195a1.125 1.125 0 01-.98-.314l-.295-.295a1.125 1.125 0 010-1.591l.13-.132a1.125 1.125 0 011.3-.21l.603.302a.809.809 0 001.086-1.086L14.25 7.5l1.256-.837a4.5 4.5 0 001.528-1.732l.146-.292M6.115 5.19A9 9 0 1017.18 4.64M6.115 5.19A8.965 8.965 0 0112 3c1.929 0 3.716.607 5.18 1.64" />
                    </svg>
                    <span class="mt-4 text-sm font-medium text-gray-900">International delivery</span>
                </dt>
                <dd class="mt-1 text-sm text-gray-500">Get your order in 2 years</dd>
            </div>
            <div class="rounded-lg border border-gray-200 bg-gray-50 p-6 text-center">
                <dt>
                    <svg class="mx-auto h-6 w-6 flex-shrink-0 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="mt-4 text-sm font-medium text-gray-900">Loyalty rewards</span>
                </dt>
                <dd class="mt-1 text-sm text-gray-500">Don&#039;t look at other tees</dd>
            </div>
        </dl>
    </section>
</div>
