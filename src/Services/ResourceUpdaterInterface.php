<?php


namespace App\Services;


use Symfony\Component\Security\Core\User\UserInterface;

interface ResourceUpdaterInterface
{
    function process(string $method, UserInterface $user): bool;
}