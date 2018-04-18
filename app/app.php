<?php

// Load 3rd party libraries using composer.
// Notice the use of the magic constant __DIR__ which returns the directory the current file is in.
//   http://php.net/manual/en/language.constants.predefined.php
require_once __DIR__.'/../vendor/autoload.php';
// Load our custom Application class that also loads other required classes.
// For this application, that mean adding the TwigTrait and UrlGeneratorTrait to the standard \Silex\Application class.
require_once __DIR__.'/SilexIntro/SilexIntroApplication.php';
// Instantiate the Silex service container (the application)
$app = new SilexIntro\SilexIntroApplication();
// Enable debugging so that errors are displayed via web pages.
// This would of course be false in production.
$app['debug'] = true;
// Register a twig service provider with the path to the twig templates given.
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));
// A simple route that outputs static HTML that points to other routes this app implements.
// The route is '/' and the method is get.  The controller to be run is passed as a closure to get().
$app->get('/', function () use ($app) {
    return <<<'EOF'
<html><body>
<a href="/test">/test</a> - A simple route.<br />
<a href="/test_url_and_path_generator">/test_url_and_path_generator</a> - Demonstrates how the URL/path generator works using PHP.<br />
<a href="/test_url_and_path_generator_twig">/test_url_and_path_generator_twig</a> - Demonstrates how the URL/path generator works using twig.<br />
<a href="/hello/Some/Guy">/hello/Some/Guy</a> - A route that extracts the value after the last / and passes it as the $name variable.<br />
<br />
<a href="/order/Jason/Coke/Pizza">/order/Jason/Coke/Pizza</a> - a route you need to make.  See the assignment text.<br />
<a href="/order_twig/Jason/Coke/Pizza">/order_twig/Jason/Coke/Pizza</a> - a route you need to make.  See the assignment text.<br />
<a href="/addition/7/3">/add/7/3</a> - a route you need to make.  See the assignment text.<br />
<a href="/multiply/7/3">/multiply/7/3</a> - a route you need to make.  See the assignment text.
</body></html>
EOF;
});
// A simple route that outputs some static text.  The route is '/test'
// Notice that the controller is a closure (sometimes referred to as an anonymous function)
$app->get('/test', function () use ($app) {
    return "Just some text!";
});

// A route with a controller that shows how to generate URLs and paths in PHP from named routes.
$app->get('/test_url_and_path_generator', function () use ($app) {
    $url = $app->url('hello_route', ['fname' => 'Jason', 'lname' => 'Cross']);
    $path = $app->path('hello_route', ['fname' => 'Jason', 'lname' => 'Cross']);
    $return_string = "<html><body>A generated URL for the hello_route with parameters fname=Jason and lname=Cross: <a href=\"$url\">$url</a><br />";
    $return_string .= "A generated path for the hello_route with parameters fname=Jason and lname=Cross: <a href=\"$path\">$path</a></body></html>";
    return $return_string;
});
// A route with a controller that shows how to generate URLs and paths in twig from named routes.
$app->get('/test_url_and_path_generator_twig', function () use ($app) {
    return $app->render('test_url_generator_with_twig.twig', ['fname' => 'Jason', 'lname' => 'Cross']);
});
// A simple route that uses part of the route URL as a pair of parameters to the controller closure.
// Notice the ->bind() call after the ->get() call.  That tells Silex what name we want the route to have.
// In this case, that name is hello_route.
$app->get('/hello/{fname}/{lname}', function ($fname, $lname) use ($app) {
    // Strip out any possible HTML/etc from $name.  This is the same function as htmlspecialchars().
    return 'Hello '.$app->escape($fname . ' ' . $lname);
})->bind('hello_route');

$app->get('/order/{fname}/{drink}/{food}', function ($fname, $food, $drink) use ($app) {
    // Strip out any possible HTML/etc from $name.  This is the same function as htmlspecialchars().
    return 'Hello '.$app->escape($fname .', you ordered a ' .$food . ' with a ' . $drink);
})->bind('order_route');

$app->get('/addition/{int_a}/{int_b}', function ($int_a,$int_b) use ($app) {
    $sum = $int_a + $int_b;
    $path = $app->path('multiply_route', ['int_a' => $int_a, 'int_b'=> $int_b]);
    $returnString = "Click <a href=\"$path\">here</a> to multiply 7 and 3.</body></html>";
    return $app->escape( $int_a.' + '.$int_b.' = '.$sum). " ".$returnString;

})->bind('addition_route');

$app->get('/multiply/{int_a}/{int_b}', function ($int_a, $int_b) use ($app) {
    $product= $int_a * $int_b;
    return $app->escape( $int_a.' * '.$int_b.' = '.$product);
})->bind('multiply_route');


$app->get('/order_twig/{fname}/{drink}/{food}', function ($fname, $food, $drink) use ($app) {
    $url = $app->url('order_route', ['fname' => $fname, 'food'=> $food, 'drink' => $drink]);
    $path = $app->path('order_route', ['fname' => $fname, 'food'=> $food, 'drink' => $drink]);
    $return_string = "<html><body>A generated URL for the hello_route with parameters fname = Jason, food = Pizza and drink = Coke: <a href=\"$url\">$url</a><br />";
    $return_string .= "A generated path for the hello_route with parameters fname = Jason, food = Pizza and drink = Coke: <a href=\"$path\">$path</a></body></html>";
    return $return_string;
});





// DO NOT PUT ANY OF YOUR CODE BELOW HERE!!!
// Return the service container used by web/index.php
return $app;