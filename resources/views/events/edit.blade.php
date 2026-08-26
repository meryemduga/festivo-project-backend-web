<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6">Event Bewerken</h2>

                <form action="{{ route('admin.events.update', $event) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="title" value="Titel" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $event->title)" required />
                    </div>

                    <div>
                        <x-input-label for="content" value="Beschrijving" />
                        <textarea id="content" name="content" rows="5" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('content', $event->content) }}</textarea>
                    </div>

                    <div>
                        <x-input-label for="image" value="Afbeelding URL (bijv. https://images.unsplash.com/...)" />
                        <x-text-input id="image" name="image" type="text" class="mt-1 block w-full" :value="old('image', $event->image)" placeholder="Plak hier een link naar een afbeelding" />
                    </div>

                    @if(isset($tags) && $tags->count() > 0)
                        <div>
                            <x-input-label value="Tags selecteren" class="mb-2" />
                            <div class="flex flex-wrap gap-4">
                                @foreach($tags as $tag)
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" 
                                            {{ $event->tags->contains($tag->id) ? 'checked' : '' }}
                                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                        <span class="ml-2 text-sm text-gray-600">#{{ $tag->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-indigo-700">
                            Bijwerken
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
