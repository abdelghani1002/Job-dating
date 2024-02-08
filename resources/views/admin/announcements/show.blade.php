<x-app-layout>
    <div class="dark:bg-gray-800 dark:text-white p-6">
        <h2 class="text-2xl font-bold mb-4">{{ $announcement->title }}</h2>
        <p class="dark:text-gray-300 mb-2 text-sm">{{ $announcement->description }}</p>

        <div class="mb-3">
            <h3 class="font-semibold mb-2">Companies partened</h3>
            <div class="flex flex-wrap gap-4">
                @foreach ($parteners as $company)
                    <a href="{{ route('companies.show', $company) }}" class="p-2 flex items-center gap-2 border border-gray-500 dark:text-gray-300 rounded-lg dark:bg-slate-900">
                        <span>
                            <img class="w-8 h-8 rounded-full" src="{{ asset('storage/logos/' . $company->logo) }}"
                                alt="{{ $company->name }} logo">
                        </span>
                        <p>{{ $company->name }}</p>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="mb-3">
            <h3 class="font-semibold">Skills required</h3>
            <div class="my-2 flex flex-wrap gap-2 w-full">
                @foreach ($skills as $skill)
                        <span class="p-1 rounded-md dark:text-gray-400 dark:bg-slate-900 border border-gray-600">{{ $skill->name }}</span>
                @endforeach
            </div>
        </div>

        <div class="flex justify-between items-end dark:text-gray-300">
            <div class="mt-4">
                <strong>Start Date:</strong> {{ $announcement->start_date }}
            </div>
            <div class="mt-2">
                <strong>End Date:</strong> {{ $announcement->end_date }}
            </div>
        </div>
    </div>

</x-app-layout>
