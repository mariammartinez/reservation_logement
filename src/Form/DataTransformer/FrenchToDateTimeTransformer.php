<?php

namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class FrenchToDateTimeTransformer implements DataTransformerInterface {

    public function transform($date)
    {
        if($date === null){
            die('date = null');
            return '';
        }

        return $date->format('d/m/Y');
    }

    public function reverseTransform($frenchDate)
    {
        if ($frenchDate === null){
            //exception
            throw new TransformationFailedException("la date");
        }
        $date = \DateTime::createFromFormat('d/m/Y', $frenchDate);

        if($date == false){
            //exception
            throw  new TransformationFailedException("pas bon");
        }
        return $date;
    }
}

