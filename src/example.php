<?php

/**
 * Exemplo de Uso do Evolution API Plugin
 *
 * Este arquivo demonstra a lógica de uso do Evolution API Plugin para interagir com a API Evolution.
 * Ele serve como um guia de referência para implementação em projetos reais.
 *
 * @package EvolutionApiPlugin
 */

require 'vendor/autoload.php';

use EvolutionApiPlugin\EvolutionApi;

// Configuração da API
$apiKey = ''; // Substitua pela sua chave da API
$apiUrl = ''; // Substitua pela URL da API, se necessário

// Instancia o plugin
$evolutionApi = new EvolutionApi($apiKey, $apiUrl);

// 1. Criar uma Instância
try {
    $instanceName = 'exampleInstance';
    $token = '';
    $qrcode = true;

    $response = $evolutionApi->createInstance($instanceName, $token, $qrcode);
    // $response contém os dados da instância criada
} catch (Exception $e) {
    // Trate o erro de criação da instância
}

// 2. Enviar uma Mensagem de Texto
try {
    $number = '5511999999999'; // Número de telefone no formato internacional
    $text = 'Olá, mundo!';     // Texto da mensagem
    $options = [               // Opções (opcional)
        'delay' => 2,          // Atraso de 2 segundos
        'presence' => 'composing', // Indicador de "digitando"
    ];
    $mentions = [              // Menções (opcional)
        'everyone' => false,
        'mentioned' => ['fulano', 'ciclano'],
    ];

// Exemplo de envio de texto
$response = $evolutionApi->sendTextMessage($instanceName, $number, 'Olá, esta é uma mensagem de texto!');    // $response contém o resultado do envio da mensagem
} catch (Exception $e) {
    // Trate o erro de envio da mensagem
}

// 3. Listar Informações de uma Instância
try {
    $instanceName = 'exampleInstance';

    $response = $evolutionApi->fetchInstance($instanceName);
    // $response contém as informações da instância
} catch (Exception $e) {
    // Trate o erro de listagem da instância
}

// 4. Excluir uma Instância
try {
    $instanceName = 'exampleInstance';

    $response = $evolutionApi->deleteInstance($instanceName);
    // $response contém o resultado da exclusão da instância
} catch (Exception $e) {
    // Trate o erro de exclusão da instância
}


// Exemplo de envio de lista
$listMessage = [
    'title' => 'Título da Lista',
    'description' => 'Descrição da Lista',
    'footerText' => 'Texto do Rodapé',
    'buttonText' => 'Texto do Botão',
    'sections' => [
        [
            'title' => 'Seção 1',
            'rows' => [
                [
                    'title' => 'Item 1',
                    'description' => 'Descrição do Item 1',
                    'rowId' => 'item1',
                ],
                [
                    'title' => 'Item 2',
                    'description' => 'Descrição do Item 2',
                    'rowId' => 'item2',
                ],
            ],
        ],
    ],
];

$response = $evolutionApi->sendList($instanceName, $number, $listMessage);
print_r($response);

// Exemplo de envio de mídia
$mediaMessage = [
    'mediatype' => 'image',
    'fileName' => 'foto.jpg',
    'caption' => 'Esta é uma imagem de exemplo',
    'media' => 'https://exemplo.com/foto.jpg', // URL ou base64 da mídia
];
$response = $evolutionApi->sendMediaMessage($instanceName, $number, $mediaMessage);
print_r($response);