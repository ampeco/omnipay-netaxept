<?php

namespace Ampeco\OmnipayNetaxept;

use Ampeco\OmnipayNetaxept\Message\AuthorizeRequest;
use Ampeco\OmnipayNetaxept\Message\CaptureRequest;
use Ampeco\OmnipayNetaxept\Message\CreateCardRequest;
use Ampeco\OmnipayNetaxept\Message\PurchaseRequest;
use Ampeco\OmnipayNetaxept\Message\QueryRequest;
use Ampeco\OmnipayNetaxept\Message\VerifyCardRequest;
use Ampeco\OmnipayNetaxept\Message\VoidRequest;

class Gateway extends AbstractGateway
{
    public function getName(): string
    {
        return 'Netaxept';
    }

    public function createCard(array $options = [])
    {
        return $this->createRequest(CreateCardRequest::class, $options);
    }

    public function verifyCard(array $options = [])
    {
        return $this->createRequest(VerifyCardRequest::class, $options);
    }

    public function authorize(array $options = [])
    {
        return $this->createRequest(AuthorizeRequest::class, $options);
    }

    public function capture(array $options = [])
    {
        return $this->createRequest(CaptureRequest::class, $options);
    }

    public function void(array $options = [])
    {
        return $this->createRequest(VoidRequest::class, $options);
    }

    public function purchase(array $options = [])
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    public function query(array $options = [])
    {
        return $this->createRequest(QueryRequest::class, $options);
    }
}
