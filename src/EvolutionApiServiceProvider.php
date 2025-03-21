<?php

namespace EvolutionApiPlugin;

use Illuminate\Support\ServiceProvider;

class EvolutionApiServiceProvider extends ServiceProvider
{
    /**
     * Registra o serviço no container do Laravel.
     */
    public function register()
    {
        // Registra a classe EvolutionApi no container do Laravel
        $this->app->singleton(EvolutionApi::class, function ($app) {
            // Configuração programática (pode ser ajustada para usar config ou .env)
            $apiKey = config('evolution.api_key'); // Chave da API
            $apiUrl = config('evolution.api_url', ''); // URL da API (com valor padrão)

            return new EvolutionApi($apiKey, $apiUrl);
        });
    }

    /**
     * Executa ações de inicialização, como publicar arquivos de configuração.
     */
    public function boot()
    {
        // Publica o arquivo de configuração (se necessário)
        $this->publishes([
            __DIR__ . '/../config/evolution.php' => config_path('evolution.php'),
        ], 'config');
    }
}