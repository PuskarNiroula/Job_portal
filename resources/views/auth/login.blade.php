<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50">
        <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-8 space-y-6">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-indigo-600">JobPortal</h1>
                <p class="text-gray-500 mt-2">Sign in to your employer account</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form class="space-y-5" id="loginForm" action="{{route('login')}}" method="Post">
                @csrf
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium" />
                    <x-text-input id="email" type="email" name="email" :value="old('email')"
                                  required autofocus
                                  class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                                  placeholder="you@example.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
                </div>

                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
                    <x-text-input id="password" type="password" name="password" required
                                  class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                                  placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center text-sm text-gray-600">
                        <input id="remember_me" type="checkbox" name="remember"
                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <span class="ml-2">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-sm text-indigo-600 hover:text-indigo-700">
                            Forgot your password?
                        </a>
                    @endif
                </div>
                <div>
                    <x-primary-button class="w-full py-2 px-4 rounded-lg bg-indigo-600 hover:bg-indigo-700 transition">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>

            <div class="text-center text-gray-500 text-sm mt-4">
                © {{ date('Y') }} JobPortal. Built with ❤️
            </div>
        </div>
    </div>

</x-guest-layout>

