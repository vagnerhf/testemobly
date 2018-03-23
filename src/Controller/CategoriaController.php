<?php

namespace App\Controller;

use App\Entity\Produto;
use App\Form\ProdutoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoriaController extends Controller
{
    /**
     * @Route("/categoria", name="listar_categoria")
     * @Template("categoria/index.html.twig")
     */
    public function index()
    {

        /*TODO: TROCAR PRODUTO POR CATEGORIA */
        $em = $this->getDoctrine()->getManager();

        $produtos = $em->getRepository(Produto::class)->findAll();

        return [
            'produtos' => $produtos
        ];

    }


    /**
     * @param Request $request
     *
     * @Route("/categoria/cadastrar", name="cadastrar_categoria")
     * @Template("categoria/create.html.twig")
     * @return Response
     */
    public function create(Request $request)
    {
        /*TODO: TROCAR PRODUTO POR CATEGORIA */
        $produto = new Produto();

        $form = $this->createForm(ProdutoType::class, $produto);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($produto);
            $em->flush();

            //$this->get('session')->getFlashBag()->set('success', 'Produto foi salvo com sucesso!');
            $this->addFlash('success', "Produto cadastrado!");
            return $this->redirectToRoute('listar_categoria');


        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @param Request $request
     * @return Response
     * @Template("categoria/update.html.twig")
     * @Route("categoria/editar/{id}", name="editar_categoria")
     */
    public function update(Request $request, $id)
    {
        /*TODO: TROCAR PRODUTO POR CATEGORIA */
        $em = $this->getDoctrine()->getManager();
        $produto = $em->getRepository(Produto::class)->find($id);

        $form = $this->createForm(ProdutoType::class, $produto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($produto);
            $em->flush();

            $this->get("session")->getFlashBag()->set("success", "O Produto " . $produto->getNome() . " foi alterado com sucesso!");
            return $this->redirectToRoute("listar_categoria");
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
     * @Route("categoria/visualizar/{id}", name="visualizar_categoria")
     * @Template("categoria/view.html.twig")
     */
    public function view(Request $request, $id)
    {
        /*TODO: TROCAR PRODUTO POR CATEGORIA */
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
     * @Route("categoria/apagar/{id}", name="apagar_categoria")
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Request $request, $id)
    {

        /*TODO: TROCAR PRODUTO POR CATEGORIA */
        $em = $this->getDoctrine()->getManager();
        $produto = $em->getRepository(Produto::class)->find($id);

        if (!$produto) {
            $mensagem = "Produto não foi encontrado!";
            $tipo = "warning";
        } else {
            $em->remove($produto);
            $em->flush();
            $mensagem = "Produto foi excluído com sucesso!";
            $tipo = "success";
        }

        $this->get('session')->getFlashBag()->set($tipo, $mensagem);
        return $this->redirectToRoute("listar_categoria");

    }
}
