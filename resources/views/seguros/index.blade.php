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
                                    d="M9 12.75 11.25 15 15 9.75M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9Z"
                                />
                            </svg>

                        </div>

                        <div>

                            <p class="text-xs font-extrabold uppercase tracking-[0.2em] text-orange-600">
                                Fatecie Seguro AI
                            </p>

                            <h1 class="mt-0.5 text-3xl font-extrabold tracking-tight text-gray-950">
                                Seguros
                            </h1>

                        </div>

                    </div>

                    <p class="mt-4 max-w-2xl text-sm font-medium leading-6 text-gray-600">
                        Controle os seguros dos alunos e acompanhe cada etapa do estágio.
                    </p>

                </div>


                {{-- ACESSAR SEGURADORA --}}

                <a
                    href="https://centauroseguradora.com.br/"
                    target="_blank"
                    rel="noopener noreferrer"
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
                            d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V15m-3-12h6m0 0v6m0-6L10.5 12.75"
                        />
                    </svg>

                    Acessar seguradora

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
                MENSAGEM DE ERRO
            ====================================================== --}}

            @if (session('error'))

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
                                d="M12 9v3.75m0 3.75h.007v.008H12v-.008ZM10.29 3.86 1.82 18a2.25 2.25 0 0 0 1.93 3.375h16.5A2.25 2.25 0 0 0 22.18 18L13.71 3.86a2.25 2.25 0 0 0-3.42 0Z"
                            />
                        </svg>

                    </div>

                    <p class="text-sm font-semibold text-red-800">
                        {{ session('error') }}
                    </p>

                </div>

            @endif


            {{-- =====================================================
                CURSOS E NÚCLEOS DISPONÍVEIS PARA OS FILTROS
            ====================================================== --}}

            @php

                $cursosFiltro = $seguros
                    ->pluck('aluno.curso')
                    ->filter()
                    ->unique('id')
                    ->sortBy('nome');

                $nucleosFiltro = $seguros
                    ->pluck('aluno.curso.nucleo')
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

                    modalAberto: false,
                    acao: null,
                    tituloModal: '',
                    mensagemModal: '',
                    rotaModal: '',

                    seguros: @js(
                        $seguros->map(function ($seguro) {

                            return [

                                'id' => $seguro->id,

                                'nome' => strtolower(
                                    $seguro->aluno->nome ?? ''
                                ),

                                'ra' => strtolower(
                                    $seguro->aluno->ra ?? ''
                                ),

                                'curso' => (string) (
                                    $seguro->aluno->curso->id ?? ''
                                ),

                                'nucleo' => (string) (
                                    $seguro->aluno->curso->nucleo->id ?? ''
                                ),

                                'status' => $seguro->status,

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

                    seguroPassaFiltro(seguro) {

                        const busca = this.busca
                            .toLowerCase()
                            .trim();

                        const passaBusca =
                            busca === '' ||
                            seguro.nome.includes(busca) ||
                            seguro.ra.includes(busca);

                        const passaCurso =
                            this.curso === '' ||
                            seguro.curso === this.curso;

                        const passaNucleo =
                            this.nucleo === '' ||
                            seguro.nucleo === this.nucleo;

                        const passaStatus =
                            this.status === '' ||
                            seguro.status === this.status;

                        return (
                            passaBusca &&
                            passaCurso &&
                            passaNucleo &&
                            passaStatus
                        );

                    },

                    segurosFiltrados() {

                        return this.seguros.filter(
                            seguro => this.seguroPassaFiltro(seguro)
                        );

                    },

                    totalFiltrado() {

                        return this.segurosFiltrados().length;

                    },

                    quantidadePorStatus(status) {

                        return this.segurosFiltrados()
                            .filter(
                                seguro => seguro.status === status
                            )
                            .length;

                    },

                    abrirModal(
                        acao,
                        rota,
                        titulo,
                        mensagem
                    ) {

                        this.acao = acao;
                        this.rotaModal = rota;
                        this.tituloModal = titulo;
                        this.mensagemModal = mensagem;
                        this.modalAberto = true;

                    },

                    fecharModal() {

                        this.modalAberto = false;
                        this.acao = null;
                        this.rotaModal = '';

                    }

                }"

                @keydown.escape.window="fecharModal()"
            >


                {{-- =================================================
                    INDICADORES
                ================================================== --}}

                <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">


                    {{-- TOTAL --}}

                    <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-200">

                        <p class="text-sm font-bold text-gray-700">
                            Total de seguros
                        </p>

                        <p
                            class="mt-2 text-4xl font-extrabold text-gray-950"
                            x-text="totalFiltrado()"
                        >
                            {{ $totalSeguros }}
                        </p>

                        <p class="mt-1 text-xs font-semibold text-gray-500">
                            Seguros encontrados
                        </p>

                    </div>


                    {{-- AGUARDANDO INCLUSÃO --}}

                    <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-200">

                        <p class="text-sm font-bold text-gray-700">
                            Aguardando inclusão
                        </p>

                        <p
                            class="mt-2 text-4xl font-extrabold text-yellow-600"
                            x-text="quantidadePorStatus('aguardando_inclusao')"
                        >
                            {{ $segurosAguardandoInclusao }}
                        </p>

                        <p class="mt-1 text-xs font-semibold text-gray-500">
                            Pendentes de inclusão
                        </p>

                    </div>


                    {{-- ATIVOS --}}

                    <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-200">

                        <p class="text-sm font-bold text-gray-700">
                            Seguros ativos
                        </p>

                        <p
                            class="mt-2 text-4xl font-extrabold text-green-600"
                            x-text="quantidadePorStatus('ativo')"
                        >
                            {{ $segurosAtivos }}
                        </p>

                        <p class="mt-1 text-xs font-semibold text-gray-500">
                            Em vigência
                        </p>

                    </div>


                    {{-- PRÓXIMOS DO VENCIMENTO --}}

                    <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-200">

                        <p class="text-sm font-bold text-gray-700">
                            Próximos do vencimento
                        </p>

                        <p
                            class="mt-2 text-4xl font-extrabold text-orange-600"
                            x-text="quantidadePorStatus('proximo_do_vencimento')"
                        >
                            {{ $segurosProximos }}
                        </p>

                        <p class="mt-1 text-xs font-semibold text-gray-500">
                            Requerem atenção
                        </p>

                    </div>


                    {{-- VENCIDOS --}}

                    <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-200">

                        <p class="text-sm font-bold text-gray-700">
                            Vencidos
                        </p>

                        <p
                            class="mt-2 text-4xl font-extrabold text-red-600"
                            x-text="quantidadePorStatus('vencido')"
                        >
                            {{ $segurosVencidos }}
                        </p>

                        <p class="mt-1 text-xs font-semibold text-gray-500">
                            Fora da vigência
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
                                Pesquisar e filtrar seguros
                            </h2>

                        </div>

                        <p class="mt-1.5 text-sm font-medium text-gray-600">
                            Pesquise por nome ou RA e filtre os seguros por curso, núcleo e status.
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

                                <option value="aguardando_inclusao">
                                    Aguardando inclusão
                                </option>

                                <option value="ativo">
                                    Ativo
                                </option>

                                <option value="proximo_do_vencimento">
                                    Próximo do vencimento
                                </option>

                                <option value="vencido">
                                    Vencido
                                </option>

                                <option value="retirado">
                                    Retirado
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
                            Lista de seguros
                        </h2>

                        <p class="mt-1 text-sm font-medium text-gray-600">
                            Acompanhe a situação dos seguros cadastrados.
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

                                @forelse ($seguros as $seguro)

                                    @php

                                        $statusClasses = [

                                            'aguardando_inclusao' =>
                                                'bg-yellow-100 text-yellow-800',

                                            'ativo' =>
                                                'bg-green-100 text-green-800',

                                            'proximo_do_vencimento' =>
                                                'bg-orange-100 text-orange-800',

                                            'vencido' =>
                                                'bg-red-100 text-red-800',

                                            'retirado' =>
                                                'bg-gray-100 text-gray-800',

                                        ];


                                        $statusLabels = [

                                            'aguardando_inclusao' =>
                                                'Aguardando inclusão',

                                            'ativo' =>
                                                'Ativo',

                                            'proximo_do_vencimento' =>
                                                'Próximo do vencimento',

                                            'vencido' =>
                                                'Vencido',

                                            'retirado' =>
                                                'Retirado',

                                        ];

                                    @endphp


                                    <tr
                                        data-seguro
                                        x-show="
                                            seguroPassaFiltro(
                                                seguros.find(
                                                    seguro =>
                                                        seguro.id === {{ $seguro->id }}
                                                )
                                            )
                                        "
                                        x-cloak
                                        class="transition hover:bg-gray-50

                                            @if ($seguro->status === 'vencido')
                                                bg-red-50

                                            @elseif ($seguro->status === 'proximo_do_vencimento')
                                                bg-orange-50
                                            @endif

                                        "
                                    >


                                        {{-- ALUNO --}}

                                        <td class="whitespace-nowrap px-6 py-4">

                                            <div class="flex items-center gap-3">

                                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-orange-100 text-sm font-extrabold text-orange-700">

                                                    {{ strtoupper(substr($seguro->aluno->nome, 0, 1)) }}

                                                </div>

                                                <div>

                                                    <div class="text-sm font-bold text-gray-900">
                                                        {{ $seguro->aluno->nome }}
                                                    </div>

                                                    <div class="text-xs font-semibold text-gray-500">
                                                        RA: {{ $seguro->aluno->ra }}
                                                    </div>

                                                </div>

                                            </div>

                                        </td>


                                        {{-- CURSO --}}

                                        <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-gray-700">

                                            {{ $seguro->aluno->curso->nome }}

                                        </td>


                                        {{-- NÚCLEO --}}

                                        <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-gray-700">

                                            {{ $seguro->aluno->curso->nucleo->nome }}

                                        </td>


                                        {{-- INÍCIO --}}

                                        <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-gray-700">

                                            {{ $seguro->data_inicio?->format('d/m/Y') }}

                                        </td>


                                        {{-- FIM --}}

                                        <td class="whitespace-nowrap px-6 py-4">

                                            <div class="text-sm font-semibold text-gray-700">

                                                {{ $seguro->data_fim?->format('d/m/Y') }}

                                            </div>


                                            @if (
                                                in_array(
                                                    $seguro->status,
                                                    [
                                                        'proximo_do_vencimento',
                                                        'vencido',
                                                    ]
                                                )
                                                && $seguro->data_fim
                                            )

                                                @php

                                                    $dias = now()
                                                        ->startOfDay()
                                                        ->diffInDays(
                                                            $seguro->data_fim,
                                                            false
                                                        );

                                                @endphp


                                                @if ($seguro->status === 'vencido')

                                                    <div class="mt-1 text-xs font-extrabold text-red-600">

                                                        {{ abs($dias) }}

                                                        {{ abs($dias) === 1 ? 'dia' : 'dias' }}

                                                        vencido

                                                    </div>

                                                @else

                                                    <div class="mt-1 text-xs font-extrabold text-orange-600">

                                                        {{ $dias }}

                                                        {{ $dias === 1 ? 'dia' : 'dias' }}

                                                        restantes

                                                    </div>

                                                @endif

                                            @endif

                                        </td>


                                        {{-- STATUS --}}

                                        <td class="whitespace-nowrap px-6 py-4">

                                            <span
                                                class="inline-flex rounded-full px-3 py-1 text-xs font-extrabold {{ $statusClasses[$seguro->status] ?? 'bg-gray-100 text-gray-800' }}"
                                            >

                                                {{ $statusLabels[$seguro->status] ?? $seguro->status }}

                                            </span>

                                        </td>


                                        {{-- AÇÕES --}}

                                        <td class="whitespace-nowrap px-6 py-4">

                                            @if ($seguro->status === 'aguardando_inclusao')

                                                <button
                                                    type="button"
                                                    @click="
                                                        abrirModal(
                                                            'inclusao',
                                                            '{{ route('seguros.confirmarInclusao', $seguro) }}',
                                                            'Confirmar inclusão',
                                                            'Deseja realmente confirmar a inclusão deste seguro?'
                                                        )
                                                    "
                                                    class="rounded-lg bg-green-600 px-3.5 py-2 text-xs font-bold text-white transition hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                                                >
                                                    Confirmar inclusão
                                                </button>

                                            @elseif (
                                                in_array(
                                                    $seguro->status,
                                                    [
                                                        'ativo',
                                                        'proximo_do_vencimento',
                                                        'vencido',
                                                    ]
                                                )
                                            )

                                                <button
                                                    type="button"
                                                    @click="
                                                        abrirModal(
                                                            'retirada',
                                                            '{{ route('seguros.registrarRetirada', $seguro) }}',
                                                            'Registrar retirada',
                                                            'Deseja realmente registrar a retirada deste seguro?'
                                                        )
                                                    "
                                                    class="rounded-lg bg-red-600 px-3.5 py-2 text-xs font-bold text-white transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                                >
                                                    Registrar retirada
                                                </button>

                                            @else

                                                <span class="text-xs font-semibold text-gray-400">
                                                    Retirado
                                                </span>

                                            @endif

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td
                                            colspan="7"
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
                                                        d="M9 12.75 11.25 15 15 9.75M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9Z"
                                                    />
                                                </svg>

                                            </div>

                                            <p class="mt-4 text-sm font-semibold text-gray-700">
                                                Nenhum seguro cadastrado.
                                            </p>

                                        </td>

                                    </tr>

                                @endforelse


                                {{-- NENHUM RESULTADO NOS FILTROS --}}

                                @if ($seguros->count() > 0)

                                    <tr
                                        x-show="totalFiltrado() === 0"
                                        x-cloak
                                    >

                                        <td
                                            colspan="7"
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
                                                Nenhum seguro encontrado com os filtros selecionados.
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


                {{-- =====================================================
                    MODAL DE CONFIRMAÇÃO
                ====================================================== --}}

                <div
                    x-show="modalAberto"
                    x-cloak
                    x-transition.opacity
                    class="fixed inset-0 z-50 flex items-center justify-center bg-gray-950/50 px-4"
                    @click.self="fecharModal()"
                >

                    <div
                        x-show="modalAberto"
                        x-transition:enter="ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl"
                        @click.stop
                    >

                        {{-- ÍCONE --}}

                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-xl"
                            :class="
                                acao === 'inclusao'
                                    ? 'bg-green-100 text-green-600'
                                    : 'bg-red-100 text-red-600'
                            "
                        >

                            {{-- ÍCONE DE INCLUSÃO --}}

                            <template x-if="acao === 'inclusao'">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    class="h-6 w-6"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m4.5 12.75 6 6 9-13.5"
                                    />
                                </svg>

                            </template>


                            {{-- ÍCONE DE RETIRADA --}}

                            <template x-if="acao === 'retirada'">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    class="h-6 w-6"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 9v3.75m0 3h.008v.008H12v-.008ZM10.343 3.94l-7.06 12.25A1.875 1.875 0 0 0 4.908 19h14.184a1.875 1.875 0 0 0 1.625-2.81l-7.06-12.25a1.875 1.875 0 0 0-3.314 0Z"
                                    />
                                </svg>

                            </template>

                        </div>


                        {{-- TÍTULO --}}

                        <h3
                            class="mt-5 text-lg font-extrabold text-gray-950"
                            x-text="tituloModal"
                        ></h3>


                        {{-- MENSAGEM --}}

                        <p
                            class="mt-2 text-sm font-medium leading-6 text-gray-600"
                            x-text="mensagemModal"
                        ></p>


                        {{-- AÇÕES --}}

                        <div class="mt-6 flex justify-end gap-3">

                            <button
                                type="button"
                                @click="fecharModal()"
                                class="rounded-xl px-4 py-2.5 text-sm font-bold text-gray-600 transition hover:bg-gray-100"
                            >
                                Cancelar
                            </button>


                            <form
                                method="POST"
                                :action="rotaModal"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="rounded-xl px-4 py-2.5 text-sm font-bold text-white shadow-sm transition focus:outline-none focus:ring-2 focus:ring-offset-2"
                                    :class="
                                        acao === 'inclusao'
                                            ? 'bg-green-600 hover:bg-green-700 focus:ring-green-500'
                                            : 'bg-red-600 hover:bg-red-700 focus:ring-red-500'
                                    "
                                    x-text="
                                        acao === 'inclusao'
                                            ? 'Confirmar inclusão'
                                            : 'Registrar retirada'
                                    "
                                ></button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
