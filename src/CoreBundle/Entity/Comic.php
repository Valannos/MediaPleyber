<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comic
 *
 * @ORM\Table(name="comic", indexes={@ORM\Index(name="media_id", columns={"media_id"})})
 * @ORM\Entity
 */
class Comic
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
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255, nullable=false)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="drawer", type="string", length=255, nullable=false)
     */
    private $drawer;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Comic
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set drawer
     *
     * @param string $drawer
     *
     * @return Comic
     */
    public function setDrawer($drawer)
    {
        $this->drawer = $drawer;

        return $this;
    }

    /**
     * Get drawer
     *
     * @return string
     */
    public function getDrawer()
    {
        return $this->drawer;
    }

    /**
     * Set media
     *
     * @param \CoreBundle\Entity\Media $media
     *
     * @return Comic
     */
    public function setMedia(\CoreBundle\Entity\Media $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return \CoreBundle\Entity\Media
     */
    public function getMedia()
    {
        return $this->media;
    }
}
