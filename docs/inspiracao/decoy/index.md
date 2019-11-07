# Installation

1. Add to your app with `composer require bkwld/decoy`

2. Add `Facilitador\Decoy\ServiceProvider::class` to the `providers` in your Laravel's app config file.

3. Add the following config to the `aliases` in your Laravel's app config file:

		'Decoy' => Facilitador\Decoy\Facades\Decoy::class,
		'DecoyURL' => Facilitador\Decoy\Facades\DecoyURL::class,

4. Publish the migrations, config files, and public assets by running `php artisan vendor:publish --provider="Facilitador\Decoy\ServiceProvider"`

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

See the [Github "Releases"](https://github.com/BKWLD/decoy/releases) history.
