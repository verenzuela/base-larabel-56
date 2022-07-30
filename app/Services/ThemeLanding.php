<?php

namespace App\Services;
use App\Theme;

class ThemeLanding
{

  private $activeTheme;
  private $settings;

  public function __construct(){
    $this->activeTheme = Theme::where('status', '=', 1)->first();
    $this->settings = $this->activeTheme->landing_config;
  }

  public function settings($sectionName=false){
    if($this->settings){
      $config = json_decode($this->settings);
      return $config->$sectionName;
    }else{
      return false;  
    }
  }

  public function enabled(){
    return ($this->settings)  ? true : false;
  }
  
  public function has($sectionName=false){
    if($this->settings){
      $config = json_decode($this->settings);
      return ( $config->$sectionName ) ? true : false;
    }else{
      return false;  
    }
  }

}