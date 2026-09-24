<nav x-data="{ open: false }" class="border-b border-gray-200 bg-white">

    {{-- =========================================================
        BARRA PRINCIPAL
    ========================================================== --}}

    <div class="w-full px-4 sm:px-6 lg:px-8">

        <div class="flex h-[68px] items-center justify-between">


            {{-- =================================================
                LADO ESQUERDO
            ================================================== --}}

            <div class="flex h-full items-center">


                {{-- LOGO --}}

                <div class="flex shrink-0 items-center">

                    <a
                        href="{{ auth()->user()->modalidade === 'ead'
                            ? route('dashboard.ead')
                            : route('dashboard.presencial') }}"
                        class="flex items-center gap-2"
                    >

                        <span class="text-xl font-extrabold tracking-tight text-gray-900">
                            Fatecie
                        </span>

                        <span class="text-xl font-extrabold tracking-tight text-orange-600">
                            Seguro
                        </span>

                        <span class="text-xl font-extrabold tracking-tight text-gray-700">
                            AI
                        </span>

                    </a>

                </div>


                {{-- =================================================
                    MENU DESKTOP
                ================================================== --}}

                <div class="ml-10 hidden h-full items-center gap-1 lg:flex">


                    {{-- DASHBOARD --}}

                    <a
                        href="{{ auth()->user()->modalidade === 'ead'
                            ? route('dashboard.ead')
                            : route('dashboard.presencial') }}"
                        class="relative flex h-full items-center px-4 text-sm font-semibold transition
                            {{ request()->routeIs('dashboard.ead', 'dashboard.presencial')
                                ? 'text-orange-600'
                                : 'text-gray-600 hover:text-gray-900' }}"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="mr-2 h-5 w-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 13.125 12 4l9 9.125M5.25 11.25V20h5.25v-5.25h3V20h5.25v-8.75"
                            />
                        </svg>

                        Dashboard


                        @if (request()->routeIs('dashboard.ead', 'dashboard.presencial'))

                            <span class="absolute inset-x-3 bottom-0 h-0.5 rounded-full bg-orange-500"></span>

                        @endif

                    </a>


                    {{-- ALUNOS --}}

                    <a
                        href="{{ route('alunos.index') }}"
                        class="relative flex h-full items-center px-4 text-sm font-semibold transition
                            {{ request()->routeIs('alunos.*')
                                ? 'text-orange-600'
                                : 'text-gray-600 hover:text-gray-900' }}"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="mr-2 h-5 w-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 0 0 3.375.622 9.34 9.34 0 0 0 3.375-.622M15 19.128v-.003c0-1.054-.59-2.01-1.53-2.488A8.95 8.95 0 0 0 9 15.75a8.95 8.95 0 0 0-4.47.887C3.59 17.115 3 18.071 3 19.125v.003M15 19.128c0-1.054-.59-2.01-1.53-2.488M9 15.75a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm6-5.25a3 3 0 1 0-6 0 3 3 0 0 0 6 0Z"
                            />
                        </svg>

                        Alunos


                        @if (request()->routeIs('alunos.*'))

                            <span class="absolute inset-x-3 bottom-0 h-0.5 rounded-full bg-orange-500"></span>

                        @endif

                    </a>


                    {{-- SEGUROS --}}

                    <a
                        href="{{ route('seguros.index') }}"
                        class="relative flex h-full items-center px-4 text-sm font-semibold transition
                            {{ request()->routeIs('seguros.*')
                                ? 'text-orange-600'
                                : 'text-gray-600 hover:text-gray-900' }}"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="mr-2 h-5 w-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 12.75 11.25 15 15 9.75M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9Z"
                            />
                        </svg>

                        Seguros


                        @if (request()->routeIs('seguros.*'))

                            <span class="absolute inset-x-3 bottom-0 h-0.5 rounded-full bg-orange-500"></span>

                        @endif

                    </a>


                    {{-- CURSOS --}}

                    <a
                        href="{{ route('cursos.index') }}"
                        class="relative flex h-full items-center px-4 text-sm font-semibold transition
                            {{ request()->routeIs('cursos.*')
                                ? 'text-orange-600'
                                : 'text-gray-600 hover:text-gray-900' }}"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="mr-2 h-5 w-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 14.25 3 9.75 12 5.25l9 4.5-9 4.5Z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 11.25v5.25c0 1.657 2.686 3 6 3s6-1.343 6-3v-5.25"
                            />
                        </svg>

                        Cursos


                        @if (request()->routeIs('cursos.*'))

                            <span class="absolute inset-x-3 bottom-0 h-0.5 rounded-full bg-orange-500"></span>

                        @endif

                    </a>


                    {{-- NÚCLEOS --}}

                    <a
                        href="{{ route('nucleos.index') }}"
                        class="relative flex h-full items-center px-4 text-sm font-semibold transition
                            {{ request()->routeIs('nucleos.*')
                                ? 'text-orange-600'
                                : 'text-gray-600 hover:text-gray-900' }}"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="mr-2 h-5 w-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3.75 21h16.5M4.5 21V10.5L12 3l7.5 7.5V21M8.25 21v-6h7.5v6M9 10.5h.008v.008H9V10.5Zm3 0h.008v.008H12V10.5Zm3 0h.008v.008H15V10.5Z"
                            />
                        </svg>

                        Núcleos


                        @if (request()->routeIs('nucleos.*'))

                            <span class="absolute inset-x-3 bottom-0 h-0.5 rounded-full bg-orange-500"></span>

                        @endif

                    </a>


                    {{-- CONFIGURAÇÕES --}}

                    <a
                        href="{{ route('configuracoes.index') }}"
                        class="relative flex h-full items-center px-4 text-sm font-semibold transition
                            {{ request()->routeIs('configuracoes.*')
                                ? 'text-orange-600'
                                : 'text-gray-600 hover:text-gray-900' }}"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="mr-2 h-5 w-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9.594 3.94c.09-.54.556-.94 1.104-.94h2.604c.548 0 1.014.4 1.104.94l.178 1.067a1.125 1.125 0 0 0 1.71.728l.91-.546a1.125 1.125 0 0 1 1.43.148l1.841 1.841c.388.388.446 1.01.148 1.43l-.546.91a1.125 1.125 0 0 0 .728 1.71l1.067.178c.54.09.94.556.94 1.104v2.604c0 .548-.4 1.014-.94 1.104l-1.067.178a1.125 1.125 0 0 0-.728 1.71l.546.91c.298.42.24 1.042-.148 1.43l-1.841 1.841a1.125 1.125 0 0 1-1.43.148l-.91-.546a1.125 1.125 0 0 0-1.71.728l-.178 1.067c-.09.54-.556.94-1.104.94h-2.604a1.125 1.125 0 0 1-1.104-.94l-.178-1.067a1.125 1.125 0 0 0-1.71-.728l-.91.546a1.125 1.125 0 0 1-1.43-.148l-1.841-1.841a1.125 1.125 0 0 1-.148-1.43l.546-.91a1.125 1.125 0 0 0-.728-1.71l-1.067-.178a1.125 1.125 0 0 1-.94-1.104v-2.604c0-.548.4-1.014.94-1.104l1.067-.178a1.125 1.125 0 0 0 .728-1.71l-.546-.91a1.125 1.125 0 0 1 .148-1.43l1.841-1.841a1.125 1.125 0 0 1 1.43-.148l.91.546a1.125 1.125 0 0 0 1.71-.728l.178-1.067Z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                            />
                        </svg>

                        Configurações


                        @if (request()->routeIs('configuracoes.*'))

                            <span class="absolute inset-x-3 bottom-0 h-0.5 rounded-full bg-orange-500"></span>

                        @endif

                    </a>

                </div>

            </div>


            {{-- =================================================
                LADO DIREITO
            ================================================== --}}

            <div class="hidden items-center gap-3 sm:flex">


                {{-- ALERTAS --}}

                <a
                    href="{{ route('seguros.index', [
                        'status' => [
                            'proximo_do_vencimento',
                            'vencido',
                        ]
                    ]) }}"
                    class="relative flex h-10 w-10 items-center justify-center rounded-lg text-gray-500 transition hover:bg-orange-50 hover:text-orange-600"
                    title="Alertas de seguros"
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
                            d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9a6 6 0 0 0-12 0v.75a8.967 8.967 0 0 1-2.31 6.022c1.733.64 3.553 1.09 5.454 1.31m5.713 0a24.255 24.255 0 0 1-5.713 0m5.713 0a3 3 0 1 1-5.713 0"
                        />
                    </svg>


                    @if ($alertasSeguros > 0)

                        <span class="absolute right-0.5 top-0.5 flex h-5 min-w-5 items-center justify-center rounded-full bg-red-600 px-1 text-[10px] font-bold text-white ring-2 ring-white">

                            {{ $alertasSeguros }}

                        </span>

                    @endif

                </a>


                {{-- DIVISOR --}}

                <div class="h-8 w-px bg-gray-200"></div>


                {{-- USUÁRIO --}}

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button
                            type="button"
                            class="flex items-center gap-3 rounded-lg px-2 py-2 text-left transition hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2"
                        >

                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-orange-100 text-sm font-bold text-orange-700">

                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                            </div>


                            <div class="hidden xl:block">

                                <p class="max-w-[150px] truncate text-sm font-semibold text-gray-800">
                                    {{ Auth::user()->name }}
                                </p>

                                <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                    {{ Auth::user()->modalidade }}
                                </p>

                            </div>


                            <svg
                                class="h-4 w-4 text-gray-400"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                />
                            </svg>

                        </button>

                    </x-slot>


                    <x-slot name="content">

                        <x-dropdown-link :href="route('profile.edit')">
                            Perfil
                        </x-dropdown-link>


                        <x-dropdown-link :href="route('configuracoes.index')">
                            Configurações
                        </x-dropdown-link>


                        <form
                            method="POST"
                            action="{{ route('logout') }}"
                        >

                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                            >
                                Sair
                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>


            {{-- =================================================
                BOTÃO MOBILE
            ================================================== --}}

            <div class="flex items-center lg:hidden">

                <button
                    @click="open = ! open"
                    class="inline-flex h-10 w-10 items-center justify-center rounded-lg text-gray-500 transition hover:bg-orange-50 hover:text-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2"
                >

                    <svg
                        class="h-6 w-6"
                        stroke="currentColor"
                        fill="none"
                        viewBox="0 0 24 24"
                    >

                        {{-- MENU --}}

                        <path
                            :class="{
                                'hidden': open,
                                'inline-flex': ! open
                            }"
                            class="inline-flex"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M4 6h16M4 12h16M4 18h16"
                        />


                        {{-- FECHAR --}}

                        <path
                            :class="{
                                'hidden': ! open,
                                'inline-flex': open
                            }"
                            class="hidden"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M6 18 18 6M6 6l12 12"
                        />

                    </svg>

                </button>

            </div>

        </div>

    </div>


    {{-- =========================================================
        MENU MOBILE
    ========================================================== --}}

    <div
        :class="{
            'block': open,
            'hidden': ! open
        }"
        class="hidden border-t border-gray-100 bg-white lg:hidden"
    >

        <div class="space-y-1 px-4 py-4">


            {{-- DASHBOARD --}}

            <a
                href="{{ auth()->user()->modalidade === 'ead'
                    ? route('dashboard.ead')
                    : route('dashboard.presencial') }}"
                class="flex items-center rounded-lg px-4 py-3 text-sm font-semibold transition
                    {{ request()->routeIs('dashboard.ead', 'dashboard.presencial')
                        ? 'bg-orange-50 text-orange-700'
                        : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.8"
                    stroke="currentColor"
                    class="mr-3 h-5 w-5"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 13.125 12 4l9 9.125M5.25 11.25V20h5.25v-5.25h3V20h5.25v-8.75"
                    />
                </svg>

                Dashboard

            </a>


            {{-- ALUNOS --}}

            <a
                href="{{ route('alunos.index') }}"
                class="flex items-center rounded-lg px-4 py-3 text-sm font-semibold transition
                    {{ request()->routeIs('alunos.*')
                        ? 'bg-orange-50 text-orange-700'
                        : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.8"
                    stroke="currentColor"
                    class="mr-3 h-5 w-5"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 19.128a9.38 9.38 0 0 0 3.375.622 9.34 9.34 0 0 0 3.375-.622M15 19.128v-.003c0-1.054-.59-2.01-1.53-2.488A8.95 8.95 0 0 0 9 15.75a8.95 8.95 0 0 0-4.47.887C3.59 17.115 3 18.071 3 19.125v.003M15 19.128c0-1.054-.59-2.01-1.53-2.488M9 15.75a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm6-5.25a3 3 0 1 0-6 0 3 3 0 0 0 6 0Z"
                    />
                </svg>

                Alunos

            </a>


            {{-- SEGUROS --}}

            <a
                href="{{ route('seguros.index') }}"
                class="flex items-center rounded-lg px-4 py-3 text-sm font-semibold transition
                    {{ request()->routeIs('seguros.*')
                        ? 'bg-orange-50 text-orange-700'
                        : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.8"
                    stroke="currentColor"
                    class="mr-3 h-5 w-5"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 12.75 11.25 15 15 9.75M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9Z"
                    />
                </svg>

                Seguros

            </a>


            {{-- CURSOS --}}

            <a
                href="{{ route('cursos.index') }}"
                class="flex items-center rounded-lg px-4 py-3 text-sm font-semibold transition
                    {{ request()->routeIs('cursos.*')
                        ? 'bg-orange-50 text-orange-700'
                        : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.8"
                    stroke="currentColor"
                    class="mr-3 h-5 w-5"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 14.25 3 9.75 12 5.25l9 4.5-9 4.5Z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 11.25v5.25c0 1.657 2.686 3 6 3s6-1.343 6-3v-5.25"
                    />
                </svg>

                Cursos

            </a>


            {{-- NÚCLEOS --}}

            <a
                href="{{ route('nucleos.index') }}"
                class="flex items-center rounded-lg px-4 py-3 text-sm font-semibold transition
                    {{ request()->routeIs('nucleos.*')
                        ? 'bg-orange-50 text-orange-700'
                        : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.8"
                    stroke="currentColor"
                    class="mr-3 h-5 w-5"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3.75 21h16.5M4.5 21V10.5L12 3l7.5 7.5V21M8.25 21v-6h7.5v6M9 10.5h.008v.008H9V10.5Zm3 0h.008v.008H12V10.5Zm3 0h.008v.008H15V10.5Z"
                    />
                </svg>

                Núcleos

            </a>


            {{-- CONFIGURAÇÕES --}}

            <a
                href="{{ route('configuracoes.index') }}"
                class="flex items-center rounded-lg px-4 py-3 text-sm font-semibold transition
                    {{ request()->routeIs('configuracoes.*')
                        ? 'bg-orange-50 text-orange-700'
                        : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.8"
                    stroke="currentColor"
                    class="mr-3 h-5 w-5"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9.594 3.94c.09-.54.556-.94 1.104-.94h2.604c.548 0 1.014.4 1.104.94l.178 1.067a1.125 1.125 0 0 0 1.71.728l.91-.546a1.125 1.125 0 0 1 1.43.148l1.841 1.841c.388.388.446 1.01.148 1.43l-.546.91a1.125 1.125 0 0 0 .728 1.71l1.067.178c.54.09.94.556.94 1.104v2.604c0 .548-.4 1.014-.94 1.104l-1.067.178a1.125 1.125 0 0 0-.728 1.71l.546.91c.298.42.24 1.042-.148 1.43l-1.841 1.841a1.125 1.125 0 0 1-1.43.148l-.91-.546a1.125 1.125 0 0 0-1.71.728l-.178 1.067c-.09.54-.556.94-1.104.94h-2.604a1.125 1.125 0 0 1-1.104-.94l-.178-1.067a1.125 1.125 0 0 0-1.71-.728l-.91.546a1.125 1.125 0 0 1-1.43-.148l-1.841-1.841a1.125 1.125 0 0 1-.148-1.43l.546-.91a1.125 1.125 0 0 0-.728-1.71l-1.067-.178a1.125 1.125 0 0 1-.94-1.104v-2.604c0-.548.4-1.014.94-1.104l1.067-.178a1.125 1.125 0 0 0 .728-1.71l-.546-.91a1.125 1.125 0 0 1 .148-1.43l1.841-1.841a1.125 1.125 0 0 1 1.43-.148l.91.546a1.125 1.125 0 0 0 1.71-.728l.178-1.067Z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                    />
                </svg>

                Configurações

            </a>

        </div>


        {{-- =====================================================
            USUÁRIO MOBILE
        ====================================================== --}}

        <div class="border-t border-gray-100 px-4 py-4">

            <div class="flex items-center gap-3 px-2">

                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-orange-100 text-sm font-bold text-orange-700">

                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                </div>


                <div class="min-w-0">

                    <p class="truncate text-sm font-semibold text-gray-800">
                        {{ Auth::user()->name }}
                    </p>

                    <p class="truncate text-xs text-gray-500">
                        {{ Auth::user()->email }}
                    </p>

                </div>

            </div>


            <div class="mt-4 space-y-1 border-t border-gray-100 pt-3">


                {{-- PERFIL --}}

                <a
                    href="{{ route('profile.edit') }}"
                    class="flex items-center rounded-lg px-4 py-3 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-gray-900"
                >

                    Perfil

                </a>


                {{-- ALERTAS --}}

                <a
                    href="{{ route('seguros.index', [
                        'status' => [
                            'proximo_do_vencimento',
                            'vencido',
                        ]
                    ]) }}"
                    class="flex items-center rounded-lg px-4 py-3 text-sm font-medium text-gray-600 transition hover:bg-orange-50 hover:text-orange-700"
                >

                    Alertas de seguros


                    @if ($alertasSeguros > 0)

                        <span class="ml-2 inline-flex min-w-5 items-center justify-center rounded-full bg-red-600 px-1 text-xs font-bold text-white">

                            {{ $alertasSeguros }}

                        </span>

                    @endif

                </a>


                {{-- SAIR --}}

                <form
                    method="POST"
                    action="{{ route('logout') }}"
                >

                    @csrf

                    <a
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="flex items-center rounded-lg px-4 py-3 text-sm font-medium text-red-600 transition hover:bg-red-50"
                    >

                        Sair

                    </a>

                </form>

            </div>

        </div>

    </div>

</nav>