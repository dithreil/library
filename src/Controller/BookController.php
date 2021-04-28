<?php


namespace App\Controller;


use App\Entity\Author;
use App\Entity\Book;
use App\Form\BookType;
use App\Service\BookService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookController extends AbstractController
{
    /**
     * @var BookService
     */
    private $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * @return Response
     */
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

        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $this->bookService->handleCreate($form);

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
        $b = $this->getDoctrine()->getRepository(Book::class)->find(1);

        $books = $author->getBooks();

        return $this->render('books/by_author.html.twig', array ('books' => $books, 'author' => $author));
    }
}