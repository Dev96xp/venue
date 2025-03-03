<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Pages configurations</h1>
            <p class="mt-2 text-sm text-gray-700">A list of all the pages</p>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            {{-- <button type="button"
                class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create
                page</button> --}}
                @livewire('admin.page.create-page')
        </div>
    </div>
    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead>
                        <tr>
                            <th scope="col"
                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Name</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Route/Active
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Role
                            </th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach ($pages as $page)
                            <tr>
                                <td class="whitespace-nowrap py-1 pl-4 pr-3 text-sm sm:pl-0">
                                    <div class="flex items-center" wire:click="select_page({{ $page }})">
                                        <div class="h-11 w-11 flex-shrink-0">
                                            <img class="h-11 w-11 rounded-full"
                                                src="https://cdn.pixabay.com/photo/2018/03/31/08/23/girl-3277529_1280.jpg"
                                                alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="font-bold {{ $selecionado == $page->name ? 'text-blue-500 text-md' : '' }}">{{ $page->name }} </div>
                                            <div class="text-gray-500">{{ $page->description }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="whitespace-nowrap px-3 py-1 text-sm text-gray-500">
                                    <div class="text-gray-900">{{ $page->route }}</div>
                                    <div class="text-gray-500">{{ $page->active }}</div>
                                </td>

                                <td class="whitespace-nowrap px-3 py-1 text-sm text-gray-500">
                                    <span
                                        class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">{{ $page->status }}</span>
                                </td>

                                <td class="whitespace-nowrap px-3 py-1 text-sm text-gray-500">Member</td>

                                <td
                                    class="relative whitespace-nowrap py-1 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span
                                            class="sr-only">, Lindsay Walton</span></a>
                                </td>
                                <td wire:click="delete_page({{ $page }})"
                                    class="relative text-red-600 hover:text-red-900 whitespace-nowrap py-1 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                    Delete
                                </td>
                            </tr>
                        @endforeach


                        <!-- More people... -->


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
