<?php

namespace App\Controller;

use App\Form\OrderType;
use App\Form\UserType;
use App\Security\LoginFormAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AuthController extends AbstractController
{
    /**
     * @Route("/admin/registration", name="admin_registration")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param GuardAuthenticatorHandler $guardHandler
     * @param LoginFormAuthenticator $authenticator
     * @return Response
     */
    public function register(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $authenticator)
    {
        if(!(isset($_ENV['APP_REGISTRATION']) && $_ENV['APP_REGISTRATION'] === 'true')) {
            throw $this->createNotFoundException();
        }

        if ($this->getUser()) {
            return $this->redirectToRoute('index_admin');
        }

        $form = $this->createForm(UserType::class);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $registration_key = $request->request->get('user')['registration_key'];

            if(!(isset($_ENV['APP_REGISTRATION_KEY']) && $_ENV['APP_REGISTRATION_KEY'] === $registration_key)) {
                return $this->redirectToRoute('admin_registration');
            }

            $user = $form->getData();
            $retype_password = $request->request->get('user')['recovery_password'];

            if ($user->getPassword() === $retype_password) {
                $user->setPassword(
                    $passwordEncoder->encodePassword(
                        $user,
                        $user->getPassword()
                    )
                );

                $user->setRoles(['ROLE_ADMIN']);
                $em->persist($user);
                $em->flush();

                return $guardHandler->authenticateUserAndHandleSuccess(
                    $user,
                    $request,
                    $authenticator,
                    'main' // firewall name in security.yaml
                );
            }
        }

        return $this->render('index_admin/auth/register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/login", name="admin_login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('index_admin/auth/login.html.twig', [
            'form_order' => $this->createForm(OrderType::class)->createView(),
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    /**
     * @Route("/admin/logout", name="admin_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
