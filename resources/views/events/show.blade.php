<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $event->title }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
            @if($event->image)
                <img src="{{ asset('storage/' . $event->image) }}" class="w-full h-64 object-cover rounded mb-4">
            @endif

            <div class="flex gap-2 mb-4">
                @foreach($event->tags as $tag)
                    <span class="bg-gray-200 text-sm px-2 py-1 rounded">#{{ $tag->name }}</span>
                @endforeach
            </div>

            <p class="text-gray-700 whitespace-pre-line mb-6">{{ $event->content }}</p>

            <a href="{{ route('events.index') }}" class="text-blue-500 hover:underline">&larr; Terug naar overzicht</a>
        </div>
    </div>
</x-app-layout>