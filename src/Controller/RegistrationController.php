<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Service\JWTService;
use App\Service\SendMailService;
use Doctrine\ORM\EntityManagerInterface;
use PharIo\Version\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    private RegistrationFormType $registrationForm;

    public function __construct(RegistrationFormType $registrationForm)
    {
        $this->registrationForm = $registrationForm;
    }

    #[Route('/registration', name: 'app_registration')]
    public function index(Request $request, SendMailService $mail, JWTService $jwt, EntityManagerInterface $entityManager, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $existingEmail=$userRepository->findOneBy(['email' => $user->getEmail()]);
            $existingUsername=$userRepository->findOneBy(['user_name' => $user->getUserName()]);

            if (!$existingEmail && !$existingUsername){
                try{
                    $this->registrationForm->handleform($user, $form);

                    $entityManager->persist($user);
                    $entityManager->flush();

                    //on génère le JWT de l'utilisateur
                    //on crée le header
                    $header = ['typ' => 'JWT', 'alg' => 'HS256'];

                    //on crée le payload
                    $payload = ['user_id' => $user->getId()];

                    //on génère le token
                    $token = $jwt->generate($header, $payload, $this->getParameter('app.jwtsecret'));

                    //on envoie un mail de confirmation
                    $mail->send(
                        'no-reply@maps.com',
                        $user->getEmail(),
                        'Activation de votre compte MAPS',
                        'register',
                        ['user' => $user, 'token' => $token] //<=>compact('user', 'token')
                    );
                    $this->addFlash('success', 'Inscription réussie ! ');

                } catch(Exception){
                $this->addFlash('danger', 'Un problème est survenu');
                }
                return $this->redirectToRoute('app_login');
            }
            else {
                $this->addFlash('danger', 'Nom d\'utilisateur ou email déjà utilisé, merci de réessayer.');
            }
        }

        return $this->render('registration/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/verif/{token}', name: 'app_verify_user')]
    public function verifyUser($token, JWTService $jwt, UserRepository $userRepository, EntityManagerInterface $em): Response
    {
        //on vérifie si le token est valide, n'a pas expiré et n'a pas été modifié
        if($jwt->isValid($token) && !$jwt->isExpired($token) && $jwt->check($token, $this->getParameter('app.jwtsecret'))){
            // on récupère le payload
            $payload = $jwt->getPayload($token);

            // on récupère le user du token
            $user = $userRepository->find($payload['user_id']);

            //on vérifie que l'user existe et n'a pas activé son compte
            if($user && !$user->getIsVerified()){
                $user->setIsVerified(true);
                $em->flush($user);
                $this->addFlash('success', 'Adresse email vérifiée.');
                return $this->redirectToRoute('app_homepage');
            }
        }
        // problème dans le token
        $this->addFlash('danger', 'Le token est invalide ou a expiré.');
        return $this->redirectToRoute('app_login');
    }


    #[Route('/reverif', name: 'app_re_verify_user')]
    public function reVerify(JWTService $jwt, SendMailService $mail): Response
    {
        $user = $this->getUser();

        if(!$user){
            $this->addFlash('danger', 'Vous devez être connecté pour accéder à cette page.');
            return $this->redirectToRoute('app_login');
        }

        if($user->getIsVerified()){
            $this->addFlash('warning', 'Cet utilisateur est déjà vérifié.');
            return $this->redirectToRoute('app_login');
        }

        //on génère le JWT de l'utilisateur
            //on crée le header
        $header = ['typ' => 'JWT', 'alg' => 'HS256'];

        //on crée le payload
        $payload = ['user_id' => $user->getId()];

        //on génère le token
        $token = $jwt->generate($header, $payload, $this->getParameter('app.jwtsecret'));

        //on envoie un mail
        $mail->send(
            'no-reply@maps.com',
            $user->getEmail(),
            'Activation de votre compte MAPS',
            'register',
            ['user' => $user, 'token' => $token] // <=>compact('user', 'token')
        );

        $this->addFlash('success', 'Email de vérification envoyé.');
        return $this->redirectToRoute('app_homepage');
    }
}