<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

trait Timestampable
{
    /**
     * @var \DateTimeInterface
     * @ORM\Column (type="datetime")
     */
    private \DateTimeInterface $createdAt;

    /**
     * @var \DateTimeInterface
     * @ORM\Column (type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $updatedAt;

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeInterface $updatedAt
     * @return Timestampable
     */
    public function setUpdatedAt(?\DateTimeInterface $updatedAt): Timestampable
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }


}
