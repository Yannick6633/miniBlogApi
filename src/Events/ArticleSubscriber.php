<?php

declare(strict_types=1);

namespace App\Events;


use ApiPlatform\Core\EventListener\EventPriorities;
use App\Authorizations\ArticleAuthorizationChecker;
use App\Authorizations\userAuthorizationChecker;
use App\Entity\Article;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ArticleSubscriber implements EventSubscriberInterface
{
    private array $methodNotAllowed = [
        Request::METHOD_POST,
        Request::METHOD_GET
    ];
    private ArticleAuthorizationChecker $ArticleAuthorizationChecker;


    public function __construct(ArticleAuthorizationChecker $ArticleAuthorizationChecker)
    {
        $this->ArticleAuthorizationChecker = $ArticleAuthorizationChecker;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['check', EventPriorities::PRE_VALIDATE]
        ];
    }

    public function check(ViewEvent $event)
    {
        $article = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if ($article instanceof Article && !in_array($method, $this->methodNotAllowed, true)){
            $this->ArticleAuthorizationChecker->check($article, $method);
            $article->setUpdatedAt(new \DateTimeImmutable());
        }
    }
}