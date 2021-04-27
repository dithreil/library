<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;

class AuthorController
{
    public function index()
    {
        return new Response('Author Controller');
    }
}