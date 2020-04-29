<?php

namespace Webbhuset\CollectorPaymentSDK\Invoice\Article;

use Webbhuset\CollectorPaymentSDK\Adapter\AdapterInterface as AdapterInterface;

class Article
{
    protected $articleId;
    protected $description;
    protected $quantity;
    protected $sku;

    public function __construct(
        string $articleId,
        string $description,
        int $quantity,
        string $sku=""
    ) {
        $this->articleId    = $articleId;
        $this->description  = $description;
        $this->quantity     = $quantity;
        $this->sku          = $sku;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     */
    public function setSku(string $sku)
    {
        $this->sku = $sku;
    }

    /**
     * @return string
     */
    public function getArticleId(): string
    {
        return $this->articleId;
    }

    /**
     * @param string $articleId
     */
    public function setArticleId(string $articleId)
    {
        $this->articleId = $articleId;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }

    public function toArray()
    {
        return [
            'ArticleId'     => $this->articleId,
            'Description'   => $this->description,
            'Quantity'      => $this->quantity,
        ];
    }
}
