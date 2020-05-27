<?php

namespace App\Security\Voter;

use App\Entity\Task;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class TaskControllerVoter extends Voter
{
    const VIEW = 'view';

    protected function supports($attribute, $subject)
    {

        // https://symfony.com/doc/current/security/voters.html
        if ($attribute != self::VIEW) {
            return false;
        }

        // only vote on `Post` objects
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

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'POST_EDIT':
                // logic to determine if the user can EDIT
                // return true or false
                break;
            case 'POST_VIEW':
                // logic to determine if the user can VIEW
                // return true or false
                break;
        }

        return false;
    }

    private function canView(Post $post, User $user)
    {
        // if they can edit, they can view
        if ($this->canEdit($post, $user)) {
            return true;
        }

        // the Post object could have, for example, a method `isPrivate()`
        return !$post->isPrivate();
    }

    private function canEdit(Post $post, User $user)
    {
        // this assumes that the Post object has a `getOwner()` method
        return $user === $post->getOwner();
    }
}
