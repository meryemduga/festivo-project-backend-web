<!DOCTYPE html>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Festivo Events</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(auth()->check() && auth()->user()->is_admin)
                <div class="mb-6">
                    <a href="{{ route('admin.events.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">+ Nieuw Event Aanmaken</a>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($events as $event)
                    <div class="bg-white rounded shadow p-4 flex flex-col justify-between">
                        <div>
                            @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" class="w-full h-40 object-cover rounded mb-2">
                            @endif
                            <h3 class="font-bold text-lg mb-2">{{ $event->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($event->content, 100) }}</p>
                        </div>

                        <div>
                            <a href="{{ route('events.show', $event) }}" class="text-blue-500 font-bold block mb-2">Lees meer &rarr;</a>
                            
                            @if(auth()->check() && auth()->user()->is_admin)
                                <div class="flex gap-2 border-t pt-2 mt-2">
                                    <a href="{{ route('admin.events.edit', $event) }}" class="text-xs bg-yellow-500 text-white px-2 py-1 rounded">Bewerken</a>
                                    <form action="{{ route('admin.events.destroy', $event) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs bg-red-600 text-white px-2 py-1 rounded" onclick="return confirm('Zeker weten?')">Verwijderen</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="col-span-3 text-gray-500">Nog geen events aanwezig.</p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>