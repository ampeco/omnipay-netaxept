<?php

namespace Ampeco\OmnipayNetaxept\Message;

class RefundRequest extends AbstractRequest
{
    public function getEndpoint(): string
    {
        return '/Netaxept/Process.aspx';
    }

    public function getData(): array
    {
        $this->validate('transactionReference');

        return [
            'operation' => 'CREDIT',
            'transactionId' => $this->getTransactionReference(),
        ];
    }
}
