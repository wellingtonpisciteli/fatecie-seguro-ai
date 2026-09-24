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
                                    d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-.324-.015-.647-.044-.966M15 19.128a9.38 9.38 0 0 1-2.625-.372m5.25 0a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M9.75 19.128v-.003a9.38 9.38 0 0 1 2.625-.372m-5.25.375a9.38 9.38 0 0 1-2.625-.372 9.337 9.337 0 0 1-4.121-.952 4.125 4.125 0 0 1 7.533-2.493M9.75 19.128a9.38 9.38 0 0 0 2.625.372m0 0a9.38 9.38 0 0 0 2.625-.372M12 13.5a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Zm-6.75 0a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Zm13.5 0a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z"
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
                        Gerencie os alunos e acompanhe os períodos de estágio.
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
                CONTEÚDO
            ====================================================== --}}

            <div
                x-data="{
                    busca: '',
                    status: '',

                    limparFiltros() {
                        this.busca = '';
                        this.status = '';
                    }
                }"
            >

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
                            Pesquise por nome ou RA e filtre os alunos pelo status.
                        </p>

                    </div>


                    {{-- CAMPOS --}}

                    <div class="grid gap-4 md:grid-cols-[1fr_240px_auto]">

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
                                class="w-full rounded-xl border-gray-300 py-3 pl-11 pr-11 text-sm font-medium text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-orange-500 focus:ring-orange-500"
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
                            x-show="busca !== '' || status !== ''"
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
                            Alunos cadastrados e seus respectivos períodos de estágio.
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
                                        Data inicial
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-extrabold uppercase tracking-wider text-gray-600">
                                        Data final
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-extrabold uppercase tracking-wider text-gray-600">
                                        Status
                                    </th>

                                    <th class="px-6 py-4 text-right text-xs font-extrabold uppercase tracking-wider text-gray-600">
                                        Ações
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-gray-200">

                                @forelse ($alunos as $aluno)

                                    <tr
                                        data-aluno
                                        x-show="
                                            (
                                                busca.trim() === '' ||
                                                @js(strtolower($aluno->nome)).includes(busca.toLowerCase().trim()) ||
                                                @js(strtolower($aluno->ra)).includes(busca.toLowerCase().trim())
                                            )
                                            &&
                                            (
                                                status === '' ||
                                                status === @js($aluno->status)
                                            )
                                        "
                                        x-cloak
                                        class="transition hover:bg-gray-50"
                                    >

                                        <td class="whitespace-nowrap px-6 py-4">

                                            <div class="flex items-center gap-3">

                                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-orange-100 text-sm font-extrabold text-orange-700">
                                                    {{ strtoupper(substr($aluno->nome, 0, 1)) }}
                                                </div>

                                                <span class="text-sm font-bold text-gray-900">
                                                    {{ $aluno->nome }}
                                                </span>

                                            </div>

                                        </td>


                                        <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-gray-700">
                                            {{ $aluno->ra }}
                                        </td>


                                        <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-gray-700">
                                            {{ $aluno->curso->nome }}
                                        </td>


                                        <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-gray-700">
                                            {{ $aluno->curso->nucleo->nome }}
                                        </td>


                                        <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-gray-700">
                                            {{ $aluno->data_inicial->format('d/m/Y') }}
                                        </td>


                                        <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-gray-700">
                                            {{ $aluno->data_final->format('d/m/Y') }}
                                        </td>


                                        <td class="whitespace-nowrap px-6 py-4">

                                            @if ($aluno->status === 'vigente')

                                                <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-xs font-extrabold text-green-700">
                                                    Vigente
                                                </span>

                                            @elseif ($aluno->status === 'aguardando')

                                                <span class="inline-flex items-center rounded-full bg-orange-100 px-3 py-1 text-xs font-extrabold text-orange-700">
                                                    Aguardando
                                                </span>

                                            @elseif ($aluno->status === 'encerrado')

                                                <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-extrabold text-gray-700">
                                                    Encerrado
                                                </span>

                                            @endif

                                        </td>


                                        <td class="whitespace-nowrap px-6 py-4 text-right">

                                            <a
                                                href="{{ route('alunos.edit', $aluno) }}"
                                                class="inline-flex items-center gap-1.5 rounded-lg bg-orange-600 px-3.5 py-2 text-xs font-bold text-white transition hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2"
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
                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.5 16.154 7 17l.846-3.5L16.862 4.487ZM19.5 13.5V19.125A1.875 1.875 0 0 1 17.625 21H4.875A1.875 1.875 0 0 1 3 19.125V6.375A1.875 1.875 0 0 1 4.875 4.5H10.5"
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
                                                        d="M12 13.5a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Zm-6.75 0a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Zm13.5 0a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z"
                                                    />
                                                </svg>

                                            </div>

                                            <p class="mt-4 text-sm font-semibold text-gray-700">
                                                Nenhum aluno cadastrado.
                                            </p>

                                        </td>

                                    </tr>

                                @endforelse


                                {{-- =================================================
                                    NENHUM RESULTADO NOS FILTROS
                                ================================================== --}}

                                @if ($alunos->count() > 0)

                                    <tr
                                        x-show="
                                            !Array.from(
                                                $el.parentElement.querySelectorAll('tr[data-aluno]')
                                            ).some(row => row.offsetParent !== null)
                                        "
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