<?php

namespace DraperStudio\Commentable;

use DraperStudio\ServiceProvider\ServiceProvider as BaseProvider;

class ServiceProvider extends BaseProvider
{
    protected $packageName = 'commentable';

    public function boot()
    {
        $this->setup(__DIR__)
             ->publishMigrations();
    }
}
