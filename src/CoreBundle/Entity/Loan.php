<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Loan
 *
 * @ORM\Table(name="loan", indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="user_id_2", columns={"user_id", "media_id"}), @ORM\Index(name="media_coderef", columns={"media_id"})})
 * @ORM\Entity
 */
class Loan
{
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
     * @ORM\Column(name="return_date", type="date", nullable=false)
     */
    private $returnDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="loan_date", type="date", nullable=false)
     */
    private $loanDate;

    /**
     * @var string
     *
     * @ORM\Column(name="media_id", type="string", length=20, nullable=false)
     */
    private $mediaId;

    /**
     * @var \CoreBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Media")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set returnDate
     *
     * @param \DateTime $returnDate
     *
     * @return Loan
     */
    public function setReturnDate($returnDate)
    {
        $this->returnDate = $returnDate;

        return $this;
    }

    /**
     * Get returnDate
     *
     * @return \DateTime
     */
    public function getReturnDate()
    {
        return $this->returnDate;
    }

    /**
     * Set loanDate
     *
     * @param \DateTime $loanDate
     *
     * @return Loan
     */
    public function setLoanDate($loanDate)
    {
        $this->loanDate = $loanDate;

        return $this;
    }

    /**
     * Get loanDate
     *
     * @return \DateTime
     */
    public function getLoanDate()
    {
        return $this->loanDate;
    }

    /**
     * Set mediaId
     *
     * @param string $mediaId
     *
     * @return Loan
     */
    public function setMediaId($mediaId)
    {
        $this->mediaId = $mediaId;

        return $this;
    }

    /**
     * Get mediaId
     *
     * @return string
     */
    public function getMediaId()
    {
        return $this->mediaId;
    }

    /**
     * Set user
     *
     * @param \CoreBundle\Entity\Media $user
     *
     * @return Loan
     */
    public function setUser(\CoreBundle\Entity\Media $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \CoreBundle\Entity\Media
     */
    public function getUser()
    {
        return $this->user;
    }
}
