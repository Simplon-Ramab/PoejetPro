<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EvenementRepository")
 */
class Evenement
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
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="datetime")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="datetime")
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="heureDebut", type="datetime", length=255)
     */
    private $heureDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heureFin", type="datetime")
     */
    private $heureFin;

    /**
     * @var int
     *
     * @ORM\Column(name="place", type="integer")
     */
    private $place;

    /**
    * @const path to cover directory
    */
    const COVER_DIRECTORY = '/images/imagevent/';

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $cover;

    /**
     * @var File
     *
     * @Assert\File(mimeTypes={ "image/jpeg","image/png"  })
     */
    private $file;

    /**
    * @ORM\ManyToOne(targetEntity="Categorie", inversedBy="evenements")
    * @ORM\JoinColumn(name="categorie_id", referencedColumnName="id")
    */
    private $categorie;


    /**
     * @ORM\ManyToOne(targetEntity="Utilisateur", inversedBy="evenements")
     * @ORM\JoinColumn(name="utilisateur_id", referencedColumnName="id")
     */
    private $utilisateur;


    /**
    * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Utilisateur", inversedBy="evenements")
    * @ORM\JoinTable(name="participation")
    */
   private $participants;


    /**
     * Get Cover
     *
     * @return string
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * Set cover
     *
     * @param string $cover
     *
     * @return Article
     */
    public function setCover($cover)
    {
        $this->cover = $cover;

        return $this;
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
     * Constructor
     */
    public function __construct()
    {

        $this->setDateDebut(new \Datetime('now'));
        $this->setDateFin(new \Datetime('now'));
        $this->setHeureDebut(new \Datetime('now'));
        $this->setHeureFin(new \Datetime('now'));
        $this->participants = new ArrayCollection();

    }


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
     * Set titre
     *
     * @param string $titre
     *
     * @return Evenement
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }


    /**
     * Set participants
     *
     * @param string $participants
     *
     * @return Evenement
     */
    public function setParticipants($participants)
    {
        $this->participants = $participants;

        return $this;
    }

    /**
     * Get participants
     *
     * @return string
     */
    public function getParticipants()
    {
        return $this->participants;
    }


    /**
     * Set titre
     *
     * @param string $description
     *
     * @return Evenement
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }



    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Evenement
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Evenement
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set heureDebut
     *
     * @param \DateTime $heureDebut
     *
     * @return Evenement
     */
    public function setHeureDebut($heureDebut)
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    /**
     * Get heureDebut
     *
     * @return string
     */
    public function getHeureDebut()
    {
        return $this->heureDebut;
    }

    /**
     * Set heureFin
     *
     * @param \DateTime $heureFin
     *
     * @return Evenement
     */
    public function setHeureFin($heureFin)
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    /**
     * Get heureFin
     *
     * @return \DateTime
     */
    public function getHeureFin()
    {
        return $this->heureFin;
    }

    /**
     * Set place
     *
     * @param integer $place
     *
     * @return Evenement
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return int
     */
    public function getPlace()
    {
        return $this->place;
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
        return $this->getCoverUploadDirectory() . $this->getCover();
    }

    /**
     * Chemin de l'image via l'URL, servira dans pour l'affichage dans les templates twig
     *
     * @return string
     */
    public function getCoverWebPath()
    {
        return self::COVER_DIRECTORY . $this->getCover();
    }






    /**
     * Set categorie
     *
     * @param \AppBundle\Entity\Categorie $categorie
     *
     * @return Evenement
     */
    public function setCategorie(\AppBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \AppBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set utilisateur
     *
     * @param \AppBundle\Entity\Utilisateur $utilisateur
     *
     * @return Evenement
     */
    public function setUtilisateur(\AppBundle\Entity\Utilisateur $utilisateur)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \AppBundle\Entity\Utilisateur
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Add participant
     *
     * @param \AppBundle\Entity\Utilisateur $participant
     *
     * @return Evenement
     */
    public function addParticipant(\AppBundle\Entity\Utilisateur $participant)
    {
        $this->participants[] = $participant;

        return $this;
    }

    /**
     * Remove participant
     *
     * @param \AppBundle\Entity\Utilisateur $participant
     */
    public function removeParticipant(\AppBundle\Entity\Utilisateur $participant)
    {
        $this->participants->removeElement($participant);
    }
}
