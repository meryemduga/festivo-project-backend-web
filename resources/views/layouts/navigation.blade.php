<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('events.index') }}" class="font-bold text-xl text-indigo-600">
                        Festivo
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('events.index')" :active="request()->routeIs('events.index')">
                        {{ __('Events') }}
                    </x-nav-link>
                    <x-nav-link :href="route('faq.index')" :active="request()->routeIs('faq.index')">
                        {{ __('FAQ') }}
                    </x-nav-link>
                    <x-nav-link :href="route('contact.show')" :active="request()->routeIs('contact.show')">
                        {{ __('Contact') }}
                    </x-nav-link>

                    <!-- Admin Specifieke Links in Navbar -->
                    @auth
                        @if(auth()->user()->is_admin)
                            <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                                {{ __('Gebruikersbeheer') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.messages.index')" :active="request()->routeIs('admin.messages.*')">
                                {{ __('Berichten') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Settings / Login Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }} @if(Auth::user()->is_admin) (Admin) @endif</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @if(Auth::user()->username)
                                <x-dropdown-link :href="route('profile.show', Auth::user()->username)">
                                    {{ __('Mijn Publiek Profiel') }}
                                </x-dropdown-link>
                            @endif
                            
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profiel Bewerken') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Uitloggen') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="space-x-4">
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-gray-900">Inloggen</a>
                        <a href="{{ route('register') }}" class="text-sm bg-indigo-600 text-white px-3 py-2 rounded-md hover:bg-indigo-700">Registreren</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>