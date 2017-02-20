<?php
namespace App\Core\Framework;
class Object{
    static function n(){
        static $self;
        if($self){
            return $self;
        }else{
          return  new static();
        }
    }
}