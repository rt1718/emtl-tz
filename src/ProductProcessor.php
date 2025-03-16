<?php

namespace src;

/**
 * Класс ProductProcessor генерирует новый отформатированный массив
 * с нужными категориями, указанными в документации.
 */
class ProductProcessor
{
    /**
     * Обрабатывает массив товаров, фильтруя только металлопродукцию и форматируя их данные.
     *
     * @param array $products Входной массив товаров.
     * @return array Отфильтрованный и обработанный массив товаров.
     */
    public function process(array $products): array
    {
        $result = [];
        $metalCategories = [
            "Арматура", "Балка", "Баллоны", "Дробь", "Задвижки", "Заглушки", "Заготовки",
            "Катанка", "Канаты стальные", "Квадрат", "Краны шаровые", "Крепеж", "Круг",
            "Лента и штрипс", "Лист", "МВСП", "Металлочерепица", "Отводы", "Опоры",
            "Переходы", "Плита", "Поковка", "Полособульб", "Полоса", "Порошки и пудра",
            "Проволока", "Профиль", "Профнастил", "Рельсы", "Рулоны", "Сварочное оборудование",
            "Сетка", "Слитки", "Сэндвич-панели", "Тройники", "Труба", "Уголок", "Фланцы",
            "Чушки", "Швеллер", "Шестигранник", "Шина", "Шпунт", "Электроды"
        ];

        foreach ($products as $productData) {
            if (!in_array($productData['category'], $metalCategories, true)) {
                continue;
            }

            $product = new MetalProduct($productData);
            $parser = new ProductParser($product);
            $formatter = new ProductFormatter($parser);

            $result[$product->getItemId()] = $formatter->format();
        }

        return $result;
    }
}
