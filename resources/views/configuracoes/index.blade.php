<x-app-layout>

<div class="bg-gray-50 py-8">

    <div class="w-full px-4 sm:px-6 lg:px-8 xl:px-10 2xl:px-12">

        {{-- HEADER --}}
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
                            d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.592c.55 0 1.02.398 1.11.94l.18 1.077a1.125 1.125 0 0 0 .61.82c.114.057.228.117.34.18a1.125 1.125 0 0 0 1.019.05l.95-.475a1.125 1.125 0 0 1 1.34.183l1.834 1.834c.389.39.46.997.183 1.47l-.475.95a1.125 1.125 0 0 0 .05 1.019c.063.112.123.226.18.34.16.317.46.548.82.61l1.077.18c.542.09.94.56.94 1.11v2.592c0 .55-.398 1.02-.94 1.11l-1.077.18a1.125 1.125 0 0 0-.82.61c-.057.114-.117.228-.18.34a1.125 1.125 0 0 0-.05 1.019l.475.95c.277.473.206 1.08-.183 1.47l-1.834 1.834a1.125 1.125 0 0 1-1.34.183l-.95-.475a1.125 1.125 0 0 0-1.019.05c-.112.063-.226.123-.34.18a1.125 1.125 0 0 0-.61.82l-.18 1.077c-.09.542-.56.94-1.11.94h-2.592c-.55 0-1.02-.398-1.11-.94l-.18-1.077a1.125 1.125 0 0 0-.61-.82 6.74 6.74 0 0 1-.34-.18 1.125 1.125 0 0 0-1.019-.05l-.95.475a1.125 1.125 0 0 1-1.34-.183l-1.834-1.834a1.125 1.125 0 0 1-.183-1.47l.475-.95a1.125 1.125 0 0 0-.05-1.019 6.74 6.74 0 0 1-.18-.34 1.125 1.125 0 0 0-.82-.61l-1.077-.18A1.125 1.125 0 0 1 3 15.42v-2.592c0-.55.398-1.02.94-1.11l1.077-.18a1.125 1.125 0 0 0 .82-.61c.057-.114.117-.228.18-.34a1.125 1.125 0 0 0 .05-1.019l-.475-.95a1.125 1.125 0 0 1 .183-1.47l1.834-1.834a1.125 1.125 0 0 1 1.34-.183l.95.475a1.125 1.125 0 0 0 1.019-.05c.112-.063.226-.123.34-.18.317-.16.548-.46.61-.82l.18-1.077Z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 13.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                        />

                    </svg>

                </div>

                <div>

                    <p class="text-xs font-extrabold uppercase tracking-[0.2em] text-orange-600">
                        Fatecie Seguro AI
                    </p>

                    <h1 class="mt-0.5 text-3xl font-extrabold tracking-tight text-gray-950">
                        Configurações
                    </h1>

                </div>

            </div>

            <p class="mt-4 max-w-2xl text-sm font-medium leading-6 text-gray-600">
                Configure os parâmetros utilizados pelo sistema para controlar os seguros.
            </p>

        </div>


        {{-- SUCCESS --}}
        @if (session('success'))

            <div class="mb-6 flex items-start gap-3 rounded-xl border border-green-200 bg-green-50 px-5 py-4">

                <div class="mt-0.5 text-green-600">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="h-5 w-5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 12.75 11.25 15 15 9.75M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9Z"
                        />
                    </svg>

                </div>

                <p class="text-sm font-semibold text-green-800">
                    {{ session('success') }}
                </p>

            </div>

        @endif


        {{-- VALIDATION ERRORS --}}
        @if ($errors->any())

            <div class="mb-6 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 px-5 py-4">

                <div class="mt-0.5 text-red-600">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="h-5 w-5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 9v3.75m0 3h.008v.008H12v-.008ZM10.343 3.94l-7.06 12.25A1.875 1.875 0 0 0 4.908 19h14.184a1.875 1.875 0 0 0 1.625-2.81l-7.06-12.25a1.875 1.875 0 0 0-3.314 0Z"
                        />
                    </svg>

                </div>

                <div>

                    <p class="text-sm font-extrabold text-red-800">
                        Não foi possível salvar a configuração.
                    </p>

                    <ul class="mt-2 space-y-1 text-sm font-medium text-red-700">

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        @endif


        {{-- ===================================================== --}}
        {{-- ALPINE + CONFIGURAÇÃO --}}
        {{-- ===================================================== --}}

        <div
            x-data="{
                modalConfirmacao: false,
                prazo: '',

                abrirModalConfirmacao() {

                    const form = this.$refs.form;

                    if (!form.checkValidity()) {
                        form.reportValidity();
                        return;
                    }

                    this.prazo = document.getElementById('prazo_alerta_vencimento').value;

                    this.modalConfirmacao = true;
                }
            }"
        >

            {{-- CONFIGURAÇÕES --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">

                {{-- CARD HEADER --}}
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
                                    d="M12 6.75v10.5M7.5 10.5h9M5.25 6.75h13.5M5.25 17.25h13.5"
                                />
                            </svg>

                        </div>

                        <div>

                            <h2 class="text-xl font-extrabold text-gray-950">
                                Seguros
                            </h2>

                            <p class="mt-1 text-sm font-medium text-gray-600">
                                Parâmetros relacionados ao controle e vencimento dos seguros.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- FORM --}}
                <form
                    x-ref="form"
                    method="POST"
                    action="{{ route('configuracoes.atualizar') }}"
                    class="p-6"
                >

                    @csrf
                    @method('PUT')


                    <div class="max-w-xl">

                        <label
                            for="prazo_alerta_vencimento"
                            class="block text-sm font-extrabold text-gray-800"
                        >
                            Antecedência para vencimento
                        </label>

                        <p class="mt-1 text-sm font-medium leading-6 text-gray-600">
                            Defina quantos dias antes do vencimento o seguro deverá ser
                            identificado como próximo do vencimento.
                        </p>


                        <div class="mt-4 flex items-center gap-3">

                            <input
                                type="number"
                                name="prazo_alerta_vencimento"
                                id="prazo_alerta_vencimento"
                                value="{{ old('prazo_alerta_vencimento', $prazoAlerta) }}"
                                min="1"
                                max="365"
                                required
                                class="block w-32 rounded-xl border-gray-300 bg-white px-4 py-3 text-sm font-bold text-gray-900 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                            >

                            <span class="text-sm font-bold text-gray-700">
                                dias
                            </span>

                        </div>


                        {{-- INFORMAÇÃO --}}
                        <div class="mt-4 rounded-xl border border-orange-200 bg-orange-50 px-4 py-4">

                            <div class="flex items-start gap-3">

                                <div class="mt-0.5 text-orange-600">

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
                                            d="M12 9v3.75m0 3h.008v.008H12v-.008ZM10.343 3.94l-7.06 12.25A1.875 1.875 0 0 0 4.908 19h14.184a2.25 2.25 0 0 0 1.95-3.375L13.95 4.375a2.25 2.25 0 0 0-3.9 0l-7.184 12.25A2.25 2.25 0 0 0 4.816 20H19.184"
                                        />
                                    </svg>

                                </div>

                                <div>

                                    <p class="text-sm font-extrabold text-orange-800">
                                        Como funciona
                                    </p>

                                    <p class="mt-1 text-sm font-medium leading-6 text-orange-700">
                                        Quando o seguro estiver dentro desse período antes
                                        da data de vencimento, ele será marcado como
                                        <strong>Próximo do vencimento</strong>.
                                    </p>

                                </div>

                            </div>

                        </div>


                        @error('prazo_alerta_vencimento')

                            <p class="mt-2 text-sm font-semibold text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- ACTIONS --}}
                    <div class="mt-8 flex justify-end border-t border-gray-200 pt-6">

                        <button
                            type="button"
                            @click="abrirModalConfirmacao()"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-orange-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition duration-200 hover:bg-orange-700 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="h-5 w-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M17.593 3.322c.405.405.633.954.633 1.527v14.302a2.16 2.16 0 0 1-2.16 2.16H7.934a2.16 2.16 0 0 1-2.16-2.16V4.849c0-.573.228-1.122.633-1.527l.162-.162a2.16 2.16 0 0 1 3.054 0l.162.162c.405.405.954.633 1.527.633h4.321c.573 0 1.122-.228 1.527-.633l.162-.162a2.16 2.16 0 0 1 3.054 0l.162.162Z"
                                />
                            </svg>

                            Salvar configuração

                        </button>

                    </div>

                </form>

            </div>


            {{-- ===================================================== --}}
            {{-- MODAL DE CONFIRMAÇÃO --}}
            {{-- ===================================================== --}}

            <div
                x-show="modalConfirmacao"
                x-cloak
                class="fixed inset-0 z-50 flex items-center justify-center px-4"
                role="dialog"
                aria-modal="true"
                aria-labelledby="modal-configuracao-titulo"
            >

                {{-- OVERLAY --}}
                <div
                    x-show="modalConfirmacao"
                    x-transition.opacity
                    @click="modalConfirmacao = false"
                    class="absolute inset-0 bg-gray-950/50"
                ></div>


                {{-- MODAL --}}
                <div
                    x-show="modalConfirmacao"
                    x-transition
                    @click.stop
                    class="relative w-full max-w-lg overflow-hidden rounded-2xl bg-white shadow-2xl"
                >

                    {{-- CABEÇALHO --}}
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
                                        d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.592c.55 0 1.02.398 1.11.94l.18 1.077a1.125 1.125 0 0 0 .61.82c.114.057.228.117.34.18a1.125 1.125 0 0 0 1.019.05l.95-.475a1.125 1.125 0 0 1 1.34.183l1.834 1.834c.389.39.46.997.183 1.47l-.475.95a1.125 1.125 0 0 0 .05 1.019c.063.112.123.226.18.34.16.317.46.548.82.61l1.077.18c.542.09.94.56.94 1.11v2.592c0 .55-.398 1.02-.94 1.11l-1.077.18a1.125 1.125 0 0 0-.82.61c-.057.114-.117.228-.18.34a1.125 1.125 0 0 0-.05 1.019l.475.95c.277.473.206 1.08-.183 1.47l-1.834 1.834a1.125 1.125 0 0 1-1.34.183l-.95-.475a1.125 1.125 0 0 0-1.019.05c-.112.063-.226.123-.34.18a1.125 1.125 0 0 0-.61.82l-.18 1.077c-.09.542-.56.94-1.11.94h-2.592c-.55 0-1.02-.398-1.11-.94l-.18-1.077a1.125 1.125 0 0 0-.61-.82 6.74 6.74 0 0 1-.34-.18 1.125 1.125 0 0 0-1.019-.05l-.95.475a1.125 1.125 0 0 1-1.34-.183l-1.834-1.834a1.125 1.125 0 0 1-.183-1.47l.475-.95a1.125 1.125 0 0 0-.05-1.019 6.74 6.74 0 0 0-.18-.34 1.125 1.125 0 0 0-.82-.61l-1.077-.18A1.125 1.125 0 0 1 3 15.42v-2.592c0-.55.398-1.02.94-1.11l1.077-.18a1.125 1.125 0 0 0 .82-.61c.057-.114.117-.228.18-.34a1.125 1.125 0 0 0 .05-1.019l-.475-.95a1.125 1.125 0 0 1 .183-1.47l1.834-1.834a1.125 1.125 0 0 1 1.34-.183l.95.475a1.125 1.125 0 0 0 1.019-.05c.112-.063.226-.123.34-.18.317-.16.548-.46.61-.82l.18-1.077Z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15 13.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                    />

                                </svg>

                            </div>

                            <div>

                                <h2
                                    id="modal-configuracao-titulo"
                                    class="text-lg font-extrabold text-gray-950"
                                >
                                    Confirmar alteração
                                </h2>

                                <p class="mt-1 text-sm font-medium text-gray-600">
                                    Confira o novo parâmetro antes de salvar.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- RESUMO --}}
                    <div class="px-6 py-6">

                        <div class="rounded-xl border border-gray-200">

                            <div class="px-4 py-4">

                                <p class="text-xs font-extrabold uppercase tracking-wide text-gray-500">
                                    Antecedência para vencimento
                                </p>

                                <div class="mt-2 flex items-baseline gap-2">

                                    <span
                                        class="text-2xl font-extrabold text-gray-950"
                                        x-text="prazo"
                                    ></span>

                                    <span class="text-sm font-bold text-gray-600">
                                        dias
                                    </span>

                                </div>

                            </div>

                        </div>


                        {{-- AVISO --}}
                        <div class="mt-5 rounded-xl border border-orange-200 bg-orange-50 px-4 py-4">

                            <div class="flex items-start gap-3">

                                <div class="mt-0.5 text-orange-600">

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
                                            d="M12 9v3.75m0 3h.008v.008H12v-.008ZM10.343 3.94l-7.06 12.25A1.875 1.875 0 0 0 4.908 19h14.184a2.25 2.25 0 0 0 1.95-3.375L13.95 4.375a2.25 2.25 0 0 0-3.9 0l-7.184 12.25A2.25 2.25 0 0 0 4.816 20H19.184"
                                        />
                                    </svg>

                                </div>

                                <p class="text-sm font-medium leading-6 text-orange-800">
                                    Ao confirmar, o sistema passará a utilizar este
                                    período para identificar os seguros próximos do
                                    vencimento.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- AÇÕES DO MODAL --}}
                    <div class="flex flex-col-reverse gap-3 border-t border-gray-200 bg-gray-50 px-6 py-4 sm:flex-row sm:justify-end">

                        <button
                            type="button"
                            @click="modalConfirmacao = false"
                            class="inline-flex items-center justify-center rounded-xl bg-white px-5 py-3 text-sm font-bold text-gray-700 shadow-sm ring-1 ring-gray-300 transition hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2"
                        >
                            Voltar
                        </button>

                        <button
                            type="button"
                            @click="$refs.form.submit()"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-orange-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="h-5 w-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m4.5 12.75 6 6 9-13.5"
                                />
                            </svg>

                            Confirmar alteração

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</x-app-layout>
