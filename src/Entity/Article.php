<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Controller\ArticleUpdatedAt;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 * @ORM\HasLifecycleCallbacks()
 *
 * @ApiResource(
 *     collectionOperations={
 *          "get"={
 *              "normalization_context"={"groups"={"list_article"}}
 *          },
 *          "post"
 *      },
 *     itemOperations={
 *          "get"={
 *              "normalization_context"={"groups"={"details_article"}}
 *          },
 *          "put",
 *          "patch",
 *          "delete",
 *          "put_updated_at"={
                "method"="PUT",
 *              "path"="/articles/{id}/updated_at",
 *              "controller"=ArticleUpdatedAt::class,
 *          }
 *      }
 * )
 */
class Article
{
    use ResourceId;
    use Timestampable;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"list_article", "details_user", "details_article"})
     */
    private string $name;

    /**
     * @ORM\Column(type="text")
     * @Groups({"list_article", "details_user", "details_article"})
     */
    private string $content;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     *
     * @Groups({"details_article"})
     */
    private UserInterface $author;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getAuthor(): UserInterface
    {
        return $this->author;
    }

    public function setAuthor(UserInterface $author): self
    {
        $this->author = $author;
        return $this;
    }
}
