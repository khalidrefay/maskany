<header class="bg-white shadow-sm sticky top-0 z-40 border-b border-gray-100">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <!-- Left side - Logo and Menu -->
            <div class="flex items-center space-x-4">
                <button class="p-2 rounded-lg hover:bg-gray-100 focus:outline-none transition-colors duration-200" id="menuButton">
                    <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <a href="{{ route('home') }}" class="flex items-center">
                    <span class="text-xl font-bold text-gray-800 hover:text-indigo-600 transition-colors duration-200">
                        {{ config('app.name') }}
                    </span>
                </a>
            </div>

            <!-- Center - Navigation Links -->
            <nav class="hidden md:flex space-x-6">
                <a href="{{ route('inspired-designs') }}"
                    class="px-3 py-2 text-gray-600 hover:text-indigo-600 font-medium transition-colors duration-200 relative group">
                    {{ __('home.header.Inspired Designs') }}
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-indigo-600 transition-all duration-300 group-hover:w-full"></span>
                </a>

                <a href="{{ route('project.index') }}"
                    class="px-3 py-2 text-gray-600 hover:text-indigo-600 font-medium transition-colors duration-200 relative group">
                    {{ __('home.header.Estimated home cost') }}
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-indigo-600 transition-all duration-300 group-hover:w-full"></span>
                </a>

                <a href="{{ route('land.exchange.index') }}"
                    class="px-3 py-2 text-gray-600 hover:text-indigo-600 font-medium transition-colors duration-200 relative group">
                    {{ __('home.header.Land purchase initiative') }}
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-indigo-600 transition-all duration-300 group-hover:w-full"></span>
                </a>

                <a href="{{ route('project.items.index') }}"
                    class="px-3 py-2 text-gray-600 hover:text-indigo-600 font-medium transition-colors duration-200 relative group">
                    {{ __('home.header.My Projects') }}
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-indigo-600 transition-all duration-300 group-hover:w-full"></span>
                </a>
            </nav>

            <!-- Right side - Language and Auth Links -->
            <div class="flex items-center space-x-4">
                <!-- Language Switcher -->
                <a href="{{ route('language.switch', ['lang' => app()->getLocale() === 'en' ? 'ar' : 'en']) }}"
                    class="hidden md:flex items-center px-3 py-2 text-gray-600 hover:text-indigo-600 font-medium transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                    </svg>
                    {{ app()->getLocale() === 'en' ? __('messages.header.arabic') : __('messages.header.english') }}
                </a>

                @guest
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 text-indigo-600 font-medium rounded-lg hover:bg-indigo-50 transition-colors duration-200">
                        {{ __('messages.header.login') }}
                    </a>
                    <a href="{{ route('register') }}"
                        class="hidden md:block px-4 py-2 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors duration-200">
                        {{ __('messages.header.register') }}
                    </a>
                @else
                    <!-- Profile Dropdown -->
                    <div class="relative">
                        <button type="button" class="flex items-center focus:outline-none group" id="user-menu-button">
                            <div
                                class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center overflow-hidden border-2 border-transparent group-hover:border-indigo-200 transition-colors duration-200">
                                @if (auth()->user()->image)
                                    <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="Profile Picture"
                                        class="h-full w-full object-cover">
                                @else
                                    <span class="text-lg font-medium text-indigo-800">
                                        {{ substr(auth()->user()->first_name, 0, 1) }}{{ substr(auth()->user()->last_name, 0, 1) }}
                                    </span>
                                @endif
                            </div>
                            <svg class="ml-1 h-4 w-4 text-gray-500 group-hover:text-gray-700 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div class="hidden absolute right-0 mt-2 w-56 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none divide-y divide-gray-100"
                            id="user-menu">
                            <!-- User Info -->
                            <div class="px-4 py-3">
                                <p class="text-sm font-medium text-gray-900 truncate">{{ auth()->user()->first_name ?? '' }}
                                    {{ auth()->user()->last_name ?? '' }}</p>
                                <p class="text-sm text-gray-500 truncate">{{ auth()->user()->email ?? '' }}</p>
                            </div>

                            <!-- Navigation Links -->
                            <div class="py-1">
                                <a href="{{ route(auth()->user()->role . '.dashboard') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                    </svg>
                                    {{ __('messages.dashboard.' . auth()->user()->role) }}
                                </a>
                                <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    {{ __('messages.profile.title') }}
                                </a>
                            </div>

                            <!-- Logout -->
                            <div class="py-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        {{ __('messages.auth.logout') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</header>

<style>
    /* Smooth transitions for interactive elements */
    #user-menu {
        transition: opacity 0.2s ease-in-out, transform 0.2s ease-in-out;
        transform-origin: top right;
        opacity: 0;
        transform: scale(0.95);
        pointer-events: none;
    }

    #user-menu.show {
        opacity: 1;
        transform: scale(1);
        pointer-events: auto;
    }

    /* Mobile menu button animation */
    #menuButton:hover svg {
        transform: scale(1.1);
        transition: transform 0.2s ease-in-out;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .md\:flex {
            display: none;
        }

        /* Mobile language switcher */
        .hidden.md\:flex {
            display: none;
        }
    }

    /* Active nav link indicator */
    .router-link-active {
        color: #4f46e5;
    }

    .router-link-active span {
        width: 100%;
    }
</style>

<script>
    // Enhanced dropdown menu with animations
    const userMenuButton = document.getElementById('user-menu-button');
    const userMenu = document.getElementById('user-menu');

    if (userMenuButton && userMenu) {
        userMenuButton.addEventListener('click', (e) => {
            e.stopPropagation();
            userMenu.classList.toggle('show');
            userMenu.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', () => {
            if (userMenu.classList.contains('show')) {
                userMenu.classList.remove('show');
                setTimeout(() => userMenu.classList.add('hidden'), 200);
            }
        });
    }

    // Mobile menu toggle with animation
    const menuButton = document.getElementById('menuButton');
    if (menuButton) {
        menuButton.addEventListener('click', () => {
            // You would add mobile menu functionality here
            console.log('Mobile menu toggled');
        });
    }
</script>