<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Usuario;
use App\Form\UsuarioType;

class UsuarioController extends Controller
{

	/**
	 * @Route("/usuario/crear", name="usuario_crear")
	 * @Template()
	 */
	public function crear(Request $request)
	{
		$usuario = new Usuario();
		$form = $this->createForm(UsuarioType::class, $usuario);
		$form->handleRequest($request);
		if ($form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($usuario);
			$em->flush();
			return $this->redirectToRoute('usuario_porid', ['id' => $usuario->getId()]);
		}

		return [
			'form'=>$form->createView(),
		];
	}

	/**
	 * @Route("/usuario/editar/{id}", name="usuario_editar")
	 * @Template()
	 */
	public function editar(Usuario $usuario, Request $request)
	{
	    $form = $this->createForm(UsuarioType::class, $usuario);
	    $form->handleRequest($request);
	    if ($form->isValid()) {
	    	$em = $this->getDoctrine()->getManager();
	    	$em->flush();
			return $this->redirectToRoute('usuario_porid', ['id' => $usuario->getId()]);
	    }
		return [
			'form'=>$form->createView(),
		];
	}


    /**
     * @Route("/usuario", name="usuario")
     * @Template()
     */
    public function index()
    {
    	$usuario = new Usuario();
    	$usuario->setNombre('Juan');
    	$usuario->setApellido('Perez');
    	$em = $this->getDoctrine()->getManager();
    	$em->persist($usuario);
    	$em->flush();
        // return new Response('Se ha creado una entidad con Id. '.$usuario->getId());
        return [
        	'usuario'=>$usuario,
        ];
    }

    /**
     * @Route("/usuario/{id}", name="usuario_porid")
     * @Template()
     */
    public function porid($id)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository(Usuario::class)->find($id);
        if ($usuario == null)
        	return new Response('No existe usuario');

        return [
        	'usuario'=>$usuario,
        ];
    }

    /**
     * @Route("/borrarpornombre/{nombre}", name="usuario_borrarpornombre")
     * @Template()
     */
    public function borrarpornombre($nombre)
    {
    	$em = $this->getDoctrine()->getManager();
    	$usuarios = $em->getRepository(Usuario::class)->findBy(['nombre'=>$nombre]);
    	foreach ($usuarios as $usuario) {
    		$em->remove($usuario);
    	}
    	$em->flush();
    	return [
    		'usuarios'=>$usuarios,
    	];
        
    }
}
