<?php 

class WDI_admin_view{
  
  private $params;
  
  function __construct($initial_params=array()){
    
    $defaults= array(
      "input_size"=>"36",
      "textarea_height"=>"150",
      "textarea_width"=>"450",
      "select_width"=>"240",
      "upload_size" => "30",
      "upload_filetype" => "image",
    );
    
    $this->params=$this->merge_params($defaults,$initial_params);     
  }
 


  /**
  * Displays a link like button
  *
  */
  public function link_button($element, $context = 'option', $opt_val = '', $meta=array()){
    global $wdi_options;
    ?>
    <div class="wdwt_param" id="wdwt_wrap_<?php echo $element['name']; ?>">
      <div class="block margin">
          <a href="<?php echo $element['href']; ?>" id="<?php echo $element['name']; ?>"  class="button" style="text-decoration:none;"><?php echo (isset($element['value']))?esc_html($element['value']):esc_html($element['title']); ?></a>
      </div>
      <?php if(isset($element['description'])){ ?>
          <p style="font-style: italic;"><?php echo $element['description']; ?></p>
      <?php } ?>
    </div>
    <?php   
  }

  /**
  * Displays a single button for toggling some other elements onclick
  *
  * @param $element['show'] = array('name_of _element_to_hide')
  * @param $element['hide'] = array('name_of _element_to_show')
  */
  public function button($element, $context = 'option', $opt_val = '', $meta=array()){
    global $wdi_options;
    ?>
    <div class="wdwt_param" id="wdwt_wrap_<?php echo $element['name']; ?>">
      <div class="block margin">
        <div class="optioninput checkbox">
          <span id="<?php echo $element['name']; ?>"  class="button" style="text-decoration:none;"><?php echo esc_html($element['title']); ?></span>
        </div>
      </div>
      <script>
      jQuery(document).ready(function () {
        /*init*/
        var element_<?php echo $element['name']; ?> = {
          id : "<?php echo $element['name']; ?>",
          show : [
            <?php
            foreach ($element['show'] as $element_to_show) :
            echo "'". $element_to_show ."', ";
            endforeach; 
            ?>        
            ],
          hide : [
            <?php
            foreach ($element['hide'] as $element_to_hide) :
            echo "'". $element_to_hide ."', ";
            endforeach; 
            ?>        
          ]
        };
        
        wdwt_elements.button_toggle(element_<?php echo $element['name']; ?>);
        /*change on click*/
        jQuery('#<?php echo $element['name']; ?>').on( "click", function() {
          wdwt_elements.button_toggle(element_<?php echo $element['name']; ?>);
        });
    
      });
    </script>
    </div>
    <?php   
  }

  /**
  * Displays single checkbox with hidden input field
  *
  *
  */

  public function checkbox($element, $context = 'option', $opt_val = '', $meta=array()){
    
    if($context == 'meta'){
      $optionname = "topt".'[' .$element['name']. ']';
    }
    else{
      global $wdi_options;
      $optionname = WDI_OPT.'[' .$element['name']. ']';
      $opt_val = isset($wdi_options[$element['name']]) ? $wdi_options[$element['name']] : '';
    }
    if(is_bool($opt_val)){
      $opt_val = $opt_val ? 'true' : '';
    }
    $opt_val = trim($opt_val);
    
    
    ?>
    <div class="wdwt_param" id="wdwt_wrap_<?php echo $element['name']; ?>">
      <div class="block margin">
        <div class="optioninput checkbox">
          <input type="checkbox" class="checkbox" name="<?php echo $optionname; ?>" id="<?php echo $element['name'] ?>" <?php checked($opt_val || $opt_val =='on'); ?> <?php $this->custom_attrs($element); ?> value="1">
        </div>
      </div>
    </div>
    <?php   
  }

  /**
  * Displays a checkbox which shows or hides some other elements onclick
  *
  * @param $element['show'] = array('name_of _element_to_show') on being checked
  * @param $element['hide'] = array('name_of _element_to_hide') on being checked
  */
  
  public function checkbox_open($element, $context = 'option', $opt_val ='', $meta=array()){
    
    if($context== 'meta'){
      $optionname = WDI_META.'[' .$element['name']. ']';
    }
    else{
      global $wdi_options;
      $optionname = WDI_OPT.'[' .$element['name']. ']';
      $opt_val = $wdi_options[$element['name']];  
    }
    if(is_bool($opt_val)){
      $opt_val = $opt_val ? 'true' : '';
    }
    $opt_val = trim($opt_val);
    
    ?>
    <div class="wdwt_param" id="wdwt_wrap_<?php echo $element['name']; ?>">
      <div class="block margin">
        <div class="optioninput checkbox">
          <input type="checkbox" class="checkbox" name="<?php echo $optionname; ?>" id="<?php echo $element['name'] ?>" <?php checked($opt_val || $opt_val =='on'); ?>  <?php $this->custom_attrs($element); ?> value="<?php echo esc_attr($opt_val); ?>">
        </div>
      </div>
    </div>
    <script>
      jQuery(document).ready(function () {
        /*init*/

        var element_<?php echo $element["name"]; ?> = {
          id : "<?php echo $element["name"]; ?>",
          show : [
            <?php
            foreach ($element['show'] as $element_to_show) :
            echo "'". $element_to_show ."', ";
            endforeach; 
            ?>        
            ],
          hide : [
            <?php
            foreach ($element['hide'] as $element_to_hide) :
            echo "'". $element_to_hide ."', ";
            endforeach; 
            ?>        
          ]
        };
        
        wdwt_elements.checkbox_open(element_<?php echo $element["name"]; ?>);
        /*change on click*/
        jQuery('#<?php echo $element["name"]; ?>').on( "click", function() {
          wdwt_elements.checkbox_open(element_<?php echo $element["name"]; ?>);
        });
    
      });
    </script>
    <?php   
  }

  /**
  * Displays a single color control
  */

   public function color($element, $context='option', $opt_val='', $meta=array()){

     if($context== 'meta'){
       $optionname = WDI_META.'[' .$element['name']. ']';
     }
     else{
       $wdi_options = get_option(WDI_OPT );
       $optionname = WDI_OPT.'[' .$element['name']. ']';
       $opt_val = $wdi_options[$element['name']];
     }
     ?>
     <div class="wdwt_param" id="wdwt_wrap_<?php echo $element['name']; ?>">
         <div class='wdwt_float'>  
           <div>
              <input type="text" class='color_input' id="<?php echo $element['name']; ?>" name="<?php echo $optionname; ?>"   value="<?php echo esc_attr($opt_val); ?>" data-default-color="<?php echo $element['default']; ?>" <?php $this->custom_attrs($element); ?> style="background-color:<?php echo esc_attr($opt_val); ?>;">
           </div>
         </div>
     </div>
     <script  type="text/javascript">
     jQuery(document).ready(function() {
       jQuery('.color_input').wpColorPicker();
     });
     </script>
     <?php
   }


  public function users_list($element){
    global $wdi_options;

    $readonly = isset($element['readonly']) ? 'readonly="' . esc_attr($element['readonly']) . '"' : '';
    $input_size = isset($element["input_size"]) ? $element["input_size"] : $this->params["input_size"];
    $optionname = WDI_OPT.'[' .$element['name']. ']';

    ?>
      <div class="wdwt_param" id="wdwt_wrap_<?php echo $element['name']; ?>">
          <div class="block">
            <?php WDILibrary::add_auth_button(''); ?>
              <div class="wdi_more_token_template" style="display: none;">
                  <input type="text" name="<?php echo $optionname . '[access_token][]'; ?>" class="wdi_more_access_token" disabled/>
                  <input type="text" name="<?php echo $optionname . '[user_name][]'; ?>" class="wdi_more_user_name" disabled/>
                  <input type="text" name="<?php echo $optionname . '[user_id][]'; ?>" class="wdi_more_user_id" disabled/>
              </div>
          </div>
      </div>
      <div style="margin-left: 15px;font-style: italic;">
          <p>Log out from the previous account before signing up.</p>
      </div>
    <?php
  }


  /**
  * Displays single input text field
  * 
  * @param $element['default']: one of the keys from 'valid options' as default value
  * @param $element['input_size']: input field size
  * @param $element['value'] : give constant value
  */
  
  public function input($element, $context = 'option', $opt_val = '', $meta=array()){
      $readonly = isset($element['readonly'])? 'readonly="'.esc_attr($element['readonly']).'"' : '';
  
      if($context== 'meta'){
         $optionname = WDI_META.'[' .$element['name']. ']';
       }
      else{
       global $wdi_options;
        $optionname = WDI_OPT.'[' .$element['name']. ']';
        $opt_val = isset($wdi_options[$element['name']])? $wdi_options[$element['name']] : '';
        if($opt_val == ''){
          $opt_val = isset($element['value']) ? $element['value'] : '';
        }
        
      }
    
    $input_size = isset($element["input_size"]) ? $element["input_size"] : $this->params["input_size"];

    ?>
    <div class="wdwt_param" id="wdwt_wrap_<?php echo $element['name']; ?>">
      <div class="block">
        <div class="optioninput">
          <input <?php echo $readonly;?> type=<?php echo isset($element['input_type']) ?  $element['input_type'] : 'text'?> name="<?php echo $optionname; ?>" id="<?php echo $element['name'];?>" 
               <?php echo isset($element['required'])? 'required' : ''; $this->custom_attrs($element); ?> 
               value="<?php echo esc_attr($opt_val); ?>" size="<?php echo $input_size; ?>"
               <?php if(isset($element['attr'])) {echo $element['attr']['name'] . '="' .$element["attr"]["value"].'"';} ?>>
            <?php 
            if(isset($element['unit_symbol'])){
              echo $element['unit_symbol']; 
            }
            echo isset($element['label']) ? $element['label'] : "";
            ?>
            
        </div>
      </div>
    </div>  
    <?php   
  }



  /**
  * Displays a group of radio buttons
  *
  * @param $option['valid options']: ($key => array('title'=>'value', 'description'=>'value'))
  * @param $option['default']: one of the keys from 'valid options' as default value 
  */
  
  public function radio($element, $context = 'option', $opt_val = '', $meta=array()){
    if($context== 'meta'){
      $optionname = WDI_META.'[' .$element['name']. ']';
    }
    else{
      global $wdi_options;
      $optionname = WDI_OPT.'[' .$element['name']. ']';
      $opt_val = $wdi_options[$element['name']];
    }

    ?>
    <div class="wdwt_param" id="wdwt_wrap_<?php echo $element['name']; ?>">
    <?php 
    foreach ( $element['valid_options'] as $key => $option ) {
    ?>
      <input type="radio" name="<?php echo $optionname; ?>" <?php checked( $key, $opt_val ); ?> <?php $this->custom_attrs($element); ?> value="<?php echo esc_attr($key); ?>" /> <?php echo esc_html($option); ?>
    <?php
      echo isset($element['label']) ? $element['label'] : "";
    }
    ?>
    </div>
    <?php
  }

  /**
  * Displays a group of radio buttons which show or hide some other elements onchange
  *
  * @param $element['show'] = array("key" => "value") or array("key" => array("value","valeu2"))
  * @param $element['hide'] = array("key" => "value")
  */

  public function radio_open($element,$context = 'option', $opt_val = '', $meta=array()){

    if($context== 'meta'){
      $optionname = WDI_META.'[' .$element['name']. ']';
    }
    else{
      global $wdi_options;
      $optionname = WDI_OPT.'[' .$element['name']. ']';
      $opt_val = $wdi_options[$element['name']];
    }

    

    ?>
    <div class="wdwt_param" id="wdwt_wrap_<?php echo $element['name']; ?>">
    
      <?php 
      foreach ( $element['valid_options'] as $key => $option ) {
      ?>
        <input type="radio" name="<?php echo $optionname; ?>" <?php checked( $key, $opt_val ); ?> <?php $this->custom_attrs($element); ?> value="<?php echo esc_attr($key); ?>" /> <?php echo esc_html($option); ?>
      <?php
      }
      ?>
      
    </div>
    <script>
      jQuery(document).ready(function () {
        /*init*/
        var element_<?php echo $element["name"]; ?> = {
          name : "<?php echo $optionname; ?>",
          show : [
            <?php
            foreach ($element['show'] as $key => $value) :
              echo "{key: '" . $key ."', val: [" ; 
              if(gettype ($value)=='array'){ /*many items. array of strings of names*/
               foreach ($value as $item){
                echo "'".$item."',";
               } 
              }
              else{/*single item name string */
                echo "'".$value."',";
              }
              echo "]},";
            endforeach; 
            ?>        
            ],
          hide : [
            <?php
            foreach ($element['hide'] as $key => $value) :
              echo "{key: '" . $key ."', val: [" ; 
              if(gettype ($value)=='array'){ /*many items. array of strings of names*/
               foreach ($value as $item){
                echo "'".$item."',";
               } 
              }
              else{/*single item name string */
                echo "'".$value."',";
              }
              echo "]},";
            endforeach; 
            ?>        
          ]
        };
        
        wdwt_elements.radio_open(element_<?php echo $element["name"]; ?>);
        /*shor or hide on change*/
        jQuery('input[type=radio][name="<?php echo $optionname; ?>"]').on( "change", function() {
          wdwt_elements.radio_open(element_<?php echo $element["name"]; ?>);
        });
    
      });
    </script>

    <?php
    
  }

  /**
  * Displays a group of radio buttons with images as descriptions
  *
  * @param $element['valid options']: array( array('index' => 0, title'=>'value', 'description'=>'value'))
  * @param $element['default']: one of the indices from 'valid options' as default value
  * @param $element['img_src']:
  * @param $element['img_height']:
  * @param $element['img_width']:
  */
  
  public function radio_images($element, $context='meta', $opt_val='', $meta=array()){

    if($context== 'meta'){
      $optionname = WDI_META.'[' .$element['name']. ']';
    }
    else{
      global $wdi_options;
      $optionname = WDI_OPT.'[' .$element['name']. ']';
      $opt_val = $wdi_options[$element['name']];
    }
    ?>
      
    <div class="wdwt_param" id="wdwt_wrap_<?php echo $element['name']; ?>">
    <?php 
    $img_h = intval($element['img_height']) / sizeof($element['valid_options']);
    foreach($element['valid_options'] as $option) { ?>
      <div class="sprite_layouts">
        <div alt="<?php echo esc_attr($option['title']); ?>" style="width:<?php echo esc_attr($element['img_width']); ?>px; height:<?php echo esc_attr($img_h); ?>px; background:url(<?php echo esc_url(WDWT_IMG_INC.$element['img_src']); ?>) no-repeat 0 -<?php echo (intval($option['index'])-1) * $img_h; ?>px;"></div>
        <input type="radio" name="<?php echo $optionname; ?>" <?php checked( $option['index'], $opt_val ); ?> <?php $this->custom_attrs($element); ?> value="<?php echo intval($option['index']); ?>">
      </div>
    <?php 
    }
    ?>
    </div>
    <?php  
  }
  /**
  * Displays a group of radio buttons with images as descriptions which show or hide some other elements onchange
  *
  * @param $element['valid options']: array( array('index' => 0, title'=>'value', 'description'=>'value'))
  * @param $element['default']: one of the indices from 'valid options' as default value
  * @param $element['img_src']:
  * @param $element['img_height']:
  * @param $element['img_width']:
  * @param $element['show'] = array("key" => "value") or array("key" => array("value","valeu2"))
  * @param $element['hide'] = array("key" => "value")
  *
  */

  
  public function radio_images_open($element, $context='option', $opt_val ='', $meta=array()){

    if($context== 'meta'){
      $optionname = WDI_META.'[' .$element['name']. ']';
    }
    else{
      global $wdi_options;
      $optionname = WDI_OPT.'[' .$element['name']. ']';
      $opt_val = $wdi_options[$element['name']];
    }
    ?>
      
    <div class="wdwt_param" id="wdwt_wrap_<?php echo $element['name']; ?>">
    <?php 
    $img_h = intval($element['img_height']) / sizeof($element['valid_options']);
    foreach($element['valid_options'] as $option) { ?>
      <div class="sprite_layouts">
        <div alt="<?php echo esc_attr($option['title']); ?>" style="width:<?php echo $element['img_width']; ?>px; height:<?php echo $img_h; ?>px; background:url(<?php echo esc_url(WDWT_IMG_INC.$element['img_src']); ?>) no-repeat 0 -<?php echo (intval($option['index'])-1) * $img_h; ?>px;"></div>
        <input type="radio" name="<?php echo $optionname; ?>" <?php checked( $option['index'], $opt_val ); ?> <?php $this->custom_attrs($element); ?> value="<?php echo intval($option['index']); ?>">
      </div>
    <?php 
    }
    ?>
    </div>
    <script>
      jQuery(document).ready(function () {
        /*init*/
        var element_<?php echo $element["name"]; ?> = {
          name : "<?php echo $optionname; ?>",
          show : [
            <?php
            foreach ($element['show'] as $key => $value) :
              echo "{key: '" . $key ."', val: [" ; 
              if(gettype ($value)=='array'){ /*many items. array of strings of names*/
               foreach ($value as $item){
                echo "'".$item."',";
               } 
              }
              else{/*single item name string */
                echo "'".$value."',";
              }
              echo "]},";
            endforeach; 
            ?>        
            ],
          hide : [
            <?php
            foreach ($element['hide'] as $key => $value) :
              echo "{key: '" . $key ."', val: [" ; 
              if(gettype ($value)=='array'){ /*many items. array of strings of names*/
               foreach ($value as $item){
                echo "'".$item."',";
               } 
              }
              else{/*single item name string */
                echo "'".$value."',";
              }
              echo "]},";
            endforeach; 
            ?>        
          ]
        };
        
        wdwt_elements.radio_open(element_<?php echo $element["name"]; ?>);
        /*shor or hide on change*/
        jQuery('input[type=radio][name="<?php echo $optionname; ?>"]').on( "change", function() {
          wdwt_elements.radio_open(element_<?php echo $element["name"]; ?>);
        });
    
      });
    </script>
    <?php  
  }

  /**
  * Displays single <select> element
  *
  * @param $select['valid options']: ($key => $value)
  * @param $select['default']: one of the keys from 'valid options' as default value
  */
  
  public function select($element, $context='option', $opt_val = array(), $meta=array()){

    if($context== 'meta'){
      $optionname = WDI_META.'[' .$element['name']. '][]';
      if(!is_array($opt_val)){
        /*old format*/
        $opt_val = $this->get_old_posts_cats($opt_val);
      }
    }
    else{
      global $wdi_options;
      $optionname = isset($element["multiple"]) ? WDI_OPT.'[' .$element['name']. '][]' : WDI_OPT.'[' .$element['name']. ']';
      $opt_val = isset($wdi_options[$element['name']]) ? $wdi_options[$element['name']] : $element["default"];
    }
    $opt_val = is_array($opt_val) ? $opt_val : array($opt_val);
    $multiple = isset($element["multiple"]) ? true : false;
    $width = isset($element["width"]) ? intval($element["width"]) : $this->params["select_width"];
    $disabled = isset($element["disabled"]) ? $element["disabled"] : array();
    ?>
    <div class="wdwt_param" id="wdwt_wrap_<?php echo $element['name']; ?>">
      <div class="block">   
        <div class="optioninput">     
          <select name="<?php echo $optionname; ?>" id="<?php echo $element['name'] ?>" <?php echo $multiple ? 'multiple="multiple"' : ''; ?> <?php $this->custom_attrs($element); ?> style="width:<?php echo $width; ?>px; resize:vertical;">
          <?php foreach($element['valid_options'] as $key => $value){ ?>
            <option value="<?php echo esc_attr($key) ?>" <?php selected(true, in_array($key, $opt_val)); ?> <?php echo in_array($key, $disabled) ? 'disabled="disabled"' : ''; ?>>
              <?php echo esc_html($value); ?>
            </option>
          <?php } ?>
          </select>
        </div>
      </div>
    </div>
    <?php
  }

  /**
  * Displays a select with options which shows or hides some other elements onchange
  *
  * @param $element['show'] = array("key" => "value") or array("key" => array("value","valeu2"))
  * @param $element['hide'] = array("key" => "value")
  */

  public function select_open($element, $context='option', $opt_val ='', $meta=array()){

    if($context== 'meta'){
      $optionname = WDI_META.'[' .$element['name']. '][]';
    }
    else{
      global $wdi_options;
      $optionname = WDI_OPT.'[' .$element['name']. '][]';
      $opt_val = $wdi_options[$element['name']];
    }
    $opt_val = is_array($opt_val) ? $opt_val : array($opt_val);
    $multiple = isset($element["multiple"]) ? true : false;
    $width = isset($element["width"]) ? intval($element["width"]) : $this->params["select_width"];

    ?>
    <div class="wdwt_param" id="wdwt_wrap_<?php echo $element['name']; ?>">
      
      <select name="<?php echo $optionname; ?>" id="<?php echo $element['name'] ?>" <?php echo $multiple ? 'multiple="multiple"' : ''; ?> <?php $this->custom_attrs($element); ?> style="width:<?php echo $width; ?>px; resize:vertical;">
      <?php
      foreach($element['valid_options'] as $key => $value){ ?>
        <option value="<?php echo esc_attr($key); ?>" <?php selected(true, in_array($key, $opt_val)); ?>><?php echo esc_html($value); ?></option>
      <?php } ?>
      </select>
    </div>
    <script>
      jQuery(document).ready(function () {
        /*init*/

        var element_<?php echo $element["name"]; ?> = {
          id : "<?php echo $element['name']; ?>",
          show : [
            <?php
            foreach ($element['show'] as $key => $value) :
              echo "{key: '" . $key ."', val: [" ; 
              if(gettype ($value)=='array'){ /*many items. array of strings of names*/
                foreach ($value as $item){
                 echo "'".$item."',";
               } 
              }
              else{/*single item name string */
                echo "'".$value."',";
              }
              echo "]},";
            endforeach; 
            ?>        
            ],
          hide : [
            <?php
            foreach ($element['hide'] as $key => $value) :
              echo "{key: '" . $key ."', val: [" ; 
              if(gettype ($value)=='array'){ /*many items. array of strings of names*/
               foreach ($value as $item){
                echo "'".$item."',";
               } 
              }
              else{/*single item name string */
                echo "'".$value."',";
              }
              echo "]},";
            endforeach; 
            ?>        
          ]
        };


        
        wdwt_elements.select_open(element_<?php echo $element["name"]; ?>);
        /*change on click*/
        jQuery('#<?php echo $element["name"]; ?>').on( "change", function() {
          wdwt_elements.select_open(element_<?php echo $element["name"]; ?>);
        });
    
      });
    </script>
    <?php
  }

  /**
  * Displays a select with style options which allow to modify preview text
  *
  * @param $element['text_preview'] = 'name'
  * @param $element['style_param'] = 'font-size' (css param name)
  * @param $element['valid_options'] = array('1em' => "1 em")
  */

  public function select_style($element, $context='option', $opt_val='', $meta=array()){

    if($context== 'meta'){
      $optionname = WDI_META.'[' .$element['name']. '][]';
    }
    else{
      global $wdi_options;
      $optionname = WDI_OPT.'[' .$element['name']. '][]';
      $opt_val = $wdi_options[$element['name']];
    }
    $width = isset($element["width"]) ? $element["width"] : $this->params["select_width"];

    ?>
    <div class="wdwt_param" id="wdwt_wrap_<?php echo $element['name']; ?>">
      <select name="<?php echo $optionname; ?>" id="<?php echo $element['name'] ?>" <?php $this->custom_attrs($element); ?> style="width:<?php echo $width;?>px;">
        <?php
        foreach($element['valid_options'] as $key => $value){ ?>
          <option value="<?php echo esc_attr($key); ?>" <?php selected(true, in_array($key, $opt_val)); ?>><?php echo esc_html($value); ?></option>
        <?php } ?>
      </select>
    </div>
    <?php
    if($context == 'option') :
    ?>
      <script>
        jQuery(document).ready(function () {
          /*init*/

          var element_<?php echo $element["name"]; ?> = {
            id : "<?php echo $element["name"]; ?>",
            text_preview : "<?php echo $element['text_preview']; ?>",
            style_param : "<?php echo $element['style_param']; ?>",
          };
          
          wdwt_elements.select_style(element_<?php echo $element["name"]; ?>);
          /*change preview text*/
          jQuery('#<?php echo $element["name"]; ?>').on( "change", function() {
            wdwt_elements.select_style(element_<?php echo $element["name"]; ?>);
          });
      
        });
      </script>
    <?php
    endif;
  }



  /**
  * Displays single textarea field
  *
  * @param $params["textarea_height"] and $params["textarea_width"]
  *
  */

  public function textarea($element, $context='option', $opt_val='', $meta=array()){
    
    if($context== 'meta'){
      $optionname = WDI_META.'[' .$element['name']. ']';
    }
    else{
      global $wdi_options;
      $optionname = WDI_OPT.'[' .$element['name']. ']';
      $opt_val = isset($wdi_options[$element['name']])? $wdi_options[$element['name']] : '';
    }

    $textarea_w = isset($element["width"]) ? $element["width"] : $this->params["textarea_width"];
    $textarea_h = isset($element["height"]) ? $element["height"] : $this->params["textarea_height"];
    ?>
    <div class="wdwt_param" id="wdwt_wrap_<?php echo $element['name']; ?>">
      <div class="block">
        <div class="optioninput">
          <textarea name="<?php echo $optionname; ?>" id="<?php echo $element['name'] ?>" <?php $this->custom_attrs($element); ?> style="width:<?php echo $textarea_w; ?>px; height:<?php echo $textarea_h; ?>px;"><?php echo esc_html($opt_val); ?></textarea>
        </div>
      </div>
    </div>
  <?php
  
  }



  
  /**
  * displays a preview text in typography page
  * @param $element['modified_by'] = array('home_font_weight' => 'font-weight')
  *
  */

  public function text_preview($element, $context='option', $opt_val='', $meta=array()){
    global $wdi_options;
    ?>
    
    <div class="font_preview_wrap" id="wdwt_wrap_<?php echo $element['name']; ?>">
      <label class="typagrphy_label" for="" style="font-size:18px;font-size: 20px;font-family: Segoe UI;"><?php echo __('Preview', WDWT_LANG ); ?></label>
      <div class="font_preview">
        <div class="optioninput-preview" id="<?php echo $element['name']; ?>" style="margin-top: 14px; margin-bottom: 23px;" ><?php
          $theme = wp_get_theme();
          echo esc_html($theme->description);
        ?></div>
      </div>
    </div>
  <?php 
  }

  
  
  /**
  * Displays an upload with single input field for filename
  *
  * @param $element[''] = 
  *
  * not for the slider!!!
  */

  public function upload_single($element, $context='', $opt_val=''){
    
    if($context== 'meta'){
      $optionname = WDI_META.'[' .$element['name']. ']';
    }
    else{
      global $wdi_options;
      $optionname = WDI_OPT.'[' .$element['name']. ']';
      $opt_val = $wdi_options[$element['name']];
    }

    $upload_size =  isset($element["upload_size"]) ? $element["upload_size"] : $this->params["upload_size"];
    $filetype = (isset($element["filetype"]) && $element_filetype != '') ? $element["filetype"] : $this->params["upload_filetype"];
    
    ?>
      <script>
        jQuery(document).ready(function ($) {
            
          /* set uploader size in resizing*/
          tb_position = function() {
            var tbWindow = jQuery('#TB_window'),
              width = jQuery(window).width(),
              H = jQuery(window).height(),
              W = ( 850 < width ) ? 850 : width,
              adminbar_height = 0;
        
            if ( jQuery('#wpadminbar').length ) {
              adminbar_height = parseInt(jQuery('#wpadminbar').css('height'), 10 );
            }
        
            if ( tbWindow.size() ) {
              tbWindow.width( W - 50 ).height( H - 45 - adminbar_height );
              jQuery('#TB_iframeContent').width( W - 50 ).height( H - 75 - adminbar_height );
              tbWindow.css({'margin-left': '-' + parseInt( ( ( W - 50 ) / 2 ), 10 ) + 'px'});
              if ( typeof document.body.style.maxWidth !== 'undefined' )
                tbWindow.css({'top': 20 + adminbar_height + 'px', 'margin-top': '0'});
            }
          };
          
          /*setup the var*/
          jQuery('#uploader_<?php echo $element['name']; ?>').on('click', function () {
            
            window.parent.uploadID = jQuery(this).prev('#<?php echo $element['name']; ?>');
            /*grab the specific input*/
            /*formfield = jQuery('.upload').attr('name');*/
            tb_show('', 'media-upload.php?type=<?php echo $filetype;?>&amp;TB_iframe=true');
            return false;
          });
          window.send_to_editor = function (html) {
            imgurl = jQuery('img', html).attr('src');
            /*assign the value to the input*/
            window.parent.uploadID.val(imgurl);
            /*trigger change for the customizer control*/
            window.parent.uploadID.change();
            tb_remove();
          };
          
          /*jQuery(".slide_tab").prev().parent().prev().css("display","none");*/
        });
      </script>
      <div class="wdwt_param" id="wdwt_wrap_<?php echo $element['name']; ?>">
        <div class="optioninput" id="upload_images">
          <input type="text" class="upload" id="<?php echo $element["name"] ?>" name="<?php echo $optionname; ?>" size="<?php echo $upload_size; ?>" <?php $this->custom_attrs($element); ?> value="<?php echo esc_url($opt_val); ?>"/>
          <input class="upload-button button" type="button" id="uploader_<?php echo $element['name']; ?>" value="<?php esc_attr_e('Upload Image', WDWT_LANG); ?>"/>
        </div>
      </div>
    <?php 
    
  }


  /**
  * Displays an upload with 
  *                    input fields for filename, 
  *                    remove button, 
  *                    img href text, image title text, imange description textarea,
  *                    and upload new image button
  *                    
  *
  * @param $element[''] = 
  *
  * for the slider!!!
  */


  public function upload_multiple($element, $context='', $opt_val='', $meta=array()){
    if($context== 'meta'){
    $optionname = WDI_META.'[' .$element['name']. ']';
    /*correct here later*/
    }
    else {
      global $wdi_options;
      $imgs_url = $wdi_options[$element['name']];
      $optionname_url = WDI_OPT.'[' .$element['name']. ']';

      $imgs_href = $wdi_options[$element['option']['imgs_href']] ;
      $optionname_href = WDI_OPT.'[' .$element['option']['imgs_href']. ']';
      $imgs_title = $wdi_options[$element['option']['imgs_title']] ;
      $optionname_title = WDI_OPT.'[' .$element['option']['imgs_title']. ']';
      $imgs_desc = $wdi_options[$element['option']['imgs_description']];
      $optionname_desc = WDI_OPT.'[' .$element['option']['imgs_description']. ']';
    }

    $upload_size =  isset($element["upload_size"]) ? $element["upload_size"] : $this->params["upload_size"];
    $filetype = (isset($element["filetype"]) && $element_filetype != '') ? $element["filetype"] : $this->params["upload_filetype"];
    ?>

    <div class="wdwt_param" id="wdwt_wrap_<?php echo $element['name']; ?>">
      
      <div class="wdwt_slide wdwt_slide_<?php echo $element['name']; ?> last_slide" id="wdwt_slide_<?php echo $element['name']; ?>_0">
        <!-- Image URL -->
        <div class="slide-from-base_url" style="margin-bottom:3%;">
          <div valign="middle"><h2><?php esc_html_e("Image URL",WDWT_LANG); ?></h2></div>
          <div>
            <input type="text" id="<?php echo $element['name']; ?>_url_0" size="50" value="" class="upload image_links_group" >
            
            <input type="button" class="<?php echo $element['name']; ?>_update-image slide_but_up" id="<?php echo $element['name']; ?>_update-button_0" value="<?php esc_attr_e("Update image", WDWT_LANG); ?>">

            <input type="button" class="<?php echo $element['name']; ?>_remove-image slide_but_rem wdwt_btn_red" id="<?php echo $element['name']; ?>_remove-button_0" value="<?php esc_attr_e("Remove this slide", WDWT_LANG); ?>"  />
          </div>
        </div>
        <!-- Image -->
        <div class="slide-from-base_image">
          <div><img style="width:82%;" id="<?php echo $element['name']; ?>_img_0" src="" /></div>
        </div>
        <!-- Image HREF -->
        <div class="slide-from-base_href">
          <div valign="middle"><h2><?php esc_html_e("Image Href", WDWT_LANG); ?></h2></div>
          <div><input  type="text" id="<?php echo $element['name']; ?>_href_0"  class="image_href_group" value="" /></div>
        </div>
        <!-- Image TITLE -->
        <div class="slide-from-base_title">
          <div  valign="middle">
            <h2><?php esc_html_e("Image Title", WDWT_LANG); ?></h2>
          </div>
          <div><input  type="text" id="<?php echo $element['name']; ?>_title_0" class="image_title_group" value="" /></div>
        </div>
        <!-- Image DESCRIPTION -->
        <div class="slide-from-base_desc" style="margin-bottom:3%;">
          <div valign="middle">
            <h2><?php esc_html_e("Image Description", WDWT_LANG); ?></h2>
          </div>
          <div>
            <textarea class="image_descr_group" id="<?php echo $element['name']; ?>_descr_0"  style="width:236px; height:120px;"></textarea>
          </div>
        </div>
      </div>
      
      <div class="slider-controls">
        <div valign="middle">
          <h2>
            <?php esc_html_e("Image", WDWT_LANG); ?>
            <span class="hasTip" style="cursor: pointer;color: #3B5998;" title="<?php esc_attr_e("Using this option you can add images for the slider.",WDWT_LANG); ?>">[?]</span>
          </h2>
        </div>
        <div>
          <input type="hidden" name="<?php echo $optionname_url; ?>" id="<?php echo $element['name']; ?>_urls" data-customize-setting-link="<?php echo $optionname_url; ?>" value="<?php echo esc_attr($imgs_url); ?>" >
          <input type="hidden" name="<?php echo $optionname_href; ?>" id="<?php echo $element['name']; ?>_hrefs" data-customize-setting-link="<?php echo $optionname_href; ?>" value="<?php echo esc_attr($imgs_href); ?>" >
          <input type="hidden" name="<?php echo $optionname_title; ?>" id="<?php echo $element['name']; ?>_titles" data-customize-setting-link="<?php echo $optionname_title; ?>" value="<?php echo esc_attr($imgs_title); ?>" >
          <input type="hidden" name="<?php echo $optionname_desc; ?>" id="<?php echo $element['name']; ?>_descrs" data-customize-setting-link="<?php echo $optionname_desc; ?>" value="<?php echo esc_attr($imgs_desc); ?>" >
          <input class="upload_button_slide" type="button" id="<?php echo $element['name']; ?>_add-button" value="<?php esc_attr_e('Add new slide', WDWT_LANG); ?>" />
        </div>
      </div>
    </div>
    <script type="text/javascript">
    jQuery(document).ready(function(){ 

      var element_<?php echo $element["name"]; ?> = {
        id : "<?php echo $element['name']; ?>",
        urls : jQuery('#<?php echo $element['name']; ?>_urls').val(),
        hrefs : jQuery('#<?php echo $element['name']; ?>_hrefs').val(),
        titles : jQuery('#<?php echo $element['name']; ?>_titles').val(),
        descrs : jQuery('#<?php echo $element['name']; ?>_descrs').val(),
        active : 0,
        number_slides :  wdwt_elements.slider.len(jQuery('#<?php echo $element['name']; ?>_urls').val()),
        };
      /*init show*/
      wdwt_elements.slider.init(element_<?php echo $element["name"]; ?>);
      wdwt_elements.slider.show(element_<?php echo $element["name"]; ?>);
      /*firefox bug!*/
      jQuery('#customize-control-theme_portfolio_gallery_options-slider_head').find("*").on("focus",function(e){
        console.log(e);
      });
      /*watch for changes in values*/
      jQuery("#wdwt_wrap_<?php echo $element['name']; ?>").on("change", ".image_links_group" , function (){
        var index = wdwt_elements.slider.find_index(jQuery(this), "<?php echo $element['name']; ?>_url_");
        wdwt_elements.slider.edit(element_<?php echo $element["name"]; ?>, index, "url");
      });
      jQuery("#wdwt_wrap_<?php echo $element['name']; ?>").on("change", ".image_href_group", function (){
        var index = wdwt_elements.slider.find_index(jQuery(this), "<?php echo $element['name']; ?>_href_");
        wdwt_elements.slider.edit(element_<?php echo $element["name"]; ?>, index, "href");
      });
      jQuery("#wdwt_wrap_<?php echo $element['name']; ?>").on("change", ".image_title_group", function (){
        var index = wdwt_elements.slider.find_index(jQuery(this), "<?php echo $element['name']; ?>_title_");
        wdwt_elements.slider.edit(element_<?php echo $element["name"]; ?>, index,  "title");
      });
      jQuery("#wdwt_wrap_<?php echo $element['name']; ?>").on("change", ".image_descr_group", function (){
        var index = wdwt_elements.slider.find_index(jQuery(this), "<?php echo $element['name']; ?>_descr_");
        wdwt_elements.slider.edit(element_<?php echo $element["name"]; ?>, index, "descr");
      });
      /*add new slide*/
      jQuery("#<?php echo $element['name']; ?>_add-button").on('click', function(){
        tb_show("", "media-upload.php?type=image&amp;TB_iframe=true");  
        add_image=send_to_editor ;
        window.send_to_editor = function(html) { 
          imgurl = jQuery("img",html).attr("src");
          after = element_<?php echo $element["name"]; ?>.number_slides-1;
          wdwt_elements.slider.insert(element_<?php echo $element["name"]; ?>, after, imgurl);
          tb_remove();  
        };
        return false;   
      });
      /*update image*/
      jQuery("#wdwt_wrap_<?php echo $element['name']; ?>").on('click', ".<?php echo $element['name']; ?>_update-image", function(){
        var index = wdwt_elements.slider.find_index(jQuery(this), "<?php echo $element['name']; ?>_update-button_");        
        tb_show("", "media-upload.php?type=image&amp;TB_iframe=true");    
        window.send_to_editor = function(html) { 
          imgurl = jQuery("img",html).attr("src");
          jQuery("#<?php echo $element['name']; ?>_url_"+index).val(imgurl);
          jQuery("#<?php echo $element['name']; ?>_url_"+index).change();
          tb_remove();
        };
        return false;   
      }); 
      /*remove slide*/
      jQuery("#wdwt_wrap_<?php echo $element['name']; ?>").on('click', ".<?php echo $element['name']; ?>_remove-image", function(){
        var index = wdwt_elements.slider.find_index(jQuery(this), "<?php echo $element['name']; ?>_remove-button_");                
        element_<?php echo $element["name"]; ?>.active = index;
        wdwt_elements.slider.remove(element_<?php echo $element["name"]; ?>);
      });
    });
    </script>     
    <?php
  }





  /**
  * Displays a select with color theme options which allows to select active theme
  *
  * @param $element['color_panel'] = 'name of color panel'
  * @param $element['default'] = array(
  *                                  'active'=>0, 
  *                                  'themes' => array(array('name'=>'theme_1', "title" =>'')),
  *                                  'colors'=> array(
  *                                    array('color_name => 'array('value'=>'#cccccc', 'default'=>'#000000')))
  *                                  )
  * 
  */
  
  public function select_theme($element, $context='option', $opt_val='', $meta=array()){

    
    if($context== 'meta'){
      $optionname = WDI_META.'[' .$element['name']. ']';
    }
    else{
      global $wdi_options;
      $optionname = WDI_OPT.'[' .$element['name']. ']';
      $opt_val = $wdi_options[$element['name']];
    }
    
    $current = $opt_val['active'];
    $width = isset($element["width"]) ? $element["width"] : $this->params["select_width"];
    ?>
    <div class="wdwt_param" id="wdwt_wrap_<?php echo $element['name']; ?>">
      <select name="<?php echo $optionname; ?>[active]" id="<?php echo $element['name'] ?>" <?php $this->custom_attrs($element); ?> style="width:<?php echo $width; ?>px;">
        <?php
        for($i=0; $i<sizeof($element['default']['themes']); $i++){ ?>
          <option value="<?php echo $i ?>" <?php selected( $current, $i); ?>> <?php echo esc_html($element['default']['themes'][$i]['title']); ?></option>
        <?php } ?>
      </select>
    </div>
    <script>/*stop here*/
      jQuery(document).ready(function () {

        /*create var storing all parameters*/
        var element_<?php echo $element['name'] ?> = {
            id : "<?php echo $element["name"]; ?>",
            cpanel:"<?php echo $element['color_panel']; ?>",
            themes:[],
            colors:[]
             };

        <?php
        /*add themes to variable*/
        for($i=0; $i<sizeof($opt_val['themes']); $i++):
        ?>
          element_<?php echo $element['name']; ?>.themes.push({name: "<?php echo $opt_val['themes'][$i]['name']; ?>", title: "<?php echo esc_attr($opt_val['themes'][$i]['title']); ?>"});
          var theme_colors = {};
          <?php
          foreach ($opt_val['colors'][$i] as $color_name => $color){
          ?>
            theme_colors["<?php echo $color_name; ?>"] = { name: "<?php echo $color_name; ?>", val: "<?php echo $color['value']; ?>", def: "<?php echo $color['default']; ?>"};
          <?php
          }
          /*add colors of every theme to variable  */
          ?>
          element_<?php echo $element['name']; ?>.colors.push(theme_colors);
        <?php
        endfor;
        ?>
        /*refresh color panel on theme select change*/
        jQuery('#<?php echo $element["name"]; ?>').on( "change", function() {
          wdwt_elements.refresh_colorpanel(element_<?php echo $element['name'] ?>);
        });
 
      });
    </script>
    <?php
  }

  
  /**
  * Displays a color panel with names, pickers and default buttons for every color
  * Active theme index and its colors are taken from here, not from select_theme
  *
  * @param $element['default'] = array( 'select_theme' => 'color_scheme', 'active' => 0, 
  * 'colors' => array('color_name'=>array('value'=>'#cccccc', 'value'=>'#000000')))
  */

  public function colors($element, $context='option', $opt_val='', $meta=array()){

    if($context== 'meta'){
      $optionname = WDI_META.'[' .$element['name']. ']';
    }
    else{
      global $wdi_options;
      $optionname = WDI_OPT.'[' .$element['name']. ']';
      $opt_val = $wdi_options[$element['name']];
    }
    
    $select_theme = $opt_val['select_theme'];
    ?>
    <div class="wdwt_param" id="wdwt_wrap_<?php echo $element['name']; ?>">
      <input type="text" class="hidden_field" id="theme_<?php echo $element['name']; ?>" hidden='hidden' name="<?php echo $optionname.'[select_theme]'; ?>"   value="<?php echo esc_attr($opt_val['select_theme']); ?>">
      <input type="text" class="hidden_field" id="active_<?php echo $element['name']; ?>" hidden='hidden' name="<?php echo $optionname.'[active]'; ?>"   value="<?php echo esc_attr($opt_val['active']); ?>">
      <?php foreach($opt_val['colors'] as $color_name => $color): ?>
        <div class='wdwt_float'>  
          <span class="wdwt_color_title"><?php echo esc_html($element['color_names'][$color_name]); ?></span>
          <div>
            <input type="text" class="hidden_field" id="default_<?php echo $element['name']; ?>_<?php echo $color_name; ?>" hidden='hidden' name="<?php echo $optionname.'[colors]['.$color_name.']'.'[default]'; ?>"   value="<?php echo $color['default']; ?>">
            <input type="text" class='color_input' id="value_<?php echo $element['name']; ?>_<?php echo $color_name; ?>" name="<?php echo $optionname.'[colors]['.$color_name.']'.'[value]'; ?>"   value="<?php echo $color['value']; ?>" data-default-color="<?php echo $color['default']; ?>" style="background-color:<?php echo $color['value']; ?>;">
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <script  type="text/javascript">
    jQuery(document).ready(function() {
      jQuery('.color_input').wpColorPicker();


    });
    </script>
    <?php
  }


  /**
  * Displays a diagram with 
  *                    input fields for title and percent
  * colors and other options are given separately, type (horizonral, circular etc. ...)                    
  */


  public function diagram($element, $context='', $opt_val='', $meta=array()){
    if($context== 'meta'){
    $optionname = WDI_META.'[' .$element['name']. ']';
    $diagram_title = isset($meta[$element['option']['diagram_title']]) ? $meta[$element['option']['diagram_title']] : '' ;
    $optionname_title = WDI_META.'[' .$element['option']['diagram_title']. ']';
    $diagram_percent = isset($meta[$element['option']['diagram_percent']]) ? $meta[$element['option']['diagram_percent']] : '';
    $optionname_percent = WDI_META.'[' .$element['option']['diagram_percent']. ']';
    }
    else {
      global $wdi_options;

      $diagram_title = $wdi_options[$element['option']['diagram_title']] ;
      $optionname_title = WDI_OPT.'[' .$element['option']['diagram_title']. ']';
      $diagram_percent = $wdi_options[$element['option']['diagram_percent']];
      $optionname_percent = WDI_OPT.'[' .$element['option']['diagram_percent']. ']';
    }
    ?>

    <div class="wdwt_param" id="wdwt_wrap_<?php echo $element['name']; ?>">
      
      <div class="wdwt_diagram wdwt_diagram_<?php echo $element['name']; ?> last_percent" id="wdwt_diagram_<?php echo $element['name']; ?>_0">
        <!-- Percent TITLE -->
        <div class="diagram-from-base_title">
          <div  valign="middle">
            <h2><?php esc_html_e("Title", WDWT_LANG); ?></h2>
          </div>
          <div><input  type="text" id="<?php echo $element['name']; ?>_title_0" class="diagram_title_group" value="" /></div>
        </div>
        <!-- percent DESCRIPTION -->
        <div class="diagram-from-base_desc" style="margin-bottom:3%;">
          <div valign="middle">
            <h2><?php esc_html_e("Percent", WDWT_LANG); ?></h2>
          </div>
          <div>
            <input type="text" class="diagram_percent_group" id="<?php echo $element['name']; ?>_percent_0"  value="" />% 
            <input type="button" class="<?php echo $element['name']; ?>_remove-percent wdwt_btn_red" id="<?php echo $element['name']; ?>_remove-button_0" value="<?php esc_attr_e("Remove this percent", WDWT_LANG); ?>"  />
          </div>
        </div>
      </div>
      
      <div class="diagram-controls">
        <div>
          <input type="hidden" name="<?php echo $optionname_title; ?>" id="<?php echo $element['name']; ?>_titles" data-customize-setting-link="<?php echo $optionname_title; ?>" value="<?php echo esc_attr($diagram_title); ?>" >
          <input type="hidden" name="<?php echo $optionname_percent; ?>" id="<?php echo $element['name']; ?>_percents" data-customize-setting-link="<?php echo $optionname_percent; ?>" value="<?php echo esc_attr($diagram_percent); ?>" >
          <input class="add_percent wdwt_btn_blue" type="button" id="<?php echo $element['name']; ?>_add-button" value="<?php esc_attr_e('Add new percent value', WDWT_LANG); ?>" />
        </div>
      </div>
    </div>
    <script type="text/javascript">
    jQuery(document).ready(function(){ 

      var element_<?php echo $element["name"]; ?> = {
        id : "<?php echo $element['name']; ?>",
        titles : jQuery('#<?php echo $element['name']; ?>_titles').val(),
        percents : jQuery('#<?php echo $element['name']; ?>_percents').val(),
        active : 0,
        number_percents :  wdwt_elements.diagram.len(jQuery('#<?php echo $element['name']; ?>_titles').val()),
        };
      /*init show*/
      wdwt_elements.diagram.init(element_<?php echo $element["name"]; ?>);
      wdwt_elements.diagram.show(element_<?php echo $element["name"]; ?>);
      /*watch for changes in values*/
      jQuery("#wdwt_wrap_<?php echo $element['name']; ?>").on("change", ".diagram_title_group", function (){
        var index = wdwt_elements.diagram.find_index(jQuery(this), "<?php echo $element['name']; ?>_title_");
        wdwt_elements.diagram.edit(element_<?php echo $element["name"]; ?>, index,  "title");
      });
      jQuery("#wdwt_wrap_<?php echo $element['name']; ?>").on("change", ".diagram_percent_group", function (){
        var index = wdwt_elements.diagram.find_index(jQuery(this), "<?php echo $element['name']; ?>_percent_");
        wdwt_elements.diagram.edit(element_<?php echo $element["name"]; ?>, index, "percent");
      });
      /*add new percent*/
      jQuery("#<?php echo $element['name']; ?>_add-button").on('click', function(){
        console.log('call');
        after = element_<?php echo $element["name"]; ?>.number_percents-1;
        wdwt_elements.diagram.insert(element_<?php echo $element["name"]; ?>, after, '');
      });
      /*remove percent*/
      jQuery("#wdwt_wrap_<?php echo $element['name']; ?>").on('click', ".<?php echo $element['name']; ?>_remove-percent", function(){
        var index = wdwt_elements.diagram.find_index(jQuery(this), "<?php echo $element['name']; ?>_remove-button_");                
        element_<?php echo $element["name"]; ?>.active = index;
        wdwt_elements.diagram.remove(element_<?php echo $element["name"]; ?>);
      });
    });
    </script>     
    <?php
  }


 public static function html_page_nav($count_items, $page_number, $form_id, $items_per_page = 20) {
    $limit = 20;
    if ($count_items) {
      if ($count_items % $limit) {
        $items_county = ($count_items - $count_items % $limit) / $limit + 1;
      }
      else {
        $items_county = ($count_items - $count_items % $limit) / $limit;
      }
    }
    else {
      $items_county = 1;
    }
    ?>
    <script type="text/javascript">
      var items_county = <?php echo $items_county; ?>;
      function wdi_spider_page(x, y) {       
        switch (y) {
          case 1:
            if (x >= items_county) {
              document.getElementById('page_number').value = items_county;
            }
            else {
              document.getElementById('page_number').value = x + 1;
            }
            break;
          case 2:
            document.getElementById('page_number').value = items_county;
            break;
          case -1:
            if (x == 1) {
              document.getElementById('page_number').value = 1;
            }
            else {
              document.getElementById('page_number').value = x - 1;
            }
            break;
          case -2:
            document.getElementById('page_number').value = 1;
            break;
          default:
            document.getElementById('page_number').value = 1;
        }
        document.getElementById('<?php echo $form_id; ?>').submit();
      }
      function check_enter_key(e) {
        var key_code = (e.keyCode ? e.keyCode : e.which);
        if (key_code == 13) { /*Enter keycode*/
          if (jQuery('#current_page').val() >= items_county) {
           document.getElementById('page_number').value = items_county;
          }
          else {
           document.getElementById('page_number').value = jQuery('#current_page').val();
          }
          document.getElementById('<?php echo $form_id; ?>').submit();
        }
        return true;
      }
    </script>
    <div class="tablenav-pages">
      <span class="displaying-num">
        <?php
        if ($count_items != 0) {
          echo $count_items; ?> item<?php echo (($count_items == 1) ? '' : 's');
        }
        ?>
      </span>
      <?php
      if ($count_items > $items_per_page) {
        $first_page = "first-page";
        $prev_page = "prev-page";
        $next_page = "next-page";
        $last_page = "last-page";
        if ($page_number == 1) {
          $first_page = "first-page disabled";
          $prev_page = "prev-page disabled";
          $next_page = "next-page";
          $last_page = "last-page";
        }
        if ($page_number >= $items_county) {
          $first_page = "first-page ";
          $prev_page = "prev-page";
          $next_page = "next-page disabled";
          $last_page = "last-page disabled";
        }
      ?>
      <span class="pagination-links">
        <a class="<?php echo $first_page; ?>" title="Go to the first page" href="javascript:wdi_spider_page(<?php echo $page_number; ?>,-2);">«</a>
        <a class="<?php echo $prev_page; ?>" title="Go to the previous page" href="javascript:wdi_spider_page(<?php echo $page_number; ?>,-1);">‹</a>
        <span class="paging-input">
          <span class="total-pages">
          <input class="current_page" id="current_page" name="current_page" value="<?php echo $page_number; ?>" onkeypress="return check_enter_key(event)" title="Go to the page" type="text" size="1" />
        </span> of 
        <span class="total-pages">
            <?php echo $items_county; ?>
          </span>
        </span>
        <a class="<?php echo $next_page ?>" title="Go to the next page" href="javascript:wdi_spider_page(<?php echo $page_number; ?>,1);">›</a>
        <a class="<?php echo $last_page ?>" title="Go to the last page" href="javascript:wdi_spider_page(<?php echo $page_number; ?>,2);">»</a>
        <?php
      }
      ?>
      </span>
    </div>
    <input type="hidden" id="page_number" name="page_number" value="<?php echo ((isset($_POST['page_number'])) ? (int) $_POST['page_number'] : 1); ?>" />
    <input type="hidden" id="search_or_not" name="search_or_not" value="<?php echo ((isset($_POST['search_or_not'])) ? esc_html($_POST['search_or_not']) : ''); ?>"/>
    <?php
  }



  /**
  *
  *
  *
  */

    
    
  private function merge_params($param_begin_low_prioritet,$param_last_high_priorete){
    $new_param=array();
    foreach($param_begin_low_prioritet as $key=>$value){
      if(isset($param_last_high_priorete[$key])){
        $new_param[$key]=$param_last_high_priorete[$key];
      }
      else{
        $new_param[$key]=$value;
      }
    }
    return $new_param;
  }

  private function custom_attrs($element = array()){
    $attrs_array = isset($element['custom_attrs']) ? $element['custom_attrs'] : array();

    foreach ($attrs_array as $attr => $value) {
      echo esc_html($attr).'="'.esc_attr($value).'" ';
    }


  }

  /**
   * get posts and categories createdwith checkboxes
   */
  protected function get_old_posts_cats($val){

    $value = $val;
    $val = json_decode( $val , true );
    $result = array();

    if( $val == NULL ){ 
       if(is_string($value)){
        $result = explode(",", $value);
       }
    } else {
      $result = $val;
    }
    return $result;
     
  }

  
}



?>