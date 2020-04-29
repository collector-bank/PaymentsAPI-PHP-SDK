<?php

namespace Webbhuset\CollectorPaymentSDK\Adapter;

use Webbhuset\CollectorPaymentSDK\Adapter\AdapterInterface as AdapterInterface;
use Webbhuset\CollectorPaymentSDK\Config\ConfigInterface as ConfigInterface;

class MockAdapter implements AdapterInterface
{

    protected $config;

    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }

    public function activateInvoice(array $data): array
    {
        $correlationId = "0";
        if (isset($data['CorrelationId'])) {
            $correlationId = $data['CorrelationId'];
        }

        $twoWeeksFromNow = date('c', strtotime('+2 weeks'));

        return [
            'CorrelationId' => $correlationId,
            'DueDate' => $twoWeeksFromNow,
            'InvoiceUrl' => 'https://invoice-test.collectorbank.com/invoice',
            'LowestAmountToPay' => '50.00',
            'PaymentReference' => '100012345678910',
            'TotalAmount' => '100.00'
        ];
    }

    public function cancelInvoice(array $data): array
    {
        $correlationId = "0";
        if (isset($data['CorrelationId'])) {
            $correlationId = $data['CorrelationId'];
        }

        return [
            'CorrelationId' => $correlationId,
        ];
    }

    public function creditInvoice(array $data): array
    {
        $correlationId = "0";
        if (isset($data['CorrelationId'])) {
            $correlationId = $data['CorrelationId'];
        }

        return [
            'CorrelationId' => $correlationId,
        ];
    }

    public function getInvoiceInformation(array $data): array
    {
        $correlationId = "0";
        if (isset($data['CorrelationId'])) {
            $correlationId = $data['CorrelationId'];
        }

        return [
            'CorrelationId' => $correlationId,
            'Status' => 3,
            'StatusText' => 'Delivered'
        ];
    }

}