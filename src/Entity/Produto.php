<?php

namespace App\Entity;

use App\Repository\MinhaEntidade;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
