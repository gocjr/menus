<?php

declare(strict_types=1);

namespace Menus;

use Cake\Core\BasePlugin;
use Cake\Core\PluginApplicationInterface;
use Cake\Http\MiddlewareQueue;
use Cake\Routing\RouteBuilder;

/**
 * Plugin for Menus
 */
class Plugin extends BasePlugin
{
    /**
     * Load all the plugin configuration and bootstrap logic.
     *
     * The host application is provided as an argument. This allows you to load
     * additional plugin dependencies, or attach events.
     *
     * @param \Cake\Core\PluginApplicationInterface $app The host application
     * @return void
     */
    public function bootstrap(PluginApplicationInterface $app): void
    {
    }

    /**
     * Add routes for the plugin.
     *
     * If your plugin has many routes and you would like to isolate them into a separate file,
     * you can create `$plugin/config/routes.php` and delete this method.
     *
     * @param \Cake\Routing\RouteBuilder $routes The route builder to update.
     * @return void
     */
    public function routes(RouteBuilder $routes): void
    {
        $routes->prefix('Admin', function (RouteBuilder $builder) {
            $builder->plugin('Menus', ['path' => '/menus'], function (RouteBuilder $builder) {
                $options = ['pass' => ['target'], 'controller' => 'items'];
                $builder->connect('/', ['action' => 'index', 'controller' => 'Menus']);
                $builder->connect('/:controller/:target', ['action' => 'index'], $options);
                $builder->connect('/:controller/:target/:action/*', [], $options);
                $builder->connect('/:controller', ['action' => 'index']);
                $builder->connect('/:controller/:action/*', []);
            });
            $builder->fallbacks();
        });

        $routes->plugin('Menus', ['path' => '/menus'], function (RouteBuilder $builder) {
            $builder->fallbacks();
        });
        parent::routes($routes);
    }

    /**
     * Add middleware for the plugin.
     *
     * @param \Cake\Http\MiddlewareQueue $middleware The middleware queue to update.
     * @return \Cake\Http\MiddlewareQueue
     */
    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        // Add your middlewares here

        return $middlewareQueue;
    }
}
