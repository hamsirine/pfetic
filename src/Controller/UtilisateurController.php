<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistreType;
use App\Repository\AdminRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UtilisateurController extends AbstractController
{
    #[Route('/', name: 'app_utilisateur')]
    public function index(): Response
    {
        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }


    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param UserPasswordHasherInterface $userPasswordHasher
     * @param ManagerRegistry $doctrine
     * @param AdminRepository $adminRepository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/addUser", name="addUser")
     */


    public function addUser(\Symfony\Component\HttpFoundation\Request $request, UserPasswordHasherInterface $userPasswordHasher, ManagerRegistry $doctrine, AdminRepository $adminRepository)
    {
        $user = new User();
        $form=$this->createForm(RegistreType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            $matricule=$adminRepository->findOneBy($form->get('Matricule'));
            if ($matricule)
            {
                $entityManager->persist($user);
                $entityManager->flush();
            }else
            {
                echo'Saisir matricule correcte';
            }


            return $this->redirectToRoute("addUser");
        }
        return $this->render("home/index.html.twig",[
            'f'=>$form->createView()
        ]);

    }
}
