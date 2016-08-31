<?php

/*
 * This file is part of Laravel :package_name.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DraperStudio\Commentable;

/**
 * Class ServiceProvider.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
class ServiceProvider extends \DraperStudio\ServiceProvider\ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishMigrations();

        $this->publishes([
            __DIR__.'/../../../resources/config/commentable.php' => config_path('commentable.php'),
        ]);

        $this->mergeConfigFrom(__DIR__.'/../resources/config/commentable.php', 'commentable');
    }

    /**
     * Get the default package name.
     *
     * @return string
     */
    public function getPackageName()
    {
        return 'commentable';
    }
}
