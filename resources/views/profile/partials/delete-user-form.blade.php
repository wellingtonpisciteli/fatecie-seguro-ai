<section class="space-y-6">

    <header>
        <h2 class="text-lg font-extrabold text-gray-950">
            Excluir conta
        </h2>

        <p class="mt-1 text-sm font-medium leading-6 text-gray-600">
            Depois que sua conta for excluída, todos os seus dados e recursos serão
            removidos permanentemente. Antes de excluir sua conta, certifique-se de
            salvar qualquer informação que deseja manter.
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >
        Excluir conta
    </x-danger-button>

    <x-modal
        name="confirm-user-deletion"
        :show="$errors->userDeletion->isNotEmpty()"
        focusable
    >
        <form
            method="post"
            action="{{ route('profile.destroy') }}"
            class="p-6"
        >
            @csrf
            @method('delete')

            <div class="flex items-start gap-4">

                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-100 text-red-600">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        class="h-5 w-5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673A2.25 2.25 0 0 1 15.916 21H8.084a2.25 2.25 0 0 1-2.244-1.327L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0V4.5a2.25 2.25 0 0 0-2.25-2.25h-3A2.25 2.25 0 0 0 10.5 4.5v.75m7.5 0h-15"
                        />
                    </svg>

                </div>

                <div>
                    <h2 class="text-lg font-extrabold text-gray-950">
                        Tem certeza de que deseja excluir sua conta?
                    </h2>

                    <p class="mt-1 text-sm font-medium leading-6 text-gray-600">
                        Essa ação é permanente e todos os seus dados serão excluídos.
                        Digite sua senha abaixo para confirmar a exclusão da conta.
                    </p>
                </div>

            </div>

            <div class="mt-6">

                <x-input-label
                    for="password"
                    value="Senha"
                    class="sr-only"
                />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full"
                    placeholder="Digite sua senha"
                />

                <x-input-error
                    :messages="$errors->userDeletion->get('password')"
                    class="mt-2"
                />

            </div>

            <div class="mt-6 flex justify-end gap-3">

                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancelar
                </x-secondary-button>

                <x-danger-button>
                    Excluir conta
                </x-danger-button>

            </div>

        </form>
    </x-modal>

</section>