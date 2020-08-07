# Installation

1. Add to your app with `composer require sierratecnologia/facilitador`

2. Add `Facilitador\ServiceProvider::class` to the `providers` in your Laravel's app config file.

3. Add the following config to the `aliases` in your Laravel's app config file:

		'Decoy' => Facilitador\Facades\Facilitador::class,
		'SupportURL' => Facilitador\Facades\SupportURL::class,

4. Publish the migrations, config files, and public assets by running `php artisan vendor:publish --provider="Facilitador\ServiceProvider"`

5. Run the migrations by running `php artisan migrate`

Next, see the [quick start](quick-start) for tips on your first install.


## Compatibility

Decoy is tested to support the following browsers:

- Latest Chrome (recommended)
- Latest Firefox
- Latest Safari
- IE 10+
- iOS 8 Safari on iPhone and iPad
- Latest Android Chrome


## Version history

See the [Github "Releases"](https://github.com/sierratcnologia/facilitador/releases) history.
