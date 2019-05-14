<?php

namespace League\OAuth2\Server\Grant;


use DateInterval;
use League\OAuth2\Server\Exception\OAuthServerException;
use League\OAuth2\Server\Repositories\DeviceCodeRepositoryInterface;
use League\OAuth2\Server\ResponseTypes\DeviceAuthorizationResponse;
use League\OAuth2\Server\ResponseTypes\ResponseTypeInterface;
use Psr\Http\Message\ServerRequestInterface;

class DeviceFlowGrant extends AbstractGrant
{
    private $serverUrl;
    private $deviceCodeRepository;

    public function __construct(DeviceCodeRepositoryInterface $deviceCodeRepository)
    {
        $this->deviceCodeRepository = $deviceCodeRepository;
    }

    public function respondToAccessTokenRequest(ServerRequestInterface $request, ResponseTypeInterface $responseType, DateInterval $accessTokenTTL)
    {
        // TODO: Implement respondToAccessTokenRequest() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentifier()
    {
        return 'urn:ietf:params:oauth:grant-type:device_code';
    }

    public function authorizeDevice(ServerRequestInterface $request, DeviceAuthorizationResponse $responseType) {
        // TODO: Handle no client ID provided
        // TODO: Ensure TLS is used
        // TODO: Handle scopes provided
        $clientId = $this->getRequestParameter('client_id', $request);

        $userCode = $this->generateUserCode();

        $responseType->setDeviceCode($this->generateDeviceCode());
        $responseType->setUserCode($userCode);
        $responseType->setVerificationUri($this->serverUrl . '/authorize');
        $responseType->setVerificationUriComplete($this->serverUrl . '/authorize?user_code=' . $userCode);
        $responseType->setExpiresIn($expiresIn); // TODO: Set an expiry date
        $responseType->setInterval($interval); // TODO: Set an interval

        return $responseType;
    }

    private function generateDeviceCode()
    {
        return bin2hex(random_bytes(36));
    }

    private function generateUserCode()
    {
        // TODO: Might allow users to set their own entropy
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $alphaMax = strlen($alphabet) - 1;
        $userCode = '';

        for ($i = 0; $i < 8; ++$i) {
            $userCode .= $alphabet[random_int(0, $alphaMax)];
        }

        return $userCode;
    }

    public function setServerUrl($serverUrl)
    {
        // TODO: Candidate to move to .env file
        $this->serverUrl = $serverUrl;
    }

    // This should be called at the standard token endpoint...
    public function respondToAccessTokenRequest(
        ServerRequestInterface $request,
        ResponseTypeInterface $responseType,
        DateInterval $accessTokenTTL
    )
    {
        // TODO: Need to handle ALL error states - write tests for these!

        $client = $this->validateClient($request);
        $deviceCode = $this->getRequestParameter('device_code', $request);

        if ($deviceCode === null) {
            throw OAuthServerException::invalidRequest('device_code');
        }

        $deviceCodeStatus = $this->deviceCodeRepository->getDeviceCodeStatus();

        if ($deviceCodeStatus === 'pending') {
            // TODO: Return an authorization_pending error
        }

        if ($deviceCodeStatus === 'denied') {
            throw OAuthServerException::accessDenied();
        }

        if ($deviceCodeStatus === 'expired') {
            // TODO: return expired_token
        }

        // TODO: Need to add in support for scopes at some point...
        $accessToken = $this->issueAccessToken($accessTokenTTL, $client, null);

        $this->getEmitter()->emit(new RequestEvent(RequestEvent::ACCESS_TOKEN_ISSUED, $request));

        // TODO: Need to check if we can issue a refresh token
        $responseType->setAccessToken($accessToken);

        return $responseType;
    }
}