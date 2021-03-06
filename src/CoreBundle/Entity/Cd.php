<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cd
 *
 * @ORM\Table(name="cd", indexes={@ORM\Index(name="id", columns={"id_media"})})
 * @ORM\Entity
 */
class Cd {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255, nullable=false)
     */
    private $author;

    /**
     * @var \CoreBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Media")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_media", referencedColumnName="id")
     * })
     */
    private $media;

    /**
     * @var string 
     * 
     * @ORM\Column(name="genre", type="string")
     */
    private $genre;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Cd
     */
    public function setAuthor($author) {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor() {
        return $this->author;
    }

    /**
     * Set Media
     *
     * @param \CoreBundle\Entity\Media $media
     *
     * @return Cd
     */
    public function setMedia(\CoreBundle\Entity\Media $media = null) {
        $this->media = $media;

        return $this;
    }

    /**
     * Get Media
     *
     * @return \CoreBundle\Entity\Media
     */
    public function getMedia() {
        return $this->media;
    }

    public function getGenre() {
        return $this->genre;
    }

    public function setGenre($genre) {
        $this->genre = $genre;
    }

}
