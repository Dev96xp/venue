<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-center">
            <div class="text-lg font-bold">{{ Auth::guard('employee')->user()->name }}</div>
            @if ($locationName)
                <div class="text-sm text-gray-600">Edificio: {{ $locationName }}</div>
            @endif
        </div>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 text-center">
                {{ session('status') }}
            </div>
        @endif

        <div class="mb-4 text-center">
            @if ($open)
                <div class="text-sm text-gray-600">Entrada registrada: {{ $open->check_in->format('h:i A') }}</div>
            @else
                <div class="text-sm text-gray-600">Sin turno abierto hoy.</div>
            @endif
        </div>

        <div x-data="clockIn({{ $location && $location->hasCoordinates() ? 'true' : 'false' }})" x-init="init()">
            <form method="POST" action="{{ route('employee.clock-in.toggle') }}" x-ref="form" @submit="onSubmit">
                @csrf
                <input type="hidden" name="location" value="{{ $locationName }}">
                <input type="hidden" name="latitude" x-model="latitude">
                <input type="hidden" name="longitude" x-model="longitude">

                <div class="flex items-center justify-center">
                    <x-button type="submit" x-bind:disabled="locating">
                        <span x-show="!locating">{{ $open ? 'Registrar salida' : 'Registrar entrada' }}</span>
                        <span x-show="locating">Ubicando...</span>
                    </x-button>
                </div>
            </form>
        </div>

        <form method="POST" action="{{ route('employee.logout') }}" class="mt-6 text-center">
            @csrf
            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                Cerrar sesión
            </button>
        </form>
    </x-authentication-card>

    @push('script')
    @endpush

    <script>
        function clockIn(requiresLocation) {
            return {
                latitude: '',
                longitude: '',
                locating: false,
                requiresLocation: requiresLocation,
                init() {},
                onSubmit(event) {
                    if (!this.requiresLocation) {
                        return;
                    }

                    event.preventDefault();
                    this.locating = true;

                    navigator.geolocation.getCurrentPosition(
                        (position) => {
                            this.latitude = position.coords.latitude;
                            this.longitude = position.coords.longitude;
                            this.locating = false;
                            this.$refs.form.submit();
                        },
                        () => {
                            this.locating = false;
                            alert('No se pudo obtener tu ubicación. Actívala e intenta de nuevo.');
                        },
                        { enableHighAccuracy: true, timeout: 10000 }
                    );
                },
            };
        }
    </script>
</x-guest-layout>
