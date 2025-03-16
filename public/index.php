<?php
require __DIR__ . '/../vendor/autoload.php';

use src\ProductProcessor;

// Загружаем JSON-файл с данными.
$json = file_get_contents(__DIR__ . '/../storage/data.json');

// Декодируем JSON в ассоциативный массив.
$data = json_decode($json, true);

// Создаём экземпляр класса ProductProcessor.
$processor = new ProductProcessor();

// Обрабатываем данные и получаем отфильтрованный массив.
$parsedData = $processor->process($data);

/**
 * Выводим результат с помощью dd() для отладки.
 * Люблю ларавел, поэтому использую dd.
 */
dd($parsedData);
