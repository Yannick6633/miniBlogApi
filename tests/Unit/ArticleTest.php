<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Entity\Article;
use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Tests\Functional\TestCase;

/**
 * @method static assertInstanceOf(string $class, Article $response)
 * @method static assertEquals(string $value, string|null $getName)
 */
class ArticleTest extends TestCase
{

    private Article $article;

    protected function setUp(): void
    {
        parent::setUp();

        $this->article = new Article();
    }

    public function testGetName(): void
    {
        $value = 'Name de test';

        $response = $this->article->setName($value);

        self::assertInstanceOf(Article::class, $response);
        self::assertEquals($value, $this->article->getName());
    }

    public function testGetContent(): void
    {
        $value = 'Content de test';

        $response = $this->article->setContent($value);

        self::assertInstanceOf(Article::class, $response);
        self::assertEquals($value, $this->article->getContent());

    }

    public function testGetAuthor(): void
    {
        $value = new User();

        $response = $this->article->setAuthor($value);

        self::assertInstanceOf(Article::class, $response);
        self::assertInstanceOf(User::class, $this->article->getAuthor());
    }
}