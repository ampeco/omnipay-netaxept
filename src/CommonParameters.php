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

    public function getIsFinalCapture(): bool
    {
        return $this->getParameter('isFinalCapture');
    }

    public function setIsFinalCapture(bool $isFinalCapture): self
    {
        return $this->setParameter('isFinalCapture', $isFinalCapture);
    }

    public function getPanHash(): string
    {
        return $this->getParameter('panHash');
    }

    public function setPanHash(string $panHash): self
    {
        return $this->setParameter('panHash', $panHash);
    }

    public function getLanguage(): string
    {
        return $this->getParameter('language');
    }

    public function setLanguage(string $language): self
    {
        return $this->setParameter('language', $language);
    }
}
