<x-app-layout>
    <!-- Hero -->
    <section class="relative h-72 bg-laravel flex flex-col justify-center align-center text-center space-y-4 mb-4">
        <div class="z-10">
            <h1 class="text-6xl font-bold uppercase text-cyan-500">
                Job<span class="text-violet-700">Dating</span>
            </h1>
            <p class="text-2xl dark:text-gray-200 font-bold my-4">
                Your way to Profesionality
            </p>
            <div>
                @auth
                    <p class="dark:text-gray-400 text-center font-semibold">Welcome, {{ auth()->user()->name }}! You are
                        already logged in.</p>
                    <p class="dark:text-gray-400 text-center text-sm">Explore our platform and discover new opportunities</p>
                @else
                    <a href="register"
                        class="inline-block border-2 border-gray-400 dark:text-gray-400 py-2 px-4 rounded-xl uppercase mt-2 dark:hover:text-gray-200 dark:hover:border-gray-500">
                        Create account
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <div class="mb-4 flex items-center justify-center w-full gap-5">
        @auth
        <div class="w-1/6">
            <button id="showSuggestionsBtn"
                class="w-full bg-purple-700 rounded-md py-3 text-cyan-200 font-semibold text-lg">
                Show suggestions
            </button>
        </div>
        @endauth
        <div class="w-2/3">
            <form action="" class="flex justify-center">
                <div class="relative w-full border-2 rounded-lg">
                    <div class="absolute top-4 left-3">
                        <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i>
                    </div>
                    <input type="text" name="search"
                        class="h-14 w-full pl-8 pr-20 rounded-lg z-0 focus:outline-0 dark:placeholder:text-gray-500 bg-gray-700 text-gray-200"
                        placeholder="Search announc..." />
                    <div class="absolute top-2 right-2">
                        <button type="submit"
                            class="h-10 p-2 flex items-center text-gray-200 font-semibold rounded-lg bg-violet-500 hover:bg-violet-700">
                            <svg class="w-3/4 h-3/4" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100"
                                height="100" viewBox="0 0 50 50">
                                <path class="fill-white"
                                    d="M 21 3 C 11.621094 3 4 10.621094 4 20 C 4 29.378906 11.621094 37 21 37 C 24.710938 37 28.140625 35.804688 30.9375 33.78125 L 44.09375 46.90625 L 46.90625 44.09375 L 33.90625 31.0625 C 36.460938 28.085938 38 24.222656 38 20 C 38 10.621094 30.378906 3 21 3 Z M 21 5 C 29.296875 5 36 11.703125 36 20 C 36 28.296875 29.296875 35 21 35 C 12.703125 35 6 28.296875 6 20 C 6 11.703125 12.703125 5 21 5 Z">
                                </path>
                            </svg>
                            Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="announcements">
        @unless (count($announcements) == 0)
            <div class="lg:grid lg:grid-cols-3 gap-4 space-y-4 md:space-y-0 mx-4">
                @foreach ($announcements as $announcement)
                    <x-announcement-card :announcement="$announcement" />
                @endforeach
            </div>
        @else
            <p class="text-red-400 text-center w-full">No announcement found</p>
        @endunless

        <div class="mt-9 p-4">
            {{ $announcements->links() }}
        </div>
    </div>

    @auth
        <div id="suggestions" class="hidden">
            @unless (count($suggestions) == 0)
                <div class="lg:grid lg:grid-cols-3 gap-4 space-y-4 md:space-y-0 mx-4">
                    @foreach ($suggestions as $suggestions)
                        <x-announcement-card :announcement="$suggestions" />
                    @endforeach
                </div>
            @else
                <p class="text-slate-400 text-center w-full p-2">No suggestions for you, Try to improve your skills</p>
            @endunless
        </div>
    @endauth


    <script>
        btn = document.querySelector("#showSuggestionsBtn");
        suggestions = document.querySelector("#suggestions");
        announcements = document.querySelector("#announcements");
        console.log(announcements);
        btn.onclick = () => {
            announcements.classList.toggle("hidden")
            suggestions.classList.toggle("hidden")
            if (btn.innerText === "Show suggestions")
                btn.innerText = "Show all";
            else
                btn.innerText = "Show suggestions";
        };
    </script>
</x-app-layout>
