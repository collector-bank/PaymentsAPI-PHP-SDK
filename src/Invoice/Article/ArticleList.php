<?php

namespace Webbhuset\CollectorPaymentSDK\Invoice\Article;

use Webbhuset\CollectorPaymentSDK\Invoice\Rows\InvoiceRows;

class ArticleList
{
    protected $articles = [];

    public function __construct()
    {
    }

    public function addArticle($article)
    {
        $this->articles[] = $article;
    }

    public function getArticleBySku($sku)
    {
        foreach ($this->articles as $article) {
            if ($sku == $article->getSku()) {
                return $article;
            }
        }

        return false;
    }

    public function removeDecimalRounding()
    {
        $result = [];
        foreach ($this->articles as $article) {
            if (\Webbhuset\CollectorCheckout\Gateway\Config::CURRENCY_ROUNDING_SKU != $article->getSku()) {
                $result[] = $article;
            }
        }

        $this->articles = $result;
    }

    public function getDecimalRounding()
    {
        return $this->getArticleBySku(\Webbhuset\CollectorCheckout\Gateway\Config::CURRENCY_ROUNDING_SKU);
    }

    public function getShippingArticle()
    {
        return $this->getArticleBySku("Frakt");
    }

    public function getInvoiceRows():InvoiceRows
    {
        $invoiceRows = new InvoiceRows();
        /** @var Article $article */
        foreach ($this->articles as $article) {
            $invoiceRows->addInvoiceRow($article->toAdjustInvoiceRow());
        }

        return $invoiceRows;
    }

    public function getArticleList()
    {
        $result = [];
        foreach ($this->articles as $article) {
            $result[] = $article->toArray();
        }

        return $result;
    }
}
