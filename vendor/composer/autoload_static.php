<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit56d3940bbb036903308e04a43420ecfd
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'LINE\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'LINE\\' => 
        array (
            0 => __DIR__ . '/..' . '/linecorp/line-bot-sdk/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit56d3940bbb036903308e04a43420ecfd::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit56d3940bbb036903308e04a43420ecfd::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
