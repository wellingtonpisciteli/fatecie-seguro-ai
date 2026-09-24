<x-app-layout>

    <div class="bg-gray-50 py-8">

        <div class="w-full px-4 sm:px-6 lg:px-8 xl:px-10 2xl:px-12">

            {{-- =====================================================
                CABEÇALHO
            ====================================================== --}}

            <div class="mb-8">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-100 text-orange-600">

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
                                d="M15.75 6.75a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0"
                            />
                        </svg>

                    </div>

                    <div>

                        <p class="text-xs font-extrabold uppercase tracking-[0.2em] text-orange-600">
                            Fatecie Seguro AI
                        </p>

                        <h1 class="mt-0.5 text-3xl font-extrabold tracking-tight text-gray-950">
                            Meu perfil
                        </h1>

                    </div>

                </div>

                <p class="mt-4 max-w-2xl text-sm font-medium leading-6 text-gray-600">
                    Gerencie suas informações pessoais, senha e configurações da sua conta.
                </p>

            </div>


            {{-- =====================================================
                INFORMAÇÕES DO PERFIL
            ====================================================== --}}

            <div class="mb-6 overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">

                <div class="border-b border-gray-200 px-6 py-5">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-100 text-orange-600">

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
                                    d="M15.75 6.75a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0"
                                />
                            </svg>

                        </div>

                        <div>

                            <h2 class="text-xl font-extrabold text-gray-950">
                                Informações do perfil
                            </h2>

                            <p class="mt-1 text-sm font-medium text-gray-600">
                                Atualize seu nome e endereço de e-mail.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="px-6 py-6 sm:px-8 sm:py-8">

                    <div class="max-w-2xl">

                        @include('profile.partials.update-profile-information-form')

                    </div>

                </div>

            </div>


            {{-- =====================================================
                SENHA
            ====================================================== --}}

            <div class="mb-6 overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">

                <div class="border-b border-gray-200 px-6 py-5">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-100 text-orange-600">

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
                                    d="M16.5 10.5V6.75a4.5 4.5 0 0 0-9 0v3.75m-.75 0h10.5A2.25 2.25 0 0 1 19.5 12.75v6A2.25 2.25 0 0 1 17.25 21H6.75A2.25 2.25 0 0 1 4.5 18.75v-6A2.25 2.25 0 0 1 6.75 10.5Z"
                                />
                            </svg>

                        </div>

                        <div>

                            <h2 class="text-xl font-extrabold text-gray-950">
                                Segurança
                            </h2>

                            <p class="mt-1 text-sm font-medium text-gray-600">
                                Mantenha sua conta protegida atualizando sua senha regularmente.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="px-6 py-6 sm:px-8 sm:py-8">

                    <div class="max-w-2xl">

                        @include('profile.partials.update-password-form')

                    </div>

                </div>

            </div>


            {{-- =====================================================
                EXCLUSÃO DA CONTA
            ====================================================== --}}

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-red-200">

                <div class="border-b border-red-100 bg-red-50 px-6 py-5">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-red-100 text-red-600">

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

                            <h2 class="text-xl font-extrabold text-gray-950">
                                Excluir conta
                            </h2>

                            <p class="mt-1 text-sm font-medium text-red-700">
                                A exclusão da conta é permanente e não poderá ser desfeita.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="px-6 py-6 sm:px-8 sm:py-8">

                    <div class="max-w-2xl">

                        @include('profile.partials.delete-user-form')

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>