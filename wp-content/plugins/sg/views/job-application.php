<script type="text/javascript">var $ = jQuery.noConflict();</script>

<div class="wrap">
<div><h2 class="job_application_title">Dear Customer:</h2></div>
<div class="clear"></div>

<div>We are always looking for great people to work with us. Please fill
out the form below so that we can evaluate your skills and get back to you
regarding any open positions.
</div>
<form onsubmit="return submitJobApplication();" id="job_application_form" enctype="multipart/form-data" name="job_application_form" method="post">
<div class="form_container">
   <div class="form_line">
      <div class="name">
      <label>Your Name *</label><br>
      <input type=text id="name" name="applicant_name" size=30"></div>
   </div>
   <div class="clear"></div>   
   <div class="form_line">
      <div class="email">
      <label>Your Email *</label><br>
      <input type=text id="email" name="email" size=30"></div>
   </div>
   <div class="clear"></div>   
   <div class="form_line">
      <div class="phone">
      <label>Your Phone *</label><br>
      <input type=text id="phone" name="phone" size=30"></div>
   </div>
   <div class="clear"></div>   
   <div class="form_line">
      <div class="question_text">
      <label>Tell us about work experience in our field *</label><br>
      <div class=""><textarea cols="40" rows="5" placeholder="" id="experience" name="experience"></textarea></div>
      </div>
   </div>
   <div class="clear"></div>   
   <div class="form_line">
      <div class="question_text">
      <label>Tell us about why you think you are good fit for our company </label><br>
      <div class=""><textarea cols="40" rows="5" placeholder="" name="pitch"></textarea></div>
      </div>
   </div>
   <div class="clear"></div>   
   <div class="form_line">
      <div class="question_text">
      <label>Upload your PDF or MS Word resume</label><br>
      <div class=""><input type=file id="resume" name="resume"></div>
      </div>
   </div>

</div>
<div class="clear"></div>
<div class="form_footer">
* indicates a required field.
</div>
<div class="action_container">
   <input type="submit" id="Submit" class="button-primary" value="<?php esc_attr_e('Apply Now') ?>" />&nbsp;&nbsp;
   <input type="hidden" name="cmd" value="submit">
   <?php wp_nonce_field('check_identity','identity'); ?>
</div>
</form>


<script type="text/javascript">


function submitJobApplication()
{   

   // validate
   var err = 0;

   var firstErrorField;
   var borderVal = "1px solid #dfdfdf";

   var requiredFields = new Array('name', 'email','phone','experience');

   var err = 0;

   $.each(requiredFields, function(key, value){
      
      var field = $("#" + value);

      if (!field.val()) {
          field.css("border", "2px solid red");
          err++; 
          if (!firstErrorField)
          {
              firstErrorField = value;
          }
      }
      else {
         field.css("border", borderVal);
       }
   });


   var email = $("#email");

   if (!isValidEmailAddress(email.val())) {
       email.css("border", "2px solid red");
       email.focus();
       err++;
   }

   if (err)
   {
      $("#" + firstErrorField).focus();
      return false;
   }

   // now submit.
   return true;
}

function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);

        return pattern.test(emailAddress);
 };

</script>

<style type="text/css">
.form_container{margin-top:30px; min-height:500px;}
.form_container h2{font-size:18px;}

.message {color: #b94a48;background-color:#f2dede;
   border:#eed3d7 solid 1px;
   border-radius: 5px;
   -moz-border-radius: 5px;
   padding: 10px;
   font-size: 13px;
   position: relative;
   margin: 0 0 15px 0;
}

.form_line{margin:8px 0;}
.form_line .header{font-size:14px;font-weight:bold;}
.form_line .product_col{float:left;margin:0 20px 0 0;width:150px;}
.form_line .qty_col {float:left;margin:0 20px 0 0; width:40px;display:table;}
.form_line .qty_col input{width:40px;}
.form_line .details_col {float:left;margin:0 20px 0 0;display:table;}
.form_line .details_col input{width:550px;}
.form_line .notes {margin-top:20px;}
.form_line a{text-decoration:none;}
.action_container{margin-top:20px;}
.question_radio input[type="radio"] {margin:0 5px 0 20px;vertical-align:middle;height: 1.2em; border: 0px; }
.question_checkbox input[type="checkbox"] {margin:0 5px 0 20px;vertical-align:middle; height: 1.2em; border: 0px; }
.question_text textarea { width: 600px !important; }

</style>
