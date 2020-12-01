<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Entity\Article;
use Lexik\Bundle\JWTAuthenticationBundle\Tests\Functional\TestCase;

class ArticleTest extends TestCase
{

    private Article $article;

    protected function setUp(): void
    {
        parent::setUp();

        $this->article = new Article();
    }

    public function testGetArticle(): void
    {

    }

}