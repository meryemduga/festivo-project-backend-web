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
       <div class="mt-8 border-t pt-6">
    <h3 class="text-lg font-bold mb-4">Reacties</h3>

    @auth
        <form action="{{ route('comments.store', $event) }}" method="POST" class="mb-6">
            @csrf
            <textarea name="body" class="w-full border rounded p-2" rows="3" placeholder="Plaats een reactie..." required></textarea>
            <button type="submit" class="mt-2 bg-indigo-600 text-white px-4 py-2 rounded text-sm">Plaatsen</button>
        </form>
    @else
        <p class="text-sm text-gray-500 mb-4"><a href="{{ route('login') }}" class="text-blue-500 underline">Log in</a> om te reageren.</p>
    @endauth

    <div class="space-y-4">
        @foreach($event->comments as $comment)
            <div class="bg-gray-50 p-3 rounded flex justify-between items-start">
                <div>
                    <span class="font-bold text-sm">{{ $comment->user->name }}</span>
                    <span class="text-xs text-gray-500 ml-2">{{ $comment->created_at->diffForHumans() }}</span>
                    <p class="text-gray-700 text-sm mt-1">{{ $comment->body }}</p>
                </div>
                @if(auth()->check() && (auth()->id() === $comment->user_id || auth()->user()->is_admin))
                    <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs text-red-500">Verwijderen</button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
</div>
</x-app-layout>