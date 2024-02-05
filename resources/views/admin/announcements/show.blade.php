<x-app-layout>
    <div class="dark:bg-gray-800 dark:text-white p-6">
        <h2 class="text-2xl font-bold mb-4">{{ $announcement->title }}</h2>
        <p class="dark:text-gray-300 mb-2 text-sm">{{ $announcement->description }}</p>

        <div class="mb-3">
            <h3 class="font-semibold">Companies partened</h3>
            <div class="flex flex-wrap gap-4">
                @foreach ($parteners as $company)
                    <a href="{{ route('companies.show', $company) }}" class="p-2 flex items-center gap-2">
                        <div>
                            <img class="w-8 h-8 rounded-full" src="{{ asset('storage/logos/' . $company->logo) }}"
                                alt="{{ $company->name }} logo">
                        </div>
                        <p>{{ $company->name }}</p>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="mt-4">
            <strong>Start Date:</strong> {{ $announcement->start_date }}
        </div>
        <div class="mt-2">
            <strong>End Date:</strong> {{ $announcement->end_date }}
        </div>
    </div>

</x-app-layout>
