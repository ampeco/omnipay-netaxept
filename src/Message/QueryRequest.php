<?php

namespace Ampeco\OmnipayNetaxept\Message;

class QueryRequest extends AbstractRequest
{
    public function getEndpoint(): string
    {
        return '/Netaxept/Query.aspx';
    }

    public function getData(): array
    {
        $this->validate('transactionReference');

        return [
            'transactionId' => $this->getTransactionReference(),
        ];
    }

    protected function createResponse($data, int $statusCode)
    {
        return $this->response = new QueryResponse($this, $data, $statusCode);
    }
}
