<?php

namespace Webbhuset\CollectorPaymentSDK\Errors;

class ResponseError extends \Exception
{
    protected $request;
    protected $soapError;

    public function __construct(
        \SoapFault $soapError,
        string $request,
        int $errorCode,
        string $errorString
    ) {
        $this->soapError = $soapError;
        $this->request = $request;

        parent::__construct($errorString, $errorCode);
    }

    /**
     *
     * Returns the SOAP request sent which resulted in an exception
     *
     * @return string SOAP request sent
     */
    public function getRequest(): string
    {
        return $this->request;
    }

    /**
     *
     * Returns the SoapFault exception to be used for debugging
     *
     * @return \SoapFault
     */
    public function getSoapError(): \SoapFault
    {
        return $this->soapError;
    }
}
