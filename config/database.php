<?php

$defaultDatabaseEnvironment = 'local'; // Troque para 'production' para usar a hospedagem

function getDatabaseConnection($environment = null)
{
    $environment = $environment ?: (getenv('DB_ENV') ?: $GLOBALS['defaultDatabaseEnvironment'] ?? 'local');

    $configs = [
        'local' => [
            'host' => 'localhost',
            'user' => 'root',
            'password' => '',
            'name' => 'lista_compras',
        ],
        'production' => [
            'host' => 'sql308.infinityfree.com',
            'user' => 'if0_42307329',
            'password' => 'Jordinho159',
            'name' => 'if0_42307329_lista_compras',
        ],
    ];

    if (!isset($configs[$environment])) {
        throw new RuntimeException("Ambiente de banco não configurado: {$environment}");
    }

    $config = $configs[$environment];
    $connection = new mysqli($config['host'], $config['user'], $config['password'], $config['name']);

    if ($connection->connect_error) {
        throw new RuntimeException('Falha na conexão com o banco: ' . $connection->connect_error);
    }

    $connection->set_charset('utf8mb4');

    return $connection;
}
