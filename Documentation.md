# Program Bake Away

The bake Away Program have a total integration between Gravity Forms, Youtube and Wordpress (recipes) through Zapier.

Zapier have a Trigger of Gforms and consume your data, upload video to Youtube and return url of video, then push to endpoint of Wordpress and publish a new one recipe.

The endpoint is POST  `/wp-json/baketivity/v2/create-recipe`

NOTES:
* Zapier account is of Meny.
* YouTube account is of Meny.
* Gravity Forms use an AddOn called "Gravity Form Zapier".
* Custom EndPoint is in `themes/baketivity/inc/api-rest.class.php`