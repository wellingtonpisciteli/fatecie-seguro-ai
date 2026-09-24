<section>

    <header>
        <h2 class="text-lg font-extrabold text-gray-950">
            Alterar senha
        </h2>

        <p class="mt-1 text-sm font-medium leading-6 text-gray-600">
            Mantenha sua conta segura utilizando uma senha longa e difícil de adivinhar.
        </p>
    </header>

    <form
        method="post"
        action="{{ route('password.update') }}"
        class="mt-6 space-y-6"
    >
        @csrf
        @method('put')

        {{-- SENHA ATUAL --}}
        <div>

            <x-input-label
                for="update_password_current_password"
                value="Senha atual"
            />

            <x-text-input
                id="update_password_current_password"
                name="current_password"
                type="password"
                class="mt-1 block w-full"
                autocomplete="current-password"
                placeholder="Digite sua senha atual"
            />

            <x-input-error
                :messages="$errors->updatePassword->get('current_password')"
                class="mt-2"
            />

        </div>

        {{-- NOVA SENHA --}}
        <div>

            <x-input-label
                for="update_password_password"
                value="Nova senha"
            />

            <x-text-input
                id="update_password_password"
                name="password"
                type="password"
                class="mt-1 block w-full"
                autocomplete="new-password"
                placeholder="Digite sua nova senha"
            />

            <x-input-error
                :messages="$errors->updatePassword->get('password')"
                class="mt-2"
            />

        </div>

        {{-- CONFIRMAÇÃO --}}
        <div>

            <x-input-label
                for="update_password_password_confirmation"
                value="Confirmar nova senha"
            />

            <x-text-input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                class="mt-1 block w-full"
                autocomplete="new-password"
                placeholder="Digite novamente sua nova senha"
            />

            <x-input-error
                :messages="$errors->updatePassword->get('password_confirmation')"
                class="mt-2"
            />

        </div>

        {{-- BOTÃO --}}
        <div class="flex items-center gap-4">

            <x-primary-button>
                Alterar senha
            </x-primary-button>

            @if (session('status') === 'password-updated')

                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-medium text-green-600"
                >
                    Senha alterada com sucesso.
                </p>

            @endif

        </div>

    </form>

</section>