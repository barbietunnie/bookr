<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use League\Fractal\Manager;
use App\Http\Response\FractalResponse;
use League\Fractal\Serializer\DataArraySerializer;

class FractalServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind the DataArraySerializer to an interface contract
        $this->app->bind(
            'League\Fractal\Serializer\SerializerAbstract',
            'League\Fractal\Serializer\DataArraySerializer'
        );

        $this->app->bind(FractalResponse::class, function($app) {
            $manager = new Manager();
            $serializer = $app['League\Fractal\Serializer\SerializerAbstract'];

            return new FractalResponse($manager, $serializer);
        });

        $this->app->alias(FractalResponse::class, 'fractal');
    }

    public function boot()
    {
        // not needed for for this implementation
    }
}
