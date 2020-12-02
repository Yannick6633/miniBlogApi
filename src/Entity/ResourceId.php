<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

trait ResourceId
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @Groups({"list_user", "details_user", "details_article", "list_article"})
     */
    private int $id;

    public function getId(): ?int
    {
        return $this->id;
    }

}
