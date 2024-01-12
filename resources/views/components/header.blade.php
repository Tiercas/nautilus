<link rel="stylesheet" href="{{ asset('/css/app.css') }}">

<nav class="border-gray-200 bg-[#002550]">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="javascript:history. back()">
            <button diveId="#"
                style="background-color: transparent;color: var(--yellow);margin-right: 5px;font-size: 35px;"
                class="clickable aligne m-1 bg-gray-400 hover:bg-gray-500 
                text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                <i class="fa-solid fa-circle-arrow-left"></i>
            </button>
        </a>        
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
                <p class="text-white mr-4">{{ App\Http\Controllers\DivingNumberController::getDivingNumber(session('user')->US_ID) }} / 99</p>
                <button type="button"
                        class="flex text-sm bg-blue-500 rounded-full md:me-0 focus:ring-4 focus:ring-blue-700"
                        id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                        data-dropdown-placement="bottom">
                    <span
                        class="aligne w-8 h-8 rounded-full py-2 font-bold text-white">{{ substr(session('user')->US_FIRST_NAME, 0, 1) . substr(session('user')->US_NAME, 0, 1) }}</span>
                </button>
                <!-- Dropdown menu -->
                <div class="z-50 hidden my-4 text-base list-none divide-y rounded-lg shadow bg-blue-700 divide-blue-500"
                     id="user-dropdown">
                    <div class="px-4 py-3">
                        <span
                            class="block text-sm text-white">{{ session('user')->US_FIRST_NAME . " " . session('user')->US_NAME }}</span>
                            <span class="mb-2 mt-2 italic block text-sm truncate text-white">    {{ session('user')->roles()->pluck('ROL_LABEL')->implode(' - ') }}</span>

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
                       @if(request()->routeIs('homepage')) class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-[var(--yellow)]"
                       aria-current="page"
                       @else class="block py-2 px-3 rounded hover:bg-blue-700 md:p-0 text-white md:hover:text-[var(--yellow)] hover:text-white md:hover:bg-transparent border-gray-700" @endif>
                        Tableau de bord
                    </a>
                </li>
                @if (session()->has('user'))
                <li class="py-2 @if(request()->routeIs('dives'))border-b border-b-[#FFBE55]@endif">
                    <a href="{{ route('dives') }}"
                       @if(request()->routeIs('dives')) class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-[var(--yellow)]"
                       aria-current="page"
                       @else class="block py-2 px-3 rounded hover:bg-blue-700 md:p-0 text-white md:hover:text-[var(--yellow)] hover:text-white md:hover:bg-transparent border-gray-700" @endif>Inscription
                        aux plongées</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>


<link rel="stylesheet" href="/css/pop-up-psw-changer.css">
    <div class="form-popup" id="popupForm" style="border-radius: 15px;overflow: hidden;">
      <form action="/modification/password-changer" class="form-container" method="post">
        @csrf
        <div>
            <button onclick="closeForm()" type="button" 
            class="clickableRed w-full flex items-center justify-center w-1/2 px-5 
            py-2 text-sm text-gray-700 transition-colors duration-200 border rounded-full gap-x-2 sm:w-auto dark:hover:bg-[#002550] 
            dark:bg-[#002550] hover:bg-[#002550] dark:text-gray-200 dark:border-gray-700"
            style="border: none;width: 30px;font-size: 20px;left: 94%;position: relative;bottom: 5%;">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <h2 style="font-size: 30px">Changement de mot de passe</h2>
        <hr style="height: 3px;background-color: black;margin-bottom: 15px;margin-top: 5px; width : 100%">
        <label for="OldPassword">
           <h2>votre ancien mot de passe</h2>
        </label>
        <input type="password" value="" id="OldPassword" placeholder="Votre mot de passe" name="OldPassword" required />
        <label for="NewPassword">
            <h2>votre nouveau mot de passe</h2>
        </label>
        <input type="password" value="" id="NewPassword" placeholder="Votre Mot de passe" name="NewPassword" required />
        <button type="submit" class="clickable" style="padding: 10px; width: 100%">Changer votre mot de passe</button>
      </form>
    </div>
<script type="text/javascript" src="/js/pop-up-psw-changer.js"></script>