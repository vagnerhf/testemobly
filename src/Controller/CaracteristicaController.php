<?php

namespace App\Controller;

use App\Entity\Caracteristica;
use App\Form\CaracteristicaType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CaracteristicaController extends Controller
{
    /**
     * @Route("/caracteristicas", name="listar_caracteristica")
     * @Template("caracteristica/index.html.twig")
     */
    public function index()
    {

        $em = $this->getDoctrine()->getManager();

        $caracteristicas = $em->getRepository(Caracteristica::class)->findAll();

        return [
            'caracteristicas' => $caracteristicas
        ];

    }


    /**
     * @param Request $request
     *
     * @Route("/caracteristica/cadastrar", name="cadastrar_caracteristica")
     * @Template("caracteristica/create.html.twig")
     * @return Response
     */
    public function create(Request $request)
    {
        $caracteristica = new Caracteristica();

        $form = $this->createForm(CaracteristicaType::class, $caracteristica);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($caracteristica);
            $em->flush();

            $this->get('sessio')->getFlashBag()->set('success', 'Característica cadastrada!');
            return $this->redirectToRoute('listar_caracteristica');

        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @param Request $request
     * @return Response
     * @Template("caracteristica/update.html.twig")
     * @Route("caracteristica/editar/{id}", name="editar_caracteristica")
     */
    public function update(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $caracteristica = $em->getRepository(Caracteristica::class)->find($id);

        $form = $this->createForm(CaracteristicaType::class, $caracteristica);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($caracteristica);
            $em->flush();

            $this->get('session')->getFlashBag()->set('success', 'A Característica ' . $caracteristica->getNome() . ' foi alterada com sucesso!');
            return $this->redirectToRoute('listar_caracteristica');
        }

        return [
            'caracteristica' => $caracteristica,
            'form' => $form->createView()
        ];
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return array
     * @Route("caracteristica/visualizar/{id}", name="visualizar_caracteristica")
     * @Template("caracteristica/view.html.twig")
     */
    public function view(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $caracteristica = $em->getRepository(Caracteristica::class)->find($id);

        return [
            'caracteristica' => $caracteristica
        ];
    }


    /**
     * @param Request $request
     * @param $id
     *
     * @Route("caracteristica/apagar/{id}", name="apagar_caracteristica")
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $caracteristica = $em->getRepository(Caracteristica::class)->find($id);

        if (!$caracteristica) {
            $mensagem = 'Característica não foi encontrada!';
            $tipo = 'warning';
        } else {
            $em->remove($caracteristica);
            $em->flush();
            $mensagem = 'Característica foi excluída com sucesso!';
            $tipo = 'success';
        }

        $this->get('session')->getFlashBag()->set($tipo, $mensagem);
        return $this->redirectToRoute('listar_caracteristica');

    }
}
