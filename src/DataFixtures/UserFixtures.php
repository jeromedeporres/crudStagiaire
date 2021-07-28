<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setNom('ANTON');
        $user->setPrenom('Jerome');
        $user->setDateInscription(new \DateTime());
        $user->setEmail('jerome@abc.fr');
        $user->setRoles (['ROLE_ADMIN']);
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'jerome'));
        $manager->persist($user);
        $user2 = new User();
        $user2->setNom('DEPORRES');
        $user2->setPrenom('Kevin');
        $user2->setDateInscription(new \DateTime("2020-12-24"));
        $user2->setEmail('kevin@kevin.us');
        $user2->setPassword($this ->passwordEncoder->encodePassword($user2, 'kevin'));
        $manager->persist($user2);
        $manager->flush();
    }
}
