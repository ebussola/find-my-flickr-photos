<?php
/**
 * Created by PhpStorm.
 * User: Leonardo
 * Date: 22/02/14
 * Time: 17:43
 */

require __DIR__ . '/../vendor/autoload.php';
$config = include __DIR__ . '/../config.php';

$app = new \Slim\Slim();
\ebussola\ffphotos\Bootstrap::init($app, $config);


$app->get('/', function () use ($app) {
    /** @var \Aura\View\Template $template */
    $template = $app->container->get('template');

    $template->content = $template->fetch('main.php');
    $app->response->setBody($template->fetch('template.php'));
});


$app->group($config['opauth']['path'], function () use ($app) {
    $action = function () use ($app) {
        /** @var Opauth $opauth_flickr */
        $opauth_flickr = $app->container->get('opauth_flickr');
        $opauth_flickr->run();
    };

    $app->get('flickr', $action);
    $app->get('flickr/oauth_callback', $action);

    $app->get('callback', function () use ($app) {
        session_start();

        if (!isset($_SESSION['opauth']) && !isset($_SESSION['opauth']['auth']) && !isset($_SESSION['opauth']['auth']['credentials'])) {
            $app->halt(500, 'Auth Error');
        }

         $app->redirect('/my_photos');
    });
});

$app->group('/my_photos', function() use ($app) {
    $app->get('/', function() use ($app) {
        session_start();
        $config = $app->container->get('config');
        $config['opauth']['flickr']['access_token'] = $_SESSION['opauth']['auth']['credentials']['token'];
        $config['opauth']['flickr']['secret_access_token'] = $_SESSION['opauth']['auth']['credentials']['secret'];
        $app->container->set('config', $config);

        /** @var \Rezzza\Flickr\ApiFactory $flickr */
        $flickr = $app->container->get('flickr');
        /** @var \Aura\View\Template $template */
        $template = $app->container->get('template');

        $photos_xml = $flickr->call('flickr.photos.search', array(
            'user_id' => $_SESSION['opauth']['auth']['uid'],
            'per_page ' => 500
        ));

        $calls = array();
        foreach ($photos_xml->photos->photo as $photo_xml) {
            /** @var SimpleXMLElement $photo_xml */
            $photo_id = (string)$photo_xml['id'];
            $calls[] = array('service' => 'flickr.photos.getSizes', 'parameters' => array('photo_id' => $photo_id), 'endpoint' => null);
        }
        $sizes_xml = $flickr->multiCall($calls);

        $photos = array();
        foreach ($sizes_xml as $i => $size_xml) {
            $photo = new stdClass();
            $photo->title = (string) $photos_xml->photos->photo[$i]['title'];

            $highest_source = null;
            $smalll_source = null;
            foreach ($size_xml->sizes->size as $size) {
                $source = (string) $size['source'];
                if ($source != null) {
                    $highest_source = $source;
                }

                $label = (string) $size['label'];
                if ($label == 'Small') {
                    $smalll_source = $source;
                }
            }

            $photo->big = $highest_source;
            $photo->small = $smalll_source;
            $photos[] = $photo;
        }

        $template->photos = $photos;
        $template->content = $template->fetch('my_photos.php');
        $app->response->setBody($template->fetch('template.php'));
    });
});

$app->post('/', function () use ($app) {
    $data = $app->request->post();

    $feedee = new Feedee('flickr');
    $feedee->setUser($data['user_id']);

    $app->response->write('<p>Por enquanto só as 20 últimas fotos são exibidas =(</p>');

    foreach ($feedee as $photo) {
        $app->response->write('');
    }

    $app->response->write(file_get_contents(__DIR__ . '/../template/footer.php'));
});

$app->run();