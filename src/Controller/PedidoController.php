<?php

namespace App\Controller;

use App\Entity\Pedido;
use App\Entity\Produto;
use App\Form\PedidoType;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class PedidoController extends Controller
{
    /**
     * @Route("/pedido", name="loja_pedido")
     * @Template("pedido/index.html.twig")
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {

        $session = $this->get('session');

        $carrinho = $session->get('carrinho');

        $pedido = new Pedido();
        $form = $this->createForm(PedidoType::class, $pedido);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {


            if($carrinho) {

                $em = $this->getDoctrine()->getManager();


                $pedido->setSession($session);
                $pedido->sessaoParaCarrinho();
                $pedido->serializeCarrinho();

                $em->persist($pedido);
                $em->flush();

                $this->get('session')->getFlashBag()->set('success', 'Pedido cadastrado pode voltar a Comprar!');

            } else {

                $this->get('session')->getFlashBag()->set('warning', 'Precisa ter algo na Carrinho para Comprar.');

            }

            return $this->redirectToRoute('loja_produto');
        }

        if(!$carrinho)
        {
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

        return $this->redirectToRoute('loja_produto');

    }

    /**
     * @Route("/pedido/remove/carrinho/{id}", name="pedido_remove_carrinho")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeCart(Request $request, $id) {

        $session = $this->get('session');

        $em = $this->getDoctrine()->getManager();
        $produto = $em->getRepository(Produto::class)->find($id);

        if($produto) {
            Pedido::removeProdutoSessao($session, $produto);
        }

        return $this->redirectToRoute('loja_pedido');

    }


    /**
     * @Route("/pedido/limpar/carrinho", name="pedido_limpar_carrinho")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function clearCart() {

        $session = $this->get('session');

        Pedido::limparSessao($session);

        return $this->redirectToRoute('loja_pedido');

    }
}
