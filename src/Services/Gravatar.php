<?php
/**
 * Analisando Dependncia
 */

namespace Facilitador\Services;

use Illuminate\Contracts\Config\Repository as Config;

class Gravatar extends GravatarService
{
    /**
     * The maximum size allowed for the Gravatar.
     */
    const MAX_SIZE = 512;

    /**
     * The default size of the Gravatar.
     *
     * @var int
     */
    private $defaultSize = null;

    public function __construct(Config $config)
    {
        // Set default configuration values
        $this->setDefaultImage($config->get('gravatar.default'));
        $this->defaultSize = $config->get('gravatar.size');
        $this->setMaxRating($config->get('gravatar.maxRating', 'g'));

        $this->enableSecureImages();
    }

    /**
     * Return the URL of a Gravatar. Note: it does not check for the existence of this Gravatar.
     *
     * @param string      $email  The email address.
     * @param int         $size   Override the size of the Gravatar.
     * @param null|string $rating Override the default rating if you want to.
     *
     * @return string The URL of the Gravatar.
     */
    public function src($email, $size = null, $rating = null)
    {
        if (is_null($size)) {
            $size = $this->defaultSize;
        }

        $size = max(1, min(self::MAX_SIZE, $size));

        $this->setAvatarSize($size);

        if (!is_null($rating)) {
            $this->setMaxRating($rating);
        }

        return $this->buildGravatarURL($email);
    }

    /**
     * Check if a Gravatar image exists.
     *
     * @param string $email The email address.
     *
     * @return bool True if the Gravatar exists, false otherwise.
     */
    public function exists($email)
    {
        $this->setDefaultImage('404');

        $url = $this->buildGravatarURL($email);
        $headers = get_headers($url, 1);

        return substr($headers[0], 9, 3) == '200';
    }

    /**
     * Get the HTML image code.
     *
     * @param string $src        The source attribute of the image.
     * @param string $alt        The alt attribute of the image.
     * @param array  $attributes Used to set the width and the height.
     *
     * @return string The HTML code.
     */
    private function formatImage($src, $alt, $attributes)
    {
        return sprintf('<img src="%s" alt="%s" height="%s" width="%s">', $src, $alt, $attributes['height'], $attributes['width']);
    }
}
