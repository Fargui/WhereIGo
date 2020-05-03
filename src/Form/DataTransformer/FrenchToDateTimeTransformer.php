<?php

namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class FrenchToDateTimeTransformer implements DataTransformerInterface {


    public function transform($date)
    {
            if($date === null){
            return '';
            }
        return $this->date = $date->format('d-m-Y');
    }

    public function reverseTransform($frenchDate) 
    {
        // frenchDate = 03/01/1987
        if($frenchDate === null){
            //Exception
            throw new TransformationFailedException("Une date est necessaire");
        }
        $date = \DateTime::createFromFormat('Y-m-d', $frenchDate);

        if($date === false){
            //Exceptio,
            throw new TransformationFailedException("Le format de date n'est pas good");
        }
        return $date;       
    }
}

