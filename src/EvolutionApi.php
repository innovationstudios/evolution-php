<?php

namespace EvolutionApiPlugin;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class EvolutionApi
{
    protected $client;
    protected $apiUrl;
    protected $apiKey;

    /**
     * Construtor da classe.
     *
     * @param string $apiKey  Chave da API
     * @param string $apiUrl  URL da API (opcional, padrão: 'localhost:8080')
     */
    public function __construct($apiKey, $apiUrl = 'localhost:8080')
    {
        $this->apiKey = $apiKey;
        $this->apiUrl = $apiUrl;

        // Configura o cliente HTTP com o header apikey global
        $this->client = new Client([
            'base_uri' => $this->apiUrl,
            'headers' => [
                'accept' => 'application/json',
                'apikey' => $this->apiKey, // Header apikey global
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    /**
     * Cria uma nova instância.
     *
     * @param string $instanceName
     * @param string $token
     * @param bool $qrcode
     * @return array
     * @throws GuzzleException
     */
    public function createInstance($instanceName, $token, $qrcode = true)
    {
        $response = $this->client->post('/instance/create', [
            'json' => [
                'instanceName' => $instanceName,
                'token' => $token,
                'qrcode' => $qrcode,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * Lista informações de uma instância.
     *
     * @param string $instanceName
     * @return array
     * @throws GuzzleException
     */
    public function fetchInstance($instanceName)
    {
        $response = $this->client->get('/instance/fetchInstances', [
            'query' => [
                'instanceName' => $instanceName,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * Exclui uma instância.
     *
     * @param string $instanceName
     * @return array
     * @throws GuzzleException
     */
    public function deleteInstance($instanceName)
    {
        $response = $this->client->delete('/instance/delete', [
            'json' => [
                'instanceName' => $instanceName,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

     /**
     * Envia uma mensagem de texto.
     *
     * @param string $number       Número de telefone no formato internacional (ex: 5511999999999).
     * @param string $text         Texto da mensagem.
     * @param array  $options      Opções adicionais (opcional).
     * @param array  $mentions     Menções na mensagem (opcional).
     * @return array
     * @throws GuzzleException
     */
    public function sendTextMessage($number, $text, $options = [], $mentions = [])
    {
        // Estrutura básica da requisição
        $data = [
            'number' => $number,
            'textMessage' => [
                'text' => $text,
            ],
        ];  

        // Adiciona opções, se fornecidas
        if (!empty($options)) {
            $data['options'] = $options;
        }

        // Adiciona menções, se fornecidas
        if (!empty($mentions)) {
            if (!isset($data['options'])) {
                $data['options'] = []; // Garante que o campo 'options' exista
            }
            $data['options']['mentions'] = $mentions;
        }

        // Faz a requisição POST
        $response = $this->client->post('/message/sendText/evolution', [
            'json' => $data,
        ]);

        return json_decode($response->getBody(), true);
    }

}