<x-app-layout>
    <div class="w-full flex flex-row h-full">
        @include('layouts.aside')
        <div class="w-5/6 bg-gray-900">
            <div class="p-3 w-full flex flex-col justify-center">
                <h2 class="text-2xl font-semibold mb-2 text-center dark:text-gray-300">Edit User infos</h2>
                <img class="mx-auto mb-2 w-32 h-32 rounded-full" src="{{ asset('storage/photos/'. $user->photo) }}" alt="user photo">

                <div class="flex gap-5 justify-around w-full">

                    <form method="post" action="{{ route('users.update', $user) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="flex justify-between gap-10">
                            <div class="flex flex-col justify-between">
                                <div class="mb-4">
                                    <x-input-label for="name" :value="__('Name')" />
                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                        :value="old('name', $user->name)" required autofocus autocomplete="name" />
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                        :value="old('email', $user->email)" required autocomplete="username" />
                                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                </div>
                            </div>

                            <div class="flex flex-col justify-between">
                                <div class="mb-4">
                                    <x-input-label for="password" :value="__('Password')" />
                                    <x-text-input id="password" name="password" type="text"
                                        class="mt-1 block w-full" :value="old('password', $user->password)" required autocomplete="username" />
                                    <x-input-error class="mt-2" :messages="$errors->get('password')" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="photo" :value="__('Photo')" />
                                    <input type="file" id="photo" name="photo"
                                        class="mt-1 block w-full dark:bg-slate-900 border border-neutral-600 p-1.5 dark:text-gray-300 rounded-lg" />
                                    <x-input-error class="mt-2" :messages="$errors->get('photo')" />
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 flex w-full justify-between">
                            <div class="w-4/6">
                                <x-input-label for="skills" :value="__('Skills')" />
                                <select id="select-skill" name="skills[]" multiple placeholder="Add a skill..."
                                class="w-full dark:bg-slate-900 border border-neutral-600 p-1.5 dark:text-gray-300 rounded-lg">
                                    @foreach ($skills as $skill)
                                        <option class="text-gray-900 dark:text-gray-300 dark:bg-slate-800"
                                            value="{{ $skill->id }}"
                                            @if ($user->skills->contains($skill)) selected @endif>
                                            {{ $skill->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-1/4">
                                <x-input-label for="role" :value="__('Role')" />
                                <select name="role" id="role"
                                    class="h-max w-full dark:bg-slate-900 border border-neutral-600 p-1.5 dark:text-gray-300 rounded-lg">
                                    <option value="admin" @if ($user->hasRole("admin"))
                                        selected
                                    @endif>admin</option>
                                    <option value="student" @if ($user->hasRole("student"))
                                        selected
                                    @endif>student</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex justify-center gap-4">
                            <x-primary-button>{{ __('Update') }}</x-primary-button>

                            @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
