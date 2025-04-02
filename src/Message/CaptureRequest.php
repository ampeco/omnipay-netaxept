<?php

namespace Ampeco\OmnipayNetaxept\Message;

class CaptureRequest extends AbstractRequest
{
    public function getEndpoint(): string
    {
        return '/Netaxept/Process.aspx';
    }

    public function getData(): array
    {
        $this->validate('transactionReference', 'amount', 'description', 'isFinalCapture');

        return [
            'operation' => 'CAPTURE',
            'transactionId' => $this->getTransactionReference(),
            'transactionAmount' => $this->getAmountInteger(),
            'description' => $this->getDescription(),
            'isFinalCapture' => $this->getIsFinalCapture(),
        ];
    }
}
