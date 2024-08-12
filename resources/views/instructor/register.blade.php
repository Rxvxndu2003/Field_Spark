<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>
        <h1 class="font-medium text-2xl text-green-600 text-center mb-4">Instructor Registration</h1>
        <div class="text-sm">
            <x-validation-errors class="mb-4" />

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('instructor.register') }}" class="w-full max-w-xl mx-auto">
                @csrf

                <div>
                    <x-label for="name" value="{{ __('Name') }}" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>

                <div class="mt-4">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-label for="location" value="{{ __('Location') }}" />
                    <x-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location')" required autocomplete="location" />
                </div>

                <div class="mt-4">
                    <x-label for="phone" value="{{ __('Phone') }}" />
                    <x-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" required autocomplete="tel" />
                </div>

                <div class="mt-4">
                    <x-label for="job" value="{{ __('Job') }}" />
                    <x-input id="job" class="block mt-1 w-full" type="text" name="job" :value="old('job')" required autocomplete="job" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mt-4">
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    </div>

                    <div class="mt-4">
                        <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-label for="terms">
                            <div class="flex items-center">
                                <x-checkbox name="terms" id="terms" required />
                                <div class="ms-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-label>
                    </div>
                @endif

                <div class="flex flex-col items-center justify-center mt-5">
                    <x-button>
                        {{ __('Register') }}
                    </x-button>

                    <a class="underline text-sm text-gray-600 hover:text-gray-900 mt-4" href="/instructor/login">
                        {{ __('Already registered as a Instructor?') }}
                    </a>

                    <a class="underline text-sm text-gray-600 hover:text-gray-900 mt-4" href="/register">
                        {{ __('if you are an Farmer, Register Here !!!') }}
                    </a>
                </div>
            </form>

            @auth
                <div class="flex justify-center mt-4">
                    <a
                        href="{{ url('/instructor/login') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Dashboard
                    </a>
                </div>
            @endauth
        </div>
    </x-authentication-card>
</x-guest-layout>
