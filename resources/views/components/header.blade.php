<link rel="stylesheet" href="{{ asset('/css/app.css') }}">

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
                            <a class="block px-4 py-2 text-sm hover:bg-gray-600 text-gray-200 hover:text-white cursor-pointer" onclick="openForm()">changer le mdp</a>
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


<link rel="stylesheet" href="/css/pop-up-psw-changer.css">
    <div class="form-popup" id="popupForm">
      <form action="/modification/password-changer" class="form-container" method="post">
        @csrf
        <button onclick="closeForm()" type="button" class=" w-full flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 transition-colors duration-200 border rounded-full gap-x-2 sm:w-auto dark:hover:bg-[#002550] dark:bg-[#002550] hover:bg-[#002550] dark:text-gray-200 dark:border-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M376.6 84.5c11.3-13.6 9.5-33.8-4.1-45.1s-33.8-9.5-45.1 4.1L192 206 56.6 43.5C45.3 29.9 25.1 28.1 11.5 39.4S-3.9 70.9 7.4 84.5L150.3 256 7.4 427.5c-11.3 13.6-9.5 33.8 4.1 45.1s33.8 9.5 45.1-4.1L192 306 327.4 468.5c11.3 13.6 31.5 15.4 45.1 4.1s15.4-31.5 4.1-45.1L233.7 256 376.6 84.5z"/></svg>
        </button>
        <x-page-title >Changement de mot de passe</x-page-title>
        <label for="OldPassword">
           <h2>votre ancien mot de passe</h2>
        </label>
        <input type="password" value="" id="OldPassword" placeholder="Votre mot de passe" name="OldPassword" required />
        <label for="NewPassword">
            <h2>votre nouveau mot de passe</h2>
        </label>
        <input type="password" value="" id="NewPassword" placeholder="Votre Mot de passe" name="NewPassword" required />
        <button type="submit" class="btn">Changer votre mot de passe</button>
      </form>
    </div>
<script type="text/javascript" src="/js/pop-up-psw-changer.js"></script>