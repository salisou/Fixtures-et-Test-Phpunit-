<?php

namespace App\Entity;

use App\Repository\InvilideCodeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=InvilideCodeRepository::class)
 */
class InvilideCode
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=5)
     * @Assert\Regex("/\d{5}/")             // macontaint de validation Assert\Regex("/\d{5}/")
     */
    private $code;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $expire_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getExpireAt(): ?\DateTimeImmutable
    {
        return $this->expire_at;
    }

    public function setExpireAt(\DateTimeImmutable $expire_at): self
    {
        $this->expire_at = $expire_at;

        return $this;
    }
}
