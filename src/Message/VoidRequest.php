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
}
