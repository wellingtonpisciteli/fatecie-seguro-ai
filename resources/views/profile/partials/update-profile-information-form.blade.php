<section>

    <header>
        <h2 class="text-lg font-extrabold text-gray-950">
            Informações do perfil
        </h2>

        <p class="mt-1 text-sm font-medium leading-6 text-gray-600">
            Atualize suas informações pessoais e seu endereço de e-mail.
        </p>
    </header>

    <form
        id="send-verification"
        method="post"
        action="{{ route('verification.send') }}"
    >
        @csrf
    </form>

    <form
        method="post"
        action="{{ route('profile.update') }}"
        class="mt-6 space-y-6"
    >
        @csrf
        @method('patch')

        {{-- NOME --}}
        <div>

            <x-input-label
                for="name"
                value="Nome"
            />

            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-1 block w-full"
                :value="old('name', $user->name)"
                required
                autofocus
                autocomplete="name"
                placeholder="Digite seu nome"
            />

            <x-input-error
                class="mt-2"
                :messages="$errors->get('name')"
            />

        </div>

        {{-- E-MAIL --}}
        <div>

            <x-input-label
                for="email"
                value="E-mail"
            />

            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full"
                :value="old('email', $user->email)"
                required
                autocomplete="username"
                placeholder="Digite seu e-mail"
            />

            <x-input-error
                class="mt-2"
                :messages="$errors->get('email')"
            />

            {{-- VERIFICAÇÃO DE E-MAIL --}}
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())

                <div class="mt-3 rounded-xl border border-amber-200 bg-amber-50 p-4">

                    <div class="flex items-start gap-3">

                        <div class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-amber-100 text-amber-600">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.8"
                                stroke="currentColor"
                                class="h-4 w-4"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 9v3.75m0 3.75h.007v.008H12v-.008ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                />
                            </svg>

                        </div>

                        <div>

                            <p class="text-sm font-semibold text-amber-900">
                                Seu endereço de e-mail ainda não foi verificado.
                            </p>

                            <button
                                form="send-verification"
                                class="mt-1 text-sm font-semibold text-amber-700 underline decoration-amber-300 underline-offset-2 transition hover:text-amber-900"
                            >
                                Clique aqui para reenviar o e-mail de verificação.
                            </button>

                        </div>

                    </div>

                    @if (session('status') === 'verification-link-sent')

                        <p class="mt-3 text-sm font-semibold text-green-600">
                            Um novo link de verificação foi enviado para seu e-mail.
                        </p>

                    @endif

                </div>

            @endif

        </div>

        {{-- SALVAR --}}
        <div class="flex items-center gap-4">

            <x-primary-button>
                Salvar alterações
            </x-primary-button>

            @if (session('status') === 'profile-updated')

                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-semibold text-green-600"
                >
                    Alterações salvas com sucesso.
                </p>

            @endif

        </div>

    </form>

</section>