<?php


namespace App\Security;




use App\Controller\SecurityController;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\AuthenticatorInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\PasswordUpgradeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;

class LoginFormAuthenticator extends AbstractGuardAuthenticator
{

//    private $userRepository;
//    private $urlGenerator;
    protected $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
//        $this->userRepository = $userRepository;
//        $this->urlGenerator = $urlGenerator;
        $this->encoder = $encoder;

    }

    public function supports(Request $request): ?bool
    {
        return $request->attributes->get('_route') === 'app_login'
            && $request->isMethod('POST');

    }

    public function getCredentials(Request $request)
    {

        return $request->request->get('login');
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        try {
            return $userProvider->loadUserByUsername($credentials['email']);

        } catch (UsernameNotFoundException $e){
            throw new AuthenticationException("Cette adresse email n'est pas connue");
        }
    }


    public function checkCredentials($credentials, UserInterface $user)
    {

        $isValid =  $this->encoder->isPasswordValid($user,$credentials['password']);

        if (!$isValid){
            throw new AuthenticationException("Le mot de passe est incorrect");
        }

        return true;

    }



    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
    {
        return new RedirectResponse("/");
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $login = $request->request->get('login');
        $request->attributes->set(Security::LAST_USERNAME,$login['email']);
        $request->attributes->set(Security::AUTHENTICATION_ERROR, $exception);
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new RedirectResponse('/login');
    }

    public function supportsRememberMe()
    {
        // todo
    }
}