# Evolution API Plugin

Este plugin facilita a integração com a API Evolution, permitindo criar instâncias, enviar mensagens e muito mais.

## Instalação

Instale o plugin via Composer:

```bash
composer require innovation-studios/evolution-api-plugin
```

### Configuração

#### Laravel

Se estiver usando Laravel, publique o arquivo de configuração:

```bash
php artisan vendor:publish --tag=config
```

Isso criará o arquivo `config/evolution.php`, onde você pode configurar a URL e a chave da API.

No arquivo `.env`, adicione as seguintes variáveis:

```env
EVOLUTION_API_URL=SEU_URL_AQUI
EVOLUTION_API_KEY=SUA_CHAVE_AQUI
```

#### Uso Direto (PHP Puro)

Se não estiver usando Laravel, configure a API diretamente ao instanciar a classe:

```php
use EvolutionApiPlugin\EvolutionApi;

$apiKey = 'SUA_CHAVE_AQUI';
$apiUrl = 'SEU_URL_AQUI'; // Opcional, padrão: 'http://82.29.62.194:8080'

$evolutionApi = new EvolutionApi($apiKey, $apiUrl);
```

## Métodos Disponíveis

### Criar Instância

```php
$response = $evolutionApi->createInstance(
    'exampleInstance', // Nome da instância
    'SEU_TOKEN_AQUI', // Token
    true // Gerar QR Code
);
```

### Enviar Mensagem de Texto

```php
$response = $evolutionApi->sendTextMessage(
    '5511999999999', // Número
    'Olá, mundo!',   // Texto da mensagem
    [                // Opções (opcional)
        'delay' => 2,
        'presence' => 'composing',
    ],
    [                // Menções (opcional)
        'everyone' => false,
        'mentioned' => ['fulano', 'ciclano'],
    ]
);
```

### Listar Instância

```php
$response = $evolutionApi->fetchInstance('exampleInstance');
```

### Excluir Instância

```php
$response = $evolutionApi->deleteInstance('exampleInstance');
```

## Exemplos

### Laravel

```php
use EvolutionApiPlugin\EvolutionApi;

class ExampleController extends Controller
{
    protected $evolutionApi;

    public function __construct(EvolutionApi $evolutionApi)
    {
        $this->evolutionApi = $evolutionApi;
    }

    public function sendMessage()
    {
        $response = $this->evolutionApi->sendTextMessage(
            '5511999999999', // Número
            'Olá, mundo!'    // Texto da mensagem
        );

        return response()->json($response);
    }
}
```

### PHP Puro

```php
use EvolutionApiPlugin\EvolutionApi;

$apiKey = 'SUA_CHAVE_AQUI';
$evolutionApi = new EvolutionApi($apiKey);

$response = $evolutionApi->sendTextMessage(
    '5511999999999', // Número
    'Olá, mundo!'    // Texto da mensagem
);

print_r($response);
```

## Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues ou pull requests.

## Licença

Este projeto está licenciado sob a licença MIT. Veja o arquivo LICENSE para mais detalhes.
