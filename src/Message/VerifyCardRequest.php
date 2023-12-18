<?php

namespace Ampeco\OmnipayNetaxept\Message;

class VerifyCardRequest extends AbstractRequest
{
    public function getEndpoint(): string
    {
        return '/Netaxept/Process.aspx';
    }

    public function getData(): array
    {
        $this->validate('transactionReference');

        return [
            'operation' => 'VERIFY',
            'transactionId' => $this->getTransactionReference(),
        ];
    }

    protected function createResponse($data, int $statusCode)
    {
        return $this->response = new VerifyCardResponse($this, $data, $statusCode);
    }
}
