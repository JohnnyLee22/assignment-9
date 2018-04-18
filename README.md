ICS 325-02 Spring 2018 - Assignment 9
=========================

Purpose
-------
* Learn how to install 3rd party packages with composer.
* Learn the basics of Silex including routes, URL/path generation, and Twig rendering.

Resources and Examples
----------------------
* Check D2L under Class Content -> Setting Up an Environment -> Composer Instructions for how to install composer in your git repo and use it to install the necessary 3rd party packages.
* The official Silex [documentation](https://silex.symfony.com/doc/2.0/)
* The official Twig [documentation](http://twig.sensiolabs.org/documentation).
* The example routes and controllers provided in `app/app.php`.  There isn't clear documentation from Silex on how to perform all operations required by the homework, so make sure to study these examples carefully.

Collaboration
-------------
You can work with 1 or 2 other students on this assignment. Make sure to mention who you worked with when you submit your assignment in D2L.

Prerequisites
-------------
Use git to clone your assignment 9 repo to your computer.  Then in PhpStorm, use `File->Open Directory` and select your local repo.  You will also need to install composer and use it to install the necessary 3rd party packages in your local repo.

Instructions
------------
### Instructions to set up the code to run
First you need to clone your git repository to your computer.  Open GitKraken and make sure you are logged into your github.com account.  Next go to `File->Clone Repo`.  Select the `GitHub.com` icon.  A list of your repositories in github.com should pop up.  Select your assignment 9 repo.  If you want, change `Where to clone to` by clicking browser and selecting a folder for your git repo to be cloned into.  Finally, hit the `Clone the repo!` button.  The repo should now clone to your computer.

Next you need to set up PhpStorm.  We will be using the built-in PHP CGI server for this assignment.  To do so, first make sure you have the git repo open in PhpStorm by using the Open Directory menu item under File in PhpStorm (`File->Open Directory`).

Next install composer and use it to install all the necessary 3rd party packages.  Refer to the D2L class notes section for instructions on how to do this.

Next go to `Run->Edit Configurations...` Click the green `+` to create a new configuration.  Select `PHP Built-in Web Server`.  Change the name to `Assignment 9`.  Leave host as `localhost`.  Set the port to `8080`.  Set the `Document root` to the `web` directory in your git repo directory by clicking the `...` button next to the field and using the file chooser to select it.  Check the checkbox next to `Use a router script`.  Then select the file `index.php` in the `web` directory by clicking on the `...` button next to the router script field.   In the top right of the window there is a check box labled `Single instance only`, click on it to check it.  If there is a red ! icon near the bottom right of the window, click the `Fix` button and specify your PHP interpreter.  Once done, click `Ok` to exit the Edit Configurations window.  Next hit the green run button to start the PHP CGI web server.  Then go to your web browser, and enter this url [http://localhost:8080/](http://localhost:8080/).  That page lists existing routes and the routes you need to create.

### Existing Silex routes
The following Silex routes exist and are fully functional:<br />
* `/test` - A simple route. Silex Documentation: [Routing](https://silex.symfony.com/doc/2.0/usage.html#routing)
* `/test_url_and_path_generator` - Demonstrates how the URL/path generator works using PHP.
* `/test_url_and_path_generator_twig` - Demonstrates how the URL/path generator works using Twig. Silex Documentation: [Twig](https://silex.symfony.com/doc/2.0/providers/twig.html)
* `/hello/Some/Guy` - A route that extracts the values after the second and third / and passes it as the `$fname` and `$lname` variables.  This route is bound to the name `hello_route`.  That name is used by the `/test_url_and_path_generator` and `/test_url_and_path_generator_twig` routes to generate a URL or a path to this route. Silex Documentation: [Route Variables Routing](https://silex.symfony.com/doc/2.0/usage.html#route-variables).  Silex Documentation: [Named Routes](https://silex.symfony.com/doc/2.0/usage.html#named-routes)

### Assignment Work
Note: You MUST install composer and use it to install all 3rd party required packages or else the given code **WILL NOT WORK**!  Check D2L under Class Content -> Setting Up an Environment -> Composer Instructions for how to install composer in your git repo and use it to install the necessary 3rd party packages.

First study the existing example routes.  Next, you need to create 4 new routes:

1.  `/order/{name}/{drink}/{food}` - This is a dynamic route that should pass strings for a name, a drink, and a food to the controller.  The controller should be written with just PHP and should output in text:
    > Hello `name`, you ordered a `food` with a `drink`!

    Where name, food, and drink are all the values specified in the route parameters.  Silex Documentation: [Route Variables Routing](https://silex.symfony.com/doc/2.0/usage.html#route-variables).  Look at the example `/hello/Some/Guy` route.

2.  `/order_twig/{name}/{drink}/{food}` - This dynamic route works exactly the same as `/order/{name}/{drink}/{food}` except that the text should be rendered using twig.  You should pass the name, drink, and food strings to Twig and use it to render the output.  The output should be HTML.  Silex Documentation: [Twig](https://silex.symfony.com/doc/2.0/providers/twig.html). Look at the example `/test_url_and_path_generator_twig` route for how to call twig to render the HTML.

3.  `/add/{int_a}/{int_b}` - This dynamic route accepts 2 integers and adds them together.  The output should be:
    > `int_a` + `int_b` = `sum`  
    Click `here` to multiply `int_a` and `int_b`!

    Where `int_a` and `int_b` are the integers from the route parameters and `sum` is their sum.  The text `here` in `Click here` should be a link to the route `/multiply/{int_a}/{int_b}`.  You should use that route's name and use either the URL or path generator to generate the link.

4.  `/multiply/{int_a}/{int_b}` - This dynamic route accepts 2 integers and multiplies them.  The output should be:
    > `int_a` * `int_b` = `product`

    Where `int_a` and `int_b` are the integers from the route parameters and `product` is their product.  You should bind a route name to this route so it can be used to generate a URL or a path to this route.  Look at the example `/hello/Some/Guy` route for how to bind a name to the route.

Grading
-------
Points|Requirement
------|-----------
2 | `/order/{name}/{drink}/{food}` - correct output rendered using PHP.
2 | `/order_twig/{name}/{drink}/{food}` - correct output rendered using Twig.
2 | `/add/{int_a}/{int_b}` - correct output with a link to `/multiply/{int_a}/{int_b}` generated using the URL or path generator.
2 |  `/multiply/{int_a}/{int_b}` - correct output and bound to a route name.
2 |  Turn in via github.
**10**| **Total**
