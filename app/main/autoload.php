<?php

/**
 * Autoloader simples para as classes do projeto
 */
spl_autoload_register(function ($className) {
    // Remove o namespace base
    $className = str_replace('App\\Main\\', '', $className);
    
    // Converte namespace separators para directory separators
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    
    // Define os diretórios base
    $baseDir = __DIR__ . DIRECTORY_SEPARATOR;
    
    // Mapeia os namespaces para diretórios
    $paths = [
        'Config' => $baseDir . 'config' . DIRECTORY_SEPARATOR,
        'Models' => $baseDir . 'models' . DIRECTORY_SEPARATOR,
    ];
    
    // Determina o caminho baseado no primeiro segmento do namespace
    $firstSegment = explode(DIRECTORY_SEPARATOR, $className)[0];
    $path = $paths[$firstSegment] ?? $baseDir;
    
    // Monta o caminho completo do arquivo
    $file = $path . $className . '.php';
    
    // Inclui o arquivo se existir
    if (file_exists($file)) {
        require_once $file;
    }
});

