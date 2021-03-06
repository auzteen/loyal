<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit79efd70df7d2d3532be2c3bde5846887
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit79efd70df7d2d3532be2c3bde5846887::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit79efd70df7d2d3532be2c3bde5846887::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
