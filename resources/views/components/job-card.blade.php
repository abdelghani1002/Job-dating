@props(['announcement'])
<a href="{{ route('announcements.show', $announcement) }}}}"
    class="bg-gray-800 border border-gray-600 rounded-md p-6 text-gray-300 dark:hover:scale-[1.02] dark:hover:border-gray-400 dark:hover:bg-slate-800">
    <div class="flex h-full">
        {{-- <img class="hidden w-48 mr-6 md:block" src="{{asset('uploads/'.$announcement->image)}}" alt="" /> --}}
        <div class="flex flex-col justify-between h-full overflow-hidden gap-1">
            <div class="flex flex-col gap-2">
                <h2 class="text-2xl">
                    {{ $announcement->title }}
                </h2>
                <div class="flex flex-wrap gap-2">
                    @foreach ($announcement->companies as $partener)
                        <span class="p-1 text-sm bg-gray-400 text-gray-700 rounded-md">{{ $partener->name }}</span>
                    @endforeach
                </div>
            </div>

            <div class="mt-3">
                Start <i class="fa-solid fa-date-dot"></i> {{ $announcement->start_date }}
            </div>
        </div>
    </div>
</a>
