<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd9f2f96e3ad6fd86ce688af0527a1d7b
{
    public static $prefixLengthsPsr4 = array (
        'G' => 
        array (
            'Grav\\Plugin\\Form\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Grav\\Plugin\\Form\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd9f2f96e3ad6fd86ce688af0527a1d7b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd9f2f96e3ad6fd86ce688af0527a1d7b::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
