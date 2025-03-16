<?php

namespace src;

/**
 * Класс ProductParser парсит данные из json.
 */
class ProductParser
{
    /**
     * @var MetalProduct Объект металлопрокатного изделия
     */
    protected MetalProduct $metalProduct;

    /**
     * Конструктор класса ProductParser
     *
     * @param MetalProduct $metalProduct Экземпляр MetalProduct для парсинга
     */
    public function __construct(MetalProduct $metalProduct)
    {
        $this->metalProduct = $metalProduct;
    }

    /**
     * Получает объект MetalProduct
     *
     * @return MetalProduct
     */
    public function getMetalProduct(): MetalProduct
    {
        return $this->metalProduct;
    }

    /**
     * Парсит марку сплава из данных о продукте
     *
     * @return string|null Возвращает марку сплава или null, если не найдено
     */
    public function parseAlloy(): ?string
    {
        $alloy = $this->metalProduct->getAlloy();
        return !empty($alloy) ? $alloy : null;
    }

    /**
     * Парсит размеры изделия (толщина, ширина, длина)
     *
     * @return array Ассоциативный массив с ключами thickness, width, length
     */
    public function parseSize(): array
    {
        $size = $this->metalProduct->getSize();
        $title = $this->metalProduct->getTitle();

        $sizeString = (!empty($size) && $size !== '-') ? $size : $title;

        // https://www.php.net/manual/ru/regexp.reference.subpatterns.php
        if (preg_match('/(\d+(?:\.\d+)?)(?:\((\d+\+\d+)\))?x(\d+(?:\.\d+)?)x(\d+(?:\.\d+)?)/u', $sizeString, $matches)) {
            return [
                'thickness' => isset($matches[1]) ? (float)$matches[1] : null,
                'width' => isset($matches[3]) ? (float)$matches[3] : null,
                'length' => isset($matches[4]) ? (float)$matches[4] : null,
            ];
        }

        return ['thickness' => null, 'width' => null, 'length' => null];
    }

    /**
     * Парсит стандарт ГОСТ или ТУ
     *
     * @return string|null Возвращает стандарт или null, если не найдено
     */
    public function parseStandard(): ?string
    {
        $standard = $this->metalProduct->getStandard();
        $title = $this->metalProduct->getTitle();

        $standardString = (!empty($standard) && $standard !== '-') ? $standard : $title;

        if (preg_match('/ГОСТ\s\d+-\S+|ТУ\s\d+-\S+/u', $standardString, $matches)) {
            return $matches[0];
        }
        return ($standard !== '-' && !empty($standard)) ? $standard : null;
    }

    /**
     * Формирует строку с объединёнными параметрами продукта
     *
     * @return string Конкатенированная строка параметров
     */
    public function parseConcatenatedParams(): string
    {
        return implode('|', [
            $this->metalProduct->getCategory(),
            $this->metalProduct->getTitle(),
            $this->parseAlloy(),
            $this->metalProduct->getSize(),
            $this->parseStandard(),
            $this->metalProduct->getItemId()
        ]);
    }
}
