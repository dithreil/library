<?php


namespace App\Controller;


use App\Entity\Author;
use App\Entity\Book;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookController extends AbstractController
{
    public function index()
    {
        return new Response('Book Controller');
    }

    /**
     * @Route("/books/create", name="add_book")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $book = new Book();

        $form = $this->createFormBuilder($book)
            ->add('title', TextType::class, array('attr' =>
                array('class' => 'form-control')))->add('year', NumberType::class, array(
                'required' => true,
                'attr' => array(
                    'min' => -5000,
                    'max' => 2021,
                    'step' => 1,
                ),
            ))
            ->add('author', EntityType::class, array (
                'label' => 'Выбор автора',
                'class' => Author::class,
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Create',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $book = $form->getData();

            //dd($form);

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($book);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('books/create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/books/{id}", name="show_books")
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        $author = $this->getDoctrine()->getRepository(Author::class)->find($id);


        $books = $author->getBooks();

        return $this->render('books/by_author.html.twig', array ('books' => $books, 'author' => $author));
    }
}