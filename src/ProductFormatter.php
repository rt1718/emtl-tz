<?php

namespace src;

/**
 * Класс ProductFormatter формирует новый массив.
 */
class ProductFormatter
{
    /**
     * @var ProductParser Экземпляр ProductParser для обработки данных товара.
     */
    protected ProductParser $parser;

    /**
     * Конструктор класса ProductFormatter.
     *
     * @param ProductParser $parser Экземпляр ProductParser.
     */
    public function __construct(ProductParser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * Форматирует данные о товаре в соответствии с требуемой структурой.
     *
     * @return array Отформатированные данные о товаре.
     */
    public function format(): array
    {
        return [
            'name' => $this->parser->getMetalProduct()->getCategory(),
            'columns' => [
                [
                    'col_name' => 'Марка',
                    'col_code' => 'item_steel_mark',
                    'value' => $this->parser->parseAlloy()
                ],
                [
                    'col_name' => 'Толщина',
                    'col_code' => 'item_wall',
                    'value' => $this->parser->parseSize()['thickness']
                ],
                [
                    'col_name' => 'Ширина',
                    'col_code' => 'item_width',
                    'value' => $this->parser->parseSize()['width']
                ],
                [
                    'col_name' => 'Длина',
                    'col_code' => 'item_length',
                    'value' => $this->parser->parseSize()['length']
                ],
                [
                    'col_name' => 'Стандарт',
                    'col_code' => 'item_standart',
                    'value' => $this->parser->parseStandard()
                ],
            ],
            'company_name' => 'ООО МеталлТорг',
            'company_city' => 'Москва',
            'item_price' => '50000',
            'item_count' => '100',
            'concatenated_params' => $this->parser->parseConcatenatedParams(),
        ];
    }
}
