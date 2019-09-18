<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity; // Ajouté pour UniqueEntity
use Symfony\Component\Validator\Constraints as Assert; // Ajouté pour validation de formulaire
use Symfony\Component\Security\Core\User\UserInterface; // Ajouté pour cryptage de mot de passe de l'utilisateur


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields="username", message="Pseudo déjà pris")
 * @UniqueEntity(fields="email", message="Email déjà pris")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\Length(
     *    min = 2,
     *    max = 100,
     *    minMessage = "Minimum {{ limit }} caractères !",
     *    maxMessage = "Maximum {{ limit }} caractères !"
     * )
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=4, minMessage="Minimum {{ limit }} caractères !")
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Erreur répétition de Mot de passe")
     */
    public $confirm_password;
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }



    // ----- Ajouté pour cryptage de mot de passe : -----
    public function getSalt()
    {
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function eraseCredentials()
    {
    }



}
