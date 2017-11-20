<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ImageRepository")
 */
class Image
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
     * @var string
     *
     * @ORM\Column(name="nomimage", type="string", length=255)
     */
    private $nomimage;


    /**
    * @ORM\ManyToOne(targetEntity="Evenement", inversedBy="evenements")
    * @ORM\JoinColumn(name="evenement_id", referencedColumnName="id")
    */
    private $evenement;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->evenements = new ArrayCollection();
    }




    /**
    * @const path to cover directory
    */
    const COVER_DIRECTORY = '/images/imagevent/';

    /**
     * @var File
     *
     * @Assert\NotBlank(message="S'il vous plait, ajoutez une image de couverture")
     * @Assert\File(mimeTypes={ "image/jpeg","image/png"  })
     */
    private $file;


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
     * Set nomimage
     *
     * @param string $nomimage
     *
     * @return Image
     */
    public function setNomimage($nomimage)
    {
        $this->nomimage = $nomimage;

        return $this;
    }

    /**
     * Get nomimage
     *
     * @return string
     */
    public function getNomimage()
    {
        return $this->nomimage;
    }


    /**
     * @return File
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param File $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * On part de notre class et on remonte jusqu'au dossier web
     * Chemin physique sur le serveur du dossier d'upload
     *
     * @return string
     */
    public function getCoverUploadDirectory()
    {
        return __DIR__ . "/../../../web" . self::COVER_DIRECTORY;
    }


    /**
     * Chemin physique de l'image sur le serveur
     *
     * @return string
     */
    public function getCoverAbsolutePath()
    {
        return $this->getCoverUploadDirectory() . $this->getNomimage();
    }

    /**
     * Chemin de l'image via l'URL, servira dans pour l'affichage dans les templates twig
     *
     * @return string
     */
    public function getCoverWebPath()
    {
        return self::COVER_DIRECTORY . $this->getNomimage();
    }


    /**
     * Set evenement
     *
     * @param \AppBundle\Entity\Evenement $evenement
     *
     * @return Image
     */
    public function setEvenement(\AppBundle\Entity\Evenement $evenement = null)
    {
        $this->evenement = $evenement;

        return $this;
    }

    /**
     * Get evenement
     *
     * @return \AppBundle\Entity\Evenement
     */
    public function getEvenement()
    {
        return $this->evenement;
    }

    /**
     * Add evenement
     *
     * @param \AppBundle\Entity\Evenement $evenement
     *
     * @return Image
     */
    public function addEvenement(\AppBundle\Entity\Evenement $evenement)
    {
        $this->evenements[] = $evenement;

        return $this;
    }

    /**
     * Remove evenement
     *
     * @param \AppBundle\Entity\Evenement $evenement
     */
    public function removeEvenement(\AppBundle\Entity\Evenement $evenement)
    {
        $this->evenements->removeElement($evenement);
    }

    /**
     * Get evenements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvenements()
    {
        return $this->evenements;
    }
}
