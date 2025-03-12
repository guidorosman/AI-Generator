<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MistralAI
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('MISTRAL_API_KEY');
    }

    public function generateText($prompt)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post('https://api.mistral.ai/v1/chat/completions', [
            'model' => 'mistral-medium',
            'messages' => [['role' => 'user', 'content' => $prompt]],
        ]);

        return $response->json()['choices'][0]['message']['content'] ?? 'There was an error generating the text with AI';
    }
}
