<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profiel Informatie') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __("Werk je profielgegevens, foto en bio bij.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Huidige Profielfoto Tonen -->
        @if($user->profile_picture)
            <div class="mb-4">
                <p class="text-sm text-gray-600 mb-2">Huidige Profielfoto:</p>
                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profielfoto" class="w-24 h-24 rounded-full object-cover border">
            </div>
        @endif

        <!-- Upload Nieuwe Profielfoto -->
        <div>
            <x-input-label for="profile_picture" :value="__('Profielfoto')" />
            <input id="profile_picture" name="profile_picture" type="file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
            <x-input-error class="mt-2" :messages="$errors->get('profile_picture')" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Naam')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Bio -->
        <div>
            <x-input-label for="bio" :value="__('Bio / Over mij')" />
            <textarea id="bio" name="bio" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('bio', $user->bio) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        <!-- Birthday -->
        <div>
            <x-input-label for="birthday" :value="__('Geboortedatum')" />
            <x-text-input id="birthday" name="birthday" type="date" class="mt-1 block w-full" :value="old('birthday', $user->birthday ? $user->birthday->format('Y-m-d') : '')" />
            <x-input-error class="mt-2" :messages="$errors->get('birthday')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Opslaan') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Opgeslagen.') }}</p>
            @endif
        </div>
    </form>
</section>