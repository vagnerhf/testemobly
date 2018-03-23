<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Form\CategoriaType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoriaController extends Controller
{
    /**
     * @Route("/categorias", name="listar_categoria")
     * @Template("categoria/index.html.twig")
     */
    public function index()
    {

        $em = $this->getDoctrine()->getManager();

        $categorias = $em->getRepository(Categoria::class)->findAll();

        return [
            'categorias' => $categorias
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
        $categoria = new Categoria();

        $form = $this->createForm(CategoriaType::class, $categoria);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($categoria);
            $em->flush();

            //$this->get('session')->getFlashBag()->set('success', 'Produto foi salvo com sucesso!');
            $this->addFlash('success', "Categoria cadastrada!");
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

        $em = $this->getDoctrine()->getManager();
        $categoria = $em->getRepository(Categoria::class)->find($id);

        $form = $this->createForm(CategoriaType::class, $categoria);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($categoria);
            $em->flush();

            $this->get("session")->getFlashBag()->set("success", "A Categoria " . $categoria->getNome() . " foi alterado com sucesso!");
            return $this->redirectToRoute("listar_categoria");
        }

        return [
            'categoria' => $categoria,
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

        $em = $this->getDoctrine()->getManager();
        $categoria = $em->getRepository(Categoria::class)->find($id);

        return [
            'categoria' => $categoria
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

        $em = $this->getDoctrine()->getManager();
        $categoria = $em->getRepository(Categoria::class)->find($id);

        if (!$categoria) {
            $mensagem = "Categoria não foi encontrada!";
            $tipo = "warning";
        } else {
            $em->remove($categoria);
            $em->flush();
            $mensagem = "Categoria foi excluída com sucesso!";
            $tipo = "success";
        }

        $this->get('session')->getFlashBag()->set($tipo, $mensagem);
        return $this->redirectToRoute("listar_categoria");

    }
}
