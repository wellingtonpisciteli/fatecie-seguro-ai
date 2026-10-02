<x-app-layout>

<x-slot name="header">

    <div class="w-full">

        <div class="flex min-h-[120px] items-center justify-between gap-8">

            {{-- INFORMAÇÕES DO DASHBOARD --}}
            <div class="min-w-0">

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
                                d="M3.75 3.75v16.5h16.5M7.5 15.75l3-3 2.25 2.25 4.5-5.25"
                            />
                        </svg>

                    </div>

                    <div>

                        <p class="text-xs font-extrabold uppercase tracking-[0.2em] text-orange-600">
                            Fatecie Seguro AI
                        </p>

                        <h2 class="mt-0.5 text-3xl font-extrabold tracking-tight text-gray-950">
                            Dashboard
                        </h2>

                    </div>

                </div>

                <p class="mt-4 max-w-2xl text-sm font-medium leading-6 text-gray-600">
                    Acompanhe os seguros dos alunos e identifique rapidamente
                    situações que precisam de atenção.
                </p>

            </div>


            {{-- AÇÃO PRINCIPAL --}}
            <div class="hidden shrink-0 md:block">

                <a
                    href="{{ route('seguros.index') }}"
                    class="group inline-flex items-center gap-3 rounded-xl bg-orange-600 px-6 py-3.5 text-sm font-bold text-white shadow-sm transition duration-200 hover:bg-orange-700 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2"
                >

                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-white/15">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="h-5 w-5 transition-transform duration-200 group-hover:scale-110"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 12.75 11.25 15 15 9.75M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9Z"
                            />
                        </svg>

                    </span>

                    Gerenciar seguros

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-0.5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m9 5 7 7-7 7"
                        />
                    </svg>

                </a>

            </div>

        </div>


        {{-- BOTÃO MOBILE --}}
        <div class="pb-5 md:hidden">

            <a
                href="{{ route('seguros.index') }}"
                class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-orange-600 px-5 py-3.5 text-sm font-bold text-white shadow-sm transition hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2"
            >

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

                Gerenciar seguros

            </a>

        </div>

    </div>

</x-slot>


<div class="min-h-[calc(100vh-65px)] bg-gray-50">

    <div class="w-full px-4 py-6 sm:px-6 lg:px-8 xl:px-10 2xl:px-12">


        {{-- =====================================================
            INDICADORES
        ====================================================== --}}

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-5">


            {{-- TOTAL --}}

            <div class="relative overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="absolute inset-x-0 top-0 h-1 bg-orange-500"></div>

                <div class="p-6 lg:p-7">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-bold text-gray-700">
                                Total de seguros
                            </p>

                            <p class="mt-3 text-4xl font-extrabold tracking-tight text-gray-950">
                                {{ $totalSeguros }}
                            </p>

                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-50 text-orange-600">

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

                    </div>

                    <div class="mt-6 border-t border-gray-200 pt-4">

                        <p class="text-xs font-semibold text-gray-500">
                            Seguros cadastrados no sistema
                        </p>

                    </div>

                </div>

            </div>


            {{-- ATIVOS --}}

            <div class="relative overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="absolute inset-x-0 top-0 h-1 bg-green-500"></div>

                <div class="p-6 lg:p-7">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-bold text-gray-700">
                                Seguros ativos
                            </p>

                            <p class="mt-3 text-4xl font-extrabold tracking-tight text-gray-950">
                                {{ $segurosAtivos }}
                            </p>

                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-50 text-green-600">

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
                                    d="m9 12.75 2.25 2.25L15 10.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                />
                            </svg>

                        </div>

                    </div>

                    <div class="mt-6 border-t border-gray-200 pt-4">

                        <p class="text-xs font-semibold text-gray-500">
                            Seguros atualmente vigentes
                        </p>

                    </div>

                </div>

            </div>


            {{-- AGUARDANDO INCLUSÃO --}}

            <div class="relative overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="absolute inset-x-0 top-0 h-1 bg-yellow-500"></div>

                <div class="p-6 lg:p-7">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-bold text-gray-700">
                                Aguardando inclusão
                            </p>

                            <p class="mt-3 text-4xl font-extrabold tracking-tight text-gray-950">
                                {{ $segurosAguardandoInclusao }}
                            </p>

                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-yellow-50 text-yellow-600">

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
                                    d="M12 6v6l4 2m6-2a10 10 0 1 1-20 0 10 10 0 0 1 20 0Z"
                                />
                            </svg>

                        </div>

                    </div>

                    <div class="mt-6 border-t border-gray-200 pt-4">

                        <p class="text-xs font-semibold text-gray-500">
                            Seguros pendentes de inclusão
                        </p>

                    </div>

                </div>

            </div>


            {{-- PRÓXIMOS --}}

            <div class="relative overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="absolute inset-x-0 top-0 h-1 bg-orange-500"></div>

                <div class="p-6 lg:p-7">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-bold text-gray-700">
                                Próximos do vencimento
                            </p>

                            <p class="mt-3 text-4xl font-extrabold tracking-tight text-gray-950">
                                {{ $segurosProximosVencimento }}
                            </p>

                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-50 text-orange-600">

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
                                    d="M12 6v6l4 2m6-2a10 10 0 1 1-20 0 10 10 0 0 1 20 0Z"
                                />
                            </svg>

                        </div>

                    </div>

                    <div class="mt-6 border-t border-gray-200 pt-4">

                        <p class="text-xs font-semibold text-gray-500">
                            Seguros que exigem acompanhamento
                        </p>

                    </div>

                </div>

            </div>


            {{-- VENCIDOS --}}

            <div class="relative overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="absolute inset-x-0 top-0 h-1 bg-red-500"></div>

                <div class="p-6 lg:p-7">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-bold text-gray-700">
                                Seguros vencidos
                            </p>

                            <p class="mt-3 text-4xl font-extrabold tracking-tight text-gray-950">
                                {{ $segurosVencidos }}
                            </p>

                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-red-600">

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
                                    d="M12 9v3.75m0 3.75h.008v.008H12v-.008ZM10.29 3.86 1.82 18a2 2 0 0 0 1.72 3h16.92a2 2 0 0 0 1.72-3L13.71 3.86a2 2 0 0 0-3.42 0Z"
                                />
                            </svg>

                        </div>

                    </div>

                    <div class="mt-6 border-t border-gray-200 pt-4">

                        <p class="text-xs font-semibold text-gray-500">
                            Seguros que precisam de atenção
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            ÁREA PRINCIPAL
        ====================================================== --}}

        <div class="mt-6 grid grid-cols-1 items-start gap-6 xl:grid-cols-12">


            {{-- =================================================
                COLUNA PRINCIPAL
            ================================================== --}}

            <div class="space-y-6 xl:col-span-9">


                {{-- ATENÇÃO NECESSÁRIA --}}

                <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                    <div class="border-b border-gray-200 px-6 py-5 lg:px-7">

                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                            <div>

                                <div class="flex items-center gap-3">

                                    <div class="h-2.5 w-2.5 rounded-full bg-orange-500"></div>

                                    <h3 class="text-xl font-extrabold text-gray-950">
                                        Atenção necessária
                                    </h3>

                                </div>

                                <p class="mt-2 text-sm font-medium text-gray-600">
                                    Seguros próximos do vencimento ou já vencidos.
                                </p>

                            </div>


                            <a
                                href="{{ route('seguros.index') }}"
                                class="inline-flex items-center text-sm font-bold text-orange-600 transition hover:text-orange-700"
                            >

                                Ver todos

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    class="ml-1.5 h-4 w-4"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m9 5 7 7-7 7"
                                    />
                                </svg>

                            </a>

                        </div>

                    </div>


                    @if ($segurosAtencao->isEmpty())

                        <div class="flex min-h-[300px] flex-col items-center justify-center px-6 py-12 text-center">

                            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-green-50 text-green-600">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor"
                                    class="h-8 w-8"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m9 12.75 2.25 2.25L15 10.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                    />
                                </svg>

                            </div>

                            <p class="mt-5 text-lg font-extrabold text-gray-950">
                                Tudo em ordem
                            </p>

                            <p class="mt-1 max-w-md text-sm font-medium text-gray-600">
                                Nenhum seguro próximo do vencimento ou vencido no momento.
                            </p>

                        </div>

                    @else

                        <div class="overflow-x-auto">

                            <table class="min-w-full">

                                <thead>

                                    <tr class="border-b border-gray-200 bg-gray-50/80">

                                        <th class="px-6 py-4 text-left text-xs font-extrabold uppercase tracking-wider text-gray-600 lg:px-7">
                                            Aluno
                                        </th>

                                        <th class="px-6 py-4 text-left text-xs font-extrabold uppercase tracking-wider text-gray-600">
                                            Vencimento
                                        </th>

                                        <th class="px-6 py-4 text-left text-xs font-extrabold uppercase tracking-wider text-gray-600">
                                            Situação
                                        </th>

                                        <th class="px-6 py-4 text-left text-xs font-extrabold uppercase tracking-wider text-gray-600">
                                            Prazo
                                        </th>

                                    </tr>

                                </thead>


                                <tbody class="divide-y divide-gray-100">

                                    @foreach ($segurosAtencao as $seguro)

                                        @php

                                            $dias = $hoje->diffInDays(
                                                $seguro->data_fim,
                                                false
                                            );

                                        @endphp


                                        <tr class="transition hover:bg-orange-50/40">

                                            <td class="whitespace-nowrap px-6 py-5 lg:px-7">

                                                <div class="flex items-center gap-3">

                                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gray-100 text-sm font-bold text-gray-700">

                                                        {{ strtoupper(substr($seguro->aluno->nome ?? 'A', 0, 1)) }}

                                                    </div>

                                                    <div>

                                                        <p class="text-sm font-bold text-gray-900">
                                                            {{ $seguro->aluno->nome ?? 'Aluno não encontrado' }}
                                                        </p>

                                                    </div>

                                                </div>

                                            </td>


                                            <td class="whitespace-nowrap px-6 py-5">

                                                <p class="text-sm font-semibold text-gray-800">
                                                    {{ $seguro->data_fim->format('d/m/Y') }}
                                                </p>

                                            </td>


                                            <td class="whitespace-nowrap px-6 py-5">

                                                @if ($seguro->status === 'vencido')

                                                    <span class="inline-flex rounded-full bg-red-50 px-3 py-1.5 text-xs font-extrabold text-red-700 ring-1 ring-inset ring-red-200">
                                                        Vencido
                                                    </span>

                                                @else

                                                    <span class="inline-flex rounded-full bg-orange-50 px-3 py-1.5 text-xs font-extrabold text-orange-700 ring-1 ring-inset ring-orange-200">
                                                        Próximo do vencimento
                                                    </span>

                                                @endif

                                            </td>


                                            <td class="whitespace-nowrap px-6 py-5">

                                                @if ($seguro->status === 'vencido')

                                                    <span class="text-sm font-extrabold text-red-600">

                                                        {{ abs($dias) }}

                                                        {{ abs($dias) == 1 ? 'dia' : 'dias' }}

                                                        vencido

                                                    </span>

                                                @else

                                                    <span class="text-sm font-extrabold text-orange-600">

                                                        {{ $dias }}

                                                        {{ $dias == 1 ? 'dia' : 'dias' }}

                                                        restantes

                                                    </span>

                                                @endif

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    @endif

                </div>


                {{-- ACOMPANHAMENTO --}}

                <div class="relative overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                    <div class="absolute inset-x-0 top-0 h-1 bg-orange-500"></div>

                    <div class="p-6 lg:p-7">

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-50 text-orange-600">

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
                                    d="M12 6v6l4 2m6-2a10 10 0 1 1-20 0 10 10 0 0 1 20 0Z"
                                />
                            </svg>

                        </div>


                        <h3 class="mt-6 text-xl font-extrabold text-gray-950">
                            Acompanhamento
                        </h3>


                        <p class="mt-2 text-sm font-medium leading-6 text-gray-600">
                            Utilize os indicadores para acompanhar a situação dos seguros dos alunos.
                        </p>


                        <div class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-2">


                            {{-- AGUARDANDO INCLUSÃO --}}

                            <div class="flex items-center justify-between rounded-xl bg-yellow-50 px-4 py-4">

                                <span class="text-sm font-bold text-gray-700">
                                    Aguardando inclusão
                                </span>

                                <span class="text-lg font-extrabold text-yellow-600">
                                    {{ $segurosAguardandoInclusao }}
                                </span>

                            </div>


                            {{-- ATIVOS --}}

                            <div class="flex items-center justify-between rounded-xl bg-green-50 px-4 py-4">

                                <span class="text-sm font-bold text-gray-700">
                                    Ativos
                                </span>

                                <span class="text-lg font-extrabold text-green-600">
                                    {{ $segurosAtivos }}
                                </span>

                            </div>


                            {{-- PRÓXIMOS --}}

                            <div class="flex items-center justify-between rounded-xl bg-orange-50 px-4 py-4">

                                <span class="text-sm font-bold text-gray-700">
                                    Próximos do vencimento
                                </span>

                                <span class="text-lg font-extrabold text-orange-600">
                                    {{ $segurosProximosVencimento }}
                                </span>

                            </div>


                            {{-- VENCIDOS --}}

                            <div class="flex items-center justify-between rounded-xl bg-red-50 px-4 py-4">

                                <span class="text-sm font-bold text-gray-700">
                                    Vencidos
                                </span>

                                <span class="text-lg font-extrabold text-red-600">
                                    {{ $segurosVencidos }}
                                </span>

                            </div>

                        </div>


                        <div class="mt-8 border-t border-gray-200 pt-6">

                            <a
                                href="{{ route('seguros.index') }}"
                                class="flex w-full items-center justify-center rounded-lg bg-orange-600 px-4 py-3 text-sm font-extrabold text-white transition hover:bg-orange-700"
                            >
                                Acessar seguros
                            </a>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                PAINEL VERTICAL DA IA
            ================================================== --}}

            <div
                x-data="{
                    pergunta: '',
                    resposta: '',
                    carregando: false,
                    erro: '',

                    async perguntar() {

                        if (!this.pergunta.trim() || this.carregando) {
                            return;
                        }

                        this.carregando = true;
                        this.erro = '';
                        this.resposta = '';

                        try {

                            const response = await fetch('{{ route('assistente.perguntar') }}', {
                                method: 'POST',

                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },

                                body: JSON.stringify({
                                    pergunta: this.pergunta
                                })
                            });

                            const data = await response.json();

                            if (!response.ok || !data.sucesso) {
                                throw new Error(
                                    data.mensagem || 'Não foi possível consultar o assistente.'
                                );
                            }

                            this.resposta = data.resposta;

                        } catch (error) {

                            this.erro = error.message ||
                                'Ocorreu um erro ao consultar a IA.';

                        } finally {

                            this.carregando = false;

                        }
                    }
                }"
                class="flex min-h-[680px] flex-col overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm xl:col-span-3"
            >

                {{-- CABEÇALHO --}}

                <div class="border-b border-gray-200 bg-white px-5 py-5">

                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-orange-100 text-orange-600">

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
                                    d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.847-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.847a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.847.813a4.5 4.5 0 0 0-3.09 3.09Z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.456-2.456L14.25 6l1.035-.259a3.375 3.375 0 0 0 2.456-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456Z"
                                />

                            </svg>

                        </div>


                        <div class="min-w-0">

                            <div class="flex flex-wrap items-center gap-2">

                                <h3 class="text-lg font-extrabold text-gray-950">
                                    Assistente Fatecie
                                </h3>

                                <span class="rounded-full bg-green-50 px-2 py-1 text-[9px] font-extrabold uppercase tracking-wider text-green-700 ring-1 ring-inset ring-green-200">
                                    IA local
                                </span>

                            </div>

                            <p class="mt-1 text-xs font-medium text-gray-500">
                                Assistente do sistema
                            </p>

                        </div>

                    </div>

                </div>


                {{-- ÁREA DA CONVERSA --}}

                <div class="flex flex-1 flex-col bg-gray-50">

                    <div class="flex-1 overflow-y-auto p-5">


                        {{-- MENSAGEM INICIAL --}}

                        <div class="flex gap-3">

                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-orange-100 text-orange-600">

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
                                        d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.847-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.847a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.847.813a4.5 4.5 0 0 0 3.09 3.09Z"
                                    />
                                </svg>

                            </div>


                            <div class="max-w-[calc(100%-44px)] rounded-2xl rounded-tl-md bg-white px-4 py-3 shadow-sm ring-1 ring-gray-100">

                                <p class="text-sm leading-6 text-gray-700">
                                    Olá! Sou o assistente do Fatecie Seguro.
                                </p>

                                <p class="mt-2 text-xs leading-5 text-gray-500">
                                    Posso ajudar com dúvidas sobre o sistema.
                                </p>

                            </div>

                        </div>


                        {{-- RESPOSTA --}}

                        <template x-if="resposta">

                            <div class="mt-5 flex gap-3">

                                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-orange-100 text-orange-600">

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
                                            d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.847-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.847a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.847.813a4.5 4.5 0 0 0-3.09 3.09Z"
                                        />
                                    </svg>

                                </div>


                                <div class="max-w-[calc(100%-44px)] rounded-2xl rounded-tl-md bg-white px-4 py-3 shadow-sm ring-1 ring-gray-100">

                                    <p
                                        x-text="resposta"
                                        class="whitespace-pre-line text-sm leading-6 text-gray-700"
                                    ></p>

                                </div>

                            </div>

                        </template>


                        {{-- CARREGANDO --}}

                        <template x-if="carregando">

                            <div class="mt-5 flex gap-3">

                                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-orange-100 text-orange-600">
                                    ✦
                                </div>

                                <div class="rounded-2xl rounded-tl-md bg-white px-4 py-3 shadow-sm ring-1 ring-gray-100">

                                    <div class="flex items-center gap-1.5">

                                        <span class="h-2 w-2 animate-bounce rounded-full bg-gray-400"></span>

                                        <span
                                            class="h-2 w-2 animate-bounce rounded-full bg-gray-400"
                                            style="animation-delay: 0.15s"
                                        ></span>

                                        <span
                                            class="h-2 w-2 animate-bounce rounded-full bg-gray-400"
                                            style="animation-delay: 0.3s"
                                        ></span>

                                    </div>

                                </div>

                            </div>

                        </template>


                        {{-- ERRO --}}

                        <template x-if="erro">

                            <div class="mt-5 rounded-xl border border-red-200 bg-red-50 p-4">

                                <p
                                    x-text="erro"
                                    class="text-xs font-semibold leading-5 text-red-700"
                                ></p>

                            </div>

                        </template>


                        {{-- SUGESTÕES --}}

                        <div
                            x-show="!resposta && !carregando && !erro"
                            class="mt-6 space-y-2"
                        >

                            <p class="mb-3 text-[10px] font-extrabold uppercase tracking-[0.15em] text-gray-400">
                                Sugestões
                            </p>


                            <button
                                type="button"
                                @click="pergunta = 'Quantos seguros estão vencidos?'"
                                class="w-full rounded-xl border border-gray-200 bg-white px-3 py-3 text-left text-xs font-semibold leading-5 text-gray-600 transition hover:border-orange-300 hover:bg-orange-50 hover:text-orange-700"
                            >
                                Quantos seguros estão vencidos?
                            </button>


                            <button
                                type="button"
                                @click="pergunta = 'Quantos seguros estão próximos do vencimento?'"
                                class="w-full rounded-xl border border-gray-200 bg-white px-3 py-3 text-left text-xs font-semibold leading-5 text-gray-600 transition hover:border-orange-300 hover:bg-orange-50 hover:text-orange-700"
                            >
                                Quantos estão próximos do vencimento?
                            </button>


                            <button
                                type="button"
                                @click="pergunta = 'Existem seguros aguardando inclusão?'"
                                class="w-full rounded-xl border border-gray-200 bg-white px-3 py-3 text-left text-xs font-semibold leading-5 text-gray-600 transition hover:border-orange-300 hover:bg-orange-50 hover:text-orange-700"
                            >
                                Existem seguros aguardando inclusão?
                            </button>

                        </div>

                    </div>


                    {{-- CAMPO DE PERGUNTA --}}

                    <div class="border-t border-gray-200 bg-white p-4">

                        <form
                            @submit.prevent="perguntar()"
                            class="space-y-3"
                        >

                            <textarea
                                x-model="pergunta"
                                rows="2"
                                maxlength="1000"
                                placeholder="Digite sua pergunta..."
                                class="block w-full resize-none rounded-xl border-gray-300 text-xs shadow-sm transition focus:border-orange-500 focus:ring-orange-500"
                                :disabled="carregando"
                                @keydown.ctrl.enter.prevent="perguntar()"
                            ></textarea>


                            <div class="flex items-center justify-between gap-3">

                                <p class="text-[10px] font-medium leading-4 text-gray-400">
                                    Ctrl + Enter para enviar
                                </p>


                                <button
                                    type="submit"
                                    :disabled="carregando || !pergunta.trim()"
                                    class="inline-flex shrink-0 items-center gap-2 rounded-xl bg-orange-600 px-4 py-2.5 text-xs font-extrabold text-white shadow-sm transition hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                                >

                                    <svg
                                        x-show="carregando"
                                        class="h-4 w-4 animate-spin"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                    >
                                        <circle
                                            class="opacity-25"
                                            cx="12"
                                            cy="12"
                                            r="10"
                                            stroke="currentColor"
                                            stroke-width="4"
                                        ></circle>

                                        <path
                                            class="opacity-75"
                                            fill="currentColor"
                                            d="M4 12a8 8 0 0 1 8-8v4a4 4 0 0 0-4 4H4Z"
                                        ></path>

                                    </svg>


                                    <svg
                                        x-show="!carregando"
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
                                            d="M6 12 3.5 3.5 21 12l-17.5 8.5L6 12Zm0 0h7.5"
                                        />
                                    </svg>


                                    <span x-text="carregando ? 'Consultando...' : 'Perguntar'"></span>

                                </button>

                            </div>

                        </form>


                        <p class="mt-2 text-center text-[10px] font-medium text-gray-400">
                            IA executada localmente
                        </p>

                    </div>

                </div>

            </div>

        </div>


    </div>

</div>


</x-app-layout>
