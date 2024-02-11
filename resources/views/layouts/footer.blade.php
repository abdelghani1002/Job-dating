<footer class="flex flex-col justify-between bg-slate-950 text-white pt-8 h-96">
    <div class="px-4 container mx-auto flex justify-between items-center">
        <!-- Logo -->
        <div class="shrink-0 flex items-center">
            <a class="w-12 h-12 flex items-center gap-2" href="{{ route('home') }}">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                <span class="text-xl font-bold uppercase text-cyan-500">
                    Job<span class="text-violet-500">Dating</span>
                </span>
            </a>
        </div>
        <div class="flex space-x-10">
            <a href="#" class="hover:underline">About Us</a>
            <a href="#" class="hover:underline">Contact</a>
            <a href="#" class="hover:underline">Privacy Policy</a>
        </div>
    </div>
    <div class="px-4 py-2 bg-slate-900 flex items-center justify-center">
        <div class="text-sm text-gray-400">
            &copy; JobDating, YouCode 2024
        </div>
        <div class="">

        </div>
    </div>
</footer>
