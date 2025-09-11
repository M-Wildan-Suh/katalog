<x-guest-layout>

    <div class=" w-full relative flex justify-center">
        {{-- <a href="{{ route('register') }}" class=" text-sm absolute top-0 right-0 hover:text-third duration-300">Daftar</a> --}}
        <p class=" text-2xl font-black text-third">Login</p>
    </div>
    <form method="POST" action="{{ route('login') }}" class=" w-full">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class=" flex justify-end items-center gap-2">
                <span class="text-sm text-gray-600">{{ __('Ingat saya') }}</span>
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-liburanaja-1 shadow-sm ring-0 focus:ring-0 focus:border focus:ring-transparent" name="remember">
            </label>
        </div>

        <div class="flex flex-col items-center justify-end mt-4 gap-2">
            <button
                class=" w-full py-2 bg-byolink-2 rounded-md text-white font-bold duration-300 hover:bg-byolink-3">Login</button>
            {{-- @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none"
                    href="{{ route('password.request') }}">
                    Lupa Password
                </a>
            @endif --}}
        </div>
    </form>

</x-guest-layout>
