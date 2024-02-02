{{-- <!-- Styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Or for RTL support -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

<!-- Select2 Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script> --}}

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
                <h2 class="text-2xl font-semibold mb-4 text-center dark:text-gray-300">New Announcement</h2>

                <div class="flex flex-row justify-center h-full">
                    <form action="{{ route('announcements.update', $announcement) }}" method="post"
                        class="max-w-md w-full flex flex-col">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="title" class="block mb-1 text-sm font-medium dark:text-gray-300">Title</label>
                            <input type="text" name="title" id="title"
                                value="{{ old('title', $announcement->title) }}"
                                class="form-input w-full rounded-md dark:bg-gray-800 dark:text-gray-300">
                            @error('title')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4 flex justify-between">
                            <div>
                                <label for="start_date" class="block mb-1 text-sm font-medium dark:text-gray-300">Start
                                    date</label>
                                <input type="datetime-local" name="start_date" id="start_date"
                                    class="form-input w-full rounded-md dark:bg-gray-800 dark:text-gray-300"
                                    value="{{ old('start_date', $announcement->start_date) }}">
                                @error('start_date')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="end_date" class="block mb-1 text-sm font-medium dark:text-gray-300">End
                                    date</label>
                                <input type="datetime-local" name="end_date" id="end_date"
                                    class="form-input w-full rounded-md dark:bg-gray-800 dark:text-gray-300"
                                    value="{{ old('end_date', $announcement->end_date) }}">
                                @error('end_date')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="description"
                                class="block mb-1 text-sm font-medium dark:text-gray-300">Description</label>
                            <textarea name="description" id="myeditorinstance"
                                class="form-textarea w-full rounded-md dark:bg-gray-800 dark:text-gray-300">{{ old('description', $announcement->description) }}</textarea>
                            @error('description')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Partenair companies -->
                        <div class="mb-4">
                            <label for="description"
                                class="block mb-1 text-sm font-medium dark:text-gray-300">Parteners</label>
                            <select name="parteners[]"
                                class="form-select w-full rounded-md dark:bg-gray-800 dark:text-gray-300"
                                id="multiple-select-clear-field" data-placeholder="Choose anything">
                                <option class="hidden" value="">Select companies</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}"
                                        @if ($company->id == $announcement->companies[0]->id)
                                            {{ 'selected' }}
                                        @endif
                                    >
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parteners')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex justify-center">
                            <button type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                                Create Announcement
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // $('#multiple-select-clear-field').select2({
        //     theme: "bootstrap-5",
        //     width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        //     placeholder: $(this).data('placeholder'),
        //     closeOnSelect: false,
        //     allowClear: false,
        // });
    </script>
</x-app-layout>
