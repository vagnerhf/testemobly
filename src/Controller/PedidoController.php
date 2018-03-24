<?php

namespace App\Controller;

use App\Entity\Pedido;
use App\Form\PedidoType;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\VarDumper\VarDumper;

class PedidoController extends Controller
{
    /**
     * @Route("/pedido", name="loja_pedido")
     * @Template("pedido/index.html.twig")
     * @return Response
     */
    public function index(Request $request)
    {

        $pedido = new Pedido();

        $form = $this->createForm(PedidoType::class, $pedido);

        $form->handleRequest($request);

        $session = $this->get('session');


        VarDumper::dump($session);

        if(isset($session->get['carrinho']))
        {
            $carrinho = $session->get['carrinho'];
        } else {
            $carrinho = new ArrayCollection();
        }

        return [
            'carrinho' => $carrinho,
            'form' => $form->createView()
        ];
    }


    /**
     * @Route("/pedido/adiciona/carrinho/{id}", name="pedido_adiciona_carrinho")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addCart(Request $request, $id) {

        $session = $this->get('session');

        $em = $this->getDoctrine()->getManager();
        $produto = $em->getRepository(Produto::class)->find($id);

        if($produto) {
            Pedido::adicionaProdutoSessao($session, $produto);
        }

        return $this->redirectToRoute('pedido');

    }

    /**
     * @Route("/pedido/remove/carrinho/{id}", name="pedido_remove_carrinho")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeCart(Request $request, $id) {
/*
        $em = $this->getDoctrine()->getManager();
        $produto = $em->getRepository(Produto::class)->find($id);

        if($produto) {
            Pedido::removeProdutoSessao($session,$produto);
        }
*/
        return $this->redirectToRoute('pedido');

    }

}
