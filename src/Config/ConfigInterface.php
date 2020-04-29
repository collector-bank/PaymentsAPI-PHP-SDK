<?php

namespace Webbhuset\CollectorPaymentSDK\Config;

/**
 * Interface ConfigInterface
 *
 * @package Config
 */
interface ConfigInterface
{
    /**
     *
     * Gets the username
     *
     * @return string $username
     */
    public function getUsername(): string;


    /**
     *
     * Gets the password
     *
     * @return string $password
     */
    public function getPassword(): string;


    /**
     *
     * Gets the storeId
     *
     * @return int storeId
     */
    public function getStoreId(): string;


    /**
     *
     * Gets the country code
     *
     * @return string countryCode
     */
    public function getCountryCode(): string;


    /**
     *
     * Checks whether test mode has been set
     *
     * @return bool true if test mode
     */
    public function isTestMode(): bool;

    /**
     *
     * Checks if production mode is set
     *
     * @return bool true if production mode
     */
    public function isProductionMode(): bool;

}
