<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitae412ed5e1c88b4b3f3563ca00f29f11
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Inc\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Inc\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitae412ed5e1c88b4b3f3563ca00f29f11::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitae412ed5e1c88b4b3f3563ca00f29f11::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitae412ed5e1c88b4b3f3563ca00f29f11::$classMap;

        }, null, ClassLoader::class);
    }
}