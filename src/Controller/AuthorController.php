<?php


namespace App\Controller;


use App\Entity\Author;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AuthorController extends AbstractController
{
    public function index()
    {
        return new Response('Author Controller');
    }

    /**
     * @Route("/authors/create", name="create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $author = new Author();

        $form = $this->createFormBuilder($author)
            ->add('name', TextType::class, array('attr' =>
            array('class' => 'form-control')))->add('surname', TextType::class, array(
                'required' => false,
                'attr' => array('class' => 'form-control')
            ))
        ->add('save', SubmitType::class, array(
            'label' => 'Create',
            'attr' => array('class' => 'btn btn-primary mt-3')
        ))->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $author = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($author);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('authors/create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/authors/{id}", name="show")
     */
    public function show($id)
    {
        $author = $this->getDoctrine()->getRepository(Author::class)->find($id);

        return $this->render('authors/show.html.twig', array ('author' => $author));
    }

}