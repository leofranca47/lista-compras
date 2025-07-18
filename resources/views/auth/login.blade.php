<x-guest-layout>
    <div class="my-6 flex items-center justify-center">
        <img src="{{ asset('/assets/images/cesta.png') }}" />
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="space-y-4">
            <x-input label="Email *" type="email" id="email" name="email" :value="old('email')" required autofocus autocomplete="username" />

            <x-password label="Senha *" type="password" name="password" required autocomplete="current-password" />
        </div>

        <div class="block mt-4">
            <x-checkbox label="Lembrar" id="remember_me" type="checkbox" name="remember" />
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('register'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md" href="{{ route('register') }}">
                    {{ __('Registrar') }}
                </a>
            @endif

            <x-button type="submit" class="ms-3">
                {{ __('Acessar') }}
            </x-button>
        </div>
    </form>
    @section('scripts')
{{--        <script>--}}
{{--            window.onload = function () {--}}
{{--                const savedEmail = localStorage.getItem('rememberedEmail');--}}
{{--                if (savedEmail) {--}}
{{--                    document.getElementById('email').value = savedEmail;--}}
{{--                    document.getElementById('remember_me').checked = true;--}}
{{--                }--}}
{{--            };--}}

{{--            document.querySelector('form').addEventListener('submit', function () {--}}
{{--                const email = document.getElementById('email').value;--}}
{{--                const remember = document.getElementById('remember_me').checked;--}}

{{--                if (remember) {--}}
{{--                    localStorage.setItem('rememberedEmail', email);--}}
{{--                } else {--}}
{{--                    localStorage.removeItem('rememberedEmail');--}}
{{--                }--}}
{{--            });--}}
{{--        </script>--}}
    @endsection
</x-guest-layout>
