<?php


namespace App\Event;


use Symfony\Contracts\EventDispatcher\Event;

class FicheCreateEvent extends Event
{
    protected $fichePeda;

    public function __construct($fichePeda){
        $this->fichePeda = $fichePeda;
    }

    public function getFichePeda(){
        return $this->fichePeda;
    }



}