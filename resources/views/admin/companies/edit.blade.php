<style>
    .companies {
        background-color: rgba(255, 255, 255, 0.09);
    }
</style>
<x-app-layout>
    <div class="w-full flex flex-row h-full">
        @include('layouts.aside')
        <div class="w-5/6 bg-gray-900">
            <div class="p-3 w-full flex flex-col justify-center">
                <h2 class="text-2xl font-semibold mb-4 text-center dark:text-gray-300">Edit Company</h2>

                <div class="flex flex-row justify-center">
                    <form action="{{ route('companies.update', $company) }}" enctype="multipart/form-data" method="POST" class="max-w-md w-full flex flex-col">
                        @csrf
                        @method("PUT")

                        <div class="mb-4">
                            <label for="name" class="block mb-1 text-sm font-medium dark:text-gray-300">Company
                                Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $company->name) }}"
                                class="form-input w-full rounded-md dark:bg-gray-800 dark:text-gray-300">
                            @error('name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="logo" class="block mb-1 text-sm font-medium dark:text-gray-300">Logo</label>
                            <input type="file" name="logo" id="logo"
                                class="form-input w-full rounded-md dark:bg-gray-800 dark:text-gray-300">

                            @error('logo')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="location"
                                class="block mb-1 text-sm font-medium dark:text-gray-300">Location</label>
                            <input type="text" name="location" id="location" value="{{ old('location', $company->location) }}"
                                class="form-input w-full rounded-md dark:bg-gray-800 dark:text-gray-300">
                            @error('location')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description"
                                class="block mb-1 text-sm font-medium dark:text-gray-300">Description</label>
                            <textarea name="description" id="description" value="{{ old('description', $company->description) }}"
                                class="form-textarea w-full rounded-md dark:bg-gray-800 dark:text-gray-300"></textarea>
                            @error('description')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex justify-center">
                            <button type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                                UPDATE
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
