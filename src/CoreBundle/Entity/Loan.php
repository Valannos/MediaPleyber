<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Loan
 *
 * @ORM\Table(name="loan", indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="user_id_2", columns={"user_id", "media_id"}), @ORM\Index(name="media_coderef", columns={"media_id"})})
 * @ORM\Entity(repositoryClass = "CoreBundle\Repository\LoanRepository")
 */
class Loan {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="return_date", type="date", nullable=true)
     */
    private $returnDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="loan_date", type="date", nullable=false)
     */
    private $loanDate;

    /**
     * @var \CoreBundle\Entity\Media
     * 
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Media") 
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="media_id", referencedColumnName="id")
     * })
     */
    private $media;

    /**
     * @var \CoreBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;
    
    /**
     *
     * @var boolean
     * @ORM\Column(name="isReturned", type="boolean")
     */
    
    
    private $isReturned;

    
    
    function getId() {
        return $this->id;
    }

    function getReturnDate(): \DateTime {
        return $this->returnDate;
    }

    function getLoanDate(): \DateTime {
        return $this->loanDate;
    }

    function getMedia(): \CoreBundle\Entity\Media {
        return $this->media;
    }

    function getUser(): \CoreBundle\Entity\User {
        return $this->user;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setReturnDate(\DateTime $returnDate) {
        $this->returnDate = $returnDate;
    }

    function setLoanDate(\DateTime $loanDate) {
        $this->loanDate = $loanDate;
    }

    function setMedia(\CoreBundle\Entity\Media $media) {
        $this->media = $media;
    }

    function setUser(\CoreBundle\Entity\User $user) {
        $this->user = $user;
    }
    function getIsReturned() {
        return $this->isReturned;
    }

    function setIsReturned($isReturned) {
        $this->isReturned = $isReturned;
    }




  
}