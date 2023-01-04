<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1c1567ea4dc2715a91faa8feb4d0b1a8
{
    public static $prefixLengthsPsr4 = array (
        't' => 
        array (
            'tstauras83\\' => 11,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'M' => 
        array (
            'Monolog\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'tstauras83\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/src',
        ),
        'Monolog\\' => 
        array (
            0 => __DIR__ . '/..' . '/monolog/monolog/src/Monolog',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1c1567ea4dc2715a91faa8feb4d0b1a8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1c1567ea4dc2715a91faa8feb4d0b1a8::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1c1567ea4dc2715a91faa8feb4d0b1a8::$classMap;

        }, null, ClassLoader::class);
    }
}
