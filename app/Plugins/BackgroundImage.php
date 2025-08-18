<?php

namespace App\Plugins;

use Swis\Filament\Backgrounds\Contracts\ProvidesImages;
use Swis\Filament\Backgrounds\Image;

class BackgroundImage implements ProvidesImages
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getImage(): Image
    {
        $image = '/images/wallpaper.jpg';
        return new Image(
            'url("' . asset($image) . '")'
        );
    }
}
