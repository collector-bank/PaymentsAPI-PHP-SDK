<?php

namespace Webbhuset\CollectorPaymentSDK\Invoice;

use Webbhuset\CollectorPaymentSDK\Adapter\AdapterInterface as AdapterInterface;

class Administration
{
    protected $adapter;
    protected $invoiceStatusCodes =
        [
            0 => 'On hold',
            1 => 'Preliminary',
            2 => 'Canceled',
            3 => 'Delivered',
            4 => 'Expired',
            5 => 'Rejected',
            6 => 'Signing',
            7 => 'Strong customer verification'
        ];

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function partCreditInvoice(
        $invoiceNo,
        \Webbhuset\CollectorPaymentSDK\Invoice\Article\ArticleList $articleList,
        $correlationId = 0
    ): array {
        $data = [
            'CorrelationId' => $correlationId,
            'CreditDate'    => date("Y-m-d"),
            'InvoiceNo'     => $invoiceNo,
            'ArticleList'   => $articleList->getArticleList()
        ];

        $response = $this->adapter->partCreditInvoice($data);

        return $response;
    }

    public function partActivateInvoice(
        $invoiceNo,
        \Webbhuset\CollectorPaymentSDK\Invoice\Article\ArticleList $articleList,
        $correlationId = 0
    ): array {
        $data = [
            'CorrelationId' => $correlationId,
            'InvoiceNo'     => $invoiceNo,
            'ArticleList'   => $articleList->getArticleList()
        ];
        $idempotencyKey = $invoiceNo;

        $response = $this->adapter->partActivateInvoice($data, $idempotencyKey);

        return $response;
    }

    public function adjustInvoice(
        $invoiceNo,
        $invoiceRows,
        $correlationId = 0
    ): array {
        $data = [
            'CorrelationId' => $correlationId,
            'InvoiceNo'     => $invoiceNo,
            'InvoiceRows'   => $invoiceRows
        ];
        $response = $this->adapter->adjustInvoice($data);

        return $response;
    }

    public function activateInvoice($invoiceNo, $correlationId = 0): array
    {
        $data = [
            'CorrelationId' => $correlationId,
            'InvoiceNo' => $invoiceNo
        ];
        $response = $this->adapter->activateInvoice($data);

        return $response;
    }

    public function cancelInvoice($invoiceNo, $correlationId = 0): array
    {
        $data = [
            'CorrelationId' => $correlationId,
            'InvoiceNo' => $invoiceNo
        ];
        $response = $this->adapter->cancelInvoice($data);

        return $response;
    }

    public function creditInvoice($invoiceNo, $correlationId = 0): array
    {
        $data = [
            'CorrelationId' => $correlationId,
            'InvoiceNo' => $invoiceNo,
            'CreditDate' => date('c')
        ];
        $response = $this->adapter->creditInvoice($data);

        return $response;
    }

    public function getInvoiceInformation($invoiceNo, $clientIpAddress, $correlationId = 0): array
    {
        $data = [
            'CorrelationId' => $correlationId,
            'InvoiceNo' => $invoiceNo,
            'ClientIpAddress' => $clientIpAddress
        ];
        $response = $this->adapter->getInvoiceInformation($data);

        if (isset($response['Status'])) {
            $statusCode = (int)$response['Status'];
            $response['StatusText'] = $this->invoiceStatusCodes[$statusCode];
        }

        return $response;
    }
}
