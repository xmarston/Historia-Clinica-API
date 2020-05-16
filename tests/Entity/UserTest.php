<?php

namespace App\Tests\Entity;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testGetId()
    {
        /** @var User $user */
        $user = $this->entityManager
            ->getRepository(UserRepository::class)
            ->findOneBy(['name' => 'Ricardo']);

        $this->assertSame($user->getEmail(), 'dummy@gmail.com');
    }

    public function testGetEmail()
    {

    }

    public function testGetRoles()
    {

    }

    public function testSetEmail()
    {

    }

    public function testGetPassword()
    {

    }

    public function testSetBlocked()
    {

    }

    public function testGetUsername()
    {

    }

    public function testGetName()
    {

    }

    public function testSetPassword()
    {

    }

    public function testGetBlocked()
    {

    }

    public function testSetRoles()
    {

    }

    public function testSetName()
    {

    }
}
