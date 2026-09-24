<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Cadastrar seguro
            </h2>

            <a
                href="{{ route('seguros.index') }}"
                class="text-sm font-medium text-indigo-600 hover:text-indigo-800"
            >
                ← Voltar
            </a>
        </div>
    </x-slot>

    <div class="py-8">

        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            <div
                class="rounded-lg bg-white p-6 shadow"
                x-data="{
                    nucleo: '',
                    curso: '',
                    aluno: '',

                    cursos: {
                        @foreach ($nucleos as $nucleo)
                            '{{ $nucleo->id }}': [
                                @foreach ($nucleo->cursos as $curso)
                                    {
                                        id: '{{ $curso->id }}',
                                        nome: @js($curso->nome),

                                        alunos: [
                                            @foreach ($curso->alunos as $aluno)
                                                {
                                                    id: '{{ $aluno->id }}',
                                                    nome: @js($aluno->nome),
                                                    ra: @js($aluno->ra)
                                                },
                                            @endforeach
                                        ]
                                    },
                                @endforeach
                            ],
                        @endforeach
                    }
                }"
            >

                <form
                    method="POST"
                    action="{{ route('seguros.store') }}"
                >

                    @csrf

                    {{-- Núcleo --}}
                    <div class="mb-5">

                        <label
                            for="nucleo"
                            class="mb-1 block text-sm font-medium text-gray-700"
                        >
                            Núcleo
                        </label>

                        <select
                            id="nucleo"
                            x-model="nucleo"
                            @change="curso = ''; aluno = ''"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
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
                    <div class="mb-5">

                        <label
                            for="curso"
                            class="mb-1 block text-sm font-medium text-gray-700"
                        >
                            Curso
                        </label>

                        <select
                            id="curso"
                            x-model="curso"
                            @change="aluno = ''"
                            :disabled="!nucleo"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:bg-gray-100"
                        >

                            <option value="">
                                Selecione o curso
                            </option>

                            <template x-for="item in (cursos[nucleo] || [])" :key="item.id">

                                <option
                                    :value="item.id"
                                    x-text="item.nome"
                                ></option>

                            </template>

                        </select>

                    </div>

                    {{-- Aluno --}}
                    <div class="mb-5">

                        <label
                            for="aluno_id"
                            class="mb-1 block text-sm font-medium text-gray-700"
                        >
                            Aluno
                        </label>

                        <select
                            id="aluno_id"
                            name="aluno_id"
                            x-model="aluno"
                            required
                            :disabled="!curso"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:bg-gray-100"
                        >

                            <option value="">
                                Selecione o aluno
                            </option>

                            <template x-for="item in ((cursos[nucleo] || []).find(c => c.id == curso)?.alunos || [])" :key="item.id">

                                <option
                                    :value="item.id"
                                    x-text="item.nome + ' — RA: ' + item.ra"
                                ></option>

                            </template>

                        </select>

                        @error('aluno_id')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    {{-- Datas --}}
                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                        <div>

                            <label
                                for="data_inclusao"
                                class="mb-1 block text-sm font-medium text-gray-700"
                            >
                                Data de inclusão
                            </label>

                            <input
                                type="date"
                                id="data_inclusao"
                                name="data_inclusao"
                                value="{{ old('data_inclusao') }}"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('data_inclusao')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        <div>

                            <label
                                for="data_inicio"
                                class="mb-1 block text-sm font-medium text-gray-700"
                            >
                                Início do seguro
                            </label>

                            <input
                                type="date"
                                id="data_inicio"
                                name="data_inicio"
                                value="{{ old('data_inicio') }}"
                                required
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('data_inicio')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                    {{-- Data final --}}
                    <div class="mt-5">

                        <label
                            for="data_fim"
                            class="mb-1 block text-sm font-medium text-gray-700"
                        >
                            Fim do seguro
                        </label>

                        <input
                            type="date"
                            id="data_fim"
                            name="data_fim"
                            value="{{ old('data_fim') }}"
                            required
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >

                        @error('data_fim')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    {{-- Observação --}}
                    <div class="mt-5">

                        <label
                            for="observacao"
                            class="mb-1 block text-sm font-medium text-gray-700"
                        >
                            Observação
                        </label>

                        <textarea
                            id="observacao"
                            name="observacao"
                            rows="4"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Informações adicionais sobre o seguro..."
                        >{{ old('observacao') }}</textarea>

                        @error('observacao')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    {{-- Informação do status --}}
                    <div class="mt-6 rounded-md bg-blue-50 p-4">

                        <p class="text-sm text-blue-800">
                            O seguro será cadastrado inicialmente como
                            <strong>Aguardando inclusão</strong>.
                        </p>

                    </div>

                    {{-- Botões --}}
                    <div class="mt-8 flex items-center justify-end gap-3">

                        <a
                            href="{{ route('seguros.index') }}"
                            class="rounded-md bg-gray-200 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-300"
                        >
                            Cancelar
                        </a>

                        <button
                            type="submit"
                            class="rounded-md bg-indigo-600 px-5 py-2 text-sm font-medium text-white hover:bg-indigo-700"
                        >
                            Cadastrar seguro
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>