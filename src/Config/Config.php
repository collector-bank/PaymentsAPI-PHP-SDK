<?php

namespace Webbhuset\CollectorPaymentSDK\Config;

use Webbhuset\CollectorPaymentSDK\Config\ConfigInterface as ConfigInterface;

class Config implements ConfigInterface
{

    protected $username;
    protected $password;
    protected $storeId;
    protected $countryCode;
    protected $mode = "production";

    public function __construct()
    {

    }

    /**
     *
     * Sets the username
     *
     * @param string $username
     * @return $this
     */
    public function setUsername(string $username)
    {
        $this->username = $username;

        return $this;
    }


    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     *
     * Sets the password
     *
     * @param string $password
     * @return $this
     */
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     *
     * Sets the storeId
     *
     * @param int $storeId
     * @return $this
     */
    public function setStoreId(int $storeId)
    {
        $this->storeId = $storeId;

        return $this;
    }

    public function getStoreId(): string
    {
        return $this->storeId;
    }

    /**
     *
     * Sets the country code
     *
     * @param string $countryCode
     * @return $this
     */
    public function setCountryCode(string $countryCode)
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }


    /**
     *
     * Sets test mode
     *
     * @return $this
     */
    public function setTestMode()
    {
        $this->mode = "test";

        return $this;
    }

    /**
     *
     * Sets production mode. Production mode is default mode if nothing is set.
     *
     * @return $this
     */
    public function setProductionMode()
    {
        $this->mode = "production";

        return $this;
    }

    public function isTestMode(): bool
    {
        return $this->mode == 'test';
    }

    public function isProductionMode(): bool
    {
        return $this->mode == 'production';
    }
}