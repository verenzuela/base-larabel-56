<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Country;
use App\State;
use App\City;
use App\WebSetting;
use App\User;
use App\Category;
use App\Product;
use App\ProductGallery;
use App\ProductAttribute;

class AutocompleteController extends Controller
{
  
  protected function noDataFound(){
    return '<li style="margin-top: 2px; margin-bottom: 2px; font-weight: bold; color: red; " >'.__('admin.noDataFound').'</li>';
  }


  public function fetchCountries(Request $request){
    //if($request->get('query')){
      $query = $request->get('query');

      $data_found = 0;
      
      if($query==''){
        $data =  Country::orderBy('name', 'asc')->limit(10)->get();  
      }else{
        $data =  Country::where('name', 'like', "%{$query}%")->orderBy('name', 'asc')->get();  
      }

      $output = '<ul class="dropdown-menu" style="position: absolute; padding:10px; with:max-content; top: 80%; left: 0px; z-index: 1010; display: block;">';
        foreach($data as $row){
          $data_found += 1;
          
          $output .= '<li class="country" value="'.$row->id.'" style="margin-top: 2px; margin-bottom: 2px; font-weight: bold;" ><a href="javascript:void(0)" style="with=100%;" >'.$row->name.'</a></li>';
        }
        if($data_found === 0){
          $output .= $this->noDataFound();
        }
      $output .= '</ul>';
      echo $output;
    //}
  }


  protected function statesLi($row){
    $li = '<li class="state" value="'.$row->id.'" 
          data-country-id = "'.$row->country->id.'" 
          data-country-name = "'.$row->country->name.'" 
          style="margin-top: 2px; margin-bottom: 2px; font-weight: bold;" ><a href="javascript:void(0)" style="with=100%;" >'.
            $row->name.
          '</a>
        </li>';
    return $li;
  }


  public function fetchStates(Request $request){
    //if($request->get('query')){
      $query = $request->get('query');
      $countryId = ( $request->get('countryId') ) ? $request->get('countryId') : '';

      $data_found = 0;

      if($query==''){
        if($countryId=='') 
          $data =  State::orderBy('name', 'asc')->limit(10)->get();
        else 
          $data =  State::where('country_id', '=', $countryId)->orderBy('name', 'asc')->limit(10)->get();
      }else{
        if($countryId=='') 
          $data =  State::where('name', 'like', "%{$query}%")->orderBy('name', 'asc')->limit(10)->get();
        else 
          $data =  State::where('name', 'like', "%{$query}%")->where('country_id', '=', $countryId)->orderBy('name', 'asc')->limit(10)->get();
      }
      
      $output = '<ul class="dropdown-menu" style="position: absolute; padding:10px; with:max-content; top: 80%; left: 0px; z-index: 1010; display: block;">';
        foreach($data as $row){
          $data_found += 1;

          $output .= $this->statesLi( $row );
        }
        if($data_found === 0){
          $output .= $this->noDataFound();
        }
      $output .= '</ul>';
      echo $output;
    //}
  }
  

  protected function citiesLi($row){
    $li = '<li class="city" value="'.$row->id.'" 
          data-country-id = "'.$row->country->id.'" 
          data-country-name = "'.$row->country->name.'" 
          data-state-id = "'.$row->state->id.'" 
          data-state-name = "'.$row->state->name.'" 
          style="margin-top: 2px; margin-bottom: 2px; font-weight: bold;" ><a href="javascript:void(0)" style="with=100%;" >'.
            $row->name.
          '</a>
        </li>';
    return $li;
  }

  public function fetchCities(Request $request){
    //if($request->get('query')){
      $query = $request->get('query');
      $stateId = ( $request->get('stateId') ) ? $request->get('stateId') : '';

      $data_found = 0;

      if($query==''){
        if($stateId=='') 
          $data =  City::orderBy('name', 'asc')->limit(10)->get();
        else 
          $data =  City::where('state_id', '=', $stateId)->orderBy('name', 'asc')->limit(10)->get();
      }else{
        if($stateId=='') 
          $data =  City::where('name', 'like', "%{$query}%")->orderBy('name', 'asc')->limit(10)->get();
        else 
          $data =  City::where('name', 'like', "%{$query}%")->where('state_id', '=', $stateId)->orderBy('name', 'asc')->limit(10)->get();
      }
      
      $output = '<ul class="dropdown-menu" style="position: absolute; padding:10px; with:max-content; top: 100%; left: 0px; z-index: 1010; display: block;">';
        foreach($data as $row){
          $data_found += 1;

          $output .= $this->citiesLi( $row );
        }
        if($data_found === 0){
          $output .= $this->noDataFound();
        }
      $output .= '</ul>';
      echo $output;
    //}
  }


  
  public function fetchWebSettings(Request $request){
    if($request->get('query')){
      $query = $request->get('query');
      $data =  WebSetting::where('adm_url', 'like', "%{$query}%")->orderBy('adm_url', 'asc')->get();

      $data_found = 0;

      $output = '<ul class="dropdown-menu" style="position: absolute; padding:10px; with:100%; top: 80%; left: 0px; z-index: 1010; display: block;">';
        foreach($data as $row){
          $data_found += 1;

          $output .= '<li class="faq-section" value="'.$row->id.'" style="margin-top: 2px; margin-bottom: 2px; font-weight: bold;" ><a href="javascript:void(0)" style="with=100%;" >'.$row->adm_url.'</a></li>';
        }
        if($data_found === 0){
          $output .= $this->noDataFound();
        }
      $output .= '</ul>';
      echo $output;
    }
  }




  protected function categoriesLi($row){

    $nameCategory = ($row->parent) ? $row->parent->name . ' -> ' . $row->name : $row->name;

    $li = '<li class="category" value="'.$row->id.'" 
          data-category-id = "'.$row->id.'" 
          data-category-name = "'.$row->name.'" 
          style="margin-top: 2px; margin-bottom: 4px; font-weight: bold; border-bottom: solid 1px lightgray" ><a href="javascript:void(0)" style="with=100%;" >'. $nameCategory .'</a>
        </li>';
    return $li;
  }


  public function fetchCategories(Request $request){
    //if($request->get('query')){
      $query = $request->get('query');

      $data_found = 0;

      if($query==''){
        $data =  Category::orderBy('name', 'asc')->limit(10)->get();
      }else{
        $data =  Category::where('name', 'like', "%{$query}%")->orderBy('name', 'asc')->limit(10)->get();
      }
      
      $output = '<ul class="dropdown-menu" style="position: absolute; padding:10px; with:100%; top: 80%; left: 0px; z-index: 1010; display: block;">';
        foreach($data as $row){
          $data_found += 1;

          $output .= $this->categoriesLi( $row );
        }
        if($data_found === 0){
          $output .= $this->noDataFound();
        }
      $output .= '</ul>';
      echo $output;
    //}
  }




  protected function customersLi($row){
    $li = '<li class="customer" value="'.$row->id.'"
          style="margin-top: 2px; margin-bottom: 2px; font-weight: bold;" ><a href="javascript:void(0)" onclick="userAddressListGetUserInfo('.$row->id.')" style="with=100%;" >'.$row->name.' ('.$row->email.')</a>
        </li>';
    return $li;
  }

  public function fetchCustomers(Request $request){
    //if($request->get('query')){
      $query = $request->get('query');

      $data_found = 0;

      if($query==''){
        $data =  User::where('type_user', '=', 'frontend')->orderBy('name', 'asc')->limit(10)->get();
      }else{
        $data =  User::where('name', 'like', "%{$query}%")->where('type_user', '=', 'frontend')->orderBy('name', 'asc')->limit(10)->get();
      }
      
      $output = '<ul class="dropdown-menu" style="position: absolute; padding:10px; with:100%; top: 80%; left: 0px; z-index: 1010; display: block;">';
        foreach($data as $row){
          $data_found += 1;

          $output .= $this->customersLi( $row );
        }
        if($data_found === 0){
          $output .= $this->noDataFound();
        }
      $output .= '</ul>';
      echo $output;
    //}
  }




  protected function productSize($size){
    return ($size) ? '<spam style="border:solid 1px grey; border-radius:10px">size: '.htmlspecialchars($size).'</spam>' : '';
  }

  protected function productColor($color){
    return ($color) ? '<spam style="background-color:'.$color.'; border-radius:10px;" class="px-1"><spam style="color: '.$color.';
    -webkit-filter: invert(100%); filter: invert(100%);" >color</spam></spam>' : '';
  }


  protected function productsLi($row){
    $li = '<li class="prod-attribute" value="'.$row->id.'"
          data-product-sku = "'.htmlspecialchars($row->sku).'" 
          data-product-name = "'.htmlspecialchars($row->name).'" 
          data-product-size = "'.htmlspecialchars($row->size).'" 
          data-product-color = "'.htmlspecialchars($row->color).'" 
          data-product-price = "'.htmlspecialchars($row->price).'" 
          style="margin-top: 2px; margin-bottom: 2px; font-weight: bold;" ><a href="javascript:void(0)" style="with=100%;" >'.$row->name.' ['. $this->productSize($row->size) .' '. $this->productColor($row->color)  .']</a>
        </li>';
    return $li;
  }

  public function fetchProducts(Request $request){
    //if($request->get('query')){
      $query = $request->get('query');

      $data_found = 0;

      if($query==''){
        $data =  ProductAttribute::where('stock', '>', 0)->orderBy('name', 'asc')->limit(10)->get();
      }else{
        $data = ProductAttribute::where('stock', '>', 0)->where(function ($q) use($query) {
            $q->where('name', 'like', "%{$query}%")->orWhere('sku', 'like', "%{$query}%");
        })->orderBy('name', 'asc')->limit(10)->get();
      }
      
      $output = '<ul class="dropdown-menu" style="position: absolute; padding:10px; with:100%; top: 80%; left: 0px; z-index: 1010; display: block;">';
        foreach($data as $row){
          $data_found += 1;

          $output .= $this->productsLi( $row );
        }
        if($data_found === 0){
          $output .= $this->noDataFound();
        }
      $output .= '</ul>';
      echo $output;
    //}
  }



}
