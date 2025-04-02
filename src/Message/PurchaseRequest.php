<?php

namespace Ampeco\OmnipayNetaxept\Message;

class PurchaseRequest extends AbstractRequest
{
    public function getEndpoint(): string
    {
        return '/Netaxept/Register.aspx';
    }

    public function getData(): array
    {
        $this->validate('transactionId', 'currency', 'amount', 'panHash', 'description');

        return [
            'serviceType' => 'C',
            'orderNumber' => $this->getTransactionId(),
            'currencyCode' => $this->getCurrency(),
            'amount' => $this->getAmountInteger(),
            'autoSale' => 'true',
            'panHash' => $this->getPanHash(),
            'recurringType' => 'M',
            'recurringTransactionType' => '1',
            'description' => $this->getDescription(),
            'orderDescription' => $this->getDescription(),
        ];
    }

    protected function createResponse($data, int $statusCode)
    {
        return $this->response = new Response($this, $data, $statusCode);
    }
}
