<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="buildings")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BuildingRepository")
 */
class Buildings
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


	/**
     * @ORM\Column(type="integer")
     */
    private $buildingid;

    /**
     * @ORM\Column(type="string")
     */
    private $moveindate;

    /**
     * @ORM\Column(type="string",length=100)
     */
    private $street;

    /**
     * @ORM\Column(type="integer")
     */
    private $postcode;

    /**
     * @ORM\Column(type="string",length=100)
     */
    private $town;

    /**
     * @ORM\Column(type="string",length=100)
     */
    private $country;

    /**
     * @ORM\Column(type="string",length=100)
     */
    private $email;

    /**
     * @ORM\Column(type="string",length=1000)
     */
    private $token;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * @return mixed
     */
    public function getBuildingid()
    {
        return $this->buildingid;
    }

    /**
     * @param mixed $buildingid
     */
    public function setBuildingid($buildingid)
    {
        $this->buildingid = $buildingid;
    }

    /**
     * @return mixed
     */
    public function getMoveindate()
    {
        return $this->moveindate;
    }

    /**
     * @param mixed $moveindate
     */
    public function setMoveindate($moveindate)
    {
        $this->moveindate = $moveindate;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param mixed $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return mixed
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * @param mixed $postcode
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    }

    /**
     * @return mixed
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * @param mixed $town
     */
    public function setTown($town)
    {
        $this->town = $town;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

}

?>