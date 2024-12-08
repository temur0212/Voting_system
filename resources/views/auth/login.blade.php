<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>


        <div class="flex items-center justify-end mt-4">
            @if (Route::has('register'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                    {{ __("Ro'yxatdan o'tish ") }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Kirish') }}
            </x-primary-button>
        </div>
        <div class="row mb-0">
            <div class="col-md-8 offset-md-4">
                <br/>
                <a href="{{ route('auth.google') }}">
                    <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png">
                </a>
            </div>
        </div>

    </form>
</x-guest-layout>
