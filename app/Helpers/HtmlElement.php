<?php

namespace App\Helpers;
use Form;

class HtmlElement
{

  public function __construct(){
    $this->permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  }

  protected function generate_string($input, $strength = 16) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
      $random_character = $input[mt_rand(0, $input_length - 1)];
      $random_string .= $random_character;
    }

    return $random_string;
  }

  protected function value($value, $name){
    if($name=='stock' && $value==0) return 0;

    if(!$value){
      return old($name);
    }else{
      return ( old($name) ) ? old($name) : $value;
    }
  }

  protected function label($customLabel, $name){
    return __( ($customLabel) ? 'admin.label.'.$customLabel : 'admin.label.'.$name );
  }

  protected function classError($errors, $name){
    if($errors)
      return ($errors->has($name)) ? 'is-invalid' : '';
    else
      return '';
  }

  protected function isChecked($value, $name){
    if(!$value){
      return ( old($name) ) ? 'checked' : '';
    }else{
      return ( $value ) ? 'checked' : '';
    }
  }

  protected function isRequired($required){
    return ( $required ) ? 'required' : '';
  }

  protected function isEditable($editable){
    return ( $editable ) ? '' : 'readonly style="background-color:#f5f2f2; cursor:not-allowed;" ';
  }

  protected function name($name){
    $explodeName = explode("___", $name);
    if($explodeName){
      return $explodeName[0];
    }
    return $name;
  }

  public function inpunt($name, $value, $errors, $required=false, $customLabel=false, $editable=true, $classOnFirstDiv='', $classOnInput='' ){
    $input = "<div class='form-group $classOnFirstDiv'>";
    $input .= " <div class='form-label-group'>";
    $input .= "   <input type='text' class='form-control ". $classOnInput . $this->classError($errors, $name) ."' id='".$name."' name='".$this->name($name)."' value='".$this->value($value, $name)."' ".$this->isRequired($required)." ".$this->isEditable($editable)." >";
    $input .= "     <label for='".$name."'>" . $this->label($customLabel, $name);
    if($required){
      $input .= "       <span class='badge badge-subtle badge-danger'>*</span>";  
    }    
    $input .= "     </label>";
    $input .= " </div>";
    $input .= "</div>";

    return $input;
  }

  public function number($name, $value, $errors, $required=false, $customLabel=false, $editable=true, $classOnFirstDiv='', $classOnInput='' ){
    $input = "<div class='form-group $classOnFirstDiv'>";
    $input .= " <div class='form-label-group'>";
    $input .= "   <input type='number' class='form-control text-right ". $classOnInput . $this->classError($errors, $name) ."' id='".$name."' name='".$this->name($name)."' value='".$this->value($value, $name)."' ".$this->isRequired($required)." ".$this->isEditable($editable)." >";
    $input .= "     <label for='".$name."'>" . $this->label($customLabel, $name);
    if($required){
      $input .= "       <span class='badge badge-subtle badge-danger'>*</span>";  
    }    
    $input .= "     </label>";
    $input .= " </div>";
    $input .= "</div>";

    return $input;
  } 

  public function colorPicker($name, $value, $errors, $required=false, $customLabel=false, $editable=true){
    $input = "<div class='form-group'>";
    $input .= " <div class='form-label-group'>";
    $input .= "   <input type='color' class='form-control ". $this->classError($errors, $name) ."' id='".$name."' name='".$this->name($name)."' value='".$this->value($value, $name)."' ".$this->isRequired($required)." ".$this->isEditable($editable)." style='height: 45px!important;' >";
    $input .= "     <label for='".$name."'>" . $this->label($customLabel, $name);
    if($required){
      $input .= "       <span class='badge badge-subtle badge-danger'>*</span>";  
    }    
    $input .= "     </label>";
    $input .= " </div>";
    $input .= "</div>";

    return $input;
  } 

  public function password($name, $value, $errors, $required=false, $customLabel=false){
    $input = "<div class='form-group'>";
    $input .= " <div class='form-label-group'>";
    $input .= "   <input type='password' class='form-control ". $this->classError($errors, $name) ."' id='".$name."' name='".$this->name($name)."' value='".$this->value($value, $name)."' ".$this->isRequired($required)." >";
    $input .= "     <label for='".$name."'>" . $this->label($customLabel, $name);
    if($required){
      $input .= "       <span class='badge badge-subtle badge-danger'>*</span>";  
    }    
    $input .= "     </label>";
    $input .= " </div>";
    $input .= "</div>";

    return $input;
  } 

  public function select($name, $value, $arrayValues, $errors, $required=false, $customLabel=false, $classOnFirstDiv='', $classOnInput='', $disabled=false){
    $select = "<div class='form-group'>";
    $select .= "  <div class='form-label-group'>";
    $select .=      Form::select($this->name($name), $arrayValues, $value, ['class'=>'custom-select '.$this->classError($errors, $name), 'id'=> $name, 'required' => $required, 'disabled' => $disabled ]);
    $select .= "     <label for='".$name."'>" . $this->label($customLabel, $name);
    if($required){
      $select .= "       <span class='badge badge-subtle badge-danger'>*</span>";  
    }    
    $select .= "     </label>";
    $select .= "  </div>";
    $select .= "</div>";
    
    return $select;
  } 

  public function switch($name, $value, $customLabel=false, $classOnFirstDiv='', $classOnInput=''){
    $switch = "<div class='form-group $classOnFirstDiv'>";
    $switch .= "  <div class='custom-control custom-switch'>";
    $switch .= "    <input type='checkbox' class='custom-control-input $classOnInput' id='".$name."' name='".$this->name($name)."' ". $this->isChecked($value, $name) ."  >";
    $switch .= "    <label class='custom-control-label cursor-pointer' for='".$name."'>".$this->label($customLabel, $name)."</label>";
    $switch .= "  </div>";
    $switch .= "</div>";
    
    return $switch;
  }

  public function switchWhitText($name, $value, $customLabel=false, $showLabel=true){
    $switchWhitText = "<div class=''>";
    if($showLabel) $switchWhitText .= "  <label class='cursor-pointer' for='".$name."'>".$this->label($customLabel, $name)."</label>";
    $switchWhitText .= "  <label class='switcher-control switcher-control-lg'>";
    $switchWhitText .= "    <input type='checkbox' class='switcher-input' id='".$name."' name='".$this->name($name)."' ".$this->isChecked($value, $name)." >";
    $switchWhitText .= "      <span class='switcher-indicator'></span>";
    $switchWhitText .= "      <span class='switcher-label-on'>". __('admin.yes') ."</span>";
    $switchWhitText .= "      <span class='switcher-label-off'>". __('admin.no') ."</span>";
    $switchWhitText .= "  </label>";
    $switchWhitText .= "</div>";
    
    return $switchWhitText;
  }

  public function textArea($name, $value, $height, $errors, $customLabel=false, $required=false){
    $textArea = "<div class='form-group'>";
    $textArea .= "     <label for='".$name."' style='color:#888c9b!important;'>". $this->label($customLabel, $name);
    if($required){
      $textArea .= "       <span class='badge badge-subtle badge-danger'>*</span>";  
    }    
    $textArea .= "     </label>";
    $textArea .= "  <textarea class='form-control ".$this->classError($errors, $name)."' id='".$name."' name='".$this->name($name)."' rows='".$height."' style='padding-top: 5px;' ".$this->isRequired($required)." >".$this->value($value, $name)."</textarea>";
    $textArea .= "</div>";
    return $textArea;
  }

  public function checkbox($name, $value, $customLabel=false, $formGroupDiv=true, $classOnFirstDiv='', $classOnInput=''){

    $id = (!$formGroupDiv) ? "-".$this->generate_string($this->permitted_chars, 20) : '';

    $checkbox = "";
    if($formGroupDiv) $checkbox .= "<div class='form-group $classOnFirstDiv '>";
    $checkbox .= "  <div class='custom-control custom-checkbox'>";
    $checkbox .= "    <input type='checkbox' class='custom-control-input $classOnInput' id='".$name.$id."' name='".$this->name($name)."' ".$this->isChecked($value, $name)." >";
    $checkbox .= "    <label class='custom-control-label' for='".$name.$id."'>".$this->label($customLabel, $name)."</label>";
    $checkbox .= "  </div>";
    if($formGroupDiv) $checkbox .= "</div>";

    return $checkbox;
  }

  public function fileInput($name, $required=false, $customLabel=false, $multiple=false){

    $fileInput = "<div class='form-group'>";
    $fileInput .= "   <label for='".$name."' style='color:#888c9b!important;'>Image";
    if($required){
      $fileInput .= "   <span class='badge badge-subtle badge-danger'>*</span>";  
    }    
    $fileInput .= "     </label>";
    $fileInput .= "  <div class='custom-file'>";
    if($multiple){
      $fileInput .= "    <input type='file' class='custom-file-input' id='".$name."' name='".$this->name($name)."[]' ".$this->isRequired($required)." multiple>";
    }else{
      $fileInput .= "    <input type='file' class='custom-file-input' id='".$name."' name='".$this->name($name)."' ".$this->isRequired($required)." >";  
    }
    $fileInput .= "    <label class='custom-file-label' for='".$name."' style='color:#888c9b!important;'>Choose Image</label>";
    $fileInput .= "  </div>";
    $fileInput .= "</div>";

    return $fileInput;
  }

  public function autocompleteSelect($name, $valueKey, $valueDisplay, $errors, $required=false, $customLabel=false, $classOnFirstDiv='', $classOnInput=''){

    $select = "<div class='form-group $classOnFirstDiv'>";
    $select .= "  <div class='form-label-group'>";
    $select .= "    <label for='".$name."'> ".$this->label($customLabel, $name);
    if($required){
      $select .= "   <span class='badge badge-subtle badge-danger'>*</span>";  
    }    
    $select .= "    </label>";
    $select .= "    <input type='text' name='".$name."_name' id='".$name."_name' class='form-control $classOnInput ".$this->classError($errors, $name)."' value='".$this->value($valueDisplay, $name.'_name')."' autocomplete='off' />";
    $select .= "    <input type='hidden' id='".$name."' name='".$this->name($name)."' value='".$this->value($valueKey, $name)."' >";
    $select .= "    <div id='".$name."_list'></div>";
    $select .= "  </div>";
    $select .= "</div>";

    return $select;
  }

  public function datepicker($name, $value, $errors, $required=false, $customLabel=false){

    if($value == '') $value = date("Y-m-d");

    $valueFormat = date('F j, Y', strtotime($value));

    $datepicker = "<div class='form-group'> ";
    $datepicker .= "  <div class='input-group input-group-alt flatpickr' id='flatpickr9' data-toggle='flatpickr' data-wrap='true' data-alt-input='true' data-alt-format='F j, Y' data-alt-input-class='form-control' data-date-format='Y-m-d' value='".$this->value($value, $name)."' placeholder='DD/MM/YYYY'> ";

    $datepicker .= "    <div class='form-label-group'> ";
    $datepicker .= "      <label for=''> ".$this->label($customLabel, $name);
    if($required){
      $datepicker .= "   <span class='badge badge-subtle badge-danger'>*</span>";  
    }
    $datepicker .= "      </label> ";
    $datepicker .= "      <input id='".$name."' name='".$this->name($name)."' type='text' class='form-control ".$this->classError($errors, $name)." ' data-input='".$this->value($value, $name)."' value='".$this->value($value, $name)."' > ";
    $datepicker .= "    </div> ";
    $datepicker .= "  </div> ";
    $datepicker .= "</div> ";

    return $datepicker;
  }
  
  protected function getStatusDecoration($status){
    if($status == '0') return 'text-decoration:line-through; color:grey';
  }


}