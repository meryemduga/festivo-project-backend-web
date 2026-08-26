<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-3xl font-bold mb-4">{{ $event->title }}</h1>

                @if($event->image)
                    <div class="mb-6">
                        <img src="{{ Str::startsWith($event->image, 'http') ? $event->image : asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="max-w-md w-full h-auto max-h-64 mx-auto object-cover rounded shadow">
                    </div>
                @endif

                <div class="prose max-w-none mb-6">
                    <p>{{ $event->content }}</p>
                </div>

                @if($event->tags && $event->tags->count() > 0)
                    <div class="flex gap-2 mb-6">
                        @foreach($event->tags as $tag)
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">
                                #{{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                @endif

                <a href="{{ route('events.index') }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">
                    &larr; Terug naar overzicht
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
