<?php

namespace App\Entity;

use App\Repository\CaracteristicaRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity(repositoryClass="App\Repository\CaracteristicaRepository")
 */
class Caracteristica extends MinhaEntidade
{

    /**
     * Many Groups have Many Users.
     * @ORM\ManyToMany(targetEntity="Produto", mappedBy="caracteristicas")
     */
    private $produtos;

    public function __construct() {
        $this->produtos = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getProdutos()
    {
        return $this->produtos;
    }

    /**
     * @param mixed $produtos
     * @return Caracteristica
     */
    public function setProdutos($produtos)
    {
        $this->produtos = $produtos;
        return $this;
    }


}
