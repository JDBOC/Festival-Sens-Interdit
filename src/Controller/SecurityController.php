<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Admin;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/new", name="app_new")
     */
    public function new(ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $admin = new Admin();
        $admin->setUsername('demo');
        $admin->setPassword($encoder->encodePassword($admin, 'demo'));
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);
        $manager->flush();
        return $this->render('security/login.html.twig');
    }

    /**
     * @Route("editpassword", name="app_editPassword")
     */
    public function editPassword(ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if (!empty($_POST)) {
            if ($encoder->isPasswordValid($user, $_POST['AncienPassword'])) {
                if ($_POST['NewPassword'] == $_POST['ConfirmePassword']) {
                    dump($_POST['NewPassword']);
                    dump($_POST['ConfirmePassword']);
                    $user->setPassword($encoder->encodePassword($user, $_POST['NewPassword']));
                    $manager->persist($user);
                    $manager->flush();
                } else {
                    $error1 = 'Les mots de passe ne correspondent pas';
                    return $this->render('/security/editPassword.html.twig', [
                                        "error1" => $error1
                                        ]);
                }
            } else {
                $error2 = 'Mauvais mot de passe';
                return $this->render('/security/editPassword.html.twig', [
                            "error2" => $error2
                            ]);
            }
        }
        return $this->render('/security/editPassword.html.twig');
    }
}
