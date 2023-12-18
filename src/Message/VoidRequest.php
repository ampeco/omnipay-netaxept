<?php

namespace Ampeco\OmnipayNetaxept\Message;

class VoidRequest extends AbstractRequest
{
    public function getEndpoint(): string
    {
        return '/Netaxept/Process.aspx';
    }

    public function getData(): array
    {
        $this->validate('transactionReference');

        return [
            'operation' => 'ANNUL',
            'transactionId' => $this->getTransactionReference(),
        ];
    }

    protected function createResponse($data, int $statusCode)
    {
        return $this->response = new VoidResponse($this, $data, $statusCode);
    }
}
