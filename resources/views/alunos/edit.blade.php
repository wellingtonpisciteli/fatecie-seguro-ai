<x-app-layout>

    <div class="bg-gray-50 py-8">

        <div class="w-full px-4 sm:px-6 lg:px-8 xl:px-10 2xl:px-12">

            {{-- HEADER --}}
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <div>

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
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0"
                                />
                            </svg>

                        </div>

                        <div>

                            <p class="text-xs font-extrabold uppercase tracking-[0.2em] text-orange-600">
                                Fatecie Seguro AI
                            </p>

                            <h1 class="mt-0.5 text-3xl font-extrabold tracking-tight text-gray-950">
                                Editar aluno
                            </h1>

                        </div>

                    </div>

                    <p class="mt-4 max-w-2xl text-sm font-medium leading-6 text-gray-600">
                        Atualize os dados cadastrais e o período de estágio do aluno.
                    </p>

                </div>

                <a
                    href="{{ route('alunos.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-gray-100 px-5 py-3 text-sm font-bold text-gray-700 transition hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="h-4 w-4"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"
                        />
                    </svg>

                    Voltar
                </a>

            </div>

            {{-- ERROS --}}
            @if ($errors->any())

                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4">

                    <div class="flex items-start gap-3">

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
                                Não foi possível salvar as alterações.
                            </p>

                            <ul class="mt-2 list-disc space-y-1 pl-5 text-sm font-medium text-red-700">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>

                        </div>

                    </div>

                </div>

            @endif

            <div
                x-data="{
                    nucleo: @js((string) $aluno->curso->nucleo_id),

                    cursos: {},

                    modalConfirmacao: false,

                    dadosConfirmacao: {
                        nucleo: '',
                        curso: '',
                        nome: '',
                        ra: '',
                        cpf: '',
                        dataNascimento: '',
                        dataInicial: '',
                        dataFinal: ''
                    },

                    init() {

                        this.cursos = {
                            @foreach ($nucleos as $nucleo)
                                '{{ $nucleo->id }}': [
                                    @foreach ($nucleo->cursos as $curso)
                                        {
                                            id: '{{ $curso->id }}',
                                            nome: @js($curso->nome)
                                        },
                                    @endforeach
                                ],
                            @endforeach
                        };

                    },

                    abrirModalConfirmacao() {

                        const form = this.$refs.form;

                        if (!form.checkValidity()) {
                            form.reportValidity();
                            return;
                        }

                        const nucleoSelect = document.getElementById('nucleo');
                        const cursoSelect = document.getElementById('curso_id');

                        this.dadosConfirmacao = {
                            nucleo: nucleoSelect.selectedOptions[0]?.text || '',
                            curso: cursoSelect.selectedOptions[0]?.text || '',
                            nome: document.getElementById('nome').value,
                            ra: document.getElementById('ra').value,
                            cpf: document.getElementById('cpf').value,
                            dataNascimento: document.getElementById('data_nascimento').value,
                            dataInicial: document.getElementById('data_inicial').value,
                            dataFinal: document.getElementById('data_final').value
                        };

                        this.modalConfirmacao = true;
                    }

                }"
            >

                <form
                    x-ref="form"
                    method="POST"
                    action="{{ route('alunos.update', $aluno) }}"
                >

                    @csrf
                    @method('PUT')

                    {{-- DADOS ACADÊMICOS --}}
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
                                            d="M12 14.25c3.314 0 6-2.015 6-4.5s-2.686-4.5-6-4.5-6 2.015-6 4.5 2.686 4.5 6 4.5Z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M4.5 20.25a7.5 7.5 0 0 1 15 0"
                                        />
                                    </svg>

                                </div>

                                <div>

                                    <h2 class="text-xl font-extrabold text-gray-950">
                                        Dados acadêmicos
                                    </h2>

                                    <p class="mt-1 text-sm font-medium text-gray-600">
                                        Atualize o núcleo e o curso do aluno.
                                    </p>

                                </div>

                            </div>

                        </div>

                        <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">

                            {{-- Núcleo --}}
                            <div>

                                <label
                                    for="nucleo"
                                    class="block text-sm font-extrabold text-gray-800"
                                >
                                    Núcleo
                                </label>

                                <select
                                    id="nucleo"
                                    x-model="nucleo"
                                    class="mt-2 block w-full rounded-xl border-gray-300 px-4 py-3 text-sm font-medium text-gray-900 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                                >

                                    <option value="">
                                        Selecione o núcleo
                                    </option>

                                    @foreach ($nucleos as $nucleo)
                                        <option value="{{ $nucleo->id }}">
                                            {{ $nucleo->nome }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>

                            {{-- Curso --}}
                            <div>

                                <label
                                    for="curso_id"
                                    class="block text-sm font-extrabold text-gray-800"
                                >
                                    Curso
                                </label>

                                <select
                                    id="curso_id"
                                    name="curso_id"
                                    required
                                    class="mt-2 block w-full rounded-xl border-gray-300 px-4 py-3 text-sm font-medium text-gray-900 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                                >

                                    <option value="">
                                        Selecione o curso
                                    </option>

                                    <template
                                        x-for="curso in (cursos[nucleo] || [])"
                                        :key="curso.id"
                                    >

                                        <option
                                            :value="curso.id"
                                            x-text="curso.nome"
                                            :selected="curso.id == '{{ $aluno->curso_id }}'"
                                        ></option>

                                    </template>

                                </select>

                                @error('curso_id')
                                    <p class="mt-2 text-sm font-semibold text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </div>

                    </div>

                    {{-- DADOS PESSOAIS --}}
                    <div class="mt-6 overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">

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
                                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0"
                                        />
                                    </svg>

                                </div>

                                <div>

                                    <h2 class="text-xl font-extrabold text-gray-950">
                                        Dados pessoais
                                    </h2>

                                    <p class="mt-1 text-sm font-medium text-gray-600">
                                        Mantenha os dados cadastrais do aluno atualizados.
                                    </p>

                                </div>

                            </div>

                        </div>

                        <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">

                            {{-- Nome --}}
                            <div class="md:col-span-2">

                                <label
                                    for="nome"
                                    class="block text-sm font-extrabold text-gray-800"
                                >
                                    Nome completo
                                </label>

                                <input
                                    type="text"
                                    id="nome"
                                    name="nome"
                                    value="{{ old('nome', $aluno->nome) }}"
                                    required
                                    class="mt-2 block w-full rounded-xl border-gray-300 px-4 py-3 text-sm font-medium text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-orange-500 focus:ring-orange-500"
                                >

                                @error('nome')
                                    <p class="mt-2 text-sm font-semibold text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                            {{-- RA --}}
                            <div>

                                <label
                                    for="ra"
                                    class="block text-sm font-extrabold text-gray-800"
                                >
                                    RA
                                </label>

                                <input
                                    type="text"
                                    id="ra"
                                    name="ra"
                                    value="{{ old('ra', $aluno->ra) }}"
                                    required
                                    class="mt-2 block w-full rounded-xl border-gray-300 px-4 py-3 text-sm font-medium text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-orange-500 focus:ring-orange-500"
                                >

                                @error('ra')
                                    <p class="mt-2 text-sm font-semibold text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                            {{-- CPF --}}
                            <div>

                                <label
                                    for="cpf"
                                    class="block text-sm font-extrabold text-gray-800"
                                >
                                    CPF
                                </label>

                                <input
                                    type="text"
                                    id="cpf"
                                    name="cpf"
                                    value="{{ old('cpf', $aluno->cpf) }}"
                                    maxlength="14"
                                    placeholder="000.000.000-00"
                                    class="mt-2 block w-full rounded-xl border-gray-300 px-4 py-3 text-sm font-medium text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-orange-500 focus:ring-orange-500"
                                >

                                @error('cpf')
                                    <p class="mt-2 text-sm font-semibold text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                            {{-- Data de nascimento --}}
                            <div>

                                <label
                                    for="data_nascimento"
                                    class="block text-sm font-extrabold text-gray-800"
                                >
                                    Data de nascimento
                                </label>

                                <input
                                    type="date"
                                    id="data_nascimento"
                                    name="data_nascimento"
                                    value="{{ old('data_nascimento', optional($aluno->data_nascimento)->format('Y-m-d')) }}"
                                    class="mt-2 block w-full rounded-xl border-gray-300 px-4 py-3 text-sm font-medium text-gray-900 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                                >

                                @error('data_nascimento')
                                    <p class="mt-2 text-sm font-semibold text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </div>

                    </div>

                    {{-- PERÍODO DO ESTÁGIO --}}
                    <div class="mt-6 overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">

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
                                            d="M6.75 3v2.25M17.25 3v2.25M3 9.75h18M4.5 5.25h15a1.5 1.5 0 0 1 1.5 1.5v12.75a1.5 1.5 0 0 1-1.5 1.5h-15a1.5 1.5 0 0 1-1.5-1.5V6.75a1.5 1.5 0 0 1 1.5-1.5Z"
                                        />
                                    </svg>

                                </div>

                                <div>

                                    <h2 class="text-xl font-extrabold text-gray-950">
                                        Período do estágio
                                    </h2>

                                    <p class="mt-1 text-sm font-medium text-gray-600">
                                        Atualize as datas utilizadas para o controle do seguro.
                                    </p>

                                </div>

                            </div>

                        </div>

                        <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">

                            {{-- Data inicial --}}
                            <div>

                                <label
                                    for="data_inicial"
                                    class="block text-sm font-extrabold text-gray-800"
                                >
                                    Data inicial do estágio
                                </label>

                                <input
                                    type="date"
                                    id="data_inicial"
                                    name="data_inicial"
                                    value="{{ old('data_inicial', optional($aluno->data_inicial)->format('Y-m-d')) }}"
                                    required
                                    class="mt-2 block w-full rounded-xl border-gray-300 px-4 py-3 text-sm font-medium text-gray-900 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                                >

                                @error('data_inicial')
                                    <p class="mt-2 text-sm font-semibold text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                            {{-- Data final --}}
                            <div>

                                <label
                                    for="data_final"
                                    class="block text-sm font-extrabold text-gray-800"
                                >
                                    Data final do estágio
                                </label>

                                <input
                                    type="date"
                                    id="data_final"
                                    name="data_final"
                                    value="{{ old('data_final', optional($aluno->data_final)->format('Y-m-d')) }}"
                                    required
                                    class="mt-2 block w-full rounded-xl border-gray-300 px-4 py-3 text-sm font-medium text-gray-900 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                                >

                                @error('data_final')
                                    <p class="mt-2 text-sm font-semibold text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </div>

                    </div>

                    {{-- AVISO --}}
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
                                    Alterações no período do estágio podem afetar o controle
                                    do seguro vinculado ao aluno.
                                </p>

                            </div>

                        </div>

                    </div>

                    {{-- BOTÕES --}}
                    <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                        <a
                            href="{{ route('alunos.index') }}"
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
                                class="h-4 w-4"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M16.862 4.487 18.55 6.175M4.5 19.5l3.75-.75L18.55 8.45a1.194 1.194 0 0 0 0-1.688l-1.312-1.312a1.194 1.194 0 0 0-1.688 0L5.25 15.75l-.75 3.75Z"
                                />
                            </svg>

                            Salvar alterações

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

                    {{-- Overlay --}}
                    <div
                        x-show="modalConfirmacao"
                        x-transition.opacity
                        @click="modalConfirmacao = false"
                        class="absolute inset-0 bg-gray-950/50"
                    ></div>

                    {{-- Modal --}}
                    <div
                        x-show="modalConfirmacao"
                        x-transition
                        @click.stop
                        class="relative max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-2xl bg-white shadow-2xl"
                    >

                        {{-- Cabeçalho --}}
                        <div class="border-b border-gray-200 px-6 py-5">

                            <div class="flex items-center gap-3">

                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-100 text-orange-600">

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

                                    <h2
                                        id="modal-confirmacao-titulo"
                                        class="text-xl font-extrabold text-gray-950"
                                    >
                                        Confirmar alterações
                                    </h2>

                                    <p class="mt-1 text-sm font-medium text-gray-600">
                                        Confira os dados antes de salvar as alterações.
                                    </p>

                                </div>

                            </div>

                        </div>

                        {{-- Dados --}}
                        <div class="grid grid-cols-1 gap-4 p-6 sm:grid-cols-2">

                            <div class="rounded-xl bg-gray-50 px-4 py-3">

                                <p class="text-xs font-extrabold uppercase tracking-wide text-gray-500">
                                    Aluno
                                </p>

                                <p
                                    class="mt-1 text-sm font-extrabold text-gray-950"
                                    x-text="dadosConfirmacao.nome || 'Não informado'"
                                ></p>

                            </div>

                            <div class="rounded-xl bg-gray-50 px-4 py-3">

                                <p class="text-xs font-extrabold uppercase tracking-wide text-gray-500">
                                    RA
                                </p>

                                <p
                                    class="mt-1 text-sm font-extrabold text-gray-950"
                                    x-text="dadosConfirmacao.ra || 'Não informado'"
                                ></p>

                            </div>

                            <div class="rounded-xl bg-gray-50 px-4 py-3">

                                <p class="text-xs font-extrabold uppercase tracking-wide text-gray-500">
                                    Núcleo
                                </p>

                                <p
                                    class="mt-1 text-sm font-extrabold text-gray-950"
                                    x-text="dadosConfirmacao.nucleo || 'Não informado'"
                                ></p>

                            </div>

                            <div class="rounded-xl bg-gray-50 px-4 py-3">

                                <p class="text-xs font-extrabold uppercase tracking-wide text-gray-500">
                                    Curso
                                </p>

                                <p
                                    class="mt-1 text-sm font-extrabold text-gray-950"
                                    x-text="dadosConfirmacao.curso || 'Não informado'"
                                ></p>

                            </div>

                            <div class="rounded-xl bg-gray-50 px-4 py-3">

                                <p class="text-xs font-extrabold uppercase tracking-wide text-gray-500">
                                    CPF
                                </p>

                                <p
                                    class="mt-1 text-sm font-extrabold text-gray-950"
                                    x-text="dadosConfirmacao.cpf || 'Não informado'"
                                ></p>

                            </div>

                            <div class="rounded-xl bg-gray-50 px-4 py-3">

                                <p class="text-xs font-extrabold uppercase tracking-wide text-gray-500">
                                    Data de nascimento
                                </p>

                                <p
                                    class="mt-1 text-sm font-extrabold text-gray-950"
                                    x-text="dadosConfirmacao.dataNascimento || 'Não informado'"
                                ></p>

                            </div>

                            <div class="rounded-xl border border-orange-100 bg-orange-50 px-4 py-3">

                                <p class="text-xs font-extrabold uppercase tracking-wide text-orange-700">
                                    Início do estágio
                                </p>

                                <p
                                    class="mt-1 text-sm font-extrabold text-orange-900"
                                    x-text="dadosConfirmacao.dataInicial || 'Não informado'"
                                ></p>

                            </div>

                            <div class="rounded-xl border border-orange-100 bg-orange-50 px-4 py-3">

                                <p class="text-xs font-extrabold uppercase tracking-wide text-orange-700">
                                    Final do estágio
                                </p>

                                <p
                                    class="mt-1 text-sm font-extrabold text-orange-900"
                                    x-text="dadosConfirmacao.dataFinal || 'Não informado'"
                                ></p>

                            </div>

                        </div>

                        {{-- Rodapé --}}
                        <div class="flex flex-col-reverse gap-3 border-t border-gray-200 bg-gray-50 px-6 py-5 sm:flex-row sm:justify-end">

                            <button
                                type="button"
                                @click="modalConfirmacao = false"
                                class="inline-flex items-center justify-center rounded-xl bg-white px-5 py-3 text-sm font-bold text-gray-700 shadow-sm ring-1 ring-gray-300 transition hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2"
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
                                    class="h-4 w-4"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m4.5 12.75 6 6 9-13.5"
                                    />
                                </svg>

                                Confirmar alterações

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>