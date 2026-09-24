<x-app-layout>

    <div class="bg-gray-50 py-8">

        <div class="w-full px-4 sm:px-6 lg:px-8 xl:px-10 2xl:px-12">

            {{-- HEADER --}}
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
                                    d="M3.75 21h16.5M4.5 18.75h15M6 18.75V5.25A2.25 2.25 0 0 1 8.25 3h7.5A2.25 2.25 0 0 1 18 5.25v13.5M9 7.5h6M9 11.25h6M9 15h3"
                                />
                            </svg>

                        </div>

                        <div>

                            <p class="text-xs font-extrabold uppercase tracking-[0.2em] text-orange-600">
                                Fatecie Seguro AI
                            </p>

                            <h1 class="mt-0.5 text-3xl font-extrabold tracking-tight text-gray-950">
                                Núcleos
                            </h1>

                        </div>

                    </div>

                    <p class="mt-4 max-w-2xl text-sm font-medium leading-6 text-gray-600">
                        Gerencie os núcleos responsáveis pelos cursos.
                    </p>

                </div>

                <a
                    href="{{ route('nucleos.create') }}"
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

                    Novo núcleo

                </a>

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

            {{-- LISTA --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">

                <div class="border-b border-gray-200 px-6 py-5">

                    <div class="flex items-center gap-2">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="h-5 w-5 text-orange-600"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3.75 21h16.5M4.5 18.75h15M6 18.75V5.25A2.25 2.25 0 0 1 8.25 3h7.5a2.25 2.25 0 0 1 2.25 2.25v13.5M9 7.5h6M9 11.25h6M9 15h3"
                            />
                        </svg>

                        <h2 class="text-xl font-extrabold text-gray-950">
                            Lista de núcleos
                        </h2>

                    </div>

                    <p class="mt-1 text-sm font-medium text-gray-600">
                        Núcleos cadastrados e responsáveis pela organização dos cursos.
                    </p>

                </div>

                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-gray-50">

                            <tr>

                                <th class="px-6 py-4 text-left text-xs font-extrabold uppercase tracking-wider text-gray-600">
                                    Núcleo
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-extrabold uppercase tracking-wider text-gray-600">
                                    Modalidade
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

                            @forelse ($nucleos as $nucleo)

                                <tr class="transition hover:bg-gray-50">

                                    {{-- NÚCLEO --}}
                                    <td class="whitespace-nowrap px-6 py-4">

                                        <div class="flex items-center gap-3">

                                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-orange-100 text-sm font-extrabold text-orange-700">

                                                {{ strtoupper(substr($nucleo->nome, 0, 1)) }}

                                            </div>

                                            <span class="text-sm font-bold text-gray-900">
                                                {{ $nucleo->nome }}
                                            </span>

                                        </div>

                                    </td>

                                    {{-- MODALIDADE --}}
                                    <td class="whitespace-nowrap px-6 py-4">

                                        @if ($nucleo->modalidade === 'presencial')

                                            <span class="inline-flex items-center rounded-full bg-orange-100 px-3 py-1 text-xs font-extrabold text-orange-700">
                                                Presencial
                                            </span>

                                        @else

                                            <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-extrabold text-blue-700">
                                                EAD
                                            </span>

                                        @endif

                                    </td>

                                    {{-- STATUS --}}
                                    <td class="whitespace-nowrap px-6 py-4">

                                        @if ($nucleo->ativo)

                                            <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-xs font-extrabold text-green-700">
                                                Ativo
                                            </span>

                                        @else

                                            <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-extrabold text-gray-700">
                                                Inativo
                                            </span>

                                        @endif

                                    </td>

                                    {{-- AÇÕES --}}
                                    <td class="whitespace-nowrap px-6 py-4 text-right">

                                        <a
                                            href="{{ route('nucleos.edit', $nucleo) }}"
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
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 15.07a4.5 4.5 0 0 1-1.897 1.13L6 17l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"
                                                />
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M19.5 7.125 16.875 4.5M18 14.25V19.5A2.25 2.25 0 0 1 15.75 21h-9A2.25 2.25 0 0 1 4.5 18.75v-9A2.25 2.25 0 0 1 6.75 7.5H12"
                                                />
                                            </svg>

                                            Editar

                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="4"
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
                                                    d="M3.75 21h16.5M4.5 18.75h15M6 18.75V5.25A2.25 2.25 0 0 1 8.25 3h7.5a2.25 2.25 0 0 1 2.25 2.25v13.5M9 7.5h6M9 11.25h6M9 15h3"
                                                />
                                            </svg>

                                        </div>

                                        <p class="mt-4 text-sm font-semibold text-gray-700">
                                            Nenhum núcleo cadastrado.
                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>