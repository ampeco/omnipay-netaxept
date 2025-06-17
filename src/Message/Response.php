<?php

namespace Ampeco\OmnipayNetaxept\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

class Response extends AbstractResponse
{
    private int $statusCode;

    public function __construct(RequestInterface $request, $data, int $statusCode)
    {
        parent::__construct($request, $data);

        $this->request = $request;

        $validatedXml = $this->validateXml($data);
        $this->data = $validatedXml ? json_decode(json_encode($validatedXml), true) : [];

        $this->statusCode = $statusCode;
    }

    public function isSuccessful(): bool
    {
        return !empty($this->data)
            && $this->statusCode === 200
            && !isset($this->data['Error'])
            && ((isset($this->data['ResponseCode']) && $this->data['ResponseCode'] === 'OK') || isset($this->data['TransactionId']));
    }

    public function getMessage(): ?string
    {
        return $this->data['Error']['Message'] ?? null;
    }

    public function getTransactionReference(): ?string
    {
        if ($this->isSuccessful()) {
            return $this->data['TransactionId'] ?? null;
        }

        return $this->data['Error']['Result']['TransactionId'] ?? null;
    }

    /**
     * @param string $data
     * @return \SimpleXMLElement|null
     */
    function validateXml($data): ?\SimpleXMLElement
    {
        if (!str_starts_with(trim($data), '<?xml')) {
            return null;
        }

        libxml_use_internal_errors(true);

        $xml = simplexml_load_string($data);
        if ($xml === false) {
            libxml_clear_errors();

            return null;
        }

        return $xml;
    }
}
