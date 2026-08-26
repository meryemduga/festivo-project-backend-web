<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-bold text-gray-900">Evenementen</h1>
                @if(auth()->check() && auth()->user()->is_admin)
                    <a href="{{ route('admin.events.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-indigo-700">
                        + Nieuw Event
                    </a>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($events as $event)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden flex flex-col justify-between">
                        <div>
                            @if($event->image)
                                <img src="{{ Str::startsWith($event->image, 'http') ? $event->image : asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400">
                                    Geen afbeelding
                                </div>
                            @endif

                            <div class="p-6">
                                <h2 class="text-xl font-bold mb-2">{{ $event->title }}</h2>
                                <p class="text-gray-600 text-sm line-clamp-3 mb-4">{{ $event->content }}</p>
                            </div>
                        </div>

                        <div class="p-6 pt-0 border-t mt-4 flex items-center justify-between">
                            <a href="{{ route('events.show', $event) }}" class="text-indigo-600 font-semibold text-sm hover:underline">
                                Lees meer &rarr;
                            </a>

                            @if(auth()->check() && auth()->user()->is_admin)
                                <a href="{{ route('admin.events.edit', $event) }}" class="text-xs text-gray-500 hover:text-gray-900 font-semibold">
                                    Bewerken
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 bg-white p-6 rounded-lg text-center text-gray-500">
                        Er zijn nog geen evenementen aangemaakt.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
