<?php


namespace App\Services;


use App\Authorizations\AuthenticationChecker;
use App\Authorizations\AuthenticationCheckerInterface;
use App\Authorizations\ResourceAccessCheckerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;

class ResourceUpdater implements ResourceUpdaterInterface
{
    protected array $methodAllowed = [
        Request::METHOD_PUT,
        Request::METHOD_PATCH,
        Request::METHOD_DELETE
    ];

    private ResourceAccessCheckerInterface $resourceAccessChecker;

    private AuthenticationCheckerInterface $authenticationChecker;

    public function __construct(ResourceAccessCheckerInterface $resourceAccessChecker, AuthenticationCheckerInterface $authenticationChecker)
    {
        $this->resourceAccessChecker = $resourceAccessChecker;
        $this->authenticationChecker = $authenticationChecker;
    }

    public function process(string $method, UserInterface $user): bool
    {
        // TODO: Implement process() method.
    }
}