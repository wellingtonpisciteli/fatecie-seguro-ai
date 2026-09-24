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
                                d="M4.5 19.5h15m-12.75-3h10.5m-8.25-3h6m-8.25-3h10.5M6.75 6h10.5A2.25 2.25 0 0 1 19.5 8.25v9A2.25 2.25 0 0 1 17.25 19.5H6.75A2.25 2.25 0 0 1 4.5 17.25v-9A2.25 2.25 0 0 1 6.75 6Z"
                            />
                        </svg>

                    </div>

                    <div>

                        <p class="text-xs font-extrabold uppercase tracking-[0.2em] text-orange-600">
                            Fatecie Seguro AI
                        </p>

                        <h1 class="mt-0.5 text-3xl font-extrabold tracking-tight text-gray-950">
                            Novo curso
                        </h1>

                    </div>

                </div>

                <p class="mt-4 max-w-2xl text-sm font-medium leading-6 text-gray-600">
                    Cadastre um curso, vincule-o a um núcleo e defina sua modalidade de ensino.
                </p>

            </div>


            {{-- ERROS --}}

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
                            Verifique os dados informados.
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


            {{-- ALPINE --}}

            <div
                x-data="{
                    modalConfirmacao: false,

                    dadosConfirmacao: {
                        nucleo: '',
                        nome: '',
                        modalidade: ''
                    },

                    abrirModalConfirmacao() {

                        const form = this.$refs.form;

                        if (!form.checkValidity()) {
                            form.reportValidity();
                            return;
                        }

                        this.dadosConfirmacao = {

                            nucleo: document.getElementById('nucleo_id')
                                .selectedOptions[0]?.text || '',

                            nome: document.getElementById('nome').value,

                            modalidade: @js(
                                auth()->user()->modalidade === 'ead'
                                    ? 'EAD'
                                    : 'Presencial'
                            )
                        };

                        this.modalConfirmacao = true;
                    }
                }"
            >

                <form
                    x-ref="form"
                    method="POST"
                    action="{{ route('cursos.store') }}"
                >

                    @csrf


                    {{-- DADOS DO CURSO --}}

                    <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">

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
                                            d="M4.5 19.5h15m-12.75-3h10.5m-8.25-3h6m-8.25-3h10.5M6.75 6h10.5A2.25 2.25 0 0 1 19.5 8.25v9A2.25 2.25 0 0 1 17.25 19.5H6.75A2.25 2.25 0 0 1 4.5 17.25v-9A2.25 2.25 0 0 1 6.75 6Z"
                                        />
                                    </svg>

                                </div>

                                <div>

                                    <h2 class="text-xl font-extrabold text-gray-950">
                                        Dados do curso
                                    </h2>

                                    <p class="mt-1 text-sm font-medium text-gray-600">
                                        Informe os dados acadêmicos do novo curso.
                                    </p>

                                </div>

                            </div>

                        </div>


                        <div class="p-6">

                            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">


                                {{-- NÚCLEO --}}

                                <div>

                                    <label
                                        for="nucleo_id"
                                        class="block text-sm font-extrabold text-gray-800"
                                    >
                                        Núcleo
                                    </label>

                                    <select
                                        id="nucleo_id"
                                        name="nucleo_id"
                                        required
                                        class="mt-2 block w-full rounded-xl border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-900 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                                    >

                                        <option value="">
                                            Selecione um núcleo
                                        </option>

                                        @foreach ($nucleos as $nucleo)

                                            <option
                                                value="{{ $nucleo->id }}"
                                                @selected(old('nucleo_id') == $nucleo->id)
                                            >
                                                {{ $nucleo->nome }}
                                            </option>

                                        @endforeach

                                    </select>

                                    @error('nucleo_id')

                                        <p class="mt-2 text-sm font-semibold text-red-600">
                                            {{ $message }}
                                        </p>

                                    @enderror

                                </div>


                                {{-- MODALIDADE DO USUÁRIO --}}

                                <div>

                                    <label
                                        class="block text-sm font-extrabold text-gray-800"
                                    >
                                        Modalidade
                                    </label>

                                    <div class="mt-2 flex items-center gap-3 rounded-xl border border-orange-200 bg-orange-50 px-4 py-3">

                                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-orange-100 text-orange-600">

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
                                                    d="M12 6.75v10.5m-6.75-7.5h13.5M5.25 18h13.5A2.25 2.25 0 0 0 21 15.75V8.25A2.25 2.25 0 0 0 18.75 6H5.25A2.25 2.25 0 0 0 3 8.25v7.5A2.25 2.25 0 0 0 5.25 18Z"
                                                />
                                            </svg>

                                        </div>

                                        <div>

                                            <p class="text-xs font-extrabold uppercase tracking-wide text-orange-700">
                                                Modalidade do usuário
                                            </p>

                                            <p class="mt-0.5 text-sm font-extrabold text-gray-950">
                                                {{ auth()->user()->modalidade === 'ead' ? 'EAD' : 'Presencial' }}
                                            </p>

                                        </div>

                                    </div>

                                    <p class="mt-2 text-xs font-medium text-gray-500">
                                        A modalidade é definida automaticamente de acordo com o usuário logado.
                                    </p>

                                </div>


                                {{-- NOME DO CURSO --}}

                                <div class="lg:col-span-2">

                                    <label
                                        for="nome"
                                        class="block text-sm font-extrabold text-gray-800"
                                    >
                                        Nome do curso
                                    </label>

                                    <input
                                        id="nome"
                                        name="nome"
                                        type="text"
                                        value="{{ old('nome') }}"
                                        required
                                        autofocus
                                        placeholder="Ex.: Engenharia de Software"
                                        class="mt-2 block w-full rounded-xl border-gray-300 px-4 py-3 text-sm font-medium text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-orange-500 focus:ring-orange-500"
                                    >

                                    @error('nome')

                                        <p class="mt-2 text-sm font-semibold text-red-600">
                                            {{ $message }}
                                        </p>

                                    @enderror

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- INFORMAÇÃO --}}

                    <div class="mt-6 rounded-2xl border border-orange-200 bg-orange-50 px-5 py-4">

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
                                        d="M12 9v3.75m0 3h.008v.008H12v-.008ZM10.343 3.94l-7.06 12.25A1.875 1.875 0 0 0 4.908 19h14.184a1.875 1.875 0 0 0 1.625-2.81l-7.06-12.25a1.875 1.875 0 0 0-3.314 0Z"
                                    />
                                </svg>

                            </div>

                            <div>

                                <p class="text-sm font-extrabold text-orange-800">
                                    Atenção
                                </p>

                                <p class="mt-1 text-sm font-medium leading-6 text-orange-700">
                                    O curso será cadastrado automaticamente na modalidade
                                    <strong>
                                        {{ auth()->user()->modalidade === 'ead' ? 'EAD' : 'Presencial' }}
                                    </strong>
                                    do usuário logado.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- AÇÕES --}}

                    <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                        <a
                            href="{{ route('cursos.index') }}"
                            class="inline-flex items-center justify-center rounded-xl bg-gray-100 px-5 py-3 text-sm font-bold text-gray-700 transition hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2"
                        >
                            Cancelar
                        </a>

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
                                    d="M12 4.5v15m7.5-7.5h-15"
                                />
                            </svg>

                            Cadastrar curso

                        </button>

                    </div>

                </form>


                {{-- MODAL DE CONFIRMAÇÃO --}}

                <div
                    x-show="modalConfirmacao"
                    x-cloak
                    class="fixed inset-0 z-50 flex items-center justify-center px-4"
                    role="dialog"
                    aria-modal="true"
                    aria-labelledby="modal-confirmacao-titulo"
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
                                            d="M12 9v3.75m0 3h.008v.008H12v-.008ZM10.343 3.94l-7.06 12.25A1.875 1.875 0 0 0 4.908 19h14.184a1.875 1.875 0 0 0 1.625-2.81l-7.06-12.25a1.875 1.875 0 0 0-3.314 0Z"
                                        />
                                    </svg>

                                </div>

                                <div>

                                    <h2
                                        id="modal-confirmacao-titulo"
                                        class="text-lg font-extrabold text-gray-950"
                                    >
                                        Confirmar cadastro
                                    </h2>

                                    <p class="mt-1 text-sm font-medium text-gray-600">
                                        Confira os dados antes de cadastrar o curso.
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- RESUMO --}}

                        <div class="px-6 py-6">

                            <div class="divide-y divide-gray-100 rounded-xl border border-gray-200">


                                {{-- CURSO --}}

                                <div class="px-4 py-3">

                                    <p class="text-xs font-extrabold uppercase tracking-wide text-gray-500">
                                        Curso
                                    </p>

                                    <p
                                        class="mt-1 text-sm font-bold text-gray-950"
                                        x-text="dadosConfirmacao.nome || 'Não informado'"
                                    ></p>

                                </div>


                                {{-- NÚCLEO --}}

                                <div class="px-4 py-3">

                                    <p class="text-xs font-extrabold uppercase tracking-wide text-gray-500">
                                        Núcleo
                                    </p>

                                    <p
                                        class="mt-1 text-sm font-bold text-gray-950"
                                        x-text="dadosConfirmacao.nucleo || 'Não informado'"
                                    ></p>

                                </div>


                                {{-- MODALIDADE --}}

                                <div class="px-4 py-3">

                                    <p class="text-xs font-extrabold uppercase tracking-wide text-gray-500">
                                        Modalidade
                                    </p>

                                    <p
                                        class="mt-1 text-sm font-bold text-gray-950"
                                        x-text="dadosConfirmacao.modalidade || 'Não informado'"
                                    ></p>

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
                                                d="M12 9v3.75m0 3h.008v.008H12v-.008ZM10.343 3.94l-7.06 12.25A1.875 1.875 0 0 0 4.908 19h14.184a1.875 1.875 0 0 0 1.625-2.81l-7.06-12.25a1.875 1.875 0 0 0-3.314 0Z"
                                            />
                                        </svg>

                                    </div>

                                    <p class="text-sm font-medium leading-6 text-orange-800">
                                        Confirme os dados para cadastrar o curso no sistema.
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

                                Confirmar cadastro

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>

