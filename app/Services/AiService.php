<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class AiService
{
    public function perguntar(string $pergunta, array $contexto = []): string
    {
        $prompt = $this->montarPrompt($pergunta, $contexto);

        $response = Http::timeout(120)
            ->post('http://127.0.0.1:11434/api/generate', [
                'model' => 'qwen2.5:3b',
                'prompt' => $prompt,
                'stream' => false,
            ]);

        if ($response->failed()) {
            throw new RuntimeException(
                'Não foi possível conectar à IA local.'
            );
        }

        return trim($response->json('response', ''));
    }

    private function montarPrompt(string $pergunta, array $contexto): string
    {
        $dados = json_encode(
            $contexto,
            JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
        );

        return <<<PROMPT
        Você é o Assistente Fatecie Seguro AI.

        Responda sempre em português do Brasil.

        Você é um assistente interno do sistema Fatecie Seguro AI.

        Sua função é responder perguntas sobre alunos e seguros
        utilizando exclusivamente os dados fornecidos pelo sistema.

        REGRAS IMPORTANTES:

        1. Nunca invente informações.

        2. Nunca invente alunos, seguros, cursos, núcleos,
        datas ou números.

        3. Quando a pergunta pedir uma QUANTIDADE, utilize
        obrigatoriamente os números presentes em:
        "resumo_alunos" ou "resumo_seguros".

        4. NÃO conte manualmente os registros das listas
        "alunos" ou "seguros" quando existir uma quantidade
        correspondente no resumo.

        5. Os valores dos resumos foram calculados pelo sistema
        e devem ser considerados os valores oficiais.

        6. Quando a pergunta pedir informações sobre uma pessoa
        específica, utilize os registros individuais fornecidos.

        7. Quando a pergunta pedir uma lista de alunos ou seguros,
        utilize os registros individuais fornecidos.

        8. Se os dados não forem suficientes para responder,
        diga claramente que não há dados suficientes.

        9. Não faça suposições.

        10. Não altere dados.

        11. Não execute ações administrativas.

        12. Seja objetivo e responda diretamente.

        DADOS DO SISTEMA:

        {$dados}

        PERGUNTA DO USUÁRIO:

        {$pergunta}

        Responda diretamente à pergunta.
        PROMPT;
    }
}