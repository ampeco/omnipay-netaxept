<?php

namespace Ampeco\OmnipayNetaxept;

trait CommonParameters
{
    /**
     * @return string Merchant ID for Netaxept
     */
    public function getMerchantId(): string
    {
        return $this->getParameter('merchantId');
    }

    public function setMerchantId(string $merchantId): self
    {
        return $this->setParameter('merchantId', $merchantId);
    }

    /**
     * @return string API Token for Netaxept
     */
    public function getToken(): string
    {
        return $this->getParameter('token');
    }

    public function setToken($value)
    {
        return $this->setParameter('token', $value);
    }
}
