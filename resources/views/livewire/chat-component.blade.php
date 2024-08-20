<div>
    {{-- Do your work, then step back. --}}
    {{-- @dd($convo) --}}
@foreach ($convo as $item)
    <div>{{ $item['username'] }} : {{ $item['message'] }}</div>
@endforeach

    <form wire:submit="submitMessage">
        <x-text-input wire:model="message" />
        <button type="submit">Send</button>
    </form>
</div>
