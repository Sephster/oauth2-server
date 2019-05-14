<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 23/12/18
 * Time: 12:11
 */

namespace League\OAuth2\Server\Repositories;


interface DeviceCodeRepositoryInterface extends RepositoryInterface
{
    public function getNewDeviceCode();

    public function persistNewDeviceCode();

    public function revokeDeviceCode();

    public function getDeviceCodeStatus();
}