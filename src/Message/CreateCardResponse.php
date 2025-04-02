<?php

namespace Ampeco\OmnipayNetaxept\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

class CreateCardResponse extends Response implements RedirectResponseInterface
{
    public function isRedirect(): bool
    {
        return true;
    }

    public function getRedirectUrl(): string
    {
        $baseUrl = $this->request->getBaseUrl();
        $merchantId = $this->request->getParameters()['merchantId'];
        $transactionReference = $this->getTransactionReference();

        return sprintf('%s/Terminal/default.aspx?merchantId=%s&transactionId=%s', $baseUrl, $merchantId, $transactionReference);
    }

    public function getRedirectMethod(): string
    {
        return 'GET';
    }
}
