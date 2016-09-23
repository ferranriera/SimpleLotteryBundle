<?php

namespace SimpleLotteryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Participant
 *
 * @ORM\Table(name="participant")
 * @ORM\Entity(repositoryClass="SimpleLotteryBundle\Repository\ParticipantRepository")
 * @UniqueEntity(fields="nickName", message="Nickname already taken")
 */
class Participant
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 3,
     *      max = 25,
     *      minMessage = "Your nickname must be at least {{ limit }} characters long",
     *      maxMessage = "Your nickname cannot be longer than {{ limit }} characters"
     * )
     */
    public $nickName;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNickName()
    {
        return $this->nickName;
    }

    /**
     * @param mixed $nickName
     */
    public function setNickName($nickName)
    {
        $this->nickName = $nickName;
    }


}

