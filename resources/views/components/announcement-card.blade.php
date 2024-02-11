@props(['announcement'])
<a href="{{ route('announcements.show', $announcement) }}}}"
    class="bg-gray-800 border border-gray-600 rounded-md p-6 text-gray-300 dark:hover:scale-[1.02] dark:hover:border-gray-400 dark:hover:bg-slate-800">
    <div class="flex flex-col h-full">
        <div>
            <img class="w-full rounded-md mr-6 md:block" src="{{ asset('storage/photos/announc.jpg') }}" alt="" />
        </div>
        <div class="flex flex-col justify-between h-full overflow-hidden gap-1">
            <div class="flex flex-col gap-2">
                <h2 class="text-2xl">
                    {{ $announcement->title }}
                </h2>
            </div>
            <div>
                <div class="flex flex-wrap gap-2">
                    @foreach ($announcement->companies as $partener)
                        <span class="flex items-center gap-1.5 p-1 text-sm dark:bg-gray-600 text-gray-300 rounded-md">
                            <div>
                                <img class="w-8 h-8 rounded-full" src="{{ asset('storage/logos/' . $partener->logo) }}"
                                    alt="company logo">
                            </div>
                            <div>
                                {{ $partener->name }}
                            </div>
                        </span>
                    @endforeach
                </div>
                <div class="mt-3 flex items-center gap-1.5 justify-between
                ">
                    <div class="flex items-center gap-1.5">
                        <span class="flex items-center">
                            <svg class="w-4 dark:fill-slate-200" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192h80v56H48V192zm0 104h80v64H48V296zm128 0h96v64H176V296zm144 0h80v64H320V296zm80-48H320V192h80v56zm0 160v40c0 8.8-7.2 16-16 16H320V408h80zm-128 0v56H176V408h96zm-144 0v56H64c-8.8 0-16-7.2-16-16V408h80zM272 248H176V192h96v56z" />
                            </svg>
                        </span>
                        <span class="flex items-center">
                            {{ \Carbon\Carbon::create($announcement->start_date)->diffForHumans() }}
                        </span>
                    </div>
                    <div>
                        <button class="px-4 py-2 rounded-md border border-violet-300 bg-cyan-600">Apply</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</a>
