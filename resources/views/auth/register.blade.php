<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __("Roʻyxatdan oʻtganmisiz?") }}
            </a>

            <x-primary-button class="ms-4">
                {{ __("Ro'yxatdan o'tish") }}
            </x-primary-button>
        </div>
        <br>
        
        <div class="container text-center my-5">
    <div class="row justify-content-center">
        <!-- Google Login Button -->
        <div class="col-md-4 mb-3">
            <a href="{{ route('auth.google') }}" 
               class="btn btn-google btn-lg btn-block d-flex align-items-center justify-content-center">
                <i class="fab fa-google mr-2"></i> Login with Google
            </a>
       
            <a href="{{ route('auth.github') }}" 
               class="btn btn-github btn-lg btn-block d-flex align-items-center justify-content-center">
                <i class="fab fa-github mr-2"></i> Login with GitHub
            </a>
        </div>
    </div>
</div>

</form>

<style>
    /* Google Button Styles */
    .btn-google {
        background: linear-gradient(45deg, rgb(66, 133, 244), rgb(52, 168, 83));
        color: white;
        border: none;
        border-radius: 5px;
        padding: 8px 10px;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 4px 10px rgba(66, 133, 244, 0.4);
        margin-right: 4px;
        
    }

    .btn-google:hover {
        background: linear-gradient(45deg, rgb(52, 168, 83), rgb(66, 133, 244));
        box-shadow: 0 6px 15px rgba(66, 133, 244, 0.6);
    }

    /* GitHub Button Styles */
    .btn-github {
        background: linear-gradient(45deg, rgb(0, 0, 0), rgb(64, 64, 64));
        color: white;
        border: none;
        border-radius: 5px;
        padding: 8px 10px;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
        margin-left: 4px;
    }

    .btn-github:hover {
        background: linear-gradient(45deg, rgb(64, 64, 64), rgb(0, 0, 0));
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.6);
    }

    /* General Button Styles */
    .btn {
        font-size: 16px;
        font-weight: bold;
        text-decoration: none;
    }

    .btn i {
        font-size: 20px;
    }
</style>
    </form>
</x-guest-layout>
