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
        $this->data = json_decode(json_encode(simplexml_load_string($data)), true);
        $this->statusCode = $statusCode;
    }

    public function isSuccessful(): bool
    {
        return $this->statusCode === 200 && !isset($this->data['Error']);
    }

    public function getMessage(): ?string
    {
        return $this->data['Error']['Message'] ?? null;
    }
}
