<?php

namespace Webbhuset\CollectorPaymentSDK\Adapter;

use Webbhuset\CollectorPaymentSDK\Adapter\AdapterInterface as AdapterInterface;
use Webbhuset\CollectorPaymentSDK\Config\ConfigInterface as ConfigInterface;
use Webbhuset\CollectorPaymentSDK\Errors\ResponseError as ResponseError;

class SoapAdapter implements AdapterInterface
{
    protected $config;

    protected $invoiceServiceUrl = "https://ecommerce.collector.se/v3.0/PaymentServicev9.svc?wsdl";
    protected $testInvoiceServiceUrl = "https://ecommercetest.collector.se/v3.0/PaymentServicev9.svc?wsdl";
    protected $invoiceServiceNamespace = "http://schemas.ecommerce.collector.se/v30/PaymentService";

    protected $activateInvoiceFunction = "ActivateInvoice";
    protected $cancelInvoiceFunction = "CancelInvoice";
    protected $creditInvoiceFunction = "CreditInvoice";
    protected $getInvoiceInformationFunction = "GetInvoiceInformation";
    protected $partActivateInvoiceFunction = 'PartActivateInvoice';
    protected $partCreditInvoiceFunction = 'PartCreditInvoice';
    protected $adjustInvoiceFunction = 'AdjustInvoice';

    protected $baseBodyData;

    protected $soapClientOptions = [
        "trace" => 1,
        'encoding'=>' UTF-8'
    ];

    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;

        $this->baseBodyData = [
            'CountryCode' => $config->getCountryCode(),
            'StoreId' => $config->getStoreId(),
        ];
    }

    public function activateInvoice(array $data): array
    {
        $bodyData = array_merge($data, $this->baseBodyData);
        $url = $this->getInvoiceServiceUrl();

        $response = $this->sendRequest($url, $this->activateInvoiceFunction, $bodyData);

        return $response;
    }

    public function adjustInvoice(array $data): array
    {
        $bodyData = array_merge($data, $this->baseBodyData);
        $url = $this->getInvoiceServiceUrl();

        $response = $this->sendRequest($url, $this->adjustInvoiceFunction, $bodyData);

        return $response;
    }

    public function cancelInvoice(array $data): array
    {
        $bodyData = array_merge($data, $this->baseBodyData);
        $url = $this->getInvoiceServiceUrl();

        $response = $this->sendRequest($url, $this->cancelInvoiceFunction, $bodyData);

        return $response;
    }

    public function creditInvoice(array $data): array
    {
        $bodyData = array_merge($data, $this->baseBodyData);
        $url = $this->getInvoiceServiceUrl();

        $response = $this->sendRequest($url, $this->creditInvoiceFunction, $bodyData);

        return $response;
    }


    public function getInvoiceInformation(array $data): array
    {
        $bodyData = array_merge($data, $this->baseBodyData);
        $url = $this->getInvoiceServiceUrl();

        $response = $this->sendRequest($url, $this->getInvoiceInformationFunction, $bodyData);

        return $response;
    }


    private function getInvoiceServiceUrl(): string
    {
        if ($this->config->isTestMode()) {

            return $this->testInvoiceServiceUrl;
        }

        return $this->invoiceServiceUrl;
    }


    public function partActivateInvoice(array $data): array
    {
        $bodyData = array_merge($data, $this->baseBodyData);
        $url = $this->getInvoiceServiceUrl();

        $response = $this->sendRequest($url, $this->partActivateInvoiceFunction, $bodyData);

        return $response;
    }

    public function partCreditInvoice(array $data) : array
    {
        $bodyData = array_merge($data, $this->baseBodyData);

        $url = $this->getInvoiceServiceUrl();

        $response = $this->sendRequest($url, $this->partCreditInvoiceFunction, $bodyData);

        return $response;
    }

    private function soapResponseToArray($soapResponse): array
    {
        $soapResponse = json_decode(json_encode($soapResponse), true);

        return $soapResponse;
    }


    private function getSoapHeader(): array
    {
        $ns = $this->invoiceServiceNamespace;

        $header[] = new \SoapHeader($ns, 'Username', $this->config->getUsername());
        $header[] = new \SoapHeader($ns, 'Password', $this->config->getPassword());

        return $header;
    }


    /**
     *
     * Sends a SOAP request
     *
     * @param string url
     * @param string $action
     * @param array  $bodyData
     *
     * @throws ResponseError
     * @throws \SoapFault
     *
     * @return array response
     */
    public function sendRequest(string $url,string $action, array $bodyData): array
    {

        $soapClient = new \SoapClient(
            $url,
            $this->soapClientOptions
        );

        $header = $this->getSoapHeader();
        $soapClient->__setSoapHeaders($header);

        try{
            $response = $soapClient->__soapCall($action,[$bodyData]);

            return $this->soapResponseToArray($response);

        } catch (\SoapFault $e){
            $lastRequest = (string)$soapClient->__getLastRequest();
            $responseError = new ResponseError($e, $lastRequest,$e->getCode(),$e->getMessage());

            throw $responseError;
        }
    }


}