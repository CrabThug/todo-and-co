<?php

namespace App\Security\Voter;

use App\Entity\Task;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class TaskVoter extends Voter
{

    public const DELETE = 'delete';
    public const EDIT = 'edit';
    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports($attribute, $subject)
    {
        // https://symfony.com/doc/current/security/voters.html
        if (!in_array($attribute, [self::DELETE, self::EDIT], true)) {
            return false;
        }

        if (!$subject instanceof Task) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof User) {
            return false;
        }
        $task = $subject;
        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::EDIT:
                return $this->canEdit($user);
                break;
            case self::DELETE:
                return $this->canDelete($task, $user);
                break;
        }

        return false;
    }

    private function canEdit(User $user)
    {
        return $user ? true : false;
    }

    private function canDelete(Task $task, User $user)
    {
        if ($user === $task->getUser()) {
            return true;
        }

        return ($this->security->isGranted('ROLE_ADMIN') && 'anonyme' === $task->getUser());
    }
}
