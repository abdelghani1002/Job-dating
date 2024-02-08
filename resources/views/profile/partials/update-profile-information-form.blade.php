<section class="flex gap-5 justify-between w-full">
    <div>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Profile Information') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __("Update your account's profile information and email address.") }}
            </p>
        </header>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
            @csrf
            @method('patch')

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                    required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                    required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification"
                                class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <div>
                <x-input-label for="photo" :value="__('Photo')" />
                <input type="file" id="photo" name="photo"
                    class="mt-1 block w-full dark:bg-slate-900 border border-neutral-600 p-1.5 dark:text-gray-300 rounded-lg" />
                <x-input-error class="mt-2" :messages="$errors->get('photo')" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>

                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
    </div>
    <div class="dark:text-gray-300 w-1/2 justify-self-end">
        <h3 class="text-xl">skills</h3>
        <div class="my-2 flex flex-wrap gap-2 w-full ">
            @foreach ($user->skills as $skill)
                <span class="p-1 rounded-md dark:text-gray-400 dark:bg-slate-900 border border-gray-600">{{ $skill->name }}</span>
            @endforeach
        </div>

        <div>
            <form class="flex flex-col gap-3 w-full" action="{{ route('profile.update_skills', $user) }}" method="POST">
                @csrf
                @method('PUT')
                <select id="select-skill" name="skills[]" multiple placeholder="Add a skill..." class="w-full dark:bg-slate-900 border border-neutral-600 p-1.5 dark:text-gray-300 rounded-lg" >
                    @foreach ($skills as $skill)
                    <option class="text-gray-900 dark:text-gray-300 dark:bg-slate-800"
                            value="{{ $skill->id }}"
                            @if ($user->skills->contains($skill))
                                selected
                            @endif
                            >
                        {{ $skill->name }}
                    </option>
                    @endforeach
                </select>
                <x-primary-button class="ml-auto">{{ __('Save') }}</x-primary-button>
            </form>
            <script>
                new TomSelect("#select-skills", {
                    maxItems: 3
                });
            </script>
        </div>
    </div>
</section>
