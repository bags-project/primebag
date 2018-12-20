<?php

namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use App\Entity\User;
use App\Form\UserRegisterType;

class UserService 
{
    private $om;
    private $userRegisterType;
    private $encoder;

    public function __construct( ObjectManager $om, UserPasswordEncoderInterface $encoder)
    {
        $this->om = $om;
        $this->encoder = $encoder;
    }

    public function registerUser($user)
    {
        
        $plainPassword = $user->getPlainPassword();
        $encoded = $this->encoder->encodePassword($user, $plainPassword);  
        $user->setPassword($encoded);
        $this->om->persist($user);
        $this->om->flush();
    }

    public function edit()
    {

        $this->om->flush();

    }

    public function delete($user)
    {
        $orders= $user->getOrders();

            foreach($orders as $order)
            {
            $order->setUser(null);       
            }

        $this->om->remove($user);
        $this->om->flush();

    }













    public function getOne($id) {
        $repo = $this->om->getRepository(User::class); 
        return $repo->find($id);
    }
}