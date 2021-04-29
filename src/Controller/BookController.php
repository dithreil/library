<?php


namespace App\Controller;


use App\Dto\BookData;
use App\Entity\Author;
use App\Entity\Book;
use App\Form\BookCreateType;
use App\Service\BookService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Uid\Uuid;

class BookController extends AbstractController
{
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
     * @param BookService $bookService
     * @return Response
     */
    public function createAction(Request $request, BookService $bookService)
    {
        $book = new BookData();

        $form = $this->createForm(BookCreateType::class, $book);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $bookService->handleCreate($form);

            return $this->redirectToRoute('index');
        }

        return $this->render('books/create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/books/{id}", name="show_books")
     * @param Uuid $id
     * @return Response
     */
    public function showAction($id)
    {
        $author = $this->getDoctrine()->getRepository(Author::class)->find($id);

        $books = $author->getBooks();

        return $this->render('books/by_author.html.twig', array ('books' => $books, 'author' => $author));
    }
}