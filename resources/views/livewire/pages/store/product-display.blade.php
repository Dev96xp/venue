<div class="bg-white">
    <div class="py-16 sm:py-24 lg:mx-auto lg:max-w-7xl lg:px-8">
        <div class="flex items-center justify-between px-4 sm:px-6 lg:px-0">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">Trending products</h2>
            <a href="#" class="hidden text-sm font-semibold text-indigo-600 hover:text-indigo-500 sm:block">
                See everything
                <span aria-hidden="true"> &rarr;</span>
            </a>
        </div>

        <div class="relative mt-8">
            <div class="relative -mb-6 w-full overflow-x-auto pb-6">

                <ul role="list"
                    class="mx-4 inline-flex space-x-8 sm:mx-6 lg:mx-0 lg:grid lg:grid-cols-4 lg:gap-x-8 lg:space-x-0">

                    @foreach ($products as $product)
                        <li class="inline-flex w-64 flex-col text-center lg:w-auto mb-8">
                            <div class="group relative">

                                @if ($product->images->count())
                                    <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200">
                                        <img src="{{ Storage::url($product->images->first()->url) }}"
                                            alt="Black machined steel pen with hexagonal grip and small white logo at top."
                                            class="h-full w-full object-cover object-center group-hover:opacity-75">
                                    </div>
                                @else
                                    <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200">
                                        <img src="https://tailwindui.com/img/ecommerce-images/home-page-02-product-01.jpg"
                                            alt="Black machined steel pen with hexagonal grip and small white logo at top."
                                            class="h-full w-full object-cover object-center group-hover:opacity-75">
                                    </div>
                                @endif

                                <div class="mt-6">
                                    <p class="text-sm text-gray-500">Black</p>
                                    <h3 class="mt-1 font-semibold text-gray-900">
                                        <a href="#">
                                            <span class="absolute inset-0"></span>
                                            {{ $product->name }}
                                        </a>
                                    </h3>
                                    <p class="mt-1 text-gray-900">${{ number_format($product->price, 2) }}</p>
                                </div>
                            </div>

                            <h4 class="sr-only">Available colors</h4>
                            <ul role="list" class="mt-auto flex items-center justify-center space-x-3 pt-6">
                                <li class="h-4 w-4 rounded-full border border-black border-opacity-10"
                                    style="background-color: #111827">
                                    <span class="sr-only">Black</span>
                                </li>
                                <li class="h-4 w-4 rounded-full border border-black border-opacity-10"
                                    style="background-color: #fde68a">
                                    <span class="sr-only">Brass</span>
                                </li>
                                <li class="h-4 w-4 rounded-full border border-black border-opacity-10"
                                    style="background-color: #e5e7eb">
                                    <span class="sr-only">Chrome</span>
                                </li>
                            </ul>

                            {{-- <div class="mt-6">
                                <a href="#"
                                    class="relative flex items-center justify-center rounded-md border border-transparent bg-gray-100 px-8 py-2 text-sm font-medium text-gray-900 hover:bg-gray-200">Add
                                    to bag<span class="sr-only">, Zip Tote Basket</span></a>
                            </div> --}}

                            <button
                                class="mt-6 relative flex items-center justify-center rounded-md border border-transparent bg-gray-100 px-8 py-2 text-sm font-medium text-gray-900 hover:bg-gray-200"
                                wire:click="addItem('{{ $product->id }}')" {{-- Miestra se este realizando un proceso, quiero cambiar el atributo a: desahibilitado --}}
                                wire:loading.attr="disabled"
                                {{-- Pero que esto SOLO ocurra cuando se este realizando el metodo: addItem --}}
                                wire:target="addItem">
                                Add to bag
                            </button>

                        </li>
                    @endforeach

                    <!-- More products... -->
                </ul>

            </div>
        </div>

        <div class="mt-12 flex px-4 sm:hidden">
            <a href="#" class="text-sm font-semibold text-indigo-600 hover:text-indigo-500">
                See everything
                <span aria-hidden="true"> &rarr;</span>
            </a>
        </div>
    </div>
</div>
