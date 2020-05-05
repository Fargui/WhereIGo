<?php

namespace App\Data;

class SearchData {


    /**
     * @var int
     */
    public $page = 1;


    /**
     * 
     */
    public $placeHasCategories = [];

    /**
     * 
     */
    public $q = '';
   

   /**
    * @var null|integer
    */
   public $min;

   /**
    * @var null|integer
    */
    public $max;
}


