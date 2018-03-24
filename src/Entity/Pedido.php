<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PedidoRepository")
 */
class Pedido
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    private $nome;

    private $endereco;

    private $numero;

    private $complemento;

    private $bairro;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     *
     */
    private $carrinho = null;

    /**
     * @var ArrayCollection
     */
    private $carrinhoCollection;

    /**
     * @var Session
     */
    private $session = null;



    public function __construct()
    {

        $this->carrinhoCollection = new ArrayCollection();

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     * @return Pedido
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * @param mixed $endereco
     * @return Pedido
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param mixed $numero
     * @return Pedido
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * @param mixed $complemento
     * @return Pedido
     */
    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * @param mixed $bairro
     * @return Pedido
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
        return $this;
    }

    /**
     * @return string
     */
    public function getCarrinho(): string
    {
        return $this->carrinho;
    }

    /**
     * @param string $carrinho
     * @return Pedido
     */
    public function setCarrinho(string $carrinho): Pedido
    {
        $this->carrinho = $carrinho;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getCarrinhoCollection(): ArrayCollection
    {
        return $this->carrinhoCollection;
    }

    /**
     * @param ArrayCollection $carrinhoCollection
     * @return Pedido
     */
    public function setCarrinhoCollection(ArrayCollection $carrinhoCollection): Pedido
    {
        $this->carrinhoCollection = $carrinhoCollection;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @param SessionInterface $session
     * @return Pedido
     */
    public function setSession(SessionInterface $session): Pedido
    {
        $this->session = $session;
        return $this;
    }


    /**
     *
     */
    public function serializeCarrinho()
    {

        $this->carrinho = json_encode($this->carrinhoCollection->toArray());

    }

    public function unSerializeCarrinho()
    {

        if($this->carrinho)
        {
            $array = json_decode($this->carrinho);

             foreach ($array as $element) {

                 $this->carrinhoCollection->add($element);
             }
        }

    }

    public function carrinhoParaSessao()
    {

        if($this->session) {

            $this->session->set('carrinho', $this->carrinhoCollection);

        }

    }

    public function sessaoParaCarrinho()
    {

        if($this->session) {

            $this->carrinhoCollection = $this->session->get('carrinho');
        }
    }

    public static function adicionaProdutoSessao(SessionInterface $session, Produto $produto, $quantidade = 1)
    {

        if(!$carrinho = $session->get('carrinho'))
        {
            $carrinho = new ArrayCollection();
        }

        $produto->setQuantidade($quantidade);

        $carrinho->add($produto);

        $session->set('carrinho', $carrinho);

    }

    public static function removeProdutoSessao(SessionInterface $session, Produto $produto)
    {

        if($carrinho = $session->get('carrinho'))
        {

            $carrinho->removeElement($produto);

            $session->set('carrinho', $carrinho);

        }

    }

    public static function limparSessao(SessionInterface $session)
    {

        if($carrinho = $session->get('carrinho'))
        {

            $session->set('carrinho', null);

        }

    }

}
