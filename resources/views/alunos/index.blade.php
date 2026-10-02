<x-app-layout>

    <div class="bg-gray-50 py-8">

        <div class="w-full px-4 sm:px-6 lg:px-8 xl:px-10 2xl:px-12">

            {{-- =====================================================
                CABEÇALHO
            ====================================================== --}}

            <div class="mb-8 flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

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
                                    d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.125-.934M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.003a12.002 12.002 0 0 1-6.75 0M15 19.128a12.002 12.002 0 0 0-6.75 0m0 0v-.003c0-1.113.285-2.16.786-3.07M8.25 19.128a9.38 9.38 0 0 1-2.625.372 9.337 9.337 0 0 1-4.125-.934M8.25 19.128v.003a12.002 12.002 0 0 0 6.75 0M8.25 19.128a12.002 12.002 0 0 1-6.75 0m0 0v-.003c0-1.113.285-2.16.786-3.07M5.625 5.25a3.375 3.375 0 1 1 6.75 0 3.375 3.375 0 0 1-6.75 0Zm12.75 3.375a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"
                                />
                            </svg>

                        </div>

                        <div>

                            <p class="text-xs font-extrabold uppercase tracking-[0.2em] text-orange-600">
                                Fatecie Seguro AI
                            </p>

                            <h1 class="mt-0.5 text-3xl font-extrabold tracking-tight text-gray-950">
                                Alunos
                            </h1>

                        </div>

                    </div>

                    <p class="mt-4 max-w-2xl text-sm font-medium leading-6 text-gray-600">
                        Gerencie os alunos em estágio e acompanhe a situação de cada período.
                    </p>

                </div>

                {{-- NOVO ALUNO --}}

                <a
                    href="{{ route('alunos.create') }}"
                    class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl bg-orange-600 px-5 py-3.5 text-sm font-bold text-white shadow-sm transition duration-200 hover:bg-orange-700 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2"
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

                    Novo aluno

                </a>

            </div>


            {{-- =====================================================
                MENSAGEM DE SUCESSO
            ====================================================== --}}

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
                                d="m4.5 12.75 6 6 9-13.5"
                            />
                        </svg>

                    </div>

                    <p class="text-sm font-semibold text-green-800">
                        {{ session('success') }}
                    </p>

                </div>

            @endif


            {{-- =====================================================
                CURSOS E NÚCLEOS
            ====================================================== --}}

            @php

                $cursosFiltro = $alunos
                    ->pluck('curso')
                    ->filter()
                    ->unique('id')
                    ->sortBy('nome');

                $nucleosFiltro = $alunos
                    ->pluck('curso.nucleo')
                    ->filter()
                    ->unique('id')
                    ->sortBy('nome');

            @endphp


            {{-- =====================================================
                PESQUISA + FILTROS + TABELA
            ====================================================== --}}

            <div
                x-data="{

                    busca: '',
                    curso: '',
                    nucleo: '',
                    status: '',

                    alunos: @js(

                        $alunos->map(function ($aluno) {

                            return [

                                'id' => $aluno->id,

                                'nome' => strtolower(
                                    $aluno->nome ?? ''
                                ),

                                'ra' => strtolower(
                                    $aluno->ra ?? ''
                                ),

                                'curso' => (string) (
                                    $aluno->curso->id ?? ''
                                ),

                                'nucleo' => (string) (
                                    $aluno->curso->nucleo->id ?? ''
                                ),

                                'status' => $aluno->status,

                            ];

                        })->values()

                    ),

                    cursosDisponiveis: @js(

                        $cursosFiltro->map(function ($curso) {

                            return [

                                'id' => (string) $curso->id,

                                'nome' => $curso->nome,

                                'nucleo' => (string) (
                                    $curso->nucleo_id ?? ''
                                ),

                            ];

                        })->values()

                    ),

                    limparFiltros() {

                        this.busca = '';
                        this.curso = '';
                        this.nucleo = '';
                        this.status = '';

                    },

                    cursosFiltrados() {

                        return this.cursosDisponiveis.filter(

                            curso => {

                                return (
                                    this.nucleo === '' ||
                                    curso.nucleo === this.nucleo
                                );

                            }

                        );

                    },

                    alterarNucleo() {

                        if (

                            this.curso !== '' &&

                            !this.cursosFiltrados().some(
                                curso => curso.id === this.curso
                            )

                        ) {

                            this.curso = '';

                        }

                    },

                    alunoPassaFiltro(aluno) {

                        const busca = this.busca
                            .toLowerCase()
                            .trim();

                        const passaBusca =
                            busca === '' ||
                            aluno.nome.includes(busca) ||
                            aluno.ra.includes(busca);

                        const passaCurso =
                            this.curso === '' ||
                            aluno.curso === this.curso;

                        const passaNucleo =
                            this.nucleo === '' ||
                            aluno.nucleo === this.nucleo;

                        const passaStatus =
                            this.status === '' ||
                            aluno.status === this.status;

                        return (
                            passaBusca &&
                            passaCurso &&
                            passaNucleo &&
                            passaStatus
                        );

                    },

                    alunosFiltrados() {

                        return this.alunos.filter(
                            aluno => this.alunoPassaFiltro(aluno)
                        );

                    },

                    totalFiltrado() {

                        return this.alunosFiltrados().length;

                    },

                    quantidadePorStatus(status) {

                        return this.alunosFiltrados()
                            .filter(
                                aluno => aluno.status === status
                            )
                            .length;

                    }

                }"
            >

                {{-- =================================================
                    INDICADORES
                ================================================== --}}

                <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">

                    {{-- TOTAL --}}

                    <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-200">

                        <p class="text-sm font-bold text-gray-700">
                            Total de alunos
                        </p>

                        <p
                            class="mt-2 text-4xl font-extrabold text-gray-950"
                            x-text="totalFiltrado()"
                        >
                            {{ $totalAlunos }}
                        </p>

                        <p class="mt-1 text-xs font-semibold text-gray-500">
                            Alunos encontrados
                        </p>

                    </div>


                    {{-- VIGENTES --}}

                    <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-200">

                        <p class="text-sm font-bold text-gray-700">
                            Alunos vigentes
                        </p>

                        <p
                            class="mt-2 text-4xl font-extrabold text-green-600"
                            x-text="quantidadePorStatus('vigente')"
                        >
                            {{ $alunosVigentes }}
                        </p>

                        <p class="mt-1 text-xs font-semibold text-gray-500">
                            Em período de estágio
                        </p>

                    </div>


                    {{-- ENCERRADOS --}}

                    <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-200">

                        <p class="text-sm font-bold text-gray-700">
                            Alunos encerrados
                        </p>

                        <p
                            class="mt-2 text-4xl font-extrabold text-red-600"
                            x-text="quantidadePorStatus('encerrado')"
                        >
                            {{ $alunosEncerrados }}
                        </p>

                        <p class="mt-1 text-xs font-semibold text-gray-500">
                            Estágio encerrado
                        </p>

                    </div>

                </div>


                {{-- =================================================
                    PESQUISA E FILTROS
                ================================================== --}}

                <div class="mb-6 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">

                    <div class="mb-5">

                        <div class="flex items-center gap-2">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="h-5 w-5 text-orange-600"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m21 21-4.35-4.35m0 0A7.5 7.5 0 1 0 6.045 6.045a7.5 7.5 0 0 0 10.605 10.605Z"
                                />
                            </svg>

                            <h2 class="text-base font-extrabold text-gray-950">
                                Pesquisar e filtrar alunos
                            </h2>

                        </div>

                        <p class="mt-1.5 text-sm font-medium text-gray-600">
                            Pesquise por nome ou RA e filtre os alunos por curso, núcleo e status.
                        </p>

                    </div>


                    {{-- CAMPOS --}}

                    <div class="grid gap-4 md:grid-cols-[1fr_200px_200px_220px_auto]">


                        {{-- PESQUISA --}}

                        <div class="relative">

                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor"
                                    class="h-5 w-5 text-gray-400"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m21 21-4.35-4.35m0 0A7.5 7.5 0 1 0 6.045 6.045a7.5 7.5 0 0 0 10.605 10.605Z"
                                    />
                                </svg>

                            </div>

                            <label
                                for="busca"
                                class="sr-only"
                            >
                                Nome ou RA
                            </label>

                            <input
                                type="text"
                                id="busca"
                                x-model="busca"
                                autocomplete="off"
                                placeholder="Digite o nome ou RA do aluno..."
                                class="w-full rounded-xl border-gray-300 py-3 pl-11 pr-11 text-sm font-medium text-gray-900 placeholder:text-gray-400 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                            >


                            {{-- LIMPAR PESQUISA --}}

                            <button
                                type="button"
                                x-show="busca !== ''"
                                x-cloak
                                @click="busca = ''"
                                class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400 transition hover:text-gray-700"
                                title="Limpar pesquisa"
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
                                        d="M6 18 18 6M6 6l12 12"
                                    />
                                </svg>

                            </button>

                        </div>


                        {{-- FILTRO DE NÚCLEO --}}

                        <div>

                            <label
                                for="nucleo"
                                class="sr-only"
                            >
                                Núcleo
                            </label>

                            <select
                                id="nucleo"
                                x-model="nucleo"
                                @change="alterarNucleo()"
                                class="w-full rounded-xl border-gray-300 px-4 py-3 text-sm font-semibold text-gray-900 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                            >

                                <option value="">
                                    Todos os núcleos
                                </option>

                                @foreach ($nucleosFiltro as $nucleoFiltro)

                                    <option value="{{ $nucleoFiltro->id }}">
                                        {{ $nucleoFiltro->nome }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- FILTRO DE CURSO --}}

                        <div>

                            <label
                                for="curso"
                                class="sr-only"
                            >
                                Curso
                            </label>

                            <select
                                id="curso"
                                x-model="curso"
                                class="w-full rounded-xl border-gray-300 px-4 py-3 text-sm font-semibold text-gray-900 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                            >

                                <option value="">
                                    Todos os cursos
                                </option>

                                <template
                                    x-for="cursoFiltro in cursosFiltrados()"
                                    :key="cursoFiltro.id"
                                >

                                    <option
                                        :value="cursoFiltro.id"
                                        x-text="cursoFiltro.nome"
                                    ></option>

                                </template>

                            </select>

                        </div>


                        {{-- FILTRO DE STATUS --}}

                        <div>

                            <label
                                for="status"
                                class="sr-only"
                            >
                                Status
                            </label>

                            <select
                                id="status"
                                x-model="status"
                                class="w-full rounded-xl border-gray-300 px-4 py-3 text-sm font-semibold text-gray-900 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                            >

                                <option value="">
                                    Todos os status
                                </option>

                                <option value="vigente">
                                    Vigente
                                </option>

                                <option value="aguardando">
                                    Aguardando
                                </option>

                                <option value="encerrado">
                                    Encerrado
                                </option>

                            </select>

                        </div>


                        {{-- LIMPAR FILTROS --}}

                        <button
                            type="button"
                            x-show="
                                busca !== '' ||
                                curso !== '' ||
                                nucleo !== '' ||
                                status !== ''
                            "
                            x-cloak
                            @click="limparFiltros()"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-gray-100 px-5 py-3 text-sm font-bold text-gray-700 transition hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2"
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
                                    d="M6 18 18 6M6 6l12 12"
                                />
                            </svg>

                            Limpar

                        </button>

                    </div>

                </div>


                {{-- =================================================
                    TABELA
                ================================================== --}}

                <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">

                    <div class="border-b border-gray-200 px-6 py-5">

                        <h2 class="text-xl font-extrabold text-gray-950">
                            Lista de alunos
                        </h2>

                        <p class="mt-1 text-sm font-medium text-gray-600">
                            Acompanhe os alunos e seus respectivos períodos de estágio.
                        </p>

                    </div>


                    <div class="overflow-x-auto">

                        <table class="min-w-full divide-y divide-gray-200">

                            <thead class="bg-gray-50">

                                <tr>

                                    <th class="px-6 py-4 text-left text-xs font-extrabold uppercase tracking-wider text-gray-600">
                                        Aluno
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-extrabold uppercase tracking-wider text-gray-600">
                                        RA
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-extrabold uppercase tracking-wider text-gray-600">
                                        Curso
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-extrabold uppercase tracking-wider text-gray-600">
                                        Núcleo
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-extrabold uppercase tracking-wider text-gray-600">
                                        Início
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-extrabold uppercase tracking-wider text-gray-600">
                                        Fim
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-extrabold uppercase tracking-wider text-gray-600">
                                        Status
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-extrabold uppercase tracking-wider text-gray-600">
                                        Ações
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-gray-200">

                                @forelse ($alunos as $aluno)

                                    @php

                                        $statusClasses = [

                                            'vigente' =>
                                                'bg-green-100 text-green-800',

                                            'aguardando' =>
                                                'bg-yellow-100 text-yellow-800',

                                            'encerrado' =>
                                                'bg-red-100 text-red-800',

                                        ];

                                        $statusLabels = [

                                            'vigente' =>
                                                'Vigente',

                                            'aguardando' =>
                                                'Aguardando',

                                            'encerrado' =>
                                                'Encerrado',

                                        ];

                                    @endphp


                                    <tr
                                        data-aluno
                                        x-show="
                                            alunoPassaFiltro(
                                                alunos.find(
                                                    aluno =>
                                                        aluno.id === {{ $aluno->id }}
                                                )
                                            )
                                        "
                                        x-cloak
                                        class="transition hover:bg-gray-50
                                            @if ($aluno->status === 'encerrado')
                                                bg-red-50
                                            @elseif ($aluno->status === 'aguardando')
                                                bg-yellow-50
                                            @endif
                                        "
                                    >


                                        {{-- ALUNO --}}

                                        <td class="whitespace-nowrap px-6 py-4">

                                            <div class="flex items-center gap-3">

                                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-orange-100 text-sm font-extrabold text-orange-700">

                                                    {{ strtoupper(substr($aluno->nome, 0, 1)) }}

                                                </div>

                                                <div>

                                                    <div class="text-sm font-bold text-gray-900">
                                                        {{ $aluno->nome }}
                                                    </div>

                                                </div>

                                            </div>

                                        </td>


                                        {{-- RA --}}

                                        <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-gray-700">

                                            {{ $aluno->ra }}

                                        </td>


                                        {{-- CURSO --}}

                                        <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-gray-700">

                                            {{ $aluno->curso->nome }}

                                        </td>


                                        {{-- NÚCLEO --}}

                                        <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-gray-700">

                                            {{ $aluno->curso->nucleo->nome }}

                                        </td>


                                        {{-- INÍCIO --}}

                                        <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-gray-700">

                                            {{ $aluno->data_inicial?->format('d/m/Y') }}

                                        </td>


                                        {{-- FIM --}}

                                        <td class="whitespace-nowrap px-6 py-4">

                                            <div class="text-sm font-semibold text-gray-700">

                                                {{ $aluno->data_final?->format('d/m/Y') }}

                                            </div>

                                            @if (
                                                $aluno->status === 'aguardando'
                                                && $aluno->data_inicial
                                            )

                                                @php

                                                    $dias = now()
                                                        ->startOfDay()
                                                        ->diffInDays(
                                                            $aluno->data_inicial,
                                                            false
                                                        );

                                                @endphp

                                                <div class="mt-1 text-xs font-extrabold text-yellow-600">

                                                    Inicia em
                                                    {{ $dias }}
                                                    {{ $dias === 1 ? 'dia' : 'dias' }}

                                                </div>

                                            @elseif (
                                                $aluno->status === 'vigente'
                                                && $aluno->data_final
                                            )

                                                @php

                                                    $dias = now()
                                                        ->startOfDay()
                                                        ->diffInDays(
                                                            $aluno->data_final,
                                                            false
                                                        );

                                                @endphp

                                                <div class="mt-1 text-xs font-extrabold text-green-600">

                                                    {{ $dias }}
                                                    {{ $dias === 1 ? 'dia' : 'dias' }}
                                                    restantes

                                                </div>

                                            @elseif (
                                                $aluno->status === 'encerrado'
                                                && $aluno->data_final
                                            )

                                                @php

                                                    $dias = now()
                                                        ->startOfDay()
                                                        ->diffInDays(
                                                            $aluno->data_final,
                                                            false
                                                        );

                                                @endphp

                                                <div class="mt-1 text-xs font-extrabold text-red-600">

                                                    {{ abs($dias) }}
                                                    {{ abs($dias) === 1 ? 'dia' : 'dias' }}
                                                    encerrado

                                                </div>

                                            @endif

                                        </td>


                                        {{-- STATUS --}}

                                        <td class="whitespace-nowrap px-6 py-4">

                                            <span
                                                class="inline-flex rounded-full px-3 py-1 text-xs font-extrabold {{ $statusClasses[$aluno->status] ?? 'bg-gray-100 text-gray-800' }}"
                                            >

                                                {{ $statusLabels[$aluno->status] ?? $aluno->status }}

                                            </span>

                                        </td>


                                        {{-- AÇÕES --}}

                                        <td class="whitespace-nowrap px-6 py-4">

                                            <a
                                                href="{{ route('alunos.edit', $aluno) }}"
                                                class="inline-flex items-center gap-2 rounded-lg bg-gray-100 px-3.5 py-2 text-xs font-bold text-gray-700 transition hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2"
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
                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 15.97a4.5 4.5 0 0 1-1.897 1.13L6 18l.9-2.685a4.5 4.5 0 0 1 1.13-1.897l8.832-8.931Z"
                                                    />
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M19.5 7.125 16.875 4.5"
                                                    />
                                                </svg>

                                                Editar

                                            </a>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td
                                            colspan="8"
                                            class="px-6 py-16 text-center"
                                        >

                                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 text-gray-500">

                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.8"
                                                    stroke="currentColor"
                                                    class="h-6 w-6"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.125-.934M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.003a12.002 12.002 0 0 1-6.75 0M15 19.128a12.002 12.002 0 0 0-6.75 0m0 0v-.003c0-1.113.285-2.16.786-3.07M8.25 19.128a9.38 9.38 0 0 1-2.625.372 9.337 9.337 0 0 1-4.125-.934M8.25 19.128v.003a12.002 12.002 0 0 0 6.75 0M8.25 19.128a12.002 12.002 0 0 1-6.75 0m0 0v-.003c0-1.113.285-2.16.786-3.07M5.625 5.25a3.375 3.375 0 1 1 6.75 0Zm12.75 3.375a2.625 2.625 0 1 1-5.25 0Z"
                                                    />
                                                </svg>

                                            </div>

                                            <p class="mt-4 text-sm font-semibold text-gray-700">
                                                Nenhum aluno cadastrado.
                                            </p>

                                            <a
                                                href="{{ route('alunos.create') }}"
                                                class="mt-3 inline-flex text-sm font-extrabold text-orange-600 transition hover:text-orange-700"
                                            >
                                                Cadastrar primeiro aluno
                                            </a>

                                        </td>

                                    </tr>

                                @endforelse


                                {{-- NENHUM RESULTADO NOS FILTROS --}}

                                @if ($alunos->count() > 0)

                                    <tr
                                        x-show="totalFiltrado() === 0"
                                        x-cloak
                                    >

                                        <td
                                            colspan="8"
                                            class="px-6 py-16 text-center"
                                        >

                                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 text-gray-500">

                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.8"
                                                    stroke="currentColor"
                                                    class="h-6 w-6"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="m21 21-4.35-4.35m0 0A7.5 7.5 0 1 0 6.045 6.045a7.5 7.5 0 0 0 10.605 10.605Z"
                                                    />
                                                </svg>

                                            </div>

                                            <p class="mt-4 text-sm font-semibold text-gray-700">
                                                Nenhum aluno encontrado com os filtros selecionados.
                                            </p>

                                            <button
                                                type="button"
                                                @click="limparFiltros()"
                                                class="mt-3 text-sm font-extrabold text-orange-600 transition hover:text-orange-700"
                                            >
                                                Limpar filtros
                                            </button>

                                        </td>

                                    </tr>

                                @endif

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>