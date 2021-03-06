<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Entity\Produto;
use App\Form\ProdutoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProdutoController extends Controller
{
    /**
     * @Route("/", name="loja_produto")
     * @Template("produto/index.html.twig")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        $produtos = $em->getRepository(Produto::class)->findAll();

        return [
            'produtos' => $produtos,
            'categoria' => null
        ];

    }

    /**
     * @Route("/produto/categoria/{id}", name="loja_produto_categoria")
     * @Template("produto/index.html.twig")
     */
    public function byCategory(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $categoria = $em->getRepository(Categoria::class)->find($id);


        return [
            'produtos' => $categoria->getProdutos(),
            'categoria' => $categoria
        ];

    }

    /**
     * @Route("/produtos", name="listar_produto")
     * @Template("produto/list.html.twig")
     */
    public function browse()
    {
        $em = $this->getDoctrine()->getManager();

        $produtos = $em->getRepository(Produto::class)->findAll();

        return [
            'produtos' => $produtos
        ];

    }


    /**
     * @param Request $request
     *
     * @Route("/produto/cadastrar", name="cadastrar_produto")
     * @Template("produto/create.html.twig")
     * @return Response
     */
    public function create(Request $request)
    {
        $produto = new Produto();

        $form = $this->createForm(ProdutoType::class, $produto);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($produto);
            $em->flush();

            $this->get('session')->getFlashBag()->set('success', 'Produto foi salvo com sucesso!');
            return $this->redirectToRoute('listar_produto');

        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @param Request $request
     * @return Response
     * @Template("produto/update.html.twig")
     * @Route("produto/editar/{id}", name="editar_produto")
     */
    public function update(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $produto = $em->getRepository(Produto::class)->find($id);

        $form = $this->createForm(ProdutoType::class, $produto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($produto);
            $em->flush();

            $this->get('session')->getFlashBag()->set('success', 'O Produto ' . $produto->getNome() . ' foi alterado com sucesso!');
            return $this->redirectToRoute('listar_produto');
        }

        return [
            'produto' => $produto,
            'form' => $form->createView()
        ];
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return array
     * @Route("produto/visualizar/{id}", name="visualizar_produto")
     * @Template("produto/view.html.twig")
     */
    public function view(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $produto = $em->getRepository(Produto::class)->find($id);

        return [
            'produto' => $produto
        ];
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return array
     * @Route("produto/detalhes/{id}", name="detalhe_produto")
     * @Template("produto/detail.html.twig")
     */
    public function detail(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $produto = $em->getRepository(Produto::class)->find($id);

        return [
            'produto' => $produto,
            'carateristicas' => $produto->getCaracteristicas()
        ];
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @Route("produto/apagar/{id}", name="apagar_produto")
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $produto = $em->getRepository(Produto::class)->find($id);

        if (!$produto) {
            $mensagem = 'Produto não foi encontrado!';
            $tipo = 'warning';
        } else {
            $em->remove($produto);
            $em->flush();
            $mensagem = 'Produto foi excluído com sucesso!';
            $tipo = 'success';
        }

        $this->get('session')->getFlashBag()->set($tipo, $mensagem);
        return $this->redirectToRoute('listar_produto');

    }




    /**
     * @Route("/busca", name="loja_busca")
     * @Template("produto/search.html.twig")
     * @param Request $request
     * @return array
     */
    public function search(Request $request)
    {

        $form = $this->createFormBuilder()
            ->add('busca', TextType::class, [
                'label' => 'Buscar Produto',
                'required' => true,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('enviar', SubmitType::class, [
                'label' => 'Buscar',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
            ->getForm()
        ;

        $form->handleRequest($request);

        $resultadoProduto = array();
        $resultadoCaracteristica = array();
        $resultadoCategoria = array();

        if ($form->isSubmitted() && $form->isValid()) {

            $formData = $form->getData();

            $busca = '%' . $formData['busca'] . '%';

            $em = $this->getDoctrine()->getManager();

            $resultadoProduto = $em->getRepository(Produto::class)->buscaProduto($busca);

            $resultadoCaracteristica = $em->getRepository(Produto::class)->buscaCaracteristica($busca);

            $resultadoCategoria = $em->getRepository(Produto::class)->buscaCategoria($busca);

        }

        return [
            'resultadoProduto' => $resultadoProduto,
            'resultadoCaracteristica' => $resultadoCaracteristica,
            'resultadoCategoria' => $resultadoCategoria,
            'form' => $form->createView()
        ];
    }

}
