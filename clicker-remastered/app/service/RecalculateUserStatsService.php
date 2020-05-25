<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\Entity\UserAccount;
use DateTime;
use Nette\Security\IAuthenticator;

class RecalculateUserStatsService implements IAuthenticator
{
    public function updateStats(UserAccount $userAccount, $perSecondGenerateNewValue)
    {
        // $perSecondGenerateAmount
        if (!$userAccount->perSecondGenerateLastCheck) { // poprvé nakupuju něco, co generuje "píčoviny/s"
            $userAccount->perSecondGenerateLastCheck = new DateTime();
        } else {
            $seconds = (new DateTime())->getTimestamp() - $userAccount->perSecondGenerateLastCheck->getTimestamp();

            dump($seconds);
            exit;
        }
    }
}
