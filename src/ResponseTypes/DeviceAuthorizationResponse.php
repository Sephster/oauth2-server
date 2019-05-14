<?php

namespace League\OAuth2\Server\ResponseTypes;

use Psr\Http\Message\ResponseInterface;

class DeviceAuthorizationResponse extends AbstractResponseType
{
    private $deviceCode;
    private $userCode;
    private $verificationUri;
    private $verificationUriComplete;
    private $expiresIn;
    private $interval;

    public function setDeviceCode($deviceCode)
    {
        $this->deviceCode = $deviceCode;
    }

    public function setUserCode($userCode)
    {
        $this->userCode = $userCode;
    }

    public function setVerificationUri($verificationUri)
    {
        $this->verificationUri = $verificationUri;
    }

    public function setVerificationUriComplete($verificationUriComplete)
    {
        $this->verificationUriComplete = $verificationUriComplete;
    }

    public function setExpiresIn($expiresIn)
    {
        $this->expiresIn = $expiresIn;
    }

    public function setInterval($interval)
    {
        $this->interval = $interval;
    }

    public function generateHttpResponse(ResponseInterface $response)
    {
        // TODO: Implement generateHttpResponse() method.
    }
}