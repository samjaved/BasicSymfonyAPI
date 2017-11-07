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
     * @ORM\Column(type="datetime")
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
	
	
	
	
}
?>