<nav class="border-gray-200 bg-[#002550]">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ route('homepage') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset("/images/logo_allonge.png") }}" class="h-14" alt="Nautilus Logo"/>
        </a>
        <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            @if (!session()->has('user'))
                <a href="{{ route('login') }}" class="text-sm text-white">
                    <x-button color="bg-blue-700" colorHover="hover:bg-[#0C57A6]">
                        Se connecter
                    </x-button>
                </a>
            @else
                <button type="button"
                        class="flex text-sm bg-blue-500 rounded-full md:me-0 focus:ring-4 focus:ring-blue-700"
                        id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                        data-dropdown-placement="bottom">
                    <span
                        class="w-8 h-8 rounded-full py-2 font-bold text-white">{{ substr(session('user')->US_FIRST_NAME, 0, 1) . substr(session('user')->US_NAME, 0, 1) }}</span>
                </button>
                <!-- Dropdown menu -->
                <div class="z-50 hidden my-4 text-base list-none divide-y rounded-lg shadow bg-blue-700 divide-blue-500"
                     id="user-dropdown">
                    <div class="px-4 py-3">
                        <span
                            class="block text-sm text-white">{{ session('user')->US_FIRST_NAME . " " . session('user')->US_NAME }}</span>
                        <span class="block text-sm truncate text-gray-400">{{ session('user')->US_EMAIL }}</span>
                    </div>
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        <li>
                             <a  href="{{route('divings')}}" class="block px-4 py-2 text-sm hover:bg-gray-600 text-gray-200 hover:text-white">Historique de mes plongées</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}"
                               class="block px-4 py-2 text-sm hover:bg-gray-600 text-gray-200 hover:text-white">Se
                                déconnecter</a>
                        </li>
                    </ul>
                </div>
            @endif
            <button data-collapse-toggle="navbar-user" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-[#002550] dark:focus:ring-gray-600"
                    aria-controls="navbar-user" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
            <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 bg-[#063E7B] md:bg-[#002550]">
                <li class="py-2 @if(request()->routeIs('homepage')) md:border-b md:border-b-[#FFBE55] border-b-0 @endif">
                    <a href="{{ route('homepage') }}"
                       @if(request()->routeIs('homepage')) class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500"
                       aria-current="page"
                       @else class="block py-2 px-3 rounded hover:bg-blue-700 md:p-0 text-white md:hover:text-blue-500 hover:text-white md:hover:bg-transparent border-gray-700" @endif>
                        Tableau de bord
                    </a>
                </li>
                @if (session()->has('user'))
                <li class="py-2 @if(request()->routeIs('dives'))border-b border-b-[#FFBE55]@endif">
                    <a href="{{ route('dives') }}"
                       @if(request()->routeIs('dives')) class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500"
                       aria-current="page"
                       @else class="block py-2 px-3 rounded hover:bg-blue-700 md:p-0 text-white md:hover:text-blue-500 hover:text-white md:hover:bg-transparent border-gray-700" @endif>Inscription
                        aux plongées</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
