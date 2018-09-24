<?php
namespace Grav\Theme;
use Grav\Common\Grav;
use Grav\Common\Theme;

class Cishydss extends Theme
{
  public static function getSubscribedEvents()
  {
    return [
      'onThemeInitialized'    => ['onThemeInitialized', 0],
      'onTwigLoader'          => ['onTwigLoader', 0],
      'onTwigInitialized'     => ['onTwigInitialized', 0],
    ];
  }

  public function onThemeInitialized()
  {

  }

  public function onTwigLoader()
  {
    
  }

  public function onTwigInitialized()
  {
    
  }
}
?>