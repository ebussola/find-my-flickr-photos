<?php
/**
 * Created by PhpStorm.
 * User: Leonardo
 * Date: 22/02/14
 * Time: 17:43
 */

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/ebussola/feedee/Feedee.php';

$app = new \Slim\Slim();

$app->response->write(file_get_contents(__DIR__.'/../template/header.php'));

$app->get('/', function() use ($app) {
    $app->response->write('<p>
    FFPhotos é uma ferramenta para facilitar a procura de suas fotos do flickr no Web. <br />
    No fundo, nada mais é que a busca do google images, mas de uma maneira mais fácil.
</p>
<p>Eu uso muito isto pois minhas fotos estão como Creative Commons e muitas pessoas usam para criar conteúdo em blogs ou sites de notícias.</p>');

    $app->response->write('<p><strong>Use <a target="_blank" href="http://idgettr.com/">esta ferramenta</a> para descobrir o seu user ID no Flickr</strong></p>');

    $app->response->write('<fieldset><form method="post" onsubmit="submit_form(this)"><label for="user_id">User ID</label><input type="text" id="user_id" name="user_id" /><input type="submit" /></form></fieldset>');


    $app->response->write(file_get_contents(__DIR__.'/../template/footer.php'));
});
$app->post('/', function() use ($app) {
    $data = $app->request->post();

    $feedee = new Feedee('flickr');
    $feedee->setUser($data['user_id']);

    $app->response->write('<p>Por enquanto só as 20 últimas fotos são exibidas =(</p>');

    foreach ($feedee as $photo) {
        $app->response->write('<div style="float:left; width:240px; margin: 3px">' . $photo->title . '<br /><a target="_blank" onclick="click_photo(this)" href="https://www.google.com/searchbyimage?&image_url='.$photo->big.'"><img src="'.$photo->medium.'" /></a></div>');
    }

    $app->response->write(file_get_contents(__DIR__.'/../template/footer.php'));
});

$app->run();