<?php
abstract class DBO
{
    private static $conn;
    public static function getDBO(){
             if(!isset(self::$conn)){
                self::$conn=mysqli_connect('127.0.0.1','root','','new_shop_cart');
            }
            return self::$conn;
    } 
    public static function showAsCurrency($amount){
        return '&#8377;'.$amount;

    }

}
