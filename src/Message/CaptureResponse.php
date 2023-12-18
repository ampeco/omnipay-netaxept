<?php

namespace Ampeco\OmnipayNetaxept\Message;

class CaptureResponse extends Response
{
    public function isSuccessful(): bool
    {
        return parent::isSuccessful() && $this->data['ResponseCode'] === 'OK';
    }

    public function getTransactionReference(): ?string
    {
        return $this->isSuccessful() ? $this->data['TransactionId'] : null;
    }
}
