<?php


namespace App\Controller;



use App\Entity\Author;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="main_page")
     */
    public function index()
    {
        $authors = $this->getDoctrine()->getRepository(Author::class)->findAll();

        // return new Response('Home Controller');
        return $this->render('home/index.html.twig', array('authors' => $authors));
    }

    /**
     * Добавить случайного автора
     * @Route("/author", name="create_random_author")
     */
    public function createAuthor(): Response
    {
        $names = ['Алан','Ирвинг','Джордж','Кори','Эрнест','Терри','Нил','Роджер','Теодор','Стивен'];
        $surnames = ['Брэдли', 'Стоун', 'Мартин', 'Тейлор', 'Хемингуэй',
            'Прачетт', 'Стивенсон', 'Желязны', 'Драйзер', 'Кинг'];

        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createAuthor(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $author = new Author();
        $author->setName($names[random_int(1,10)]);
        $author->setSurname($surnames[random_int(1,10)]);

        // tell Doctrine you want to (eventually) save the Author (no queries yet)
        $entityManager->persist($author);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return $this->redirectToRoute('index');
    }

}