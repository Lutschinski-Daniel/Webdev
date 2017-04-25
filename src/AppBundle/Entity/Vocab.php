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
    private $german;
    
    /**
     * @ORM\Column(type="string", length=32)
     */
    private $foreign;
    
    public function __construct($german, $foreign) {
        $this->setForeign($foreign);
        $this->setGerman($german);
    }
            
    function setId($id) {
        $this->id = $id;
    }

    function setGerman($german) {
        $this->german = $german;
    }

    function setForeign($foreign) {
        $this->foreign = $foreign;
    }

    function getId() {
        return $this->id;
    }

    function getGerman() {
        return $this->german;
    }

    function getForeign() {
        return $this->foreign;
    }


}
