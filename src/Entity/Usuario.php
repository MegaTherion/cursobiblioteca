<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsuarioRepository")
 */
class Usuario
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="nombre", type="string", length=40)
     */
    private $nombre;

    /**
     * @ORM\Column(name="apellido", type="string", length=40)
     */
    private $apellido;

    /**
    * Get id
    * @return  
    */
    public function getId()
    {
        return $this->id;
    }
    
    /**
    * Set id
    * @return $this
    */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
    * Get nombre
    * @return  
    */
    public function getNombre()
    {
        return $this->nombre;
    }
    
    /**
    * Set nombre
    * @return $this
    */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
    * Get apellido
    * @return  
    */
    public function getApellido()
    {
        return $this->apellido;
    }
    
    /**
    * Set apellido
    * @return $this
    */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
        return $this;
    }
}
