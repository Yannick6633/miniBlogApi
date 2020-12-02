<?php

declare(strict_types=1);

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

trait Timestampable
{
    /**
     * @var \DateTimeInterface
     * @ORM\Column (type="datetime")
     *
     * @Groups({"list_user", "details_user", "details_article", "list_article"})
     */
    private \DateTimeInterface $createdAt;

    /**
     * @var \DateTimeInterface
     * @ORM\Column (type="datetime", nullable=true)
     *
     * @Groups({"list_user", "details_user", "details_article", "list_article"})
     */
    private ?\DateTimeInterface $updatedAt;

    /**
     * @return DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt ?? new \DateTimeImmutable();
    }

    /**
     * @param DateTimeInterface $createdAt
     * @return $this
     */
    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt ?? new \DateTimeImmutable();
    }

    /**
     * @param DateTimeInterface|null $updatedAt
     * @return $this
     */
    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }


    public function updateTimestamps(): void
    {
        $now = new \DateTimeImmutable();
        $this->setUpdatedAt($now);
        if ($this->getId() === null) {
            $this->setCreatedAt($now);
        }
    }
}
