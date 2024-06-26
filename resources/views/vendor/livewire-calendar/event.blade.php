<div
    @if($eventClickEnabled)
        wire:click.stop="onEventClick('{{ $event['id']  }}')"
    @endif
    class="bg-white rounded-lg border py-2 px-3 shadow-md cursor-pointer">

    <p class="text-sm font-bold">
        {{ $event['title'] }}
    </p>
    <p class="mt-2 text-xs font-bold text-pink-500">
        {{ $event['description'] ?? 'No description' }}
    </p>
</div>
