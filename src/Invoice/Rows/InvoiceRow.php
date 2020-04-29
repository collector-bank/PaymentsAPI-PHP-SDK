<?php

namespace Webbhuset\CollectorPaymentSDK\Invoice\Rows;

use Webbhuset\CollectorPaymentSDK\Adapter\AdapterInterface as AdapterInterface;

class InvoiceRow
{
    protected $articleId;
    protected $description;
    protected $quantity;
    protected $unitPrice;
    protected $vat;

    public function __construct(
        string $articleId,
        string $description,
        int $quantity,
        float $unitPrice,
        float $vat
    ) {
        $this->articleId    = $articleId;
        $this->description  = $description;
        $this->quantity     = $quantity;
        $this->unitPrice    = $unitPrice;
        $this->vat          = $vat;
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
     * @return float
     */
    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    /**
     * @param float $unitPrice
     */
    public function setUnitPrice(float $unitPrice)
    {
        $this->unitPrice = $unitPrice;
    }

    /**
     * @return float
     */
    public function getVat(): float
    {
        return $this->vat;
    }

    /**
     * @param float $vat
     */
    public function setVat(float $vat)
    {
        $this->vat = $vat;
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
            'UnitPrice'     => $this->unitPrice,
            'VAT'           => $this->vat
        ];
    }
}
