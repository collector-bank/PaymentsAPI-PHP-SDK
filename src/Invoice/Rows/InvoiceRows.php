<?php

namespace Webbhuset\CollectorPaymentSDK\Invoice\Rows;

use Webbhuset\CollectorPaymentSDK\Adapter\AdapterInterface as AdapterInterface;

class InvoiceRows
{
    protected $invoiceRows = [];

    public function __construct()
    {

    }

    public function addInvoiceRow(\Webbhuset\CollectorPaymentSDK\Invoice\Rows\InvoiceRow $invoiceRow)
    {
        $this->invoiceRows[] = $invoiceRow;
    }

    public function getInvoiceRows()
    {
        $result = [];
        foreach ($this->invoiceRows as $invoiceRow) {
            $result[] = $invoiceRow->toArray();
        }

        return $result;
    }
}
