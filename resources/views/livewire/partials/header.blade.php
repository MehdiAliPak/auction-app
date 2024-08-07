<header
    class="top-0 flex flex-wrap w-full py-3 text-sm bg-white shadow-md z-5000 md:justify-start md:flex-nowrap md:py-0 dark:bg-gray-800">
    <nav class="max-w-[85rem] w-full mx-auto px-4 md:px-6 lg:px-8" aria-label="Global">
        <div class="relative md:flex md:items-center md:justify-between">
            <div class="flex items-center justify-between">
                <a class="flex-none text-xl font-semibold dark:text-white dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 w-[150px]"
                    href="/" aria-label="Brand">
                    <img src="{{ asset('storage/logo/logo.png') }}" alt="BidAuction Logo">
                </a>
                <div class="md:hidden">
                    <button type="button"
                        class="flex items-center justify-center text-sm font-semibold text-gray-800 border border-gray-200 rounded-lg hs-collapse-toggle w-9 h-9 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                        data-hs-collapse="#navbar-collapse-with-animation"
                        aria-controls="navbar-collapse-with-animation" aria-label="Toggle navigation">
                        <svg class="flex-shrink-0 w-4 h-4 hs-collapse-open:hidden" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" x2="21" y1="6" y2="6" />
                            <line x1="3" x2="21" y1="12" y2="12" />
                            <line x1="3" x2="21" y1="18" y2="18" />
                        </svg>
                        <svg class="flex-shrink-0 hidden w-4 h-4 hs-collapse-open:block"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M18 6 6 18" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <div id="navbar-collapse-with-animation"
                class="hidden overflow-hidden transition-all duration-300 hs-collapse basis-full grow md:block">
                <div
                    class="overflow-hidden overflow-y-auto max-h-[75vh] [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-slate-700 dark:[&::-webkit-scrollbar-thumb]:bg-slate-500">
                    <div
                        class="flex flex-col mt-5 divide-y divide-gray-200 gap-x-0 divide-dashed md:flex-row md:items-center md:justify-end md:gap-x-7 md:mt-0 md:ps-7 md:divide-y-0 md:divide-solid dark:divide-gray-700">

                        <a wire:navigate
                            class="py-3 font-medium {{ request()->is('/') ? 'text-blue-600' : 'text-gray-500' }} md:py-6 dark:text-blue-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            href="/" aria-current="page">Home</a>

                        <a wire:navigate
                            class="py-3 font-medium {{ request()->is('categories') ? 'text-blue-600' : 'text-gray-500' }} hover:text-gray-400 md:py-6 dark:text-gray-400 dark:hover:text-gray-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            href="/categories">
                            Categories
                        </a>

                        <a wire:navigate
                            class="py-3 font-medium {{ request()->is('auctions') ? 'text-blue-600' : 'text-gray-500' }} hover:text-gray-400 md:py-6 dark:text-gray-400 dark:hover:text-gray-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            href="/auctions">
                            Auctions
                        </a>

                        @guest
                            <div class="pt-3 md:pt-0">
                                <a wire:navigate
                                    class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                    href="/login">
                                    <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>
                                    Log in
                                </a>
                            </div>
                        @endguest

                        @auth
                            <div
                                class="hs-dropdown [--strategy:static] md:[--strategy:fixed] [--adaptive:none] md:[--trigger:hover] md:py-4">
                                <button type="button"
                                    class="flex items-center w-full font-medium text-gray-500 hover:text-gray-400 dark:text-gray-400 dark:hover:text-gray-500">
                                    {{ auth()->user()->name }}
                                    <svg class="w-4 h-4 ms-2" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m6 9 6 6 6-6" />
                                    </svg>
                                </button>

                                <div
                                    class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 md:w-48 hidden z-10 bg-white md:shadow-md rounded-lg p-2 dark:bg-gray-800 md:dark:border dark:border-gray-700 dark:divide-gray-700 before:absolute top-full md:border before:-top-5 before:start-0 before:w-full before:h-5">

                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                        href="#">
                                        My Account
                                    </a>
                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                        href="/logout">
                                        Logout
                                    </a>
                                </div>
                            </div>
                        @endauth

                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
