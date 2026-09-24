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
                                d="M3 7.5 12 3l9 4.5M4.5 9.75v8.25L12 21l7.5-3V9.75M12 12l9-4.5M12 12v9"
                            />
                        </svg>

                    </div>

                    <div>

                        <p class="text-xs font-extrabold uppercase tracking-[0.2em] text-orange-600">
                            Fatecie Seguro AI
                        </p>

                        <h1 class="mt-0.5 text-3xl font-extrabold tracking-tight text-gray-950">
                            Editar curso
                        </h1>

                    </div>

                </div>

                <p class="mt-4 max-w-2xl text-sm font-medium leading-6 text-gray-600">
                    Atualize as informações do curso e sua vinculação ao núcleo.
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
                                d="M12 9v3.75m0 3h.008v.008H12v-.008ZM10.343 3.94l-7.06 12.25A1.875 1.875 0 0 0 4.908 19h14.184a1.875 1.875 0 0 0 1.625-1.875 1.875 1.875 0 0 0-.25-.935l-7.06-12.25a1.875 1.875 0 0 0-3.314 0Z"
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

                    nucleos: {
                        @foreach ($nucleos as $nucleo)
                            '{{ $nucleo->id }}': {
                                nome: @js($nucleo->nome),
                                modalidade: @js(
                                    $nucleo->modalidade === 'presencial'
                                        ? 'Presencial'
                                        : 'EAD'
                                )
                            },
                        @endforeach
                    },

                    dadosConfirmacao: {
                        nucleo: '',
                        modalidade: '',
                        nome: '{{ old('nome', $curso->nome) }}',
                        status: '{{ old('ativo', $curso->ativo) == 1 ? 'Ativo' : 'Inativo' }}'
                    },

                    abrirModalConfirmacao() {

                        const form = this.$refs.form;

                        if (!form.checkValidity()) {
                            form.reportValidity();
                            return;
                        }

                        const nucleoId = document.getElementById('nucleo_id').value;
                        const nome = document.getElementById('nome').value;
                        const ativo = document.getElementById('ativo').value;

                        const nucleo = this.nucleos[nucleoId];

                        this.dadosConfirmacao = {
                            nucleo: nucleo ? nucleo.nome : 'Não informado',
                            modalidade: nucleo ? nucleo.modalidade : 'Não informada',
                            nome: nome,
                            status: ativo === '1' ? 'Ativo' : 'Inativo'
                        };

                        this.modalConfirmacao = true;
                    }
                }"
            >

                {{-- FORMULÁRIO --}}
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
                                        d="M3 7.5 12 3l9 4.5M4.5 9.75v8.25L12 21l7.5-3V9.75M12 12l9-4.5M12 12v9"
                                    />
                                </svg>

                            </div>

                            <div>

                                <h2 class="text-xl font-extrabold text-gray-950">
                                    Dados do curso
                                </h2>

                                <p class="mt-1 text-sm font-medium text-gray-600">
                                    Atualize o núcleo, nome e status do curso.
                                </p>

                            </div>

                        </div>

                    </div>

                    <form
                        x-ref="form"
                        method="POST"
                        action="{{ route('cursos.update', $curso) }}"
                    >

                        @csrf
                        @method('PUT')

                        <div class="p-6">

                            <div class="grid gap-6 md:grid-cols-2">

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
                                        class="mt-2 block w-full rounded-xl border-gray-300 px-4 py-3 text-sm font-medium text-gray-900 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                                    >

                                        @foreach ($nucleos as $nucleo)

                                            <option
                                                value="{{ $nucleo->id }}"
                                                @selected(old('nucleo_id', $curso->nucleo_id) == $nucleo->id)
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

                                    <p class="mt-2 text-xs font-medium text-gray-500">
                                        O curso só pode ser vinculado a um núcleo da sua modalidade.
                                    </p>

                                </div>

                                {{-- NOME --}}
                                <div>

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
                                        value="{{ old('nome', $curso->nome) }}"
                                        required
                                        autofocus
                                        class="mt-2 block w-full rounded-xl border-gray-300 px-4 py-3 text-sm font-medium text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-orange-500 focus:ring-orange-500"
                                    >

                                    @error('nome')

                                        <p class="mt-2 text-sm font-semibold text-red-600">
                                            {{ $message }}
                                        </p>

                                    @enderror

                                </div>

                                {{-- STATUS --}}
                                <div>

                                    <label
                                        for="ativo"
                                        class="block text-sm font-extrabold text-gray-800"
                                    >
                                        Status
                                    </label>

                                    <select
                                        id="ativo"
                                        name="ativo"
                                        class="mt-2 block w-full rounded-xl border-gray-300 px-4 py-3 text-sm font-medium text-gray-900 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                                    >

                                        <option
                                            value="1"
                                            @selected(old('ativo', $curso->ativo) == 1)
                                        >
                                            Ativo
                                        </option>

                                        <option
                                            value="0"
                                            @selected(old('ativo', $curso->ativo) == 0)
                                        >
                                            Inativo
                                        </option>

                                    </select>

                                </div>

                            </div>

                        </div>

                        {{-- AÇÕES --}}
                        <div class="flex flex-col-reverse gap-3 border-t border-gray-200 bg-gray-50 px-6 py-4 sm:flex-row sm:justify-end">

                            <a
                                href="{{ route('cursos.index') }}"
                                class="inline-flex items-center justify-center rounded-xl bg-white px-5 py-3 text-sm font-bold text-gray-700 shadow-sm ring-1 ring-gray-300 transition hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2"
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
                                        d="m4.5 12.75 6 6 9-13.5"
                                    />
                                </svg>

                                Salvar alterações

                            </button>

                        </div>

                    </form>

                </div>

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
                                            d="M3 7.5 12 3l9 4.5M4.5 9.75v8.25L12 21l7.5-3V9.75M12 12l9-4.5M12 12v9"
                                        />
                                    </svg>

                                </div>

                                <div>

                                    <h2
                                        id="modal-confirmacao-titulo"
                                        class="text-lg font-extrabold text-gray-950"
                                    >
                                        Confirmar alterações
                                    </h2>

                                    <p class="mt-1 text-sm font-medium text-gray-600">
                                        Confira os dados antes de salvar as alterações.
                                    </p>

                                </div>

                            </div>

                        </div>

                        {{-- RESUMO --}}
                        <div class="px-6 py-6">

                            <div class="divide-y divide-gray-200 rounded-xl border border-gray-200">

                                {{-- NÚCLEO --}}
                                <div class="px-4 py-4">

                                    <p class="text-xs font-extrabold uppercase tracking-wide text-gray-500">
                                        Núcleo
                                    </p>

                                    <p
                                        class="mt-1 text-sm font-bold text-gray-950"
                                        x-text="dadosConfirmacao.nucleo || 'Não informado'"
                                    ></p>

                                </div>

                                {{-- MODALIDADE --}}
                                <div class="px-4 py-4">

                                    <p class="text-xs font-extrabold uppercase tracking-wide text-gray-500">
                                        Modalidade
                                    </p>

                                    <p
                                        class="mt-1 text-sm font-bold text-gray-950"
                                        x-text="dadosConfirmacao.modalidade || 'Não informada'"
                                    ></p>

                                </div>

                                {{-- NOME --}}
                                <div class="px-4 py-4">

                                    <p class="text-xs font-extrabold uppercase tracking-wide text-gray-500">
                                        Nome do curso
                                    </p>

                                    <p
                                        class="mt-1 text-sm font-bold text-gray-950"
                                        x-text="dadosConfirmacao.nome || 'Não informado'"
                                    ></p>

                                </div>

                                {{-- STATUS --}}
                                <div class="px-4 py-4">

                                    <p class="text-xs font-extrabold uppercase tracking-wide text-gray-500">
                                        Status
                                    </p>

                                    <p
                                        class="mt-1 text-sm font-bold text-gray-950"
                                        x-text="dadosConfirmacao.status"
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
                                        Confirme os dados para salvar as alterações do curso.
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

                                Confirmar alterações

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>

