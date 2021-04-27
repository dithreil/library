<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;

class BookController
{
    public function index()
    {
        return new Response('Book Controller');
    }
}