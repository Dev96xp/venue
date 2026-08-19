<div>
    <div class="text-indigo-600 hover:text-indigo-900 cursor-pointer" wire:click="$set('open', true)">
        Edit
    </div>

    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Edit building
        </x-slot>

        <x-slot name="content">
            <div x-data="{
                locating: false,
                useMyLocation() {
                    this.locating = true;
                    navigator.geolocation.getCurrentPosition(
                        (position) => {
                            this.locating = false;
                            @this.useCurrentLocation(position.coords.latitude, position.coords.longitude);
                        },
                        () => {
                            this.locating = false;
                            alert('No se pudo obtener tu ubicación.');
                        },
                        { enableHighAccuracy: true, timeout: 10000 }
                    );
                }
            }">
                <div class="grid grid-cols-1 gap-4 mb-3">
                    <div class="col-span-1">
                        <x-label value="Name" class="mb-1" />
                        <x-input type="text" class="w-full" wire:model.defer="name" />
                        <x-input-error for="name" />
                    </div>
                </div>

                <div class="mb-3">
                    <x-secondary-button type="button" x-on:click="useMyLocation" x-bind:disabled="locating">
                        <span x-show="!locating">Usar mi ubicación actual</span>
                        <span x-show="locating">Ubicando...</span>
                    </x-secondary-button>
                </div>

                <div class="grid grid-cols-3 gap-4 mb-3">
                    <div class="col-span-1">
                        <x-label value="Latitude" class="mb-1" />
                        <x-input type="text" class="w-full" wire:model.defer="latitude" />
                        <x-input-error for="latitude" />
                    </div>
                    <div class="col-span-1">
                        <x-label value="Longitude" class="mb-1" />
                        <x-input type="text" class="w-full" wire:model.defer="longitude" />
                        <x-input-error for="longitude" />
                    </div>
                    <div class="col-span-1">
                        <x-label value="Radius in feet" class="mb-1" />
                        <x-input type="number" min="10" max="5000" class="w-full" wire:model.defer="radius_feet" />
                        <x-input-error for="radius_feet" />
                    </div>
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
</div>
