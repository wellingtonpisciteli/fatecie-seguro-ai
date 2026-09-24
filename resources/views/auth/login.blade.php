<x-guest-layout>

    <div class="min-h-screen bg-gray-50">

        <div class="flex min-h-screen items-center justify-center px-4 py-10 sm:px-6">

            <div class="w-full max-w-md">

                {{-- =====================================================
                    IDENTIDADE
                ====================================================== --}}

                <div class="mb-8 text-center">

                    <div class="mb-5 flex justify-center">

                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-100 text-orange-600">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.8"
                                stroke="currentColor"
                                class="h-7 w-7"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 3 4.5 6.75v5.625c0 4.658 3.21 7.996 7.5 8.625 4.29-.629 7.5-3.967 7.5-8.625V6.75L12 3Z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m9 12 2 2 4-4"
                                />
                            </svg>

                        </div>

                    </div>

                    <div class="flex items-center justify-center gap-1">

                        <span class="text-2xl font-extrabold tracking-tight text-gray-900">
                            Fatecie
                        </span>

                        <span class="text-2xl font-extrabold tracking-tight text-orange-600">
                            Seguro
                        </span>

                        <span class="text-2xl font-extrabold tracking-tight text-gray-700">
                            AI
                        </span>

                    </div>

                    <p class="mt-2 text-sm font-medium text-gray-500">
                        Gestão de seguros para estágio
                    </p>

                </div>

                {{-- =====================================================
                    CARD DE LOGIN
                ====================================================== --}}

                <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">

                    <div class="border-b border-gray-100 px-6 py-6 sm:px-8">

                        <h1 class="text-xl font-extrabold text-gray-950">
                            Acessar sua conta
                        </h1>

                        <p class="mt-1 text-sm font-medium text-gray-500">
                            Entre com seus dados para continuar.
                        </p>

                    </div>

                    <div class="px-6 py-6 sm:px-8 sm:py-8">

                        {{-- STATUS DA SESSÃO --}}

                        <x-auth-session-status
                            class="mb-5"
                            :status="session('status')"
                        />

                        <form
                            method="POST"
                            action="{{ route('login') }}"
                            class="space-y-5"
                        >
                            @csrf

                            {{-- E-MAIL --}}

                            <div>

                                <x-input-label
                                    for="email"
                                    value="E-mail"
                                />

                                <x-text-input
                                    id="email"
                                    class="mt-1 block w-full"
                                    type="email"
                                    name="email"
                                    :value="old('email')"
                                    required
                                    autofocus
                                    autocomplete="username"
                                    placeholder="Digite seu e-mail"
                                />

                                <x-input-error
                                    :messages="$errors->get('email')"
                                    class="mt-2"
                                />

                            </div>

                            {{-- SENHA --}}

                            <div>

                                <div class="flex items-center justify-between">

                                    <x-input-label
                                        for="password"
                                        value="Senha"
                                    />

                                    @if (Route::has('password.request'))

                                        <a
                                            href="{{ route('password.request') }}"
                                            class="text-sm font-semibold text-orange-600 transition hover:text-orange-700"
                                        >
                                            Esqueceu sua senha?
                                        </a>

                                    @endif

                                </div>

                                <x-text-input
                                    id="password"
                                    class="mt-1 block w-full"
                                    type="password"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                    placeholder="Digite sua senha"
                                />

                                <x-input-error
                                    :messages="$errors->get('password')"
                                    class="mt-2"
                                />

                            </div>

                            {{-- LEMBRAR-ME --}}

                            <div>

                                <label
                                    for="remember_me"
                                    class="inline-flex cursor-pointer items-center"
                                >

                                    <input
                                        id="remember_me"
                                        type="checkbox"
                                        class="rounded border-gray-300 text-orange-600 shadow-sm focus:ring-orange-500"
                                        name="remember"
                                    >

                                    <span class="ms-2 text-sm font-medium text-gray-600">
                                        Lembrar de mim
                                    </span>

                                </label>

                            </div>

                            {{-- BOTÃO --}}

                            <div class="pt-1">

                                <x-primary-button class="w-full justify-center py-3 text-sm">
                                    Entrar
                                </x-primary-button>

                            </div>

                        </form>

                    </div>

                </div>

                {{-- RODAPÉ --}}

                <p class="mt-6 text-center text-xs font-medium text-gray-400">
                    Fatecie Seguro AI
                </p>

            </div>

        </div>

    </div>

</x-guest-layout>