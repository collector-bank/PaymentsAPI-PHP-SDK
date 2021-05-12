<?php

namespace Webbhuset\CollectorPaymentSDK\Invoice\Article;

use Webbhuset\CollectorPaymentSDK\Invoice\Rows\InvoiceRow;

class Article
{
    protected $articleId;
    protected $description;
    protected $quantity;
    protected $sku;
    protected $unitPrice;
    protected $vat;

    public function __construct(
        string $articleId,
        string $description,
        int $quantity,
        string $sku="",
        float $unitPrice = 0,
        float $vat = 0
    ) {
        $this->articleId    = $articleId;
        $this->description  = $description;
        $this->quantity     = $quantity;
        $this->sku          = $sku;
        $this->unitPrice    = $unitPrice;
        $this->vat          = $vat;
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

    public function toInvoiceRow()
    {
        return new InvoiceRow(
            (string) $this->articleId,
            (string) $this->description,
            (int) $this->quantity,
            (float) $this->unitPrice,
            (float) $this->vat
        );
    }


    public function toAdjustInvoiceRow()
    {
        return new InvoiceRow(
            (string) $this->articleId,
            (string) $this->description,
            (int) $this->quantity,
            (float) $this->unitPrice * (-1),
            (float) $this->vat
        );
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
