<?php

namespace Facilitador\Layout;

use URL;
use Request;
use Facilitador\Routing\Wildcard;

/**
 * Generate default breadcrumbs and provide a store where they can be
 * overridden before rendering.
 */
class Icons
{
        public static function getRandon()
        {
            $icon = array_rand(self::icons(), 1);
            return '<i class="'.self::icons()[$icon]['class'].'"></i>';
        }


        public static function icons() {
                  return [


        // public function icons('66 New Icons in 4.4') {

                //   return [
                    [
                        'class' => 'fa fa-fw fa-500px',
                        'name' => 'fa-500px',
                    ],
                    [
                        'class' => 'fa fa-fw fa-amazon',
                        'name' => 'fa-amazon',
                    ],
                    [
                        'class' => 'fa fa-fw fa-balance-scale',
                        'name' => 'fa-balance-scale',
                    ],
                    [
                        'class' => 'fa fa-fw fa-battery-0',
                        'name' => 'fa-battery-0',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-battery-1',
                        'name' => 'fa-battery-1',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-battery-2',
                        'name' => 'fa-battery-2',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-battery-3',
                        'name' => 'fa-battery-3',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-battery-4',
                        'name' => 'fa-battery-4',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-battery-empty',
                        'name' => 'fa-battery-empty',
                    ],
                    [
                        'class' => 'fa fa-fw fa-battery-full',
                        'name' => 'fa-battery-full',
                    ],
                    [
                        'class' => 'fa fa-fw fa-battery-half',
                        'name' => 'fa-battery-half',
                    ],
                    [
                        'class' => 'fa fa-fw fa-battery-quarter',
                        'name' => 'fa-battery-quarter',
                    ],
                    [
                    'class' => 'fa fa-fw fa-battery-three-quarters',
                    'name' => 'fa-battery-three-quarters',
                ],
                    
                    [
                        'class' => 'fa fa-fw fa-black-tie',
                        'name' => 'fa-black-tie',
                    ],
                    [
                        'class' => 'fa fa-fw fa-calendar-check-o',
                        'name' => 'fa-calendar-check-o',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-calendar-minus-o',
                        'name' => 'fa-calendar-minus-o',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-calendar-plus-o',
                        'name' => 'fa-calendar-plus-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-calendar-times-o',
                        'name' => 'fa-calendar-times-o',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-cc-diners-club',
                        'name' => 'fa-cc-diners-club',
                    ],
                    [
                        'class' => 'fa fa-fw fa-cc-jcb',
                        'name' => 'fa-cc-jcb',
                    ],
                    [
                        'class' => 'fa fa-fw fa-chrome',
                        'name' => 'fa-chrome',
                    ],
                    [
                        'class' => 'fa fa-fw fa-clone',
                        'name' => 'fa-clone',
                    ],
                    [
                        'class' => 'fa fa-fw fa-commenting',
                        'name' => 'fa-commenting',
                    ],
                    [
                        'class' => 'fa fa-fw fa-commenting-o',
                        'name' => 'fa-commenting-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-contao',
                        'name' => 'fa-contao',
                    ],
                    [
                        'class' => 'fa fa-fw fa-creative-commons',
                        'name' => 'fa-creative-commons',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-expeditedssl',
                        'name' => 'fa-expeditedssl',
                    ],
                    [
                        'class' => 'fa fa-fw fa-firefox',
                        'name' => 'fa-firefox',
                    ],
                    [
                        'class' => 'fa fa-fw fa-fonticons',
                        'name' => 'fa-fonticons',
                    ],
                    [
                        'class' => 'fa fa-fw fa-genderless',
                        'name' => 'fa-genderless',
                    ],
                    [
                        'class' => 'fa fa-fw fa-get-pocket',
                        'name' => 'fa-get-pocket',
                    ],
                    [
                        'class' => 'fa fa-fw fa-gg',
                        'name' => 'fa-gg',
                    ],
                    [
                        'class' => 'fa fa-fw fa-gg-circle',
                        'name' => 'fa-gg-circle',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hand-grab-o',
                        'name' => 'fa-hand-grab-o',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-hand-lizard-o',
                        'name' => 'fa-hand-lizard-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hand-paper-o',
                        'name' => 'fa-hand-paper-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hand-peace-o',
                        'name' => 'fa-hand-peace-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hand-pointer-o',
                        'name' => 'fa-hand-pointer-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hand-rock-o',
                        'name' => 'fa-hand-rock-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hand-scissors-o',
                        'name' => 'fa-hand-scissors-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hand-spock-o',
                        'name' => 'fa-hand-spock-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hand-stop-o',
                        'name' => 'fa-hand-stop-o',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-hourglass',
                        'name' => 'fa-hourglass',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hourglass-1',
                        'name' => 'fa-hourglass-1',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-hourglass-2',
                        'name' => 'fa-hourglass-2',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-hourglass-3',
                        'name' => 'fa-hourglass-3',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-hourglass-end',
                        'name' => 'fa-hourglass-end',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hourglass-half',
                        'name' => 'fa-hourglass-half',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hourglass-o',
                        'name' => 'fa-hourglass-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hourglass-start',
                        'name' => 'fa-hourglass-start',
                    ],
                    [
                        'class' => 'fa fa-fw fa-houzz',
                        'name' => 'fa-houzz',
                    ],
                    [
                        'class' => 'fa fa-fw fa-i-cursor',
                        'name' => 'fa-i-cursor',
                    ],
                    [
                        'class' => 'fa fa-fw fa-industry',
                        'name' => 'fa-industry',
                    ],
                    [
                        'class' => 'fa fa-fw fa-internet-explorer',
                        'name' => 'fa-internet-explorer',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-map',
                        'name' => 'fa-map',
                    ],
                    [
                        'class' => 'fa fa-fw fa-map-o',
                        'name' => 'fa-map-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-map-pin',
                        'name' => 'fa-map-pin',
                    ],
                    [
                        'class' => 'fa fa-fw fa-map-signs',
                        'name' => 'fa-map-signs',
                    ],
                    [
                        'class' => 'fa fa-fw fa-mouse-pointer',
                        'name' => 'fa-mouse-pointer',
                    ],
                    [
                        'class' => 'fa fa-fw fa-object-group',
                        'name' => 'fa-object-group',
                    ],
                    [
                        'class' => 'fa fa-fw fa-object-ungroup',
                        'name' => 'fa-object-ungroup',
                    ],
                    [
                        'class' => 'fa fa-fw fa-odnoklassniki',
                        'name' => 'fa-odnoklassniki',
                    ],
                    [
                    'class' => 'fa fa-fw fa-odnoklassniki-square',
                    'name' => 'fa-odnoklassniki-square',
                ],
                    
                    [
                        'class' => 'fa fa-fw fa-opencart',
                        'name' => 'fa-opencart',
                    ],
                    [
                        'class' => 'fa fa-fw fa-opera',
                        'name' => 'fa-opera',
                    ],
                    [
                        'class' => 'fa fa-fw fa-optin-monster',
                        'name' => 'fa-optin-monster',
                    ],
                    [
                        'class' => 'fa fa-fw fa-registered',
                        'name' => 'fa-registered',
                    ],
                    [
                        'class' => 'fa fa-fw fa-safari',
                        'name' => 'fa-safari',
                    ],
                    [
                        'class' => 'fa fa-fw fa-sticky-note',
                        'name' => 'fa-sticky-note',
                    ],
                    [
                        'class' => 'fa fa-fw fa-sticky-note-o',
                        'name' => 'fa-sticky-note-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-television',
                        'name' => 'fa-television',
                    ],
                    [
                        'class' => 'fa fa-fw fa-trademark',
                        'name' => 'fa-trademark',
                    ],
                    [
                        'class' => 'fa fa-fw fa-tripadvisor',
                        'name' => 'fa-tripadvisor',
                    ],
                    [
                        'class' => 'fa fa-fw fa-tv',
                        'name' => 'fa-tv',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-vimeo',
                        'name' => 'fa-vimeo',
                    ],
                    [
                        'class' => 'fa fa-fw fa-wikipedia-w',
                        'name' => 'fa-wikipedia-w',
                    ],
                    [
                        'class' => 'fa fa-fw fa-y-combinator',
                        'name' => 'fa-y-combinator',
                    ],
                    [
                        'class' => 'fa fa-fw fa-yc',
                        'name' => 'fa-yc',
                    ],
                     // Alias
                  
            //     ];
            // }

                // <section id="web-application">
                  
                
        // public function icons('Web Application Icons') {

                //   return [
                    [
                        'class' => 'fa fa-fw fa-adjust',
                        'name' => 'fa-adjust',
                    ],
                    [
                        'class' => 'fa fa-fw fa-anchor',
                        'name' => 'fa-anchor',
                    ],
                    [
                        'class' => 'fa fa-fw fa-archive',
                        'name' => 'fa-archive',
                    ],
                    [
                        'class' => 'fa fa-fw fa-area-chart',
                        'name' => 'fa-area-chart',
                    ],
                    [
                        'class' => 'fa fa-fw fa-arrows',
                        'name' => 'fa-arrows',
                    ],
                    [
                        'class' => 'fa fa-fw fa-arrows-h',
                        'name' => 'fa-arrows-h',
                    ],
                    [
                        'class' => 'fa fa-fw fa-arrows-v',
                        'name' => 'fa-arrows-v',
                    ],
                    [
                        'class' => 'fa fa-fw fa-asterisk',
                        'name' => 'fa-asterisk',
                    ],
                    [
                        'class' => 'fa fa-fw fa-at',
                        'name' => 'fa-at',
                    ],
                    [
                        'class' => 'fa fa-fw fa-automobile',
                        'name' => 'fa-automobile',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-balance-scale',
                        'name' => 'fa-balance-scale',
                    ],
                    [
                        'class' => 'fa fa-fw fa-ban',
                        'name' => 'fa-ban',
                    ],
                    [
                        'class' => 'fa fa-fw fa-bank',
                        'name' => 'fa-bank <span class="text-muted">(alias)</span>',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-bar-chart',
                        'name' => 'fa-bar-chart',
                    ],
                    [
                        'class' => 'fa fa-fw fa-bar-chart-o',
                        'name' => 'fa-bar-chart-o',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-barcode',
                        'name' => 'fa-barcode',
                    ],
                    [
                        'class' => 'fa fa-fw fa-bars',
                        'name' => 'fa-bars',
                    ],
                    [
                        'class' => 'fa fa-fw fa-battery-0',
                        'name' => 'fa-battery-0',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-battery-1',
                        'name' => 'fa-battery-1',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-battery-2',
                        'name' => 'fa-battery-2',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-battery-3',
                        'name' => 'fa-battery-3',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-battery-4',
                        'name' => 'fa-battery-4',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-battery-empty',
                        'name' => 'fa-battery-empty',
                    ],
                    [
                        'class' => 'fa fa-fw fa-battery-full',
                        'name' => 'fa-battery-full',
                    ],
                    [
                        'class' => 'fa fa-fw fa-battery-half',
                        'name' => 'fa-battery-half',
                    ],
                    [
                        'class' => 'fa fa-fw fa-battery-quarter',
                        'name' => 'fa-battery-quarter',
                    ],
                    [
                    'class' => 'fa fa-fw fa-battery-three-quarters',
                    'name' => 'fa-battery-three-quarters',
                ],
                    
                    [
                        'class' => 'fa fa-fw fa-bed',
                        'name' => 'fa-bed',
                    ],
                    [
                        'class' => 'fa fa-fw fa-beer',
                        'name' => 'fa-beer',
                    ],
                    [
                        'class' => 'fa fa-fw fa-bell',
                        'name' => 'fa-bell',
                    ],
                    [
                        'class' => 'fa fa-fw fa-bell-o',
                        'name' => 'fa-bell-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-bell-slash',
                        'name' => 'fa-bell-slash',
                    ],
                    [
                        'class' => 'fa fa-fw fa-bell-slash-o',
                        'name' => 'fa-bell-slash-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-bicycle',
                        'name' => 'fa-bicycle',
                    ],
                    [
                        'class' => 'fa fa-fw fa-binoculars',
                        'name' => 'fa-binoculars',
                    ],
                    [
                        'class' => 'fa fa-fw fa-birthday-cake',
                        'name' => 'fa-birthday-cake',
                    ],
                    [
                        'class' => 'fa fa-fw fa-bolt',
                        'name' => 'fa-bolt',
                    ],
                    [
                        'class' => 'fa fa-fw fa-bomb',
                        'name' => 'fa-bomb',
                    ],
                    [
                        'class' => 'fa fa-fw fa-book',
                        'name' => 'fa-book',
                    ],
                    [
                        'class' => 'fa fa-fw fa-bookmark',
                        'name' => 'fa-bookmark',
                    ],
                    [
                        'class' => 'fa fa-fw fa-bookmark-o',
                        'name' => 'fa-bookmark-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-briefcase',
                        'name' => 'fa-briefcase',
                    ],
                    [
                        'class' => 'fa fa-fw fa-bug',
                        'name' => 'fa-bug',
                    ],
                    [
                        'class' => 'fa fa-fw fa-building',
                        'name' => 'fa-building',
                    ],
                    [
                        'class' => 'fa fa-fw fa-building-o',
                        'name' => 'fa-building-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-bullhorn',
                        'name' => 'fa-bullhorn',
                    ],
                    [
                        'class' => 'fa fa-fw fa-bullseye',
                        'name' => 'fa-bullseye',
                    ],
                    [
                        'class' => 'fa fa-fw fa-bus',
                        'name' => 'fa-bus',
                    ],
                    [
                        'class' => 'fa fa-fw fa-cab',
                        'name' => 'fa-cab <span class="text-muted">(alias)</span>',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-calculator',
                        'name' => 'fa-calculator',
                    ],
                    [
                        'class' => 'fa fa-fw fa-calendar',
                        'name' => 'fa-calendar',
                    ],
                    [
                        'class' => 'fa fa-fw fa-calendar-check-o',
                        'name' => 'fa-calendar-check-o',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-calendar-minus-o',
                        'name' => 'fa-calendar-minus-o',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-calendar-o',
                        'name' => 'fa-calendar-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-calendar-plus-o',
                        'name' => 'fa-calendar-plus-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-calendar-times-o',
                        'name' => 'fa-calendar-times-o',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-camera',
                        'name' => 'fa-camera',
                    ],
                    [
                        'class' => 'fa fa-fw fa-camera-retro',
                        'name' => 'fa-camera-retro',
                    ],
                    [
                        'class' => 'fa fa-fw fa-car',
                        'name' => 'fa-car',
                    ],
                    [
                    'class' => 'fa fa-fw fa-caret-square-o-down',
                    'name' => 'fa-caret-square-o-down',
                ],
                    [
                    'class' => 'fa fa-fw fa-caret-square-o-left',
                    'name' => 'fa-caret-square-o-left',
                ],
                    [
                    'class' => 'fa fa-fw fa-caret-square-o-right',
                    'name' => 'fa-caret-square-o-right',
                ],
                    [
                        'class' => 'fa fa-fw fa-caret-square-o-up',
                        'name' => 'fa-caret-square-o-up',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-cart-arrow-down',
                        'name' => 'fa-cart-arrow-down',
                    ],
                    [
                        'class' => 'fa fa-fw fa-cart-plus',
                        'name' => 'fa-cart-plus',
                    ],
                    [
                        'class' => 'fa fa-fw fa-cc',
                        'name' => 'fa-cc',
                    ],
                    [
                        'class' => 'fa fa-fw fa-certificate',
                        'name' => 'fa-certificate',
                    ],
                    [
                        'class' => 'fa fa-fw fa-check',
                        'name' => 'fa-check',
                    ],
                    [
                        'class' => 'fa fa-fw fa-check-circle',
                        'name' => 'fa-check-circle',
                    ],
                    [
                        'class' => 'fa fa-fw fa-check-circle-o',
                        'name' => 'fa-check-circle-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-check-square',
                        'name' => 'fa-check-square',
                    ],
                    [
                        'class' => 'fa fa-fw fa-check-square-o',
                        'name' => 'fa-check-square-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-child',
                        'name' => 'fa-child',
                    ],
                    [
                        'class' => 'fa fa-fw fa-circle',
                        'name' => 'fa-circle',
                    ],
                    [
                        'class' => 'fa fa-fw fa-circle-o',
                        'name' => 'fa-circle-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-circle-o-notch',
                        'name' => 'fa-circle-o-notch',
                    ],
                    [
                        'class' => 'fa fa-fw fa-circle-thin',
                        'name' => 'fa-circle-thin',
                    ],
                    [
                        'class' => 'fa fa-fw fa-clock-o',
                        'name' => 'fa-clock-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-clone',
                        'name' => 'fa-clone',
                    ],
                    [
                        'class' => 'fa fa-fw fa-close',
                        'name' => 'fa-close <span class="text-muted">(alias)</span>',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-cloud',
                        'name' => 'fa-cloud',
                    ],
                    [
                        'class' => 'fa fa-fw fa-cloud-download',
                        'name' => 'fa-cloud-download',
                    ],
                    [
                        'class' => 'fa fa-fw fa-cloud-upload',
                        'name' => 'fa-cloud-upload',
                    ],
                    [
                        'class' => 'fa fa-fw fa-code',
                        'name' => 'fa-code',
                    ],
                    [
                        'class' => 'fa fa-fw fa-code-fork',
                        'name' => 'fa-code-fork',
                    ],
                    [
                        'class' => 'fa fa-fw fa-coffee',
                        'name' => 'fa-coffee',
                    ],
                    [
                        'class' => 'fa fa-fw fa-cog',
                        'name' => 'fa-cog',
                    ],
                    [
                        'class' => 'fa fa-fw fa-cogs',
                        'name' => 'fa-cogs',
                    ],
                    [
                        'class' => 'fa fa-fw fa-comment',
                        'name' => 'fa-comment',
                    ],
                    [
                        'class' => 'fa fa-fw fa-comment-o',
                        'name' => 'fa-comment-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-commenting',
                        'name' => 'fa-commenting',
                    ],
                    [
                        'class' => 'fa fa-fw fa-commenting-o',
                        'name' => 'fa-commenting-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-comments',
                        'name' => 'fa-comments',
                    ],
                    [
                        'class' => 'fa fa-fw fa-comments-o',
                        'name' => 'fa-comments-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-compass',
                        'name' => 'fa-compass',
                    ],
                    [
                        'class' => 'fa fa-fw fa-copyright',
                        'name' => 'fa-copyright',
                    ],
                    [
                        'class' => 'fa fa-fw fa-creative-commons',
                        'name' => 'fa-creative-commons',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-credit-card',
                        'name' => 'fa-credit-card',
                    ],
                    [
                        'class' => 'fa fa-fw fa-crop',
                        'name' => 'fa-crop',
                    ],
                    [
                        'class' => 'fa fa-fw fa-crosshairs',
                        'name' => 'fa-crosshairs',
                    ],
                    [
                        'class' => 'fa fa-fw fa-cube',
                        'name' => 'fa-cube',
                    ],
                    [
                        'class' => 'fa fa-fw fa-cubes',
                        'name' => 'fa-cubes',
                    ],
                    [
                        'class' => 'fa fa-fw fa-cutlery',
                        'name' => 'fa-cutlery',
                    ],
                    [
                        'class' => 'fa fa-fw fa-dashboard',
                        'name' => 'fa-dashboard',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-database',
                        'name' => 'fa-database',
                    ],
                    [
                        'class' => 'fa fa-fw fa-desktop',
                        'name' => 'fa-desktop',
                    ],
                    [
                        'class' => 'fa fa-fw fa-diamond',
                        'name' => 'fa-diamond',
                    ],
                    [
                        'class' => 'fa fa-fw fa-dot-circle-o',
                        'name' => 'fa-dot-circle-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-download',
                        'name' => 'fa-download',
                    ],
                    [
                        'class' => 'fa fa-fw fa-edit',
                        'name' => 'fa-edit <span class="text-muted">(alias)</span>',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-ellipsis-h',
                        'name' => 'fa-ellipsis-h',
                    ],
                    [
                        'class' => 'fa fa-fw fa-ellipsis-v',
                        'name' => 'fa-ellipsis-v',
                    ],
                    [
                        'class' => 'fa fa-fw fa-envelope',
                        'name' => 'fa-envelope',
                    ],
                    [
                        'class' => 'fa fa-fw fa-envelope-o',
                        'name' => 'fa-envelope-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-envelope-square',
                        'name' => 'fa-envelope-square',
                    ],
                    [
                        'class' => 'fa fa-fw fa-eraser',
                        'name' => 'fa-eraser',
                    ],
                    [
                        'class' => 'fa fa-fw fa-exchange',
                        'name' => 'fa-exchange',
                    ],
                    [
                        'class' => 'fa fa-fw fa-exclamation',
                        'name' => 'fa-exclamation',
                    ],
                    [
                        'class' => 'fa fa-fw fa-exclamation-circle',
                        'name' => 'fa-exclamation-circle',
                    ],
                    [
                    'class' => 'fa fa-fw fa-exclamation-triangle',
                    'name' => 'fa-exclamation-triangle',
                ],
                    
                    [
                        'class' => 'fa fa-fw fa-external-link',
                        'name' => 'fa-external-link',
                    ],
                    [
                    'class' => 'fa fa-fw fa-external-link-square',
                    'name' => 'fa-external-link-square',
                ],
                    
                    [
                        'class' => 'fa fa-fw fa-eye',
                        'name' => 'fa-eye',
                    ],
                    [
                        'class' => 'fa fa-fw fa-eye-slash',
                        'name' => 'fa-eye-slash',
                    ],
                    [
                        'class' => 'fa fa-fw fa-eyedropper',
                        'name' => 'fa-eyedropper',
                    ],
                    [
                        'class' => 'fa fa-fw fa-fax',
                        'name' => 'fa-fax',
                    ],
                    [
                        'class' => 'fa fa-fw fa-feed',
                        'name' => 'fa-feed <span class="text-muted">(alias)</span>',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-female',
                        'name' => 'fa-female',
                    ],
                    [
                        'class' => 'fa fa-fw fa-fighter-jet',
                        'name' => 'fa-fighter-jet',
                    ],
                    [
                        'class' => 'fa fa-fw fa-file-archive-o',
                        'name' => 'fa-file-archive-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-file-audio-o',
                        'name' => 'fa-file-audio-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-file-code-o',
                        'name' => 'fa-file-code-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-file-excel-o',
                        'name' => 'fa-file-excel-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-file-image-o',
                        'name' => 'fa-file-image-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-file-movie-o',
                        'name' => 'fa-file-movie-o',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-file-pdf-o',
                        'name' => 'fa-file-pdf-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-file-photo-o',
                        'name' => 'fa-file-photo-o',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-file-picture-o',
                        'name' => 'fa-file-picture-o',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-file-powerpoint-o',
                        'name' => 'fa-file-powerpoint-o',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-file-sound-o',
                        'name' => 'fa-file-sound-o',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-file-video-o',
                        'name' => 'fa-file-video-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-file-word-o',
                        'name' => 'fa-file-word-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-file-zip-o',
                        'name' => 'fa-file-zip-o',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-film',
                        'name' => 'fa-film',
                    ],
                    [
                        'class' => 'fa fa-fw fa-filter',
                        'name' => 'fa-filter',
                    ],
                    [
                        'class' => 'fa fa-fw fa-fire',
                        'name' => 'fa-fire',
                    ],
                    [
                        'class' => 'fa fa-fw fa-fire-extinguisher',
                        'name' => 'fa-fire-extinguisher',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-flag',
                        'name' => 'fa-flag',
                    ],
                    [
                        'class' => 'fa fa-fw fa-flag-checkered',
                        'name' => 'fa-flag-checkered',
                    ],
                    [
                        'class' => 'fa fa-fw fa-flag-o',
                        'name' => 'fa-flag-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-flash',
                        'name' => 'fa-flash <span class="text-muted">(alias)</span>',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-flask',
                        'name' => 'fa-flask',
                    ],
                    [
                        'class' => 'fa fa-fw fa-folder',
                        'name' => 'fa-folder',
                    ],
                    [
                        'class' => 'fa fa-fw fa-folder-o',
                        'name' => 'fa-folder-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-folder-open',
                        'name' => 'fa-folder-open',
                    ],
                    [
                        'class' => 'fa fa-fw fa-folder-open-o',
                        'name' => 'fa-folder-open-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-frown-o',
                        'name' => 'fa-frown-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-futbol-o',
                        'name' => 'fa-futbol-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-gamepad',
                        'name' => 'fa-gamepad',
                    ],
                    [
                        'class' => 'fa fa-fw fa-gavel',
                        'name' => 'fa-gavel',
                    ],
                    [
                        'class' => 'fa fa-fw fa-gear',
                        'name' => 'fa-gear <span class="text-muted">(alias)</span>',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-gears',
                        'name' => 'fa-gears <span class="text-muted">(alias)</span>',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-gift',
                        'name' => 'fa-gift',
                    ],
                    [
                        'class' => 'fa fa-fw fa-glass',
                        'name' => 'fa-glass',
                    ],
                    [
                        'class' => 'fa fa-fw fa-globe',
                        'name' => 'fa-globe',
                    ],
                    [
                        'class' => 'fa fa-fw fa-graduation-cap',
                        'name' => 'fa-graduation-cap',
                    ],
                    [
                        'class' => 'fa fa-fw fa-group',
                        'name' => 'fa-group <span class="text-muted">(alias)</span>',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-hand-grab-o',
                        'name' => 'fa-hand-grab-o',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-hand-lizard-o',
                        'name' => 'fa-hand-lizard-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hand-paper-o',
                        'name' => 'fa-hand-paper-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hand-peace-o',
                        'name' => 'fa-hand-peace-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hand-pointer-o',
                        'name' => 'fa-hand-pointer-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hand-rock-o',
                        'name' => 'fa-hand-rock-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hand-scissors-o',
                        'name' => 'fa-hand-scissors-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hand-spock-o',
                        'name' => 'fa-hand-spock-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hand-stop-o',
                        'name' => 'fa-hand-stop-o',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-hdd-o',
                        'name' => 'fa-hdd-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-headphones',
                        'name' => 'fa-headphones',
                    ],
                    [
                        'class' => 'fa fa-fw fa-heart',
                        'name' => 'fa-heart',
                    ],
                    [
                        'class' => 'fa fa-fw fa-heart-o',
                        'name' => 'fa-heart-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-heartbeat',
                        'name' => 'fa-heartbeat',
                    ],
                    [
                        'class' => 'fa fa-fw fa-history',
                        'name' => 'fa-history',
                    ],
                    [
                        'class' => 'fa fa-fw fa-home',
                        'name' => 'fa-home',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hotel',
                        'name' => 'fa-hotel <span class="text-muted">(alias)</span>',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-hourglass',
                        'name' => 'fa-hourglass',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hourglass-1',
                        'name' => 'fa-hourglass-1',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-hourglass-2',
                        'name' => 'fa-hourglass-2',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-hourglass-3',
                        'name' => 'fa-hourglass-3',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-hourglass-end',
                        'name' => 'fa-hourglass-end',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hourglass-half',
                        'name' => 'fa-hourglass-half',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hourglass-o',
                        'name' => 'fa-hourglass-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hourglass-start',
                        'name' => 'fa-hourglass-start',
                    ],
                    [
                        'class' => 'fa fa-fw fa-i-cursor',
                        'name' => 'fa-i-cursor',
                    ],
                    [
                        'class' => 'fa fa-fw fa-image',
                        'name' => 'fa-image <span class="text-muted">(alias)</span>',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-inbox',
                        'name' => 'fa-inbox',
                    ],
                    [
                        'class' => 'fa fa-fw fa-industry',
                        'name' => 'fa-industry',
                    ],
                    [
                        'class' => 'fa fa-fw fa-info',
                        'name' => 'fa-info',
                    ],
                    [
                        'class' => 'fa fa-fw fa-info-circle',
                        'name' => 'fa-info-circle',
                    ],
                    [
                        'class' => 'fa fa-fw fa-institution',
                        'name' => 'fa-institution',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-key',
                        'name' => 'fa-key',
                    ],
                    [
                        'class' => 'fa fa-fw fa-keyboard-o',
                        'name' => 'fa-keyboard-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-language',
                        'name' => 'fa-language',
                    ],
                    [
                        'class' => 'fa fa-fw fa-laptop',
                        'name' => 'fa-laptop',
                    ],
                    [
                        'class' => 'fa fa-fw fa-leaf',
                        'name' => 'fa-leaf',
                    ],
                    [
                        'class' => 'fa fa-fw fa-legal',
                        'name' => 'fa-legal <span class="text-muted">(alias)</span>',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-lemon-o',
                        'name' => 'fa-lemon-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-level-down',
                        'name' => 'fa-level-down',
                    ],
                    [
                        'class' => 'fa fa-fw fa-level-up',
                        'name' => 'fa-level-up',
                    ],
                    [
                        'class' => 'fa fa-fw fa-life-bouy',
                        'name' => 'fa-life-bouy',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-life-buoy',
                        'name' => 'fa-life-buoy',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-life-ring',
                        'name' => 'fa-life-ring',
                    ],
                    [
                        'class' => 'fa fa-fw fa-life-saver',
                        'name' => 'fa-life-saver',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-lightbulb-o',
                        'name' => 'fa-lightbulb-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-line-chart',
                        'name' => 'fa-line-chart',
                    ],
                    [
                        'class' => 'fa fa-fw fa-location-arrow',
                        'name' => 'fa-location-arrow',
                    ],
                    [
                        'class' => 'fa fa-fw fa-lock',
                        'name' => 'fa-lock',
                    ],
                    [
                        'class' => 'fa fa-fw fa-magic',
                        'name' => 'fa-magic',
                    ],
                    [
                        'class' => 'fa fa-fw fa-magnet',
                        'name' => 'fa-magnet',
                    ],
                    [
                        'class' => 'fa fa-fw fa-mail-forward',
                        'name' => 'fa-mail-forward',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-mail-reply',
                        'name' => 'fa-mail-reply',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-mail-reply-all',
                        'name' => 'fa-mail-reply-all',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-male',
                        'name' => 'fa-male',
                    ],
                    [
                        'class' => 'fa fa-fw fa-map',
                        'name' => 'fa-map',
                    ],
                    [
                        'class' => 'fa fa-fw fa-map-marker',
                        'name' => 'fa-map-marker',
                    ],
                    [
                        'class' => 'fa fa-fw fa-map-o',
                        'name' => 'fa-map-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-map-pin',
                        'name' => 'fa-map-pin',
                    ],
                    [
                        'class' => 'fa fa-fw fa-map-signs',
                        'name' => 'fa-map-signs',
                    ],
                    [
                        'class' => 'fa fa-fw fa-meh-o',
                        'name' => 'fa-meh-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-microphone',
                        'name' => 'fa-microphone',
                    ],
                    [
                        'class' => 'fa fa-fw fa-microphone-slash',
                        'name' => 'fa-microphone-slash',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-minus',
                        'name' => 'fa-minus',
                    ],
                    [
                        'class' => 'fa fa-fw fa-minus-circle',
                        'name' => 'fa-minus-circle',
                    ],
                    [
                        'class' => 'fa fa-fw fa-minus-square',
                        'name' => 'fa-minus-square',
                    ],
                    [
                        'class' => 'fa fa-fw fa-minus-square-o',
                        'name' => 'fa-minus-square-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-mobile',
                        'name' => 'fa-mobile',
                    ],
                    [
                        'class' => 'fa fa-fw fa-mobile-phone',
                        'name' => 'fa-mobile-phone',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-money',
                        'name' => 'fa-money',
                    ],
                    [
                        'class' => 'fa fa-fw fa-moon-o',
                        'name' => 'fa-moon-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-mortar-board',
                        'name' => 'fa-mortar-board',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-motorcycle',
                        'name' => 'fa-motorcycle',
                    ],
                    [
                        'class' => 'fa fa-fw fa-mouse-pointer',
                        'name' => 'fa-mouse-pointer',
                    ],
                    [
                        'class' => 'fa fa-fw fa-music',
                        'name' => 'fa-music',
                    ],
                    [
                        'class' => 'fa fa-fw fa-navicon',
                        'name' => 'fa-navicon',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-newspaper-o',
                        'name' => 'fa-newspaper-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-object-group',
                        'name' => 'fa-object-group',
                    ],
                    [
                        'class' => 'fa fa-fw fa-object-ungroup',
                        'name' => 'fa-object-ungroup',
                    ],
                    [
                        'class' => 'fa fa-fw fa-paint-brush',
                        'name' => 'fa-paint-brush',
                    ],
                    [
                        'class' => 'fa fa-fw fa-paper-plane',
                        'name' => 'fa-paper-plane',
                    ],
                    [
                        'class' => 'fa fa-fw fa-paper-plane-o',
                        'name' => 'fa-paper-plane-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-paw',
                        'name' => 'fa-paw',
                    ],
                    [
                        'class' => 'fa fa-fw fa-pencil',
                        'name' => 'fa-pencil',
                    ],
                    [
                        'class' => 'fa fa-fw fa-pencil-square',
                        'name' => 'fa-pencil-square',
                    ],
                    [
                        'class' => 'fa fa-fw fa-pencil-square-o',
                        'name' => 'fa-pencil-square-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-phone',
                        'name' => 'fa-phone',
                    ],
                    [
                        'class' => 'fa fa-fw fa-phone-square',
                        'name' => 'fa-phone-square',
                    ],
                    [
                        'class' => 'fa fa-fw fa-photo',
                        'name' => 'fa-photo <span class="text-muted">(alias)</span>',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-picture-o',
                        'name' => 'fa-picture-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-pie-chart',
                        'name' => 'fa-pie-chart',
                    ],
                    [
                        'class' => 'fa fa-fw fa-plane',
                        'name' => 'fa-plane',
                    ],
                    [
                        'class' => 'fa fa-fw fa-plug',
                        'name' => 'fa-plug',
                    ],
                    [
                        'class' => 'fa fa-fw fa-plus',
                        'name' => 'fa-plus',
                    ],
                    [
                        'class' => 'fa fa-fw fa-plus-circle',
                        'name' => 'fa-plus-circle',
                    ],
                    [
                        'class' => 'fa fa-fw fa-plus-square',
                        'name' => 'fa-plus-square',
                    ],
                    [
                        'class' => 'fa fa-fw fa-plus-square-o',
                        'name' => 'fa-plus-square-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-power-off',
                        'name' => 'fa-power-off',
                    ],
                    [
                        'class' => 'fa fa-fw fa-print',
                        'name' => 'fa-print',
                    ],
                    [
                        'class' => 'fa fa-fw fa-puzzle-piece',
                        'name' => 'fa-puzzle-piece',
                    ],
                    [
                        'class' => 'fa fa-fw fa-qrcode',
                        'name' => 'fa-qrcode',
                    ],
                    [
                        'class' => 'fa fa-fw fa-question',
                        'name' => 'fa-question',
                    ],
                    [
                        'class' => 'fa fa-fw fa-question-circle',
                        'name' => 'fa-question-circle',
                    ],
                    [
                        'class' => 'fa fa-fw fa-quote-left',
                        'name' => 'fa-quote-left',
                    ],
                    [
                        'class' => 'fa fa-fw fa-quote-right',
                        'name' => 'fa-quote-right',
                    ],
                    [
                        'class' => 'fa fa-fw fa-random',
                        'name' => 'fa-random',
                    ],
                    [
                        'class' => 'fa fa-fw fa-recycle',
                        'name' => 'fa-recycle',
                    ],
                    [
                        'class' => 'fa fa-fw fa-refresh',
                        'name' => 'fa-refresh',
                    ],
                    [
                        'class' => 'fa fa-fw fa-registered',
                        'name' => 'fa-registered',
                    ],
                    [
                        'class' => 'fa fa-fw fa-remove',
                        'name' => 'fa-remove',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-reorder',
                        'name' => 'fa-reorder',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-reply',
                        'name' => 'fa-reply',
                    ],
                    [
                        'class' => 'fa fa-fw fa-reply-all',
                        'name' => 'fa-reply-all',
                    ],
                    [
                        'class' => 'fa fa-fw fa-retweet',
                        'name' => 'fa-retweet',
                    ],
                    [
                        'class' => 'fa fa-fw fa-road',
                        'name' => 'fa-road',
                    ],
                    [
                        'class' => 'fa fa-fw fa-rocket',
                        'name' => 'fa-rocket',
                    ],
                    [
                        'class' => 'fa fa-fw fa-rss',
                        'name' => 'fa-rss',
                    ],
                    [
                        'class' => 'fa fa-fw fa-rss-square',
                        'name' => 'fa-rss-square',
                    ],
                    [
                        'class' => 'fa fa-fw fa-search',
                        'name' => 'fa-search',
                    ],
                    [
                        'class' => 'fa fa-fw fa-search-minus',
                        'name' => 'fa-search-minus',
                    ],
                    [
                        'class' => 'fa fa-fw fa-search-plus',
                        'name' => 'fa-search-plus',
                    ],
                    [
                        'class' => 'fa fa-fw fa-send',
                        'name' => 'fa-send <span class="text-muted">(alias)</span>',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-send-o',
                        'name' => 'fa-send-o',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-server',
                        'name' => 'fa-server',
                    ],
                    [
                        'class' => 'fa fa-fw fa-share',
                        'name' => 'fa-share',
                    ],
                    [
                        'class' => 'fa fa-fw fa-share-alt',
                        'name' => 'fa-share-alt',
                    ],
                    [
                        'class' => 'fa fa-fw fa-share-alt-square',
                        'name' => 'fa-share-alt-square',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-share-square',
                        'name' => 'fa-share-square',
                    ],
                    [
                        'class' => 'fa fa-fw fa-share-square-o',
                        'name' => 'fa-share-square-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-shield',
                        'name' => 'fa-shield',
                    ],
                    [
                        'class' => 'fa fa-fw fa-ship',
                        'name' => 'fa-ship',
                    ],
                    [
                        'class' => 'fa fa-fw fa-shopping-cart',
                        'name' => 'fa-shopping-cart',
                    ],
                    [
                        'class' => 'fa fa-fw fa-sign-in',
                        'name' => 'fa-sign-in',
                    ],
                    [
                        'class' => 'fa fa-fw fa-sign-out',
                        'name' => 'fa-sign-out',
                    ],
                    [
                        'class' => 'fa fa-fw fa-signal',
                        'name' => 'fa-signal',
                    ],
                    [
                        'class' => 'fa fa-fw fa-sitemap',
                        'name' => 'fa-sitemap',
                    ],
                    [
                        'class' => 'fa fa-fw fa-sliders',
                        'name' => 'fa-sliders',
                    ],
                    [
                        'class' => 'fa fa-fw fa-smile-o',
                        'name' => 'fa-smile-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-soccer-ball-o',
                        'name' => 'fa-soccer-ball-o',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-sort',
                        'name' => 'fa-sort',
                    ],
                    [
                        'class' => 'fa fa-fw fa-sort-alpha-asc',
                        'name' => 'fa-sort-alpha-asc',
                    ],
                    [
                        'class' => 'fa fa-fw fa-sort-alpha-desc',
                        'name' => 'fa-sort-alpha-desc',
                    ],
                    [
                        'class' => 'fa fa-fw fa-sort-amount-asc',
                        'name' => 'fa-sort-amount-asc',
                    ],
                    [
                        'class' => 'fa fa-fw fa-sort-amount-desc',
                        'name' => 'fa-sort-amount-desc',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-sort-asc',
                        'name' => 'fa-sort-asc',
                    ],
                    [
                        'class' => 'fa fa-fw fa-sort-desc',
                        'name' => 'fa-sort-desc',
                    ],
                    [
                        'class' => 'fa fa-fw fa-sort-down',
                        'name' => 'fa-sort-down',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-sort-numeric-asc',
                        'name' => 'fa-sort-numeric-asc',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-sort-numeric-desc',
                        'name' => 'fa-sort-numeric-desc',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-sort-up',
                        'name' => 'fa-sort-up',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-space-shuttle',
                        'name' => 'fa-space-shuttle',
                    ],
                    [
                        'class' => 'fa fa-fw fa-spinner',
                        'name' => 'fa-spinner',
                    ],
                    [
                        'class' => 'fa fa-fw fa-spoon',
                        'name' => 'fa-spoon',
                    ],
                    [
                        'class' => 'fa fa-fw fa-square',
                        'name' => 'fa-square',
                    ],
                    [
                        'class' => 'fa fa-fw fa-square-o',
                        'name' => 'fa-square-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-star',
                        'name' => 'fa-star',
                    ],
                    [
                        'class' => 'fa fa-fw fa-star-half',
                        'name' => 'fa-star-half',
                    ],
                    [
                        'class' => 'fa fa-fw fa-star-half-empty',
                        'name' => 'fa-star-half-empty',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-star-half-full',
                        'name' => 'fa-star-half-full',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-star-half-o',
                        'name' => 'fa-star-half-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-star-o',
                        'name' => 'fa-star-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-sticky-note',
                        'name' => 'fa-sticky-note',
                    ],
                    [
                        'class' => 'fa fa-fw fa-sticky-note-o',
                        'name' => 'fa-sticky-note-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-street-view',
                        'name' => 'fa-street-view',
                    ],
                    [
                        'class' => 'fa fa-fw fa-suitcase',
                        'name' => 'fa-suitcase',
                    ],
                    [
                        'class' => 'fa fa-fw fa-sun-o',
                        'name' => 'fa-sun-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-support',
                        'name' => 'fa-support',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-tablet',
                        'name' => 'fa-tablet',
                    ],
                    [
                        'class' => 'fa fa-fw fa-tachometer',
                        'name' => 'fa-tachometer',
                    ],
                    [
                        'class' => 'fa fa-fw fa-tag',
                        'name' => 'fa-tag',
                    ],
                    [
                        'class' => 'fa fa-fw fa-tags',
                        'name' => 'fa-tags',
                    ],
                    [
                        'class' => 'fa fa-fw fa-tasks',
                        'name' => 'fa-tasks',
                    ],
                    [
                        'class' => 'fa fa-fw fa-taxi',
                        'name' => 'fa-taxi',
                    ],
                    [
                        'class' => 'fa fa-fw fa-television',
                        'name' => 'fa-television',
                    ],
                    [
                        'class' => 'fa fa-fw fa-terminal',
                        'name' => 'fa-terminal',
                    ],
                    [
                        'class' => 'fa fa-fw fa-thumb-tack',
                        'name' => 'fa-thumb-tack',
                    ],
                    [
                        'class' => 'fa fa-fw fa-thumbs-down',
                        'name' => 'fa-thumbs-down',
                    ],
                    [
                        'class' => 'fa fa-fw fa-thumbs-o-down',
                        'name' => 'fa-thumbs-o-down',
                    ],
                    [
                        'class' => 'fa fa-fw fa-thumbs-o-up',
                        'name' => 'fa-thumbs-o-up',
                    ],
                    [
                        'class' => 'fa fa-fw fa-thumbs-up',
                        'name' => 'fa-thumbs-up',
                    ],
                    [
                        'class' => 'fa fa-fw fa-ticket',
                        'name' => 'fa-ticket',
                    ],
                    [
                        'class' => 'fa fa-fw fa-times',
                        'name' => 'fa-times',
                    ],
                    [
                        'class' => 'fa fa-fw fa-times-circle',
                        'name' => 'fa-times-circle',
                    ],
                    [
                        'class' => 'fa fa-fw fa-times-circle-o',
                        'name' => 'fa-times-circle-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-tint',
                        'name' => 'fa-tint',
                    ],
                    [
                        'class' => 'fa fa-fw fa-toggle-down',
                        'name' => 'fa-toggle-down',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-toggle-left',
                        'name' => 'fa-toggle-left',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-toggle-off',
                        'name' => 'fa-toggle-off',
                    ],
                    [
                        'class' => 'fa fa-fw fa-toggle-on',
                        'name' => 'fa-toggle-on',
                    ],
                    [
                        'class' => 'fa fa-fw fa-toggle-right',
                        'name' => 'fa-toggle-right',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-toggle-up',
                        'name' => 'fa-toggle-up',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-trademark',
                        'name' => 'fa-trademark',
                    ],
                    [
                        'class' => 'fa fa-fw fa-trash',
                        'name' => 'fa-trash',
                    ],
                    [
                        'class' => 'fa fa-fw fa-trash-o',
                        'name' => 'fa-trash-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-tree',
                        'name' => 'fa-tree',
                    ],
                    [
                        'class' => 'fa fa-fw fa-trophy',
                        'name' => 'fa-trophy',
                    ],
                    [
                        'class' => 'fa fa-fw fa-truck',
                        'name' => 'fa-truck',
                    ],
                    [
                        'class' => 'fa fa-fw fa-tty',
                        'name' => 'fa-tty',
                    ],
                    [
                        'class' => 'fa fa-fw fa-tv',
                        'name' => 'fa-tv',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-umbrella',
                        'name' => 'fa-umbrella',
                    ],
                    [
                        'class' => 'fa fa-fw fa-university',
                        'name' => 'fa-university',
                    ],
                    [
                        'class' => 'fa fa-fw fa-unlock',
                        'name' => 'fa-unlock',
                    ],
                    [
                        'class' => 'fa fa-fw fa-unlock-alt',
                        'name' => 'fa-unlock-alt',
                    ],
                    [
                        'class' => 'fa fa-fw fa-unsorted',
                        'name' => 'fa-unsorted',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-upload',
                        'name' => 'fa-upload',
                    ],
                    [
                        'class' => 'fa fa-fw fa-user',
                        'name' => 'fa-user',
                    ],
                    [
                        'class' => 'fa fa-fw fa-user-plus',
                        'name' => 'fa-user-plus',
                    ],
                    [
                        'class' => 'fa fa-fw fa-user-secret',
                        'name' => 'fa-user-secret',
                    ],
                    [
                        'class' => 'fa fa-fw fa-user-times',
                        'name' => 'fa-user-times',
                    ],
                    [
                        'class' => 'fa fa-fw fa-users',
                        'name' => 'fa-users',
                    ],
                    [
                        'class' => 'fa fa-fw fa-video-camera',
                        'name' => 'fa-video-camera',
                    ],
                    [
                        'class' => 'fa fa-fw fa-volume-down',
                        'name' => 'fa-volume-down',
                    ],
                    [
                        'class' => 'fa fa-fw fa-volume-off',
                        'name' => 'fa-volume-off',
                    ],
                    [
                        'class' => 'fa fa-fw fa-volume-up',
                        'name' => 'fa-volume-up',
                    ],
                    [
                        'class' => 'fa fa-fw fa-warning',
                        'name' => 'fa-warning',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-wheelchair',
                        'name' => 'fa-wheelchair',
                    ],
                    [
                        'class' => 'fa fa-fw fa-wifi',
                        'name' => 'fa-wifi',
                    ],
                    [
                        'class' => 'fa fa-fw fa-wrench',
                        'name' => 'fa-wrench',
                    ],
                  
            //     ];
            // }

                // <section id="hand">
                  
                
        // public function icons('Hand Icons') {

                //   return [
                    [
                        'class' => 'fa fa-fw fa-hand-grab-o',
                        'name' => 'fa-hand-grab-o',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-hand-lizard-o',
                        'name' => 'fa-hand-lizard-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hand-o-down',
                        'name' => 'fa-hand-o-down',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hand-o-left',
                        'name' => 'fa-hand-o-left',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hand-o-right',
                        'name' => 'fa-hand-o-right',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hand-o-up',
                        'name' => 'fa-hand-o-up',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hand-paper-o',
                        'name' => 'fa-hand-paper-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hand-peace-o',
                        'name' => 'fa-hand-peace-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hand-pointer-o',
                        'name' => 'fa-hand-pointer-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hand-rock-o',
                        'name' => 'fa-hand-rock-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hand-scissors-o',
                        'name' => 'fa-hand-scissors-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hand-spock-o',
                        'name' => 'fa-hand-spock-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hand-stop-o',
                        'name' => 'fa-hand-stop-o',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-thumbs-down',
                        'name' => 'fa-thumbs-down',
                    ],
                    [
                        'class' => 'fa fa-fw fa-thumbs-o-down',
                        'name' => 'fa-thumbs-o-down',
                    ],
                    [
                        'class' => 'fa fa-fw fa-thumbs-o-up',
                        'name' => 'fa-thumbs-o-up',
                    ],
                    [
                        'class' => 'fa fa-fw fa-thumbs-up',
                        'name' => 'fa-thumbs-up',
                    ],
                  
            //     ];
            // }

                // <section id="transportation">
                  
                
        // public function icons('Transportation Icons') {

                //   return [
                    [
                        'class' => 'fa fa-fw fa-ambulance',
                        'name' => 'fa-ambulance',
                    ],
                    [
                        'class' => 'fa fa-fw fa-automobile',
                        'name' => 'fa-automobile',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-bicycle',
                        'name' => 'fa-bicycle',
                    ],
                    [
                        'class' => 'fa fa-fw fa-bus',
                        'name' => 'fa-bus',
                    ],
                    [
                        'class' => 'fa fa-fw fa-cab',
                        'name' => 'fa-cab <span class="text-muted">(alias)</span>',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-car',
                        'name' => 'fa-car',
                    ],
                    [
                        'class' => 'fa fa-fw fa-fighter-jet',
                        'name' => 'fa-fighter-jet',
                    ],
                    [
                        'class' => 'fa fa-fw fa-motorcycle',
                        'name' => 'fa-motorcycle',
                    ],
                    [
                        'class' => 'fa fa-fw fa-plane',
                        'name' => 'fa-plane',
                    ],
                    [
                        'class' => 'fa fa-fw fa-rocket',
                        'name' => 'fa-rocket',
                    ],
                    [
                        'class' => 'fa fa-fw fa-ship',
                        'name' => 'fa-ship',
                    ],
                    [
                        'class' => 'fa fa-fw fa-space-shuttle',
                        'name' => 'fa-space-shuttle',
                    ],
                    [
                        'class' => 'fa fa-fw fa-subway',
                        'name' => 'fa-subway',
                    ],
                    [
                        'class' => 'fa fa-fw fa-taxi',
                        'name' => 'fa-taxi',
                    ],
                    [
                        'class' => 'fa fa-fw fa-train',
                        'name' => 'fa-train',
                    ],
                    [
                        'class' => 'fa fa-fw fa-truck',
                        'name' => 'fa-truck',
                    ],
                    [
                        'class' => 'fa fa-fw fa-wheelchair',
                        'name' => 'fa-wheelchair',
                    ],
                  
            //     ];
            // }

                // <section id="gender">
                  
                
        // public function icons('Gender Icons') {

                //   return [
                    [
                        'class' => 'fa fa-fw fa-genderless',
                        'name' => 'fa-genderless',
                    ],
                    [
                        'class' => 'fa fa-fw fa-intersex',
                        'name' => 'fa-intersex',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-mars',
                        'name' => 'fa-mars',
                    ],
                    [
                        'class' => 'fa fa-fw fa-mars-double',
                        'name' => 'fa-mars-double',
                    ],
                    [
                        'class' => 'fa fa-fw fa-mars-stroke',
                        'name' => 'fa-mars-stroke',
                    ],
                    [
                        'class' => 'fa fa-fw fa-mars-stroke-h',
                        'name' => 'fa-mars-stroke-h',
                    ],
                    [
                        'class' => 'fa fa-fw fa-mars-stroke-v',
                        'name' => 'fa-mars-stroke-v',
                    ],
                    [
                        'class' => 'fa fa-fw fa-mercury',
                        'name' => 'fa-mercury',
                    ],
                    [
                        'class' => 'fa fa-fw fa-neuter',
                        'name' => 'fa-neuter',
                    ],
                    [
                        'class' => 'fa fa-fw fa-transgender',
                        'name' => 'fa-transgender',
                    ],
                    [
                        'class' => 'fa fa-fw fa-transgender-alt',
                        'name' => 'fa-transgender-alt',
                    ],
                    [
                        'class' => 'fa fa-fw fa-venus',
                        'name' => 'fa-venus',
                    ],
                    [
                        'class' => 'fa fa-fw fa-venus-double',
                        'name' => 'fa-venus-double',
                    ],
                    [
                        'class' => 'fa fa-fw fa-venus-mars',
                        'name' => 'fa-venus-mars',
                    ],
                  
            //     ];
            // }

                // <section id="file-type">
                  // File Type Icons

                //   return [
                    [
                        'class' => 'fa fa-fw fa-file',
                        'name' => 'fa-file',
                    ],
                    [
                        'class' => 'fa fa-fw fa-file-archive-o',
                        'name' => 'fa-file-archive-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-file-audio-o',
                        'name' => 'fa-file-audio-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-file-code-o',
                        'name' => 'fa-file-code-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-file-excel-o',
                        'name' => 'fa-file-excel-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-file-image-o',
                        'name' => 'fa-file-image-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-file-movie-o',
                        'name' => 'fa-file-movie-o',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-file-o',
                        'name' => 'fa-file-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-file-pdf-o',
                        'name' => 'fa-file-pdf-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-file-photo-o',
                        'name' => 'fa-file-photo-o',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-file-picture-o',
                        'name' => 'fa-file-picture-o',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-file-powerpoint-o',
                        'name' => 'fa-file-powerpoint-o',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-file-sound-o',
                        'name' => 'fa-file-sound-o',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-file-text',
                        'name' => 'fa-file-text',
                    ],
                    [
                        'class' => 'fa fa-fw fa-file-text-o',
                        'name' => 'fa-file-text-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-file-video-o',
                        'name' => 'fa-file-video-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-file-word-o',
                        'name' => 'fa-file-word-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-file-zip-o',
                        'name' => 'fa-file-zip-o',
                    ],
                     // Alias
                  
            //     ];
            // }

                // <section id="spinner">
                  // Spinner Icons

                //   return [
                    [
                        'class' => 'fa fa-fw fa-circle-o-notch',
                        'name' => 'fa-circle-o-notch',
                    ],
                    [
                        'class' => 'fa fa-fw fa-cog',
                        'name' => 'fa-cog',
                    ],
                    [
                        'class' => 'fa fa-fw fa-gear',
                        'name' => 'fa-gear <span class="text-muted">(alias)</span>',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-refresh',
                        'name' => 'fa-refresh',
                    ],
                    [
                        'class' => 'fa fa-fw fa-spinner',
                        'name' => 'fa-spinner',
                    ],
                  
            //     ];
            // }

                // <section id="form-control">
                  
                
        // public function icons('Form Control Icons') {

                //   return [
                    [
                        'class' => 'fa fa-fw fa-check-square',
                        'name' => 'fa-check-square',
                    ],
                    [
                        'class' => 'fa fa-fw fa-check-square-o',
                        'name' => 'fa-check-square-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-circle',
                        'name' => 'fa-circle',
                    ],
                    [
                        'class' => 'fa fa-fw fa-circle-o',
                        'name' => 'fa-circle-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-dot-circle-o',
                        'name' => 'fa-dot-circle-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-minus-square',
                        'name' => 'fa-minus-square',
                    ],
                    [
                        'class' => 'fa fa-fw fa-minus-square-o',
                        'name' => 'fa-minus-square-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-plus-square',
                        'name' => 'fa-plus-square',
                    ],
                    [
                        'class' => 'fa fa-fw fa-plus-square-o',
                        'name' => 'fa-plus-square-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-square',
                        'name' => 'fa-square',
                    ],
                    [
                        'class' => 'fa fa-fw fa-square-o',
                        'name' => 'fa-square-o',
                    ],
                  
            //     ];
            // }

                // <section id="payment">
                  
                
        // public function icons('Payment Icons') {

                //   return [
                    [
                        'class' => 'fa fa-fw fa-cc-amex',
                        'name' => 'fa-cc-amex',
                    ],
                    [
                        'class' => 'fa fa-fw fa-cc-diners-club',
                        'name' => 'fa-cc-diners-club',
                    ],
                    [
                        'class' => 'fa fa-fw fa-cc-discover',
                        'name' => 'fa-cc-discover',
                    ],
                    [
                        'class' => 'fa fa-fw fa-cc-jcb',
                        'name' => 'fa-cc-jcb',
                    ],
                    [
                        'class' => 'fa fa-fw fa-cc-mastercard',
                        'name' => 'fa-cc-mastercard',
                    ],
                    [
                        'class' => 'fa fa-fw fa-cc-paypal',
                        'name' => 'fa-cc-paypal',
                    ],
                    [
                        'class' => 'fa fa-fw fa-cc-stripe',
                        'name' => 'fa-cc-stripe',
                    ],
                    [
                        'class' => 'fa fa-fw fa-cc-visa',
                        'name' => 'fa-cc-visa',
                    ],
                    [
                        'class' => 'fa fa-fw fa-credit-card',
                        'name' => 'fa-credit-card',
                    ],
                    [
                        'class' => 'fa fa-fw fa-google-wallet',
                        'name' => 'fa-google-wallet',
                    ],
                    [
                        'class' => 'fa fa-fw fa-paypal',
                        'name' => 'fa-paypal',
                    ],
                  
            //     ];
            // }

                // <section id="chart">
                  
                
        // public function icons('Chart Icons') {

                //   return [
                    [
                        'class' => 'fa fa-fw fa-area-chart',
                        'name' => 'fa-area-chart',
                    ],
                    [
                        'class' => 'fa fa-fw fa-bar-chart',
                        'name' => 'fa-bar-chart',
                    ],
                    [
                        'class' => 'fa fa-fw fa-bar-chart-o',
                        'name' => 'fa-bar-chart-o',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-line-chart',
                        'name' => 'fa-line-chart',
                    ],
                    [
                        'class' => 'fa fa-fw fa-pie-chart',
                        'name' => 'fa-pie-chart',
                    ],
                  
            //     ];
            // }

                // <section id="currency">
                  
                
        // public function icons('Currency Icons') {

                //   return [
                    [
                        'class' => 'fa fa-fw fa-bitcoin',
                        'name' => 'fa-bitcoin',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-btc',
                        'name' => 'fa-btc',
                    ],
                    [
                        'class' => 'fa fa-fw fa-cny',
                        'name' => 'fa-cny <span class="text-muted">(alias)</span>',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-dollar',
                        'name' => 'fa-dollar',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-eur',
                        'name' => 'fa-eur',
                    ],
                    [
                        'class' => 'fa fa-fw fa-euro',
                        'name' => 'fa-euro <span class="text-muted">(alias)</span>',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-gbp',
                        'name' => 'fa-gbp',
                    ],
                    [
                        'class' => 'fa fa-fw fa-gg',
                        'name' => 'fa-gg',
                    ],
                    [
                        'class' => 'fa fa-fw fa-gg-circle',
                        'name' => 'fa-gg-circle',
                    ],
                    [
                        'class' => 'fa fa-fw fa-ils',
                        'name' => 'fa-ils',
                    ],
                    [
                        'class' => 'fa fa-fw fa-inr',
                        'name' => 'fa-inr',
                    ],
                    [
                        'class' => 'fa fa-fw fa-jpy',
                        'name' => 'fa-jpy',
                    ],
                    [
                        'class' => 'fa fa-fw fa-krw',
                        'name' => 'fa-krw',
                    ],
                    [
                        'class' => 'fa fa-fw fa-money',
                        'name' => 'fa-money',
                    ],
                    [
                        'class' => 'fa fa-fw fa-rmb',
                        'name' => 'fa-rmb <span class="text-muted">(alias)</span>',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-rouble',
                        'name' => 'fa-rouble',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-rub',
                        'name' => 'fa-rub',
                    ],
                    [
                        'class' => 'fa fa-fw fa-ruble',
                        'name' => 'fa-ruble <span class="text-muted">(alias)</span>',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-rupee',
                        'name' => 'fa-rupee <span class="text-muted">(alias)</span>',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-shekel',
                        'name' => 'fa-shekel',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-sheqel',
                        'name' => 'fa-sheqel',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-try',
                        'name' => 'fa-try',
                    ],
                    [
                        'class' => 'fa fa-fw fa-turkish-lira',
                        'name' => 'fa-turkish-lira',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-usd',
                        'name' => 'fa-usd',
                    ],
                    [
                        'class' => 'fa fa-fw fa-won',
                        'name' => 'fa-won <span class="text-muted">(alias)</span>',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-yen',
                        'name' => 'fa-yen <span class="text-muted">(alias)</span>',
                    ],
                    
                  
            //     ];
            // }

                // <section id="text-editor">
                  
                
        // public function icons('Text Editor Icons') {

                //   return [
                    [
                        'class' => 'fa fa-fw fa-align-center',
                        'name' => 'fa-align-center',
                    ],
                    [
                        'class' => 'fa fa-fw fa-align-justify',
                        'name' => 'fa-align-justify',
                    ],
                    [
                        'class' => 'fa fa-fw fa-align-left',
                        'name' => 'fa-align-left',
                    ],
                    [
                        'class' => 'fa fa-fw fa-align-right',
                        'name' => 'fa-align-right',
                    ],
                    [
                        'class' => 'fa fa-fw fa-bold',
                        'name' => 'fa-bold',
                    ],
                    [
                        'class' => 'fa fa-fw fa-chain',
                        'name' => 'fa-chain <span class="text-muted">(alias)</span>',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-chain-broken',
                        'name' => 'fa-chain-broken',
                    ],
                    [
                        'class' => 'fa fa-fw fa-clipboard',
                        'name' => 'fa-clipboard',
                    ],
                    [
                        'class' => 'fa fa-fw fa-columns',
                        'name' => 'fa-columns',
                    ],
                    [
                        'class' => 'fa fa-fw fa-copy',
                        'name' => 'fa-copy <span class="text-muted">(alias)</span>',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-cut',
                        'name' => 'fa-cut <span class="text-muted">(alias)</span>',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-dedent',
                        'name' => 'fa-dedent',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-eraser',
                        'name' => 'fa-eraser',
                    ],
                    [
                        'class' => 'fa fa-fw fa-file',
                        'name' => 'fa-file',
                    ],
                    [
                        'class' => 'fa fa-fw fa-file-o',
                        'name' => 'fa-file-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-file-text',
                        'name' => 'fa-file-text',
                    ],
                    [
                        'class' => 'fa fa-fw fa-file-text-o',
                        'name' => 'fa-file-text-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-files-o',
                        'name' => 'fa-files-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-floppy-o',
                        'name' => 'fa-floppy-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-font',
                        'name' => 'fa-font',
                    ],
                    [
                        'class' => 'fa fa-fw fa-header',
                        'name' => 'fa-header',
                    ],
                    [
                        'class' => 'fa fa-fw fa-indent',
                        'name' => 'fa-indent',
                    ],
                    [
                        'class' => 'fa fa-fw fa-italic',
                        'name' => 'fa-italic',
                    ],
                    [
                        'class' => 'fa fa-fw fa-link',
                        'name' => 'fa-link',
                    ],
                    [
                        'class' => 'fa fa-fw fa-list',
                        'name' => 'fa-list',
                    ],
                    [
                        'class' => 'fa fa-fw fa-list-alt',
                        'name' => 'fa-list-alt',
                    ],
                    [
                        'class' => 'fa fa-fw fa-list-ol',
                        'name' => 'fa-list-ol',
                    ],
                    [
                        'class' => 'fa fa-fw fa-list-ul',
                        'name' => 'fa-list-ul',
                    ],
                    [
                        'class' => 'fa fa-fw fa-outdent',
                        'name' => 'fa-outdent',
                    ],
                    [
                        'class' => 'fa fa-fw fa-paperclip',
                        'name' => 'fa-paperclip',
                    ],
                    [
                        'class' => 'fa fa-fw fa-paragraph',
                        'name' => 'fa-paragraph',
                    ],
                    [
                        'class' => 'fa fa-fw fa-paste',
                        'name' => 'fa-paste <span class="text-muted">(alias)</span>',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-repeat',
                        'name' => 'fa-repeat',
                    ],
                    [
                        'class' => 'fa fa-fw fa-rotate-left',
                        'name' => 'fa-rotate-left',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-rotate-right',
                        'name' => 'fa-rotate-right',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-save',
                        'name' => 'fa-save <span class="text-muted">(alias)</span>',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-scissors',
                        'name' => 'fa-scissors',
                    ],
                    [
                        'class' => 'fa fa-fw fa-strikethrough',
                        'name' => 'fa-strikethrough',
                    ],
                    [
                        'class' => 'fa fa-fw fa-subscript',
                        'name' => 'fa-subscript',
                    ],
                    [
                        'class' => 'fa fa-fw fa-superscript',
                        'name' => 'fa-superscript',
                    ],
                    [
                        'class' => 'fa fa-fw fa-table',
                        'name' => 'fa-table',
                    ],
                    [
                        'class' => 'fa fa-fw fa-text-height',
                        'name' => 'fa-text-height',
                    ],
                    [
                        'class' => 'fa fa-fw fa-text-width',
                        'name' => 'fa-text-width',
                    ],
                    [
                        'class' => 'fa fa-fw fa-th',
                        'name' => 'fa-th',
                    ],
                    [
                        'class' => 'fa fa-fw fa-th-large',
                        'name' => 'fa-th-large',
                    ],
                    [
                        'class' => 'fa fa-fw fa-th-list',
                        'name' => 'fa-th-list',
                    ],
                    [
                        'class' => 'fa fa-fw fa-underline',
                        'name' => 'fa-underline',
                    ],
                    [
                        'class' => 'fa fa-fw fa-undo',
                        'name' => 'fa-undo',
                    ],
                    [
                        'class' => 'fa fa-fw fa-unlink',
                        'name' => 'fa-unlink',
                    ],
                     // Alias
                  
            //     ];
            // }

                // <section id="directional">
                  
                
        // public function icons('Directional Icons') {

                //   return [
                    [
                        'class' => 'fa fa-fw fa-angle-double-down',
                        'name' => 'fa-angle-double-down',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-angle-double-left',
                        'name' => 'fa-angle-double-left',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-angle-double-right',
                        'name' => 'fa-angle-double-right',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-angle-double-up',
                        'name' => 'fa-angle-double-up',
                    ],
                    [
                        'class' => 'fa fa-fw fa-angle-down',
                        'name' => 'fa-angle-down',
                    ],
                    [
                        'class' => 'fa fa-fw fa-angle-left',
                        'name' => 'fa-angle-left',
                    ],
                    [
                        'class' => 'fa fa-fw fa-angle-right',
                        'name' => 'fa-angle-right',
                    ],
                    [
                        'class' => 'fa fa-fw fa-angle-up',
                        'name' => 'fa-angle-up',
                    ],
                    [
                        'class' => 'fa fa-fw fa-arrow-circle-down',
                        'name' => 'fa-arrow-circle-down',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-arrow-circle-left',
                        'name' => 'fa-arrow-circle-left',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-arrow-circle-o-down',
                        'name' => 'fa-arrow-circle-o-down',
                    ],
                    [
                        'class' => 'fa fa-fw fa-arrow-circle-o-left',
                        'name' => 'fa-arrow-circle-o-left',
                    ],
                    [
                        'class' => 'fa fa-fw fa-arrow-circle-o-right',
                        'name' => 'fa-arrow-circle-o-right',
                    ],
                    [
                        'class' => 'fa fa-fw fa-arrow-circle-o-up',
                        'name' => 'fa-arrow-circle-o-up',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-arrow-circle-right',
                        'name' => 'fa-arrow-circle-right',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-arrow-circle-up',
                        'name' => 'fa-arrow-circle-up',
                    ],
                    [
                        'class' => 'fa fa-fw fa-arrow-down',
                        'name' => 'fa-arrow-down',
                    ],
                    [
                        'class' => 'fa fa-fw fa-arrow-left',
                        'name' => 'fa-arrow-left',
                    ],
                    [
                        'class' => 'fa fa-fw fa-arrow-right',
                        'name' => 'fa-arrow-right',
                    ],
                    [
                        'class' => 'fa fa-fw fa-arrow-up',
                        'name' => 'fa-arrow-up',
                    ],
                    [
                        'class' => 'fa fa-fw fa-arrows',
                        'name' => 'fa-arrows',
                    ],
                    [
                        'class' => 'fa fa-fw fa-arrows-alt',
                        'name' => 'fa-arrows-alt',
                    ],
                    [
                        'class' => 'fa fa-fw fa-arrows-h',
                        'name' => 'fa-arrows-h',
                    ],
                    [
                        'class' => 'fa fa-fw fa-arrows-v',
                        'name' => 'fa-arrows-v',
                    ],
                    [
                        'class' => 'fa fa-fw fa-caret-down',
                        'name' => 'fa-caret-down',
                    ],
                    [
                        'class' => 'fa fa-fw fa-caret-left',
                        'name' => 'fa-caret-left',
                    ],
                    [
                        'class' => 'fa fa-fw fa-caret-right',
                        'name' => 'fa-caret-right',
                    ],
                    [
                        'class' => 'fa fa-fw fa-caret-square-o-down',
                        'name' => 'fa-caret-square-o-down',
                    ],
                    [
                        'class' => 'fa fa-fw fa-caret-square-o-left',
                        'name' => 'fa-caret-square-o-left',
                    ],
                    [
                        'class' => 'fa fa-fw fa-caret-square-o-right',
                        'name' => 'fa-caret-square-o-right',
                    ],
                    [
                        'class' => 'fa fa-fw fa-caret-square-o-up',
                        'name' => 'fa-caret-square-o-up',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-caret-up',
                        'name' => 'fa-caret-up',
                    ],
                    [
                        'class' => 'fa fa-fw fa-chevron-circle-down',
                        'name' => 'fa-chevron-circle-down',
                    ],
                    [
                        'class' => 'fa fa-fw fa-chevron-circle-left',
                        'name' => 'fa-chevron-circle-left',
                    ],
                    [
                        'class' => 'fa fa-fw fa-chevron-circle-right',
                        'name' => 'fa-chevron-circle-right',
                    ],
                    [
                        'class' => 'fa fa-fw fa-chevron-circle-up',
                        'name' => 'fa-chevron-circle-up',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-chevron-down',
                        'name' => 'fa-chevron-down',
                    ],
                    [
                        'class' => 'fa fa-fw fa-chevron-left',
                        'name' => 'fa-chevron-left',
                    ],
                    [
                        'class' => 'fa fa-fw fa-chevron-right',
                        'name' => 'fa-chevron-right',
                    ],
                    [
                        'class' => 'fa fa-fw fa-chevron-up',
                        'name' => 'fa-chevron-up',
                    ],
                    [
                        'class' => 'fa fa-fw fa-exchange',
                        'name' => 'fa-exchange',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hand-o-down',
                        'name' => 'fa-hand-o-down',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hand-o-left',
                        'name' => 'fa-hand-o-left',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hand-o-right',
                        'name' => 'fa-hand-o-right',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hand-o-up',
                        'name' => 'fa-hand-o-up',
                    ],
                    [
                        'class' => 'fa fa-fw fa-long-arrow-down',
                        'name' => 'fa-long-arrow-down',
                    ],
                    [
                        'class' => 'fa fa-fw fa-long-arrow-left',
                        'name' => 'fa-long-arrow-left',
                    ],
                    [
                        'class' => 'fa fa-fw fa-long-arrow-right',
                        'name' => 'fa-long-arrow-right',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-long-arrow-up',
                        'name' => 'fa-long-arrow-up',
                    ],
                    [
                        'class' => 'fa fa-fw fa-toggle-down',
                        'name' => 'fa-toggle-down',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-toggle-left',
                        'name' => 'fa-toggle-left',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-toggle-right',
                        'name' => 'fa-toggle-right',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-toggle-up',
                        'name' => 'fa-toggle-up',
                    ],
                     // Alias
                  
            //     ];
            // }

                // <section id="video-player">
                  
                
        // public function icons('Video Player Icons') {

                //   return [
                    [
                        'class' => 'fa fa-fw fa-arrows-alt',
                        'name' => 'fa-arrows-alt',
                    ],
                    [
                        'class' => 'fa fa-fw fa-backward',
                        'name' => 'fa-backward',
                    ],
                    [
                        'class' => 'fa fa-fw fa-compress',
                        'name' => 'fa-compress',
                    ],
                    [
                        'class' => 'fa fa-fw fa-eject',
                        'name' => 'fa-eject',
                    ],
                    [
                        'class' => 'fa fa-fw fa-expand',
                        'name' => 'fa-expand',
                    ],
                    [
                        'class' => 'fa fa-fw fa-fast-backward',
                        'name' => 'fa-fast-backward',
                    ],
                    [
                        'class' => 'fa fa-fw fa-fast-forward',
                        'name' => 'fa-fast-forward',
                    ],
                    [
                        'class' => 'fa fa-fw fa-forward',
                        'name' => 'fa-forward',
                    ],
                    [
                        'class' => 'fa fa-fw fa-pause',
                        'name' => 'fa-pause',
                    ],
                    [
                        'class' => 'fa fa-fw fa-play',
                        'name' => 'fa-play',
                    ],
                    [
                        'class' => 'fa fa-fw fa-play-circle',
                        'name' => 'fa-play-circle',
                    ],
                    [
                        'class' => 'fa fa-fw fa-play-circle-o',
                        'name' => 'fa-play-circle-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-random',
                        'name' => 'fa-random',
                    ],
                    [
                        'class' => 'fa fa-fw fa-step-backward',
                        'name' => 'fa-step-backward',
                    ],
                    [
                        'class' => 'fa fa-fw fa-step-forward',
                        'name' => 'fa-step-forward',
                    ],
                    [
                        'class' => 'fa fa-fw fa-stop',
                        'name' => 'fa-stop',
                    ],
                    [
                        'class' => 'fa fa-fw fa-youtube-play',
                        'name' => 'fa-youtube-play',
                    ],
                  
            //     ];
            // }

                
                  
                
        // public function icons('Brand Icons') {

                  /** All brand icons are trademarks of their respective owners.</li>
                    *  <li>The use of these trademarks does not indicate endorsement of the trademark holder by Font
                    *    Awesome, nor vice versa.
                    */

                //   return [
                    [
                        'class' => 'fa fa-fw fa-500px',
                        'name' => 'fa-500px',
                    ],
                    [
                        'class' => 'fa fa-fw fa-adn',
                        'name' => 'fa-adn',
                    ],
                    [
                        'class' => 'fa fa-fw fa-amazon',
                        'name' => 'fa-amazon',
                    ],
                    [
                        'class' => 'fa fa-fw fa-android',
                        'name' => 'fa-android',
                    ],
                    [
                        'class' => 'fa fa-fw fa-angellist',
                        'name' => 'fa-angellist',
                    ],
                    [
                        'class' => 'fa fa-fw fa-apple',
                        'name' => 'fa-apple',
                    ],
                    [
                        'class' => 'fa fa-fw fa-behance',
                        'name' => 'fa-behance',
                    ],
                    [
                        'class' => 'fa fa-fw fa-behance-square',
                        'name' => 'fa-behance-square',
                    ],
                    [
                        'class' => 'fa fa-fw fa-bitbucket',
                        'name' => 'fa-bitbucket',
                    ],
                    [
                        'class' => 'fa fa-fw fa-bitbucket-square',
                        'name' => 'fa-bitbucket-square',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-bitcoin',
                        'name' => 'fa-bitcoin',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-black-tie',
                        'name' => 'fa-black-tie',
                    ],
                    [
                        'class' => 'fa fa-fw fa-btc',
                        'name' => 'fa-btc',
                    ],
                    [
                        'class' => 'fa fa-fw fa-buysellads',
                        'name' => 'fa-buysellads',
                    ],
                    [
                        'class' => 'fa fa-fw fa-cc-amex',
                        'name' => 'fa-cc-amex',
                    ],
                    [
                        'class' => 'fa fa-fw fa-cc-diners-club',
                        'name' => 'fa-cc-diners-club',
                    ],
                    [
                        'class' => 'fa fa-fw fa-cc-discover',
                        'name' => 'fa-cc-discover',
                    ],
                    [
                        'class' => 'fa fa-fw fa-cc-jcb',
                        'name' => 'fa-cc-jcb',
                    ],
                    [
                        'class' => 'fa fa-fw fa-cc-mastercard',
                        'name' => 'fa-cc-mastercard',
                    ],
                    [
                        'class' => 'fa fa-fw fa-cc-paypal',
                        'name' => 'fa-cc-paypal',
                    ],
                    [
                        'class' => 'fa fa-fw fa-cc-stripe',
                        'name' => 'fa-cc-stripe',
                    ],
                    [
                        'class' => 'fa fa-fw fa-cc-visa',
                        'name' => 'fa-cc-visa',
                    ],
                    [
                        'class' => 'fa fa-fw fa-chrome',
                        'name' => 'fa-chrome',
                    ],
                    [
                        'class' => 'fa fa-fw fa-codepen',
                        'name' => 'fa-codepen',
                    ],
                    [
                        'class' => 'fa fa-fw fa-connectdevelop',
                        'name' => 'fa-connectdevelop',
                    ],
                    [
                        'class' => 'fa fa-fw fa-contao',
                        'name' => 'fa-contao',
                    ],
                    [
                        'class' => 'fa fa-fw fa-css3',
                        'name' => 'fa-css3',
                    ],
                    [
                        'class' => 'fa fa-fw fa-dashcube',
                        'name' => 'fa-dashcube',
                    ],
                    [
                        'class' => 'fa fa-fw fa-delicious',
                        'name' => 'fa-delicious',
                    ],
                    [
                        'class' => 'fa fa-fw fa-deviantart',
                        'name' => 'fa-deviantart',
                    ],
                    [
                        'class' => 'fa fa-fw fa-digg',
                        'name' => 'fa-digg',
                    ],
                    [
                        'class' => 'fa fa-fw fa-dribbble',
                        'name' => 'fa-dribbble',
                    ],
                    [
                        'class' => 'fa fa-fw fa-dropbox',
                        'name' => 'fa-dropbox',
                    ],
                    [
                        'class' => 'fa fa-fw fa-drupal',
                        'name' => 'fa-drupal',
                    ],
                    [
                        'class' => 'fa fa-fw fa-empire',
                        'name' => 'fa-empire',
                    ],
                    [
                        'class' => 'fa fa-fw fa-expeditedssl',
                        'name' => 'fa-expeditedssl',
                    ],
                    [
                        'class' => 'fa fa-fw fa-facebook',
                        'name' => 'fa-facebook',
                    ],
                    [
                        'class' => 'fa fa-fw fa-facebook-f',
                        'name' => 'fa-facebook-f',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-facebook-official',
                        'name' => 'fa-facebook-official',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-facebook-square',
                        'name' => 'fa-facebook-square',
                    ],
                    [
                        'class' => 'fa fa-fw fa-firefox',
                        'name' => 'fa-firefox',
                    ],
                    [
                        'class' => 'fa fa-fw fa-flickr',
                        'name' => 'fa-flickr',
                    ],
                    [
                        'class' => 'fa fa-fw fa-fonticons',
                        'name' => 'fa-fonticons',
                    ],
                    [
                        'class' => 'fa fa-fw fa-forumbee',
                        'name' => 'fa-forumbee',
                    ],
                    [
                        'class' => 'fa fa-fw fa-foursquare',
                        'name' => 'fa-foursquare',
                    ],
                    [
                        'class' => 'fa fa-fw fa-ge',
                        'name' => 'fa-ge',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-get-pocket',
                        'name' => 'fa-get-pocket',
                    ],
                    [
                        'class' => 'fa fa-fw fa-gg',
                        'name' => 'fa-gg',
                    ],
                    [
                        'class' => 'fa fa-fw fa-gg-circle',
                        'name' => 'fa-gg-circle',
                    ],
                    [
                        'class' => 'fa fa-fw fa-git',
                        'name' => 'fa-git',
                    ],
                    [
                        'class' => 'fa fa-fw fa-git-square',
                        'name' => 'fa-git-square',
                    ],
                    [
                        'class' => 'fa fa-fw fa-github',
                        'name' => 'fa-github',
                    ],
                    [
                        'class' => 'fa fa-fw fa-github-alt',
                        'name' => 'fa-github-alt',
                    ],
                    [
                        'class' => 'fa fa-fw fa-github-square',
                        'name' => 'fa-github-square',
                    ],
                    [
                        'class' => 'fa fa-fw fa-gittip',
                        'name' => 'fa-gittip',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-google',
                        'name' => 'fa-google',
                    ],
                    [
                        'class' => 'fa fa-fw fa-google-plus',
                        'name' => 'fa-google-plus',
                    ],
                    [
                        'class' => 'fa fa-fw fa-google-plus-square',
                        'name' => 'fa-google-plus-square',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-google-wallet',
                        'name' => 'fa-google-wallet',
                    ],
                    [
                        'class' => 'fa fa-fw fa-gratipay',
                        'name' => 'fa-gratipay',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hacker-news',
                        'name' => 'fa-hacker-news',
                    ],
                    [
                        'class' => 'fa fa-fw fa-houzz',
                        'name' => 'fa-houzz',
                    ],
                    [
                        'class' => 'fa fa-fw fa-html5',
                        'name' => 'fa-html5',
                    ],
                    [
                        'class' => 'fa fa-fw fa-instagram',
                        'name' => 'fa-instagram',
                    ],
                    [
                        'class' => 'fa fa-fw fa-internet-explorer',
                        'name' => 'fa-internet-explorer',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-ioxhost',
                        'name' => 'fa-ioxhost',
                    ],
                    [
                        'class' => 'fa fa-fw fa-joomla',
                        'name' => 'fa-joomla',
                    ],
                    [
                        'class' => 'fa fa-fw fa-jsfiddle',
                        'name' => 'fa-jsfiddle',
                    ],
                    [
                        'class' => 'fa fa-fw fa-lastfm',
                        'name' => 'fa-lastfm',
                    ],
                    [
                        'class' => 'fa fa-fw fa-lastfm-square',
                        'name' => 'fa-lastfm-square',
                    ],
                    [
                        'class' => 'fa fa-fw fa-leanpub',
                        'name' => 'fa-leanpub',
                    ],
                    [
                        'class' => 'fa fa-fw fa-linkedin',
                        'name' => 'fa-linkedin',
                    ],
                    [
                        'class' => 'fa fa-fw fa-linkedin-square',
                        'name' => 'fa-linkedin-square',
                    ],
                    [
                        'class' => 'fa fa-fw fa-linux',
                        'name' => 'fa-linux',
                    ],
                    [
                        'class' => 'fa fa-fw fa-maxcdn',
                        'name' => 'fa-maxcdn',
                    ],
                    [
                        'class' => 'fa fa-fw fa-meanpath',
                        'name' => 'fa-meanpath',
                    ],
                    [
                        'class' => 'fa fa-fw fa-medium',
                        'name' => 'fa-medium',
                    ],
                    [
                        'class' => 'fa fa-fw fa-odnoklassniki',
                        'name' => 'fa-odnoklassniki',
                    ],
                    [
                        'class' => 'fa fa-fw fa-odnoklassniki-square',
                        'name' => 'fa-odnoklassniki-square',
                    ],
                    [
                        'class' => 'fa fa-fw fa-opencart',
                        'name' => 'fa-opencart',
                    ],
                    [
                        'class' => 'fa fa-fw fa-openid',
                        'name' => 'fa-openid',
                    ],
                    [
                        'class' => 'fa fa-fw fa-opera',
                        'name' => 'fa-opera',
                    ],
                    [
                        'class' => 'fa fa-fw fa-optin-monster',
                        'name' => 'fa-optin-monster',
                    ],
                    [
                        'class' => 'fa fa-fw fa-pagelines',
                        'name' => 'fa-pagelines',
                    ],
                    [
                        'class' => 'fa fa-fw fa-paypal',
                        'name' => 'fa-paypal',
                    ],
                    [
                        'class' => 'fa fa-fw fa-pied-piper',
                        'name' => 'fa-pied-piper',
                    ],
                    [
                        'class' => 'fa fa-fw fa-pied-piper-alt',
                        'name' => 'fa-pied-piper-alt',
                    ],
                    [
                        'class' => 'fa fa-fw fa-pinterest',
                        'name' => 'fa-pinterest',
                    ],
                    [
                        'class' => 'fa fa-fw fa-pinterest-p',
                        'name' => 'fa-pinterest-p',
                    ],
                    [
                        'class' => 'fa fa-fw fa-pinterest-square',
                        'name' => 'fa-pinterest-square',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-qq',
                        'name' => 'fa-qq',
                    ],
                    [
                        'class' => 'fa fa-fw fa-ra',
                        'name' => 'fa-ra',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-rebel',
                        'name' => 'fa-rebel',
                    ],
                    [
                        'class' => 'fa fa-fw fa-reddit',
                        'name' => 'fa-reddit',
                    ],
                    [
                        'class' => 'fa fa-fw fa-reddit-square',
                        'name' => 'fa-reddit-square',
                    ],
                    [
                        'class' => 'fa fa-fw fa-renren',
                        'name' => 'fa-renren',
                    ],
                    [
                        'class' => 'fa fa-fw fa-safari',
                        'name' => 'fa-safari',
                    ],
                    [
                        'class' => 'fa fa-fw fa-sellsy',
                        'name' => 'fa-sellsy',
                    ],
                    [
                        'class' => 'fa fa-fw fa-share-alt',
                        'name' => 'fa-share-alt',
                    ],
                    [
                        'class' => 'fa fa-fw fa-share-alt-square',
                        'name' => 'fa-share-alt-square',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-shirtsinbulk',
                        'name' => 'fa-shirtsinbulk',
                    ],
                    [
                        'class' => 'fa fa-fw fa-simplybuilt',
                        'name' => 'fa-simplybuilt',
                    ],
                    [
                        'class' => 'fa fa-fw fa-skyatlas',
                        'name' => 'fa-skyatlas',
                    ],
                    [
                        'class' => 'fa fa-fw fa-skype',
                        'name' => 'fa-skype',
                    ],
                    [
                        'class' => 'fa fa-fw fa-slack',
                        'name' => 'fa-slack',
                    ],
                    [
                        'class' => 'fa fa-fw fa-slideshare',
                        'name' => 'fa-slideshare',
                    ],
                    [
                        'class' => 'fa fa-fw fa-soundcloud',
                        'name' => 'fa-soundcloud',
                    ],
                    [
                        'class' => 'fa fa-fw fa-spotify',
                        'name' => 'fa-spotify',
                    ],
                    [
                        'class' => 'fa fa-fw fa-stack-exchange',
                        'name' => 'fa-stack-exchange',
                    ],
                    [
                        'class' => 'fa fa-fw fa-stack-overflow',
                        'name' => 'fa-stack-overflow',
                    ],
                    [
                        'class' => 'fa fa-fw fa-steam',
                        'name' => 'fa-steam',
                    ],
                    [
                        'class' => 'fa fa-fw fa-steam-square',
                        'name' => 'fa-steam-square',
                    ],
                    [
                        'class' => 'fa fa-fw fa-stumbleupon',
                        'name' => 'fa-stumbleupon',
                    ],
                    [
                        'class' => 'fa fa-fw fa-stumbleupon-circle',
                        'name' => 'fa-stumbleupon-circle',
                    ],
                    
                    [
                        'class' => 'fa fa-fw fa-tencent-weibo',
                        'name' => 'fa-tencent-weibo',
                    ],
                    [
                        'class' => 'fa fa-fw fa-trello',
                        'name' => 'fa-trello',
                    ],
                    [
                        'class' => 'fa fa-fw fa-tripadvisor',
                        'name' => 'fa-tripadvisor',
                    ],
                    [
                        'class' => 'fa fa-fw fa-tumblr',
                        'name' => 'fa-tumblr',
                    ],
                    [
                        'class' => 'fa fa-fw fa-tumblr-square',
                        'name' => 'fa-tumblr-square',
                    ],
                    [
                        'class' => 'fa fa-fw fa-twitch',
                        'name' => 'fa-twitch',
                    ],
                    [
                        'class' => 'fa fa-fw fa-twitter',
                        'name' => 'fa-twitter',
                    ],
                    [
                        'class' => 'fa fa-fw fa-twitter-square',
                        'name' => 'fa-twitter-square',
                    ],
                    [
                        'class' => 'fa fa-fw fa-viacoin',
                        'name' => 'fa-viacoin',
                    ],
                    [
                        'class' => 'fa fa-fw fa-vimeo',
                        'name' => 'fa-vimeo',
                    ],
                    [
                        'class' => 'fa fa-fw fa-vimeo-square',
                        'name' => 'fa-vimeo-square',
                    ],
                    [
                        'class' => 'fa fa-fw fa-vine',
                        'name' => 'fa-vine',
                    ],
                    [
                        'class' => 'fa fa-fw fa-vk',
                        'name' => 'fa-vk',
                    ],
                    [
                        'class' => 'fa fa-fw fa-wechat',
                        'name' => 'fa-wechat',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-weibo',
                        'name' => 'fa-weibo',
                    ],
                    [
                        'class' => 'fa fa-fw fa-weixin',
                        'name' => 'fa-weixin',
                    ],
                    [
                        'class' => 'fa fa-fw fa-whatsapp',
                        'name' => 'fa-whatsapp',
                    ],
                    [
                        'class' => 'fa fa-fw fa-wikipedia-w',
                        'name' => 'fa-wikipedia-w',
                    ],
                    [
                        'class' => 'fa fa-fw fa-windows',
                        'name' => 'fa-windows',
                    ],
                    [
                        'class' => 'fa fa-fw fa-wordpress',
                        'name' => 'fa-wordpress',
                    ],
                    [
                        'class' => 'fa fa-fw fa-xing',
                        'name' => 'fa-xing',
                    ],
                    [
                        'class' => 'fa fa-fw fa-xing-square',
                        'name' => 'fa-xing-square',
                    ],
                    [
                        'class' => 'fa fa-fw fa-y-combinator',
                        'name' => 'fa-y-combinator',
                    ],
                    [
                        'class' => 'fa fa-fw fa-y-combinator-square',
                        'name' => 'fa-y-combinator-square// Alias',
                    [],
                        'class' => 'fa fa-fw fa-yahoo',
                        'name' => 'fa-yahoo',
                    ],
                    [
                        'class' => 'fa fa-fw fa-yc',
                        'name' => 'fa-yc',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-yc-square',
                        'name' => 'fa-yc-square',
                    ],
                     // Alias
                    [
                        'class' => 'fa fa-fw fa-yelp',
                        'name' => 'fa-yelp',
                    ],
                    [
                        'class' => 'fa fa-fw fa-youtube',
                        'name' => 'fa-youtube',
                    ],
                    [
                        'class' => 'fa fa-fw fa-youtube-play',
                        'name' => 'fa-youtube-play',
                    ],
                    [
                        'class' => 'fa fa-fw fa-youtube-square',
                        'name' => 'fa-youtube-square',
                    ],
                  
            //     ];
            // }

                // <section id="medical">
                  
                
        // public function icons('Medical Icons') {

            // return [
                    [
                        'class' => 'fa fa-fw fa-ambulance',
                        'name' => 'fa-ambulance',
                    ],
                    [
                        'class' => 'fa fa-fw fa-h-square',
                        'name' => 'fa-h-square',
                    ],
                    [
                        'class' => 'fa fa-fw fa-heart',
                        'name' => 'fa-heart',
                    ],
                    [
                        'class' => 'fa fa-fw fa-heart-o',
                        'name' => 'fa-heart-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-heartbeat',
                        'name' => 'fa-heartbeat',
                    ],
                    [
                        'class' => 'fa fa-fw fa-hospital-o',
                        'name' => 'fa-hospital-o',
                    ],
                    [
                        'class' => 'fa fa-fw fa-medkit',
                        'name' => 'fa-medkit',
                    ],
                    [
                        'class' => 'fa fa-fw fa-plus-square',
                        'name' => 'fa-plus-square',
                    ],
                    [
                        'class' => 'fa fa-fw fa-stethoscope',
                        'name' => 'fa-stethoscope',
                    ],
                    [
                        'class' => 'fa fa-fw fa-user-md',
                        'name' => 'fa-user-md',
                    ],
                    [
                        'class' => 'fa fa-fw fa-wheelchair',
                        'name' => 'fa-wheelchair',
                    ],
                  
            //     ];
            // }
            // public function icons('glyphicons') {
    
              
            //   <!-- /#fa-icons -->

            //   <!-- glyphicons-->
            //   <div class="tab-pane" id="glyphicons">

            //     <ul, class="bs-glyphicons">
                  [
                    'class' => 'glyphicon glyphicon-asterisk',
                    'name' => 'glyphicon glyphicon-asterisk',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-plus',
                    'name' => 'glyphicon glyphicon-plus',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-euro',
                    'name' => 'glyphicon glyphicon-euro',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-eur',
                    'name' => 'glyphicon glyphicon-eur',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-minus',
                    'name' => 'glyphicon glyphicon-minus',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-cloud',
                    'name' => 'glyphicon glyphicon-cloud',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-envelope',
                    'name' => 'glyphicon glyphicon-envelope',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-pencil',
                    'name' => 'glyphicon glyphicon-pencil',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-glass',
                    'name' => 'glyphicon glyphicon-glass',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-music',
                    'name' => 'glyphicon glyphicon-music',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-search',
                    'name' => 'glyphicon glyphicon-search',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-heart',
                    'name' => 'glyphicon glyphicon-heart',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-star',
                    'name' => 'glyphicon glyphicon-star',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-star-empty',
                    'name' => 'glyphicon glyphicon-star-empty',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-user',
                    'name' => 'glyphicon glyphicon-user',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-film',
                    'name' => 'glyphicon glyphicon-film',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-th-large',
                    'name' => 'glyphicon glyphicon-th-large',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-th',
                    'name' => 'glyphicon glyphicon-th',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-th-list',
                    'name' => 'glyphicon glyphicon-th-list',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-ok',
                    'name' => 'glyphicon glyphicon-ok',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-remove',
                    'name' => 'glyphicon glyphicon-remove',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-zoom-in',
                    'name' => 'glyphicon glyphicon-zoom-in',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-zoom-out',
                    'name' => 'glyphicon glyphicon-zoom-out',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-off',
                    'name' => 'glyphicon glyphicon-off',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-signal',
                    'name' => 'glyphicon glyphicon-signal',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-cog',
                    'name' => 'glyphicon glyphicon-cog',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-trash',
                    'name' => 'glyphicon glyphicon-trash',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-home',
                    'name' => 'glyphicon glyphicon-home',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-file',
                    'name' => 'glyphicon glyphicon-file',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-time',
                    'name' => 'glyphicon glyphicon-time',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-road',
                    'name' => 'glyphicon glyphicon-road',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-download-alt',
                    'name' => 'glyphicon glyphicon-download-alt',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-download',
                    'name' => 'glyphicon glyphicon-download',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-upload',
                    'name' => 'glyphicon glyphicon-upload',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-inbox',
                    'name' => 'glyphicon glyphicon-inbox',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-play-circle',
                    'name' => 'glyphicon glyphicon-play-circle',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-repeat',
                    'name' => 'glyphicon glyphicon-repeat',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-refresh',
                    'name' => 'glyphicon glyphicon-refresh',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-list-alt',
                    'name' => 'glyphicon glyphicon-list-alt',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-lock',
                    'name' => 'glyphicon glyphicon-lock',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-flag',
                    'name' => 'glyphicon glyphicon-flag',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-headphones',
                    'name' => 'glyphicon glyphicon-headphones',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-volume-off',
                    'name' => 'glyphicon glyphicon-volume-off',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-volume-down',
                    'name' => 'glyphicon glyphicon-volume-down',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-volume-up',
                    'name' => 'glyphicon glyphicon-volume-up',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-qrcode',
                    'name' => 'glyphicon glyphicon-qrcode',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-barcode',
                    'name' => 'glyphicon glyphicon-barcode',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-tag',
                    'name' => 'glyphicon glyphicon-tag',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-tags',
                    'name' => 'glyphicon glyphicon-tags',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-book',
                    'name' => 'glyphicon glyphicon-book',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-bookmark',
                    'name' => 'glyphicon glyphicon-bookmark',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-print',
                    'name' => 'glyphicon glyphicon-print',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-camera',
                    'name' => 'glyphicon glyphicon-camera',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-font',
                    'name' => 'glyphicon glyphicon-font',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-bold',
                    'name' => 'glyphicon glyphicon-bold',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-italic',
                    'name' => 'glyphicon glyphicon-italic',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-text-height',
                    'name' => 'glyphicon glyphicon-text-height',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-text-width',
                    'name' => 'glyphicon glyphicon-text-width',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-align-left',
                    'name' => 'glyphicon glyphicon-align-left',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-align-center',
                    'name' => 'glyphicon glyphicon-align-center',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-align-right',
                    'name' => 'glyphicon glyphicon-align-right',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-align-justify',
                    'name' => 'glyphicon glyphicon-align-justify',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-list',
                    'name' => 'glyphicon glyphicon-list',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-indent-left',
                    'name' => 'glyphicon glyphicon-indent-left',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-indent-right',
                    'name' => 'glyphicon glyphicon-indent-right',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-facetime-video',
                    'name' => 'glyphicon glyphicon-facetime-video',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-picture',
                    'name' => 'glyphicon glyphicon-picture',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-map-marker',
                    'name' => 'glyphicon glyphicon-map-marker',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-adjust',
                    'name' => 'glyphicon glyphicon-adjust',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-tint',
                    'name' => 'glyphicon glyphicon-tint',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-edit',
                    'name' => 'glyphicon glyphicon-edit',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-share',
                    'name' => 'glyphicon glyphicon-share',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-check',
                    'name' => 'glyphicon glyphicon-check',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-move',
                    'name' => 'glyphicon glyphicon-move',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-step-backward',
                    'name' => 'glyphicon glyphicon-step-backward',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-fast-backward',
                    'name' => 'glyphicon glyphicon-fast-backward',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-backward',
                    'name' => 'glyphicon glyphicon-backward',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-play',
                    'name' => 'glyphicon glyphicon-play',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-pause',
                    'name' => 'glyphicon glyphicon-pause',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-stop',
                    'name' => 'glyphicon glyphicon-stop',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-forward',
                    'name' => 'glyphicon glyphicon-forward',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-fast-forward',
                    'name' => 'glyphicon glyphicon-fast-forward',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-step-forward',
                    'name' => 'glyphicon glyphicon-step-forward',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-eject',
                    'name' => 'glyphicon glyphicon-eject',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-chevron-left',
                    'name' => 'glyphicon glyphicon-chevron-left',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-chevron-right',
                    'name' => 'glyphicon glyphicon-chevron-right',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-plus-sign',
                    'name' => 'glyphicon glyphicon-plus-sign',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-minus-sign',
                    'name' => 'glyphicon glyphicon-minus-sign',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-remove-sign',
                    'name' => 'glyphicon glyphicon-remove-sign',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-ok-sign',
                    'name' => 'glyphicon glyphicon-ok-sign',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-question-sign',
                    'name' => 'glyphicon glyphicon-question-sign',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-info-sign',
                    'name' => 'glyphicon glyphicon-info-sign',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-screenshot',
                    'name' => 'glyphicon glyphicon-screenshot',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-remove-circle',
                    'name' => 'glyphicon glyphicon-remove-circle',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-ok-circle',
                    'name' => 'glyphicon glyphicon-ok-circle',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-ban-circle',
                    'name' => 'glyphicon glyphicon-ban-circle',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-arrow-left',
                    'name' => 'glyphicon glyphicon-arrow-left',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-arrow-right',
                    'name' => 'glyphicon glyphicon-arrow-right',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-arrow-up',
                    'name' => 'glyphicon glyphicon-arrow-up',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-arrow-down',
                    'name' => 'glyphicon glyphicon-arrow-down',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-share-alt',
                    'name' => 'glyphicon glyphicon-share-alt',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-resize-full',
                    'name' => 'glyphicon glyphicon-resize-full',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-resize-small',
                    'name' => 'glyphicon glyphicon-resize-small',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-exclamation-sign',
                    'name' => 'glyphicon glyphicon-exclamation-sign',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-gift',
                    'name' => 'glyphicon glyphicon-gift',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-leaf',
                    'name' => 'glyphicon glyphicon-leaf',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-fire',
                    'name' => 'glyphicon glyphicon-fire',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-eye-open',
                    'name' => 'glyphicon glyphicon-eye-open',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-eye-close',
                    'name' => 'glyphicon glyphicon-eye-close',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-warning-sign',
                    'name' => 'glyphicon glyphicon-warning-sign',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-plane',
                    'name' => 'glyphicon glyphicon-plane',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-calendar',
                    'name' => 'glyphicon glyphicon-calendar',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-random',
                    'name' => 'glyphicon glyphicon-random',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-comment',
                    'name' => 'glyphicon glyphicon-comment',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-magnet',
                    'name' => 'glyphicon glyphicon-magnet',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-chevron-up',
                    'name' => 'glyphicon glyphicon-chevron-up',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-chevron-down',
                    'name' => 'glyphicon glyphicon-chevron-down',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-retweet',
                    'name' => 'glyphicon glyphicon-retweet',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-shopping-cart',
                    'name' => 'glyphicon glyphicon-shopping-cart',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-folder-close',
                    'name' => 'glyphicon glyphicon-folder-close',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-folder-open',
                    'name' => 'glyphicon glyphicon-folder-open',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-resize-vertical',
                    'name' => 'glyphicon glyphicon-resize-vertical',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-resize-horizontal',
                    'name' => 'glyphicon glyphicon-resize-horizontal',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-hdd',
                    'name' => 'glyphicon glyphicon-hdd',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-bullhorn',
                    'name' => 'glyphicon glyphicon-bullhorn',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-bell',
                    'name' => 'glyphicon glyphicon-bell',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-certificate',
                    'name' => 'glyphicon glyphicon-certificate',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-thumbs-up',
                    'name' => 'glyphicon glyphicon-thumbs-up',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-thumbs-down',
                    'name' => 'glyphicon glyphicon-thumbs-down',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-hand-right',
                    'name' => 'glyphicon glyphicon-hand-right',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-hand-left',
                    'name' => 'glyphicon glyphicon-hand-left',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-hand-up',
                    'name' => 'glyphicon glyphicon-hand-up',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-hand-down',
                    'name' => 'glyphicon glyphicon-hand-down',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-circle-arrow-right',
                    'name' => 'glyphicon glyphicon-circle-arrow-right',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-circle-arrow-left',
                    'name' => 'glyphicon glyphicon-circle-arrow-left',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-circle-arrow-up',
                    'name' => 'glyphicon glyphicon-circle-arrow-up',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-circle-arrow-down',
                    'name' => 'glyphicon glyphicon-circle-arrow-down',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-globe',
                    'name' => 'glyphicon glyphicon-globe',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-wrench',
                    'name' => 'glyphicon glyphicon-wrench',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-tasks',
                    'name' => 'glyphicon glyphicon-tasks',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-filter',
                    'name' => 'glyphicon glyphicon-filter',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-briefcase',
                    'name' => 'glyphicon glyphicon-briefcase',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-fullscreen',
                    'name' => 'glyphicon glyphicon-fullscreen',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-dashboard',
                    'name' => 'glyphicon glyphicon-dashboard',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-paperclip',
                    'name' => 'glyphicon glyphicon-paperclip',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-heart-empty',
                    'name' => 'glyphicon glyphicon-heart-empty',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-link',
                    'name' => 'glyphicon glyphicon-link',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-phone',
                    'name' => 'glyphicon glyphicon-phone',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-pushpin',
                    'name' => 'glyphicon glyphicon-pushpin',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-usd',
                    'name' => 'glyphicon glyphicon-usd',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-gbp',
                    'name' => 'glyphicon glyphicon-gbp',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-sort',
                    'name' => 'glyphicon glyphicon-sort',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-sort-by-alphabet',
                    'name' => 'glyphicon glyphicon-sort-by-alphabet',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-sort-by-alphabet-alt',
                    'name' => 'glyphicon glyphicon-sort-by-alphabet-alt',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-sort-by-order',
                    'name' => 'glyphicon glyphicon-sort-by-order',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-sort-by-order-alt',
                    'name' => 'glyphicon glyphicon-sort-by-order-alt',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-sort-by-attributes',
                    'name' => 'glyphicon glyphicon-sort-by-attributes',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-sort-by-attributes-alt',
                    'name' => 'glyphicon glyphicon-sort-by-attributes-alt',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-unchecked',
                    'name' => 'glyphicon glyphicon-unchecked',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-expand',
                    'name' => 'glyphicon glyphicon-expand',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-collapse-down',
                    'name' => 'glyphicon glyphicon-collapse-down',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-collapse-up',
                    'name' => 'glyphicon glyphicon-collapse-up',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-log-in',
                    'name' => 'glyphicon glyphicon-log-in',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-flash',
                    'name' => 'glyphicon glyphicon-flash',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-log-out',
                    'name' => 'glyphicon glyphicon-log-out',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-new-window',
                    'name' => 'glyphicon glyphicon-new-window',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-record',
                    'name' => 'glyphicon glyphicon-record',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-save',
                    'name' => 'glyphicon glyphicon-save',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-open',
                    'name' => 'glyphicon glyphicon-open',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-saved',
                    'name' => 'glyphicon glyphicon-saved',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-import',
                    'name' => 'glyphicon glyphicon-import',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-export',
                    'name' => 'glyphicon glyphicon-export',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-send',
                    'name' => 'glyphicon glyphicon-send',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-floppy-disk',
                    'name' => 'glyphicon glyphicon-floppy-disk',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-floppy-saved',
                    'name' => 'glyphicon glyphicon-floppy-saved',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-floppy-remove',
                    'name' => 'glyphicon glyphicon-floppy-remove',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-floppy-save',
                    'name' => 'glyphicon glyphicon-floppy-save',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-floppy-open',
                    'name' => 'glyphicon glyphicon-floppy-open',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-credit-card',
                    'name' => 'glyphicon glyphicon-credit-card',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-transfer',
                    'name' => 'glyphicon glyphicon-transfer',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-cutlery',
                    'name' => 'glyphicon glyphicon-cutlery',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-header',
                    'name' => 'glyphicon glyphicon-header',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-compressed',
                    'name' => 'glyphicon glyphicon-compressed',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-earphone',
                    'name' => 'glyphicon glyphicon-earphone',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-phone-alt',
                    'name' => 'glyphicon glyphicon-phone-alt',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-tower',
                    'name' => 'glyphicon glyphicon-tower',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-stats',
                    'name' => 'glyphicon glyphicon-stats',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-sd-video',
                    'name' => 'glyphicon glyphicon-sd-video',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-hd-video',
                    'name' => 'glyphicon glyphicon-hd-video',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-subtitles',
                    'name' => 'glyphicon glyphicon-subtitles',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-sound-stereo',
                    'name' => 'glyphicon glyphicon-sound-stereo',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-sound-dolby',
                    'name' => 'glyphicon glyphicon-sound-dolby',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-sound-5-1',
                    'name' => 'glyphicon glyphicon-sound-5-1',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-sound-6-1',
                    'name' => 'glyphicon glyphicon-sound-6-1',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-sound-7-1',
                    'name' => 'glyphicon glyphicon-sound-7-1',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-copyright-mark',
                    'name' => 'glyphicon glyphicon-copyright-mark',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-registration-mark',
                    'name' => 'glyphicon glyphicon-registration-mark',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-cloud-download',
                    'name' => 'glyphicon glyphicon-cloud-download',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-cloud-upload',
                    'name' => 'glyphicon glyphicon-cloud-upload',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-tree-conifer',
                    'name' => 'glyphicon glyphicon-tree-conifer',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-tree-deciduous',
                    'name' => 'glyphicon glyphicon-tree-deciduous',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-cd',
                    'name' => 'glyphicon glyphicon-cd',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-save-file',
                    'name' => 'glyphicon glyphicon-save-file',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-open-file',
                    'name' => 'glyphicon glyphicon-open-file',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-level-up',
                    'name' => 'glyphicon glyphicon-level-up',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-copy',
                    'name' => 'glyphicon glyphicon-copy',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-paste',
                    'name' => 'glyphicon glyphicon-paste',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-alert',
                    'name' => 'glyphicon glyphicon-alert',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-equalizer',
                    'name' => 'glyphicon glyphicon-equalizer',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-king',
                    'name' => 'glyphicon glyphicon-king',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-queen',
                    'name' => 'glyphicon glyphicon-queen',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-pawn',
                    'name' => 'glyphicon glyphicon-pawn',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-bishop',
                    'name' => 'glyphicon glyphicon-bishop',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-knight',
                    'name' => 'glyphicon glyphicon-knight',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-baby-formula',
                    'name' => 'glyphicon glyphicon-baby-formula',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-tent',
                    'name' => 'glyphicon glyphicon-tent',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-blackboard',
                    'name' => 'glyphicon glyphicon-blackboard',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-bed',
                    'name' => 'glyphicon glyphicon-bed',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-apple',
                    'name' => 'glyphicon glyphicon-apple',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-erase',
                    'name' => 'glyphicon glyphicon-erase',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-hourglass',
                    'name' => 'glyphicon glyphicon-hourglass',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-lamp',
                    'name' => 'glyphicon glyphicon-lamp',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-duplicate',
                    'name' => 'glyphicon glyphicon-duplicate',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-piggy-bank',
                    'name' => 'glyphicon glyphicon-piggy-bank',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-scissors',
                    'name' => 'glyphicon glyphicon-scissors',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-bitcoin',
                    'name' => 'glyphicon glyphicon-bitcoin',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-btc',
                    'name' => 'glyphicon glyphicon-btc',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-xbt',
                    'name' => 'glyphicon glyphicon-xbt',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-yen',
                    'name' => 'glyphicon glyphicon-yen',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-jpy',
                    'name' => 'glyphicon glyphicon-jpy',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-ruble',
                    'name' => 'glyphicon glyphicon-ruble',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-rub',
                    'name' => 'glyphicon glyphicon-rub',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-scale',
                    'name' => 'glyphicon glyphicon-scale',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-ice-lolly',
                    'name' => 'glyphicon glyphicon-ice-lolly',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-ice-lolly-tasted',
                    'name' => 'glyphicon glyphicon-ice-lolly-tasted',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-education',
                    'name' => 'glyphicon glyphicon-education',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-option-horizontal',
                    'name' => 'glyphicon glyphicon-option-horizontal',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-option-vertical',
                    'name' => 'glyphicon glyphicon-option-vertical',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-menu-hamburger',
                    'name' => 'glyphicon glyphicon-menu-hamburger',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-modal-window',
                    'name' => 'glyphicon glyphicon-modal-window',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-oil',
                    'name' => 'glyphicon glyphicon-oil',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-grain',
                    'name' => 'glyphicon glyphicon-grain',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-sunglasses',
                    'name' => 'glyphicon glyphicon-sunglasses',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-text-size',
                    'name' => 'glyphicon glyphicon-text-size',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-text-color',
                    'name' => 'glyphicon glyphicon-text-color',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-text-background',
                    'name' => 'glyphicon glyphicon-text-background',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-object-align-top',
                    'name' => 'glyphicon glyphicon-object-align-top',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-object-align-bottom',
                    'name' => 'glyphicon glyphicon-object-align-bottom',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-object-align-horizontal',
                    'name' => 'glyphicon glyphicon-object-align-horizontal',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-object-align-left',
                    'name' => 'glyphicon glyphicon-object-align-left',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-object-align-vertical',
                    'name' => 'glyphicon glyphicon-object-align-vertical',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-object-align-right',
                    'name' => 'glyphicon glyphicon-object-align-right',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-triangle-right',
                    'name' => 'glyphicon glyphicon-triangle-right',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-triangle-left',
                    'name' => 'glyphicon glyphicon-triangle-left',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-triangle-bottom',
                    'name' => 'glyphicon glyphicon-triangle-bottom',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-triangle-top',
                    'name' => 'glyphicon glyphicon-triangle-top',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-console',
                    'name' => 'glyphicon glyphicon-console',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-superscript',
                    'name' => 'glyphicon glyphicon-superscript',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-subscript',
                    'name' => 'glyphicon glyphicon-subscript',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-menu-left',
                    'name' => 'glyphicon glyphicon-menu-left',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-menu-right',
                    'name' => 'glyphicon glyphicon-menu-right',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-menu-down',
                    'name' => 'glyphicon glyphicon-menu-down',
                  ],
                  [
                    'class' => 'glyphicon glyphicon-menu-up',
                    'name' => 'glyphicon glyphicon-menu-up',
                  ]
        ];
            //     </ul>
              
            //   <!-- /#ion-icons -->
    }
}
            