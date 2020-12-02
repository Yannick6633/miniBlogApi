<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 *
 * @ApiResource(
 *     attributes={
 *          "force_eager"=false,
 *          "normalization_context"={"groups"={"list"}},
 *          "denormalization_context"={"groups"={"write"}}
 *     },
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
 *          "delete"
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
    private User $author;

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

    public function getAuthor(): User
    {
        return $this->author;
    }

    public function setAuthor(User $author): self
    {
        $this->author = $author;
        return $this;
    }
}
