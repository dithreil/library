<?php


namespace App\Controller;


use App\Entity\Author;
use App\Form\AuthorType;
use App\Service\AuthorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AuthorController extends AbstractController
{
    /**
     * @var AuthorService
     */
    private $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

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

        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $this->authorService->handleCreate($form);

            return $this->redirectToRoute('index');
        }

        return $this->render('authors/create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/authors/update/{id}", name="update_author")
     * @param int $id
     * @param Request $request
     * @return Response|RedirectResponse
     */
    public function update(int $id, Request $request): Response
    {
        $author = $this->getDoctrine()->getRepository(Author::class)->find($id);

        $form = $this->createFormBuilder($author)
            ->add('name', TextType::class, array('attr' =>
                array('class' => 'form-control')))
            ->add('surname', TextType::class, array(
                'required' => false,
                'attr' => array('class' => 'form-control')
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Edit',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('authors/create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/authors/{id}", name="show")
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        $author = $this->getDoctrine()->getRepository(Author::class)->find($id);

        return $this->render('authors/show.html.twig', array ('author' => $author));
    }

}