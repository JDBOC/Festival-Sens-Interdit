<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Admin;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $cypher;

    public function __construct(UserPasswordEncoderInterface $cypher)
    {
        $this->cypher = $cypher;
    }
    public function load(ObjectManager $manager)
    {
        $admin = new Admin();
        $admin->setUsername('demo');
        $admin->setPassword($this->cypher->encodePassword($admin, 'demo'));
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);
        $manager->flush();
    }
}
