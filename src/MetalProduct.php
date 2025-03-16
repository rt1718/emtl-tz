<?php

namespace src;

/**
 * Класс MetalProduct представляет товар и его характеристики.
 */
class MetalProduct
{
    /** @var string Категория товара (например, "Плита", "Пруток") */
    protected string $category;

    /** @var string Название товара (полное название из JSON) */
    protected string $title;

    /** @var string|null Сплав (марка металла), может отсутствовать */
    protected ?string $alloy;

    /** @var string|null Размеры (например, "11x1200x3000"), может отсутствовать */
    protected ?string $size;

    /** @var string|null Стандарт ГОСТ или ТУ, может отсутствовать */
    protected ?string $standard;

    /** @var string Уникальный идентификатор товара */
    protected string $itemId;

    /**
     * MetalProduct constructor.
     *
     * @param array $data Данные о товаре в виде массива.
     */
    public function __construct(array $data)
    {
        $this->category = $data['category'];
        $this->title = $data['title'];
        $this->alloy = $data['alloy'] ?? null;
        $this->size = $data['size'] ?? null;
        $this->standard = $data['standard'] ?? null;
        $this->itemId = $data['item_id'];
    }

    /**
     * Получить категорию товара.
     *
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * Получить название товара.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Получить сплав (марку металла).
     *
     * @return string|null
     */
    public function getAlloy(): ?string
    {
        return $this->alloy;
    }

    /**
     * Получить размеры товара.
     *
     * @return string|null
     */
    public function getSize(): ?string
    {
        return $this->size;
    }

    /**
     * Получить стандарт ГОСТ или ТУ.
     *
     * @return string|null
     */
    public function getStandard(): ?string
    {
        return $this->standard;
    }

    /**
     * Получить уникальный идентификатор товара.
     *
     * @return string
     */
    public function getItemId(): string
    {
        return $this->itemId;
    }
}
