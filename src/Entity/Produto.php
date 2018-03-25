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
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Campo imagem não pode ser vazio!")
     */
    private $imagem;


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

    /**
     * @var int
     */
    private $quantidade;

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

    /**
     * @return string
     */
    public function getImagem(): string
    {
        return $this->imagem;
    }

    /**
     * @param string $imagem
     * @return Produto
     */
    public function setImagem(string $imagem): Produto
    {
        $this->imagem = $imagem;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategorias()
    {
        return $this->categorias;
    }

    /**
     * @param mixed $categorias
     * @return Produto
     */
    public function setCategorias($categorias)
    {
        $this->categorias = $categorias;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCaracteristicas()
    {
        return $this->caracteristicas;
    }

    /**
     * @param mixed $caracteristicas
     * @return Produto
     */
    public function setCaracteristicas($caracteristicas)
    {
        $this->caracteristicas = $caracteristicas;
        return $this;
    }


    /**
     * @return int
     */
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * @param float $quantidade
     * @return $this
     */
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
        return $this;
    }


    /*
     *
     public 'preco' => string '100.00' (length=6)
     public 'imagem' => string 'http://joygayler.com/wp-content/uploads/2014/03/Product_Chair.jpg' (length=65)
     public 'quantidade' => int 1
     public 'id' => int 1
     public 'nome' => string 'Produto 1' (length=9)
     public 'descricao' => string 'Uma descrição para o Produto 1' (length=32)
     *
     */

    public function setStdClass($element) {

        $this->setPreco($element->preco);
        $this->setImagem($element->imagem);
        $this->setQuantidade($element->quantidade);
        $this->id = $element->id;
        $this->setNome($element->nome);
        $this->setDescricao($element->descricao);


    }

}
