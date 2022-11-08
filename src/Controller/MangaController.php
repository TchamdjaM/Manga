<?php

namespace App\Controller;

use App\Entity\Manga;
use App\Entity\Mangaka;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MangaController extends AbstractController
{
    /**
     * @Route("/manga", name="app_manga")
     */
    public function index(): Response
    {
        $mangas = $this->getDoctrine()
            ->getRepository(Manga::class)
            ->findAll();
        return $this->render('manga/index.html.twig', [
            'controller_name' => 'MangaController',
            'mangas'          => $mangas
        ]);
    }

    /**
     * @Route("/manga/create", name="app_manga_create")
     */

    public function create(Request $request): Response
    {
        if ($request->isMethod("POST")) {
            $manager = $this->getDoctrine()->getManager();
            // Insertion en BDD
            $manga              = new Manga;
            $manga->setName($request->request->get('name'))
                ->setDescription($request->request->get('description'))
                ->setNbTomes($request->request->get('nbTomes'));

            $mangaka = $this->getDoctrine()
                ->getRepository(Mangaka::class)
                ->find($request->request->get('mangaka'));
            $manga->setMangaka($mangaka);

            $manager->persist($manga);
            $manager->flush();

            return $this->redirectToRoute('app_manga');
        } else {
            $mangakas = $this->getDoctrine()
                ->getRepository(Mangaka::class)
                ->findAll();
            // Affichage du formulaire
            return $this->render('manga/create.html.twig', [
                'controller_name' => 'MangaController',
                'mangakas' => $mangakas
            ]);
        }
    }

    /**
     * @Route("/manga/{manga}/edit", name="app_manga_edit")
     */
    public function edit(Request $request, Manga $manga): Response
    {
        if ($request->isMethod("POST")) {
            $manager = $this->getDoctrine()->getManager();
            // Insertion en BDD
            $manga->setName($request->request->get('name'))
                ->setDescription($request->request->get('description'))
                ->setNbTomes($request->request->get('nbTomes'));

            $mangaka = $this->getDoctrine()
                ->getRepository(Mangaka::class)
                ->find($request->request->get('mangaka'));
            $manga->setMangaka($mangaka);

            $manager->flush();

            return $this->redirectToRoute('app_manga');
        } else {
            $mangakas = $this->getDoctrine()
                ->getRepository(Mangaka::class)
                ->findAll();
            // Affichage du formulaire
            return $this->render('manga/edit.html.twig', [
                'controller_name' => 'MangaController',
                'manga'           => $manga,
                'mangakas'        => $mangakas
            ]);
        }
    }

    /**
     * @Route("/manga/{manga}/delet", name="app_manga_delete")
     */
    public function delete(Request $request, Manga $manga): Response
    {
        $this->getDoctrine()->getManager()->remove($manga);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('app_manga');
    }
}
