<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Form\LivreType;
use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/livre")
 */
class LivreController extends AbstractController
{
    /**
     * @Route("/", name="livre_index", methods={"GET"})
     */
    public function index(LivreRepository $livreRepository): Response
    {
        return $this->render('livre/index.html.twig', [
            'livres' => $livreRepository->findAll(),
        ]);
    }


    /**
     * @Route("/find", name="find", methods={"GET"})
     */
    public function find(Request $request, LivreRepository $livreRepository) : Response
    {
        $value =  $request->get("search"); 

        $livres = $livreRepository->findByExampleField($value);
        
        return $this->render('livre/search.html.twig', [
            'livres' => $livres,
        ]);
    }

    /**
     * @Route("/emprunter", name="emprunter", methods={"GET"})
     */
    public function emprunter(LivreRepository $livreRepository): Response
    {
        // $livreEmpunte = $livreRepository->findBy(['disponibilite' => false]);
        $livres = $livreRepository->findAll();
        $livresEmprunte = [];
        foreach ($livres as $livre) {
            if (count($livre->getUsers()) > 0) {
                $livresEmprunte[] = $livre;
            }
        }
        return $this->render('livre/emprunter.html.twig', [
            'livres' => $livresEmprunte,
        ]);
    }

    /**
     * @Route("/{id}/emprunt", name="emprunt", methods={"GET"})
     */

    public function emprunt(Livre $livre): Response
    {
        $user1 = $this->getUser();
        $users = $livre->getUsers();
        $em = $this->getDoctrine()->getManager();
        foreach ($users as $user) {
            if ($user == $user1) {
                $livre->removeUser($user1);
                $quantiteActuelle = $livre->getQuantite();
                $livre->setQuantite($quantiteActuelle + 1);
                $livre->setDisponibilite(true);
                $em->persist($livre);
                $em->flush();
                return $this->redirectToRoute('livre_index');
            }
        }

        $quantiteActuelle = $livre->getQuantite();

        if ($quantiteActuelle <= 0) 
        {
            return $this->redirectToRoute('livre_index');
        }
        
        $livre->addUser($user1);
        $livre->setQuantite($quantiteActuelle - 1);
        $quantiteActuelle = $livre->getQuantite();

        if ($quantiteActuelle == 0) 
        {
            $livre->setDisponibilite(false);
        }
        else 
        {
            $livre->setDisponibilite(true);
        }

        $em->persist($livre);
        $em->flush();
        return $this->redirectToRoute('livre_index');
    }

    /**
     * @Route("/new", name="livre_new", methods={"GET","POST"})
     */
    function new(Request $request): Response
    {
        $livre = new Livre();
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($livre);
            $entityManager->flush();

            return $this->redirectToRoute('livre_index');
        }

        return $this->render('livre/new.html.twig', [
            'livre' => $livre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="livre_show", methods={"GET"})
     */
    public function show(Livre $livre): Response
    {
        return $this->render('livre/show.html.twig', [
            'livre' => $livre,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="livre_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Livre $livre): Response
    {
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('livre_index');
        }

        return $this->render('livre/edit.html.twig', [
            'livre' => $livre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="livre_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Livre $livre): Response
    {
        if ($this->isCsrfTokenValid('delete' . $livre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($livre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('livre_index');
    }
}
