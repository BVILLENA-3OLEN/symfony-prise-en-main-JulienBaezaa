<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Enum\Entity\RoleEnum;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;






class UserFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher
        )
    {
        
        
    }



    public function load(ObjectManager $manager): void{
        $adminRole = new Role();
        $adminRole
            ->setCode(RoleEnum::ADMIN->value)
            ->setLabel('Admin');
        $manager->persist($adminRole);

       $admin = new User();
       $admin 
            ->setName('eduardo')
            ->setEmail('ed.test@gmail.com')
            ->setPassword(
                $this->userPasswordHasher->hashPassword(
                    user:$admin,
                    plainPassword:'azerty'
                )
            )
            ->setRole($adminRole);
        $manager->persist($admin);
        $manager->flush();
    }
    
}
