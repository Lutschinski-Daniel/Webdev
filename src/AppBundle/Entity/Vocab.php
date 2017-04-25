<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="vocab_table")
 * 
 */
class Vocab {
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=32)
     */
    private $germanV;
    
    /**
     * @ORM\Column(type="string", length=32)
     */
    private $foreignV;
    
    public function __construct($germanV, $foreignV) {
        $this->setForeign($foreignV);
        $this->setGerman($germanV);
    }
            
    function setId($id) {
        $this->id = $id;
    }

    function setGerman($germanV) {
        $this->germanV = $germanV;
    }

    function setForeign($foreignV) {
        $this->foreignV = $foreignV;
    }

    function getId() {
        return $this->id;
    }

    function getGerman() {
        return $this->germanV;
    }

    function getForeign() {
        return $this->foreignV;
    }
}
