<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="user_table")
 * 
 */
class User {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=32)
     */
    protected $name;
    
    /**
     * @ORM\Column(type="string", length=32)
     */
    protected $password;
    
    public function setName($name){
        $this->name = $name;
    }
    
    public function setPassword($password){
        $this->password = $password;
    }

    public function getName() {
        return $this->name;
    }

    public function getPassword() {
        return $this->password;
    }
}
