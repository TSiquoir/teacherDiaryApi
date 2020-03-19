<?php

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;


class GoogleLoginAuthenticator extends AbstractGuardAuthenticator
{
    /*
    * @param EntityManagerInterface $em
    */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    public function supports(Request $request)
    {
        return 'api_login_google' === $request->attributes->get('_route')
        && $request->isMethod('POST');
    }

    public function getCredentials(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['id_token']) || !$data['id_token']) {
            throw new NotAcceptableHttpException("The param id_token is required");
        }

        return [
            'id_token' => $data['id_token'],
        ];    
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $client = new \Google_Client([
            'client_id' => $_ENV['GOOGLE_CLIENT_ID']
        ]);  
        
        $payload = null;
        $previous = null;

        try {
            $payload = $client->verifyIdToken($credentials['id_token']);
        } catch (\Exception $e) {
            $previous = $e;
        }
       
        $googleId = $payload['sub'];

        $user = $this->em->getRepository(User::class)
        ->findOneBy(['google' => $googleId]);

        if (!$user) {

            $email = $payload['email'];

            $user = $this->em->getRepository(User::class)
            ->findOneBy(['email' => $email]);

            if (!$user) {
                $user = new User;
                if ($payload['email'] && $payload['email_verified']) {
                    $user->setEmail($payload['email']);
                }
                if ($payload['given_name']) {
                    $user->setFirstName($payload['given_name']);
                }

                if ($payload['family_name']) {
                    $user->setLastName($payload['family_name']);
                }
                /*
                Avatar
                if ($payload['picture']) {
                    $user->setAvatar($payload['picture']);
                }
                */
            }

            $user->setGoogle($googleId);

            $this->em->persist($user);
            $this->em->flush();
        }
        return $user;
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return null;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return null;
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        return null;
    }

    public function supportsRememberMe()
    {
        return false;
    }
}
