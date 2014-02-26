<?php
/**
 * Created by PhpStorm.
 * User: Leonardo
 * Date: 23/02/14
 * Time: 20:48
 */

namespace ebussola\ffphotos;


use Aura\View\EscaperFactory;
use Aura\View\HelperLocator;
use Aura\View\Template;
use Aura\View\TemplateFinder;
use Rezzza\Flickr\ApiFactory;
use Rezzza\Flickr\Http\GuzzleAdapter;
use Rezzza\Flickr\Metadata;
use Slim\Slim;

class Bootstrap {

    public static function init(Slim $app, $config) {
        $app->container->set('config', $config);

        $app->config('debug', $config['debug']);

        $app->container->singleton('opauth_flickr', function() use ($app) {
            $config = $app->container->get('config');

            $opauth_flickr = new \Opauth(array(
                'path' => $config['opauth']['path'],
                'debug' => $config['debug'],
                'callback_url' => $config['opauth']['flickr']['callback'],
                'security_salt' => $config['opauth']['flickr']['salt'],
                'Strategy' => array(
                    'Flickr' => array(
                        'key' => $config['opauth']['flickr']['key'],
                        'secret' => $config['opauth']['flickr']['secret']
                    )
                )
            ), false);

            return $opauth_flickr;
        });

        $app->container->singleton('template', function() use ($app) {
            $config = $app->container->get('config');

            $template = new Template(new EscaperFactory(), new TemplateFinder(), new HelperLocator());
            $template->setPaths(array(
                $config['template_path']
            ));
            $template->config = $config;

            return $template;
        });

        $app->container->singleton('flickr', function() use ($app) {
            $config = $app->container->get('config');

            $metadata = new Metadata($config['opauth']['flickr']['key'], $config['opauth']['flickr']['secret']);
            $metadata->setOauthAccess($config['opauth']['flickr']['access_token'], $config['opauth']['flickr']['secret_access_token']);

            return new ApiFactory($metadata, new GuzzleAdapter());
        });
    }

}