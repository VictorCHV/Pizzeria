<?php

namespace App\Controller\Admin;

//use App\Entity\Pizza;  -> Pas besoin de ce "use"
// car l.72 on appelle "int $id" et non "Pizza $pizza"
use App\Form\PizzaType;
use App\Repository\PizzaRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @IsGranted("ROLE_ADMIN")
 *
 */
class AdminPizzaController extends AbstractController
{
    /**
     * @Route("/admin/pizza/nouvelle", name="app_admin_pizza_create")
     */
    public function create(Request $request, PizzaRepository $repository): Response
    {
        // création de l'objet Pizza
        // $Pizza= new Pizza();
        // 2 lignes du dessus -> NA car pas besoin du préremplissage de Pizza

        // création du formulaire
        $form= $this->createForm(PizzaType::class);
        //remplissage du formulaire et de l'objet php avec la requete
        $form->handleRequest($request);

        // tester si le formulaire est envoyé avec données valides
        if ($form->isSubmitted() && $form->isValid()) {
            // recup des données de l'objet/DTO "Pizza" rempli par le formulaire
            $validPizza = $form->getData();
            // enregistrer les données de la pizza dans la DB
            $repository->save($validPizza, true);

            // redirection vers la liste des pizzas
            return $this->redirectToRoute('app_admin_pizza_list');
        }

        // récuperation de la view du formulaire
        $formView= $form->createView();

        //affichage dans le template
        return $this->render('admin_pizza/create.html.twig', [
            'form' => $formView,
        ]);
    }

     /**
     * @Route("/admin/pizza", name="app_admin_pizza_list")
     */
    public function list(Request $request, PizzaRepository $repository): Response
    {
        //recuperer les pizzas depuis la DB
        $pizzas= $repository->findAll(); //retourne la liste des pizzas

        //affichage en passant la liste des pizzas récupérées
        return $this->render('admin_pizza/list.html.twig', [
            'pizzas' => $pizzas,
        ]);
    }

     /**
     * @Route("admin/pizza/modifier/{id}", name="app_admin_pizza_update")
     */

     public function update(int $id, PizzaRepository $repository, Request $request): Response
     {
         //recup les données de la pizza de l'id
         $pizza= $repository->find($id);

         //création du formulaire
         $form= $this->createForm(PizzaType::class, $pizza);

         //remplissage du formulaire et de l'objet php avec la requete
         $form->handleRequest($request);

         //tester si le formulaire est envoyé avec données valides
         if ($form->isSubmitted() && $form->isValid()) {
             //recuperation de l'objet validé et remplie par le formulaire
             $validPizza = $form->getData();

             //enregistrer les données dans la DB
             $repository->save($validPizza, true);

             //redirection vers la liste des pizzas
             return $this->redirectToRoute('app_admin_pizza_list');
         }

         //récuperation de la view du formulaire
         $formView= $form->createView();

         //affichage dans le template
         return $this->render('admin/pizza/update.html.twig', [
             'form' => $formView,
             'pizza' => $pizza,
         ]);
     }

    /**
     * @Route("/admin/pizza/{id}/supprimer", name="app_admin_pizza_delete")
     */
    public function delete(int $id, Request $request, PizzaRepository $repository): Response
    {
        //recuperer la pizza depuis son id
        $pizza = $repository->find($id);

        //suprimer la pizza de la DB
        $repository->remove($pizza, true);

        //redirection vers la liste des pizzas
        return $this->redirectToRoute('app_admin_pizza_list');
    }
}
