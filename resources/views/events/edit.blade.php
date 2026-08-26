<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6">Event Bewerken</h2>

                <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
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
                        <x-input-label value="Huidige Afbeelding" />
                        @if($event->image)
                            <div class="mt-2 mb-4">
                                <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}" class="w-48 h-32 object-cover rounded-md border">
                            </div>
                        @else
                            <p class="text-sm text-gray-500 mt-1 mb-2">Er is nog geen afbeelding gekoppeld aan dit event.</p>
                        @endif

                        <x-input-label for="image" value="Nieuwe Afbeelding uploaden (optioneel)" />
                        <input id="image" name="image" type="file" class="mt-1 block w-full text-sm text-gray-500 border border-gray-300 rounded-md cursor-pointer p-2" />
                    </div>

                    <div>
                        <x-primary-button>Bijwerken</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
