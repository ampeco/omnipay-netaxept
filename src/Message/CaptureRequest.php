<?php

namespace Ampeco\OmnipayNetaxept\Message;

class CaptureRequest extends AbstractRequest
{
    public function getEndpoint(): string
    {
        return '/Netaxept/Process.aspx';
    }

    public function getIsFinalCapture(): bool
    {
        return $this->getParameter('isFinalCapture');
    }

    public function setIsFinalCapture(bool $isFinalCapture): self
    {
        return $this->setParameter('isFinalCapture', $isFinalCapture);
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

    protected function createResponse($data, int $statusCode)
    {
        return $this->response = new CaptureResponse($this, $data, $statusCode);
    }
}
