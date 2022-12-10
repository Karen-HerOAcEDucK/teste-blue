<?php

namespace TestBlue\Base;

abstract class AncillaryClass
{
    private static $CI;

    protected static function getCI()
    {
        if (!isset(self::$CI)) {
            self::$CI = &get_instance();
        }
        return self::$CI;
    }
}