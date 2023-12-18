<?php

namespace Ampeco\OmnipayNetaxept\Message;

class QueryResponse extends Response
{
    public function getCardReference(): ?string
    {
        return $this->isSuccessful() ? $this->data['CardInformation']['PanHash'] : null;
    }

    public function getTransactionReference(): ?string
    {
        return $this->isSuccessful() ? $this->data['TransactionId'] : null;
    }

    public function getPaymentMethod(): object
    {
        $result = new \stdClass();

        $result->imageUrl = '';
        $result->last4 = substr($this->data['CardInformation']['MaskedPAN'], -4);
        $result->cardType = $this->data['CardInformation']['PaymentMethod'];

        $expiryDate = $this->data['CardInformation']['ExpiryDate'];
        $expirationMonth = (int) substr($expiryDate, 2, 4);
        $expirationYear = \DateTime::createFromFormat('y', (int) substr($expiryDate, 0, 2))->format('Y');

        $result->expirationMonth = $expirationMonth;
        $result->expirationYear = $expirationYear;

        return $result;
    }
}
