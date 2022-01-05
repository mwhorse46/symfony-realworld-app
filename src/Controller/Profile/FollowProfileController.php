<?php

declare(strict_types=1);

namespace App\Controller\Profile;

use App\Entity\User;
use App\Security\UserResolver;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/profiles/{username}/follow", methods={"POST"}, name="api_profiles_follow")
 *
 * @Security("is_granted('ROLE_USER')")
 */
final class FollowProfileController extends AbstractController
{
    private UserResolver $userResolver;
    private EntityManagerInterface $entityManager;

    public function __construct(UserResolver $userResolver, EntityManagerInterface $entityManager)
    {
        $this->userResolver = $userResolver;
        $this->entityManager = $entityManager;
    }

    public function __invoke(User $profile): array
    {
        $user = $this->userResolver->getCurrentUser();
        $user->follow($profile);

        $this->entityManager->flush();

        return ['profile' => $profile];
    }
}
