<nav x-data="{ open: false }" class="bg-transparent fixed w-full z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-row-reverse p-5">
            {{-- @if(auth()->check())
            <div class="bg-blue-500">test</div>
            @else
            <a href="{{ route('login') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Login</a>
            <a href="{{ route('register') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Register</a>
            @endif --}}

            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center justify-center  rounded-md text-gray-700 dark:text-gray-100 transition duration-150 ease-in-out">

                        <svg :class="{ 'hidden': open, 'inline-flex': !open }" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings inline-flex animate-spin" width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                            <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                        </svg>
                        <svg :class="{ 'hidden': !open, 'inline-flex': open }" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings-automation hidden" width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                            <path d="M10 9v6l5 -3z" /></svg>

                    </button>
                </x-slot>

                <x-slot name="content">
                    <ul class="py-2 w-50" aria-labelledby="user-menu-button">
                        @auth
                        <li>
                            <p class="px-5 text-md text-black dark:text-white">nama:{{ (Auth::user()->name) }}</p>
                            <p class="px-5 text-md text-black dark:text-white">email:{{ (Auth::user()->email) }}</p>
                        </li>
                        @endauth
                        <li>
                            <a class="flex items-center text-black dark:text-white gap-x-2 px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600" href="/">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />

                                </svg>

                                Home
                            </a>
                        </li>
                        @auth
                        @if(Auth::user()->hasRole('operator'))
                        <li>
                            <a class="flex items-center text-black dark:text-white gap-x-2 px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600" href="{{ route('stock.create') }}">
                                <x-tabler-shopping-cart-plus class="w-5 h-5" />
                                tambah produk
                            </a>
                        </li>
                        @endif
                        @endauth

                        <li>
                            <a class="flex items-center text-black dark:text-white  gap-x-2 px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600" href="{{ route('profile.edit') }}">
                                <x-tabler-settings-cog class="h-5 w-5" />
                                Settings
                            </a>
                        </li>
                        <li>
                            <button id="theme-toggle" type="button" class="flex items-center text-gray-600 dark:text-gray-100  gap-x-2 px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                                </svg>
                                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                                </svg>
                                Mode
                            </button>
                        </li>
                        <li class="flex mt-2 lg:mt-0 lg:items-center">
                            @if(auth()->check())
                            <form method="POST" action="{{ route('logout') }}" class="w-40 ">
                                @csrf

                                {{-- <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-responsive-nav-link> --}}
                                <button type="submit" class="text-base w-full text-center text-white py-1 lg:py-2 mx-4 lg:mx-3 xl:mx-4 font-bold bg-gradient-to-bl from-gray-600 via-blue-500 to-gray-600
                                dark:bg-gradient-to-bl dark:from-blue-950 dark:via-gray-900 dark:to-blue-950 dark:border dark:border-gray-700 px-4 rounded-md hover:bg-green-500">
                                    Logout
                                </button>
                            </form>
                            @else
                            <a href="{{ route('login') }}" class="text-base w-full text-center text-white py-1 lg:py-2 mx-4 lg:mx-3 xl:mx-4 font-bold bg-gradient-to-bl from-gray-600 via-blue-500 to-gray-600
                            dark:bg-gradient-to-bl dark:from-blue-950 dark:via-gray-900 dark:to-blue-950 dark:border dark:border-gray-700 px-4 rounded-md hover:bg-green-500">
                                Login
                            </a>

                            @endif
                        </li>
                    </ul>
                </x-slot>
            </x-dropdown>


        </div>
        <div class="flex justify-between h-16">


            <div class="fixed z-50 w-full h-16 max-w-sm -translate-x-1/2  border border-gray-200 rounded-full bottom-4 left-1/2  dark:border-gray-600 bg-transparent backdrop-filter backdrop-blur-sm">
                <div class="grid h-full max-w-sm grid-cols-3 mx-auto">

                    @auth
                    @if(Auth::user()->hasRole('operator'))
                    <a href="{{ route('operatorshoworders') }}" data-tooltip-target="tooltip-wallet" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
                        <x-tabler-shopping-cart-cog class="w-5 h-5 mb-1 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500" />
                        <span class="sr-only">lihat pesanan</span>
                    </a>
                    <div id="tooltip-wallet" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        lihat pesanan
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                    @else
                    <a href="{{ route('cart.index') }}" data-tooltip-target="tooltip-wallet" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
                        <x-tabler-shopping-cart class="w-5 h-5 mb-1 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500" />
                        <span class="sr-only">keranjang</span>
                    </a>
                    <div id="tooltip-wallet" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        keranjang
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                    @endif
                    @endauth

                    @guest
                    <a href="{{ route('cart.index') }}" data-tooltip-target="tooltip-wallet" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
                        <x-tabler-shopping-cart class="w-5 h-5 mb-1 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500" />
                        <span class="sr-only">keranjang</span>
                    </a>
                    <div id="tooltip-wallet" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        keranjang
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                    @endguest
                    <div class="flex items-center justify-center">
                        <a href="/" data-tooltip-target="tooltip-new" class="inline-flex items-center justify-center w-10 h-10 font-medium bg-blue-600 rounded-full hover:bg-blue-700 group focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800">
                            <x-tabler-home class="w-8 h-8 text-white" />
                            <span class="sr-only">Home</span>
                        </a>
                    </div>
                    <div id="tooltip-new" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Home
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                    @auth
                        @if(Auth::user()->hasRole('operator'))
                        <a href="{{ route('operator.bank.index') }}" data-tooltip-target="tooltip-settings" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
                            <x-tabler-cube-send class="w-7 h-7 mb-1 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500" />
                            <span class="sr-only">lihat kurir</span>
                        </a>
                        <div id="tooltip-settings" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            lihat kurir
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                        @else
                        <a href="{{ route('status') }}" data-tooltip-target="tooltip-settings" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
                            <x-tabler-cube-send class="w-7 h-7 mb-1 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500" />
                            <span class="sr-only">Orderan</span>
                        </a>
                        <div id="tooltip-settings" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Orderan
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                        @endif
                    @endauth
                    @guest
                    <a href="{{ route('status') }}" data-tooltip-target="tooltip-settings" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
                        <x-tabler-cube-send class="w-7 h-7 mb-1 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500" />
                        <span class="sr-only">Orderan</span>
                    </a>
                    <div id="tooltip-settings" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Orderan
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                    @endguest

                </div>
            </div>

            {{-- <div class="w-full flex justify-center ">
                <ul class=" xl:w-96  grid grid-cols-4 gap-5 p-4 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50  dark:bg-gray-800  dark:border-gray-700">
                    <li>
                        <a href="#" class=" py-2 pl-3 pr-4 text-white bg-blue-700 rounded " aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="#" class=" py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 dark:border-gray-700">About</a>
                    </li>
                    <li>
                        <a href="#" class=" py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 dark:border-gray-700">About</a>
                    </li>
                    <li>
                        <a href="#" class=" py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 dark:border-gray-700">About</a>
                    </li>
                    <li>
                                        <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-responsive-nav-link>
            </form>
            </li>

            </ul>

        </div> --}}
    </div>
    </div>

</nav>
