<?php

namespace App\Entity;

use App\Repository\ProdutoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProdutoRepository")
 */
class Produto extends MinhaEntidade
{


    /**
     * @var float
     *
     * @ORM\Column(type="decimal", scale=2)
     * @Assert\NotBlank(message="Campo preço não pode ser vazio!")
     *
     */
    private $preco;


    /**
     * Many Users have Many Categorias.
     * @ORM\ManyToMany(targetEntity="Categoria", inversedBy="produtos")
     * @ORM\JoinTable(name="produtos_categorias",
     *      joinColumns={@ORM\JoinColumn(name="id_produto", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_categoria", referencedColumnName="id")}
     * )
     */
    private $categorias;


    /**
     * Many Users have Many Groups.
     * @ORM\ManyToMany(targetEntity="Caracteristica", inversedBy="produtos")
     * @ORM\JoinTable(name="produtos_caracteristicas",
     *      joinColumns={@ORM\JoinColumn(name="id_produto", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_caracteristica", referencedColumnName="id")}
     * ))
     */
    private $caracteristicas;


    public function __construct() {
        $this->categorias = new ArrayCollection();
        $this->caracteristicas = new ArrayCollection();

    }



    /**
     * @return float
     */
    public function getPreco()
    {
        return $this->preco;
    }

    /**
     * @param float $preco
     * @return $this
     */
    public function setPreco($preco)
    {
        $this->preco = $preco;
        return $this;
    }






}
