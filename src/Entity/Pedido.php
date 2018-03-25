<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
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

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Campo nome não pode ser vazio!")
     *
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Campo endereço não pode ser vazio!")
     *
     */
    private $endereco;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Campo número não pode ser vazio!")
     *
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     *
     */
    private $complemento;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Campo bairro não pode ser vazio!")
     *
     */
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

        $serializer = new Serializer(array(new GetSetMethodNormalizer()), array('json' => new JsonEncoder()));

        $this->carrinho = $serializer->serialize($this->carrinhoCollection, 'json');

    }

    public function unSerializeCarrinho()
    {

        if($this->carrinho)
        {
            $this->carrinhoCollection = new ArrayCollection();

            $array = json_decode($this->carrinho);

             foreach ($array as $element) {

                 $produto = new Produto();

                 $produto->setStdClass($element);

                 $this->carrinhoCollection->add($produto);
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

        /**
         * TODO: Precia de uma versão mais eficaz para não duplicar os itens no carrinho.
         */

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
