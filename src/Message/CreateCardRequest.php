<?php

namespace Ampeco\OmnipayNetaxept\Message;

class CreateCardRequest extends AbstractRequest
{
    public function getLanguage(): string
    {
        return $this->getParameter('language');
    }

    public function setLanguage(string $language): self
    {
        return $this->setParameter('language', $language);
    }

    public function getEndpoint(): string
    {
        return '/Netaxept/Register.aspx';
    }

    public function getData(): array
    {
        $this->validate('description', 'transactionId', 'language', 'returnUrl');

        return [
            'serviceType' => 'B',
            'updateStoredPaymentInfo' => 'true',
            'description' => $this->getDescription(),
            'orderDescription' => $this->getDescription(),
            'orderNumber' => $this->getTransactionId(),
            'language' => $this->getLanguage(),
            'redirectUrl' => $this->getReturnUrl(),
            'force3DSecure' => 'true',
            'recurringType' => 'S',
        ];
    }

    protected function createResponse($data, int $statusCode)
    {
        return $this->response = new CreateCardResponse($this, $data, $statusCode);
    }
}
