<?php

namespace Ampeco\OmnipayNetaxept\Message;

class AuthorizeRequest extends AbstractRequest
{
    public function getPanHash(): string
    {
        return $this->getParameter('panHash');
    }

    public function setPanHash(string $panHash): self
    {
        return $this->setParameter('panHash', $panHash);
    }

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
            'autoAuth' => 'true',
            'panHash' => $this->getPanHash(),
            'recurringType' => 'M',
            'recurringTransactionType' => '1',
            'description' => $this->getDescription(),
            'orderDescription' => $this->getDescription(),
        ];
    }

    protected function createResponse($data, int $statusCode)
    {
        return $this->response = new AuthorizeResponse($this, $data, $statusCode);
    }
}
