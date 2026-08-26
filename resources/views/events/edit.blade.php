<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Event Bewerken</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
            <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block font-medium">Titel</label>
                    <input type="text" name="title" value="{{ $event->title }}" class="w-full border rounded p-2" required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium">Beschrijving</label>
                    <textarea name="content" class="w-full border rounded p-2" rows="5" required>{{ $event->content }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block font-medium">Nieuwe Afbeelding (optioneel)</label>
                    <input type="file" name="image" class="w-full border rounded p-2">
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-2">Tags</label>
                    @foreach($tags as $tag)
                        <label class="inline-flex items-center mr-4">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ $event->tags->contains($tag->id) ? 'checked' : '' }}>
                            <span class="ml-1">{{ $tag->name }}</span>
                        </label>
                    @endforeach
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Bijwerken</button>
            </form>
        </div>
    </div>
</x-app-layout>