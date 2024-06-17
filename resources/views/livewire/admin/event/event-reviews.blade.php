<div>

    <section class="mr-2 mt-2">

        {{-- MASRTER CLASS - OJO , SOLO SI, el usuario esta autentificado, se mostrara este textarea --}}
        {{-- @can('enrolled', $business) --}}
        <article class="mb-1">

            <textarea wire:model="comment" class="form-control w-full mb-2" rows="3" placeholder="Agrega una nota"></textarea>

            <div class="flex items-center">
                <button class="btn btn-primary mr-2 py-1" wire:click="store">Agregar</button>

                {{-- Hacer las estrella en horizoltal y pequeñas --}}
                <ul class="flex">
                    <li class="mr-1 cursor-pointer" wire:click="$set('rating', 1)">
                        <i class="fas fa-star text-{{ $rating >= 1 ? 'yellow' : 'gray' }}-300"></i>
                    </li>
                    <li class="mr-1 cursor-pointer" wire:click="$set('rating', 2)">
                        <i class="fas fa-star text-{{ $rating >= 2 ? 'yellow' : 'gray' }}-300"></i>
                    </li>
                    <li class="mr-1 cursor-pointer" wire:click="$set('rating', 3)">
                        <i class="fas fa-star text-{{ $rating >= 3 ? 'yellow' : 'gray' }}-300"></i>
                    </li>
                    <li class="mr-1 cursor-pointer" wire:click="$set('rating', 4)">
                        <i class="fas fa-star text-{{ $rating >= 4 ? 'yellow' : 'gray' }}-300"></i>
                    </li>
                    <li class="mr-1 cursor-pointer" wire:click="$set('rating', 5)">
                        <i class="fas fa-star text-{{ $rating == 5 ? 'yellow' : 'gray' }}-300"></i>
                    </li>
                </ul>
            </div>

        </article>

        {{-- @endcan --}}

        @isset($event->notes)
            <div class="card">
                <div class="card-body p-2">

                    <p class="text-gray-800 text-right">{{ $event->notes->count() }} notas</p>

                    @foreach ($event->notes as $note)
                        <article class="flex text-gray-800">

                            <figure class="mr-2">
                                <img class="h-10 w-10 object-cover rounded-full shadow-xs"
                                    src="{{ $note->user->profile_photo_url }}" alt="">
                            </figure>

                            <div class="flex-1">
                                <div class="card-body p-2 text-xs bg-gray-100">
                                    <p><b>{{ $note->user->name }}</b></p>
                                    <span class="text-md">{{ $note->comment }}</span>
                                </div>
                            </div>


                        </article>
                        <div class="text-xs text-right mb-2">
                            {{-- {{ $note->created_at }} --}}
                            {{-- {{ \Carbon\Carbon::parse($note->created_at)->toFormattedDateString('l j F g:i') }} --}}
                            {{-- {{ \Carbon\Carbon::parse($note->created_at)->Format('jS F Y g:i a l') }} VERY GOOD --}}
                            {{ \Carbon\Carbon::parse($note->created_at)->isoFormat('lll') }}  {{-- VERY GOOD  --}}
                        </div>
                    @endforeach


                </div>
            </div>
        @endisset
    </section>

</div>
