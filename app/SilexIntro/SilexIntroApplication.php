<?php

namespace SilexIntro;

// \Silex\Application is the main class that controls a Silex application.
// We want to add traits to it, so we will create our own class and extend it.
class SilexIntroApplication extends \Silex\Application {
    // Use the twig trait so that we can call render on $app ($app->render).
    use \Silex\Application\TwigTrait;
    // Allow URLs and paths to be generated using named routes
    use \Silex\Application\UrlGeneratorTrait;
}
