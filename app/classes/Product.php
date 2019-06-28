<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 06/01/2019
 * Time: 09:40
 */

namespace App\classes;


class Product
{
    private static $_instance = null;
    private $col;
    private $x;


    public   function gggg()
    {

    }
    public static function getInstance()
    {
        if( !is_object(self::$_instance) )  //or if( is_null(self::$_instance) ) or if( self::$_instance == null )
            self::$_instance = new Product();
        return self::$_instance;
    }


    public function where($col)
    {
        $this->col = $col;
        return $this;
    }

    public function test($x)
    {
        $this->x = $x;

        return $this;
    }

    public function make()
    {
        echo $this->col."_____".$this->x;
    }
}

//abstract class Product
//{
//    private $sku;
//    private $name;
//    protected $type = null;
//
//
//    public static function create($product_type)
//    {
//
//        switch($product_type)
//        {
//            case 'chair':
//
//                return new Product_Chair();
//
//
//            case 'table':
//                return new Product_Table();
//
//
//            case 'sofa':
//                return new Product_Sofa();
//
//
//            case 'bookcase':
//                return new Product_Bookcase();
//
//        }
//
//    }
//
//}
//
//class Product_Chair extends Product
//{
//    // protected $type = 'chair';
//}
//
//class Product_Table extends Product
//{
//    public function __construct(){
//        echo "Product_Table is class";
//    }
//
//    public function test()
//    {
//      echo 4444;
//    }
//}
//
//class Product_Bookcase extends Product
//{
//    public function __construct(){
//        echo "Product_Bookcase is class";
//    }
//}
//
//class Product_Sofa extends Product
//{
//    public function __construct(){
//        echo "Product_Sofa is class";
//    }
//
//}
//// /////////////////////////////
//
//
