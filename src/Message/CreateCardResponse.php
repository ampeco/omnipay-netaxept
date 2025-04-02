<?php

namespace Ampeco\OmnipayNetaxept\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

class CreateCardResponse extends Response implements RedirectResponseInterface
{
    public function isRedirect(): bool
    {
        return true;
    }

    public function getRedirectMethod(): string
    {
        return 'GET';
    }
}
