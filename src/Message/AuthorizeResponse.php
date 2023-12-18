<?php

namespace Ampeco\OmnipayNetaxept\Message;

class AuthorizeResponse extends Response
{
    public function isSuccessful(): bool
    {
        return parent::isSuccessful() && isset($this->data['TransactionId']);
    }

    public function getTransactionReference()
    {
        return $this->isSuccessful() ? $this->data['TransactionId'] : null;
    }
}
