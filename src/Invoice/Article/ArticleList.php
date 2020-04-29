<?php

namespace Webbhuset\CollectorPaymentSDK\Invoice\Article;

use Webbhuset\CollectorPaymentSDK\Adapter\AdapterInterface as AdapterInterface;

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
            if ("Currency rounding" != $article->getSku())
            {
                $result[] = $article;
            }
        }

        $this->articles = $result;
    }

    public function getDecimalRounding()
    {
        return $this->getArticleBySku("Currency rounding");
    }

    public function getShippingArticle()
    {
        return $this->getArticleBySku("");
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
