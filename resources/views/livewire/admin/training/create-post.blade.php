<div>
    <div class="mb-6 text-lg">
        Creando un POST para aprender livewire
    </div>

    <form wire:submit="save">
        <input type="text" wire:model="title" class="form-control w-40 mb-2">
        <div>
            {{-- Se aggrego validacion --}}
            @error('title')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <input type="text" wire:model="content" class="form-control w-40 mb-2">
        <div>
            {{-- Se aggrego validacion --}}
            @error('content')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-danger">Save</button>
    </form>
</div>
