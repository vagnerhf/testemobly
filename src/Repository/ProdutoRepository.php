<?php

namespace App\Repository;

use App\Entity\Caracteristica;
use App\Entity\Categoria;
use App\Entity\Produto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


/**
 * @method Produto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produto[]    findAll()
 * @method Produto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProdutoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Produto::class);
    }

    public function buscaProduto($busca)
    {
        $qb = $this->createQueryBuilder('p');

        $qb->where($qb->expr()->orX(
            $qb->expr()->like('p.nome', ':busca1'),
            $qb->expr()->like('p.descricao', ':busca2')
        ))
            ->setParameter('busca1', $busca)
            ->setParameter('busca2', $busca)
        ;

        return $qb->getQuery()->getResult();
    }

    public function buscaCaracteristica($busca)
    {
        $sql = 'SELECT
                    produto.id,
                    produto.nome,
                    produto.preco,
                    produto.descricao,
                    produto.imagem
                FROM produto
                  INNER JOIN produtos_caracteristicas ON produto.id = produtos_caracteristicas.id_produto
                  INNER JOIN caracteristica ON caracteristica.id = produtos_caracteristicas.id_caracteristica
                WHERE
                  caracteristica.nome LIKE :busca1 OR
                  caracteristica.descricao LIKE :busca2'
        ;

        return $this->getEntityManager()
            ->getConnection()
            ->executeQuery(
                $sql,
                [
                    ':busca1' => $busca,
                    ':busca2' => $busca,
                ]
            )
            ->fetchAll(\PDO::FETCH_OBJ);
    }

    public function buscaCategoria($busca)
    {

        $sql = 'SELECT
                    produto.id,
                    produto.nome,
                    produto.preco,
                    produto.descricao,
                    produto.imagem
                FROM produto
                  INNER JOIN produtos_categorias ON produto.id = produtos_categorias.id_produto
                  INNER JOIN categoria ON categoria.id = produtos_categorias.id_categoria
                WHERE
                  categoria.nome LIKE :busca1 OR
                  categoria.descricao LIKE :busca2'
        ;

        return $this->getEntityManager()
            ->getConnection()
            ->executeQuery(
                $sql,
                [
                    ':busca1' => $busca,
                    ':busca2' => $busca,
                ]
            )
            ->fetchAll(\PDO::FETCH_OBJ);
    }

}


