<?php

namespace Ampeco\OmnipayNetaxept\Message;

use Ampeco\OmnipayNetaxept\CommonParameters;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    use CommonParameters;

    public const API_URL_PROD = 'https://epayment.nets.eu';
    public const API_URL_TEST = 'https://test.epayment.nets.eu';

    abstract public function getEndpoint();

    public function getBaseUrl(): string
    {
        return $this->getTestMode() ? self::API_URL_TEST : self::API_URL_PROD;
    }

    public function getHttpMethod(): string
    {
        return 'GET';
    }

    public function sendData($data)
    {
        $data['token'] = $this->getToken();
        $data['merchantId'] = $this->getMerchantId();

        $queryParams = 'GET' === $this->getHttpMethod() ? '?'.http_build_query($data, '', '&') : '';
        $httpResponse = $this->httpClient->request(
            $this->getHttpMethod(),
            $this->getBaseUrl().$this->getEndpoint().$queryParams,
            [],
            'GET' === $this->getHttpMethod() ? null : $data
        );

        return $this->createResponse($httpResponse->getBody()->getContents(), $httpResponse->getStatusCode());
    }

    abstract protected function createResponse($data, int $statusCode);
}
