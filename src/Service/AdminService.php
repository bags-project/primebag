<?php
namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;

class AdminService {

    private $manager;

    public function __construct( ObjectManager $manager) {
        $this->manager = $manager;
    }

    
    public function getAll() {
        // return $this->events;
        $repo = $this->manager->getRepository( Events::class );
        return $repo->findAll();
    }


    public function getOne($id) {
        // return $this->events[$id];

        $repo = $this->manager->getRepository( Events::class );
        return $repo->find( $id);
        

        // foreach ($this->events as $value)
        // {

        //     if ($value['id'] == $id)
        //     {
        //         return $value;
        //     }
            
        // }
        // return null;
    }


    // Ajouté pour recherche personnalisé
    public function search($name, $sort, $page)
    {
        $repo = $this->om->getRepository( Events::class );
        return $repo->search($name, $sort, $page);
    }

    public function counter()
    {
        $repo = $this->om->getRepository( Events::class );
        return $repo->counter();
    }

    public function add($event) {
        $repo = $this->om->getRepository( User::class );
        $user = $repo->find( 1 );
        $event->setOwner( $user );
        $this->setupMedia( $event );
        $this->om->persist($event);
        $this->om->flush();
    }

    private function setupMedia( $event ) {
        if(!empty($event->getPosterUrl() )) {
            return $event->setPoster( $event->getPosterUrl() );
        }

        $file = $event->getPosterFile();
        $filename = md5( uniqid() ).'.'.$file->guessExtension();

        $file->move( './assets/img', $filename );

        return $event->setPoster( $filename );
    }



}