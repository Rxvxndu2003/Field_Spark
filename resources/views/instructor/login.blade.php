<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>
        <h1 class="font-medium text-2xl text-green-600 text-center mb-4">Instructor Login</h1>
        <div class="text-sm">
            <x-validation-errors class="mb-4" />

            @session('status')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ $value }}
                </div>
            @endsession

            <form method="POST" action="{{ route('instructor.login') }}">
                @csrf

                <div>
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                </div>

                <div class="block mt-4">
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="flex items-center">
                            <x-checkbox id="remember_me" name="remember" />
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                        <span class="text-sm text-gray-600">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                        </span>
                    </div>
                </div>

                <div class="items-center mt-4 flex justify-center">
                    <x-button class="ms-4">
                        {{ __('Log in') }}
                    </x-button>
                </div>

                <div class="register-link mt-6 text-center text-custom-green">
                    <p>Don't have an account? <a href="/instructor/register" class="underline hover:text-custom-green-hover">Register</a></p>
                    <br>
                    <p>Are you already registered as an Farmer? <a href="/login" class="underline hover:text-custom-green-hover">Log In</a></p>
                </div>
            </form>

            @auth
                <div class="flex justify-center mt-4">
                    <a
                        href="{{ url('/idashboard') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Dashboard
                    </a>
                </div>
            @endauth
        </div>
    </x-authentication-card>
</x-guest-layout>
