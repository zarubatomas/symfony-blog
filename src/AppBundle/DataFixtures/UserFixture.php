<?php
namespace AppBundle\DataFixtures;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture implements OrderedFixtureInterface
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;



    /**
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }



    /**
     * @param ObjectManager $objectManager
     */
    public function load(ObjectManager $objectManager)
    {
        $user = new User();
        $user
            ->setLogin('admin@admin.cz')
            ->setName('Jan')
            ->setSurname('Novak')
            ->addRole('ROLE_USER')
            ->addRole('ROLE_ADMIN');
        $user->setPassword($this->encoder->encodePassword($user, 'test1234'));

        $this->addReference('admin-user', $user);

        $objectManager->persist($user);
        $objectManager->flush();
    }


    public function getOrder()
    {
        return 2;
    }
}