<?php

namespace app\engine;

use app\interfaces\IRender;


class TwigRender implements IRender
{
    protected $twig;

    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../templates');
        $this->twig = new \Twig\Environment($loader, [
            'debug' => true,
        ]);
    }

    public function renderTemplate($template, $params = [])
    {
        $this->twig->addGlobal('session', $_SESSION);
        $this->twig->addExtension(new \Twig\Extension\DebugExtension());
        return $this->twig->render($template . '.twig', $params);
    }
}