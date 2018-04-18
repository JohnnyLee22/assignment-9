<?php

$app->get('/order/{fname}/{drink}/{food}', function ($fname,$food, $drink) use ($app) {
    // Strip out any possible HTML/etc from $name.  This is the same function as htmlspecialchars().
    return 'Hello '.$app->escape($fname .', you ordered a ' .$food . ' with a ' . $drink);
})->bind('order_route');

$app->get('/order_twig/Jason/Coke/Pizza', function () use ($app) {
    $url = $app->url('order_route', ['fname' => 'Jason', 'food'=> 'Pizza', 'drink' => 'Coke']);
    $path = $app->path('order_route', ['fname' => 'Jason', 'food'=> 'Pizza', 'drink' => 'Coke']);
    $return_string = "<html><body>A generated URL for the hello_route with parameters fname = Jason, food = Pizza and drink = Coke: <a href=\"$url\">$url</a><br />";
    $return_string .= "A generated path for the hello_route with parameters fname = Jason, food = Pizza and drink = Coke: <a href=\"$path\">$path</a></body></html>";
    return $return_string;
});
$app->get('/plus/{int_a}/{int_b}"', function ($int_a, $int_b) use ($app) {
    $sum= $int_a + $int_b;
    return $app->escape( $int_a.' + '.$int_b.' = '.$sum);
})->bind('add_route');

$app->get('/multiply/{int_a}/{int_b}', function ($int_a, $int_b) use ($app) {
    $product= $int_a * $int_b;
    return $app->escape( $int_a.' x '.$int_b.' = '.$product);
})->bind('multiply_route');