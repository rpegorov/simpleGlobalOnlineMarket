<?php

namespace App\Entity;

use App\Entity\Traits\TimestampableTrait;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User extends PersistentEntity implements UserInterface, PasswordAuthenticatedUserInterface
{

    use TimestampableTrait;
    #[ORM\Column(length: 255)]
    private string $password;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private string $email;

    #[ORM\Column(type: 'json')]
    private array $roles = [];


    /**
     * @param string $password
     */
    public function setPassword(string $password): self {
        $this->password = $password;
        return $this;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): self {
        $this->email = $email;

        return $this;
    }

    public function setRoles(array $roles): self {
        $this->roles = $roles;

        return $this;
    }

    public function getUserIdentifier(): string {
        return (string)$this->email;
    }

    public function getRoles(): array {
        $roles   = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function eraseCredentials() {
        return null;
    }
    public function getPassword(): ?string {
       return $this->password;
    }
}
