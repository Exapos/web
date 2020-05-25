<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\Entity\DbUser;
use App\Model\Service\UserAccountService;
use App\Model\Service\UserService;
use Kdyby\Translation\Translator;
use Nette\Security\AuthenticationException;
use Nette\Security\IAuthenticator;
use Nette\Security\Passwords;
use Nette\SmartObject;

/**
 * Class Authenticator
 */
class Authenticator implements IAuthenticator
{
    use SmartObject;

    const NAMESPACE_ADMIN = 'administration';
    const NAMESPACE_FRONT = 'front';
    const ADMIN_STORAGE = 'Nette.Http.UserStorage/admin';

    /** @var UserAccountService */
    private $userAccountService;

    /** @var Translator */
    private $translator;

    public function __construct(UserAccountService $userAccountService, Translator $translator)
    {
        $this->userAccountService = $userAccountService;
        $this->translator = $translator;
    }

    public function authenticate(array $credentials)
    {

        list($email, $password) = $credentials;
        $module = self::NAMESPACE_FRONT;
        $force = false;

        $user = $module == self::NAMESPACE_FRONT
            ? $this->authenticateToFront($email, $password, $force)
            : $this->authenticateToAdmin($email, $password);

        return $user;
    }

    private function authenticateToFront($email, $password, $force = false)
    {
        if (!$user = $this->userAccountService->findOneBy(['username' => $email])) {
            throw new AuthenticationException(
                'wrongEmail',
                self::IDENTITY_NOT_FOUND
            );
        }

        // if (!$force && !Passwords::verify($password, $user->password)) {
        if (!$force && sha1($password) !=  $user->password) {
            throw new AuthenticationException(
                $this->translator->translate('wrongPassword'),
                self::INVALID_CREDENTIAL
            );
        }

        $this->userAccountService->save($user);

        return $user;
    }

    private function authenticateToAdmin($email, $password)
    {
        /** @var DbUser $user */
        $user = $this->dbUserRepository->findOneBy(['email' => $email]);

        if (!$user) {
            throw new AuthenticationException(
                $this->translator->translate('wrongEmail'),
                self::IDENTITY_NOT_FOUND
            );
        }

        if (!$user->isAdmin()) {
            throw new AuthenticationException(
                $this->translator->translate('accessDenied'),
                self::FAILURE
            );
        }

        if ($user->new_hash) {
            // standard login - with nette hash
            if (!Passwords::verify($password, $user->password)) {
                throw new AuthenticationException(
                    $this->translator->translate('wrongPassword'),
                    self::INVALID_CREDENTIAL
                );
            }
        } else {
            // old login - md5 with salt
            $oldHash = $user->password;
            $parts = explode(':', $oldHash);
            $hash = $parts[0];
            $salt = $parts[1];
            if ($hash != md5($password . $salt)) {
                throw new AuthenticationException(
                    $this->translator->translate('wrongPassword'),
                    self::INVALID_CREDENTIAL
                );
            }
            $user->new_hash = true;
            $user->password = Passwords::hash($password);
            $this->dbUserRepository->persist($user);
        }

        return $user;
    }

    private static function getSessionIdentity()
    {
        if (isset($_SESSION['__NF']['DATA'][self::ADMIN_STORAGE]['identity'])) {
            return $_SESSION['__NF']['DATA'][self::ADMIN_STORAGE]['identity'];
        }
    }
}
