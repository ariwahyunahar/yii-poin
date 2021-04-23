<?php
class Model_ariwa_CleanSpace{

    static function remove_doublewhitespace($s = null){
           return  $ret = preg_replace('/([\s])\1+/', '', $s);
    }

    static function remove_whitespace($s = null){
           return $ret = preg_replace('/[\s]+/', '', $s );
    }

    static function remove_whitespace_feed( $s = null){
           return $ret = preg_replace('/[\t\n\r\0\x0B]/', '', $s);
    }

    static function smart_clean($s = null){
           return $ret = trim( self::remove_doublewhitespace( self::remove_whitespace_feed( self::remove_whitespace($s)) ) );
    }
}