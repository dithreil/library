<?php


namespace App\Controller;

use App\Dto\AuthorData;
use App\Dto\Transformer\AuthorToDataTransformer;
use App\Entity\Author;
use App\Form\AuthorCreateType;
use App\Form\AuthorUpdateType;
use App\Service\AuthorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
     * @param AuthorService $authorService
     * @return Response
     */
    public function createAction(Request $request, AuthorService $authorService): Response
    {
        $authorData = new AuthorData();

        $form = $this->createForm(AuthorCreateType::class, $authorData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $authorService->handleCreate($form);

            return $this->redirectToRoute('index');
        }

        return $this->render('authors/create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/authors/update/{id}", name="update_author")
     * @param string $id
     * @param Request $request
     * @param AuthorService $authorService
     * @param AuthorToDataTransformer $adt
     * @return Response|RedirectResponse
     */
    public function updateAction(
        string $id,
        Request $request,
        AuthorService $authorService,
        AuthorToDataTransformer $adt
    ): Response
    {
        $authorData = $adt->transformAuthorToData($this->getDoctrine()->getRepository(Author::class)->find($id));

        $form = $this->createForm(AuthorUpdateType::class, $authorData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $authorService->handleUpdate($id, $form);

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
    public function showAction($id)
    {
        $author = $this->getDoctrine()->getRepository(Author::class)->find($id);

        return $this->render('authors/show.html.twig', array('author' => $author));
    }

}