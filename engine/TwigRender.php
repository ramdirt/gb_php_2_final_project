<?php

namespace app\engine;

use app\interfaces\IRender;

require_once '../vendor/autoload.php';

class TwigRender implements IRender
{
    public function renderTemplate($template, $params = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader('../templates');
        $twig = new \Twig\Environment($loader, [
            'debug' => true,
        ]);
        $twig->addGlobal('session', $_SESSION);
        $twig->addExtension(new \Twig\Extension\DebugExtension());
        return $twig->render($template . '.twig', $params);
    }
}