<?php

namespace App\Entity;

use App\Repository\CategoriaRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoriaRepository")
 */
class Categoria extends MinhaEntidade
{

    /**
     * Many Groups have Many Users.
     * @ORM\ManyToMany(targetEntity="Produto", mappedBy="categorias")
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
     * @return Categoria
     */
    public function setProdutos($produtos)
    {
        $this->produtos = $produtos;
        return $this;
    }


}
