<style>
    .announcements {
        background-color: rgba(255, 255, 255, 0.09);
    }
</style>
<x-app-layout>
    <div class="w-full flex flex-row">
        @include('layouts.aside')
        <div class="w-5/6 bg-gray-900">
            <div class="p-3 w-full flex flex-col justify-center">
                <h2 class="text-2xl font-semibold mb-4 text-center dark:text-gray-300">Update Announcement</h2>

                <div class="flex flex-row justify-center h-full">
                    <form action="{{ route('announcements.update', $announcement) }}" method="POST"
                        class="w-full flex flex-col">
                        @csrf
                        @method('PUT')
                        <div class="w-full flex gap-5">
                            <div class="w-1/2 h-full flex-col justify-between">
                                <!-- title -->
                                <div class="mb-3">
                                    <label for="title"
                                        class="block mb-1 text-sm font-medium dark:text-gray-300">Title</label>
                                    <input type="text" name="title" id="title"
                                        value="{{ old('title', $announcement->title) }}"
                                        class="form-input w-full rounded-md dark:bg-gray-800 dark:text-gray-300">
                                    @error('title')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Start & end date -->
                                <div class="mb-3 flex justify-between">
                                    <div>
                                        <label for="start_date"
                                            class="block mb-1 text-sm font-medium dark:text-gray-300">Start
                                            date</label>
                                        <input type="datetime-local" name="start_date" id="start_date"
                                            class="form-input w-full rounded-md dark:bg-gray-800 dark:text-gray-300"
                                            value="{{ old('start_date', $announcement->start_date) }}">
                                        @error('start_date')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="end_date"
                                            class="block mb-1 text-sm font-medium dark:text-gray-300">End
                                            date</label>
                                        <input type="datetime-local" name="end_date" id="end_date"
                                            class="form-input w-full rounded-md dark:bg-gray-800 dark:text-gray-300"
                                            value="{{ old('end_date', $announcement->end_date) }}">
                                        @error('end_date')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Partenair companies -->
                                <div class="mb-3">
                                    <label for="description"
                                        class="block mb-1 text-sm font-medium dark:text-gray-300">Parteners</label>
                                    <select id="select-partener" name="parteners[]" multiple placeholder="Add a partener..."
                                        class="w-full dark:bg-slate-900 border border-neutral-600 p-1.5 dark:text-gray-300 rounded-lg">
                                        @foreach ($companies as $company)
                                            <option class="text-gray-900 dark:text-gray-300 dark:bg-slate-800"
                                                value="{{ $company->id }}"
                                                @if ($announcement->companies->contains($company))
                                                    {{ 'selected' }}
                                                @endif>
                                                {{-- <img class="w-5 h-5 rounded-full" src="{{ public_path("storage/logos/" . $company->logo) }}" alt=""> --}}
                                                {{ $company->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('parteners')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Skills required -->
                                <div class="mb-3">
                                    <label for="skills"
                                        class="block mb-1 text-sm font-medium dark:text-gray-300">Skills
                                        required</label>
                                    <select id="select-skill" name="skills[]" multiple placeholder="Add a skill..."
                                        class="w-full dark:bg-slate-900 border border-neutral-600 p-1.5 dark:text-gray-300 rounded-lg">
                                        @foreach ($skills as $skill)
                                            <option class="text-gray-900 dark:text-gray-300 dark:bg-slate-800"
                                                value="{{ $skill->id }}"
                                                @if ($announcement->skills->contains($skill))
                                                    {{ 'selected' }}
                                                @endif>
                                                {{ $skill->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('skills')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Description -->
                            <div class="w-1/2 h-full">
                                <div class="mb-3 h-full">
                                    <label for="description"
                                        class="block mb-1 text-sm font-medium dark:text-gray-300">Description</label>
                                    <textarea name="description" id="myeditorinstance"
                                        class="form-textarea w-full max-h-5/6 h-5/6 box- rounded-md dark:bg-gray-800 dark:text-gray-300">{{ old('description', $announcement->description) }}</textarea>
                                    @error('description')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-center mt-4">
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
