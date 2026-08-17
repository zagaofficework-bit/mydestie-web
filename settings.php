<?php $page_title="Settings";

include("includes/header.php");

  // Get settings		
$qry="SELECT * FROM tbl_settings WHERE `id`='1'";
$result=mysqli_query($mysqli,$qry);
$settings_row=mysqli_fetch_assoc($result);

  // Update app settings	
if(isset($_POST['submit']))
{

  $img_res=mysqli_query($mysqli,"SELECT * FROM tbl_settings WHERE `id`='1'");
  $img_row=mysqli_fetch_assoc($img_res);

  if($_FILES['app_logo']['name']!="")
  {        

    unlink('images/'.$img_row['app_logo']);   

    $app_logo=$_FILES['app_logo']['name'];
    $pic1=$_FILES['app_logo']['tmp_name'];

    $tpath1='images/'.$app_logo;      
    copy($pic1,$tpath1);


    $data = array(      
      'app_from_email'  =>  '-',   
      'app_name'  =>  cleanInput($_POST['app_name']),
      'app_logo'  =>  $app_logo,  
      'app_description'  => addslashes($_POST['app_description']),
      'app_version'  =>  cleanInput($_POST['app_version']),
      'app_author'  =>  cleanInput($_POST['app_author']),
      'app_contact'  =>  cleanInput($_POST['app_contact']),
      'app_email'  => cleanInput($_POST['app_email']),   
      'app_website'  =>  cleanInput($_POST['app_website']),
      'app_developed_by'  =>  cleanInput($_POST['app_developed_by'])                     

    );

  }
  else
  {
    $data = array(      
      'app_from_email'  =>  '-',   
      'app_name'  =>  cleanInput($_POST['app_name']),
      'app_description'  => addslashes($_POST['app_description']),
      'app_version'  =>  cleanInput($_POST['app_version']),
      'app_author'  =>  cleanInput($_POST['app_author']),
      'app_contact'  =>  cleanInput($_POST['app_contact']),
      'app_email'  => cleanInput($_POST['app_email']),   
      'app_website'  =>  cleanInput($_POST['app_website']),
      'app_developed_by'  =>  cleanInput($_POST['app_developed_by'])                     

    );
  } 

  $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
  
  $_SESSION['msg']="11";
  header( "Location:settings.php");
  exit;
  
}

 // Update admob settings
else if(isset($_POST['admob_submit']))
{	

   $data = array(
          'publisher_id'  =>  $_POST['publisher_id'],
          'interstital_ad'  =>  ($_POST['interstital_ad']) ? 'true' : 'false',
          'interstital_ad_id'  =>  $_POST['interstital_ad_id'],
          'interstital_facebook_id'  =>  cleanInput($_POST['interstital_facebook_id']),
          'interstital_ad_click'  =>  $_POST['interstital_ad_click'],
          'interstitial_unity_id'  =>  cleanInput($_POST['interstitial_unity_id']),
          'interstitial_applovin_id'  =>  cleanInput($_POST['interstitial_applovin_id']),
          'interstitial_wortise_id'  =>  cleanInput($_POST['interstitial_wortise_id']),


          'banner_ad'  =>  ($_POST['banner_ad']) ? 'true' : 'false',
          'banner_ad_id'  =>  $_POST['banner_ad_id'],
          'banner_facebook_id'  =>  cleanInput($_POST['banner_facebook_id']),
          'banner_unity_id'  =>  cleanInput($_POST['banner_unity_id']),
          'banner_applovin_id'  =>  cleanInput($_POST['banner_applovin_id']),
          'banner_wortise_id'  =>  cleanInput($_POST['banner_wortise_id']),

          'nativ_ad'  =>  ($_POST['nativ_ad']) ? 'true' : 'false',
          'nativ_ad_id'  =>  $_POST['nativ_ad_id'],
          'nativ_facebook_id'  =>  cleanInput($_POST['nativ_facebook_id']),
          'nativ_ad_click'  =>  $_POST['nativ_ad_click'],
          'nativ_applovin_id'  =>  cleanInput($_POST['nativ_applovin_id']),
          'native_wortise_id'  =>  cleanInput($_POST['nativ_wortise_id']),

          'unity_game_id' => cleanInput($_POST['unity_game_id']),
          'start_ads_id' => cleanInput($_POST['start_ads_id']),
          'android_ad_network' => cleanInput($_POST['ad_type'])
          );

      $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");

      $_SESSION['msg']="11";
      header( "Location:settings.php");
      exit;
}

  // Update api settings
else if(isset($_POST['api_submit']))
{

  $data = array(
   'api_page_limit'  =>  cleanInput($_POST['api_page_limit']),
   'api_cat_order_by'  =>  cleanInput($_POST['api_cat_order_by']),
   'api_cat_post_order_by'  =>  cleanInput($_POST['api_cat_post_order_by'])
 );

  $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");

  $_SESSION['msg']="11";
  header( "Location:settings.php");
  exit;
}
 // Update app update popup 
else if(isset($_POST['app_update_popup']))
{

  $data = array(
    'app_update_status'  =>  ($_POST['app_update_status']) ? 'true' : 'false',
    'app_new_version'  =>  trim($_POST['app_new_version']),
    'app_update_desc'  =>  trim($_POST['app_update_desc']),
    'app_redirect_url'  =>  trim($_POST['app_redirect_url']),
    'cancel_update_status'  =>  ($_POST['cancel_update_status']) ? 'true' : 'false',

    'app_update_status_ios'  =>  ($_POST['app_update_status_ios']) ? 'true' : 'false',
    'app_new_version_ios'  =>  trim($_POST['app_new_version_ios']),
    'app_update_desc_ios'  =>  trim($_POST['app_update_desc_ios']),
    'app_redirect_url_ios'  =>  trim($_POST['app_redirect_url_ios']),
    'cancel_update_status_ios'  =>  ($_POST['cancel_update_status_ios']) ? 'true' : 'false'
  );

  $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");

  $_SESSION['msg']="11";
  header("Location:settings.php");
  exit;

}
  // Update app privacy policy
else if(isset($_POST['app_pri_poly']))
{
  $data = array(
    'app_privacy_policy'  =>  addslashes($_POST['app_privacy_policy']) 
  );

  $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");

  $_SESSION['msg']="11";
  header( "Location:settings.php");
  exit;
}
 // Update delete intruction start
else if(isset($_POST['account_delete'])){

  $data = array(
    'account_delete_intruction'  =>  trim($_POST['account_delete_intruction'])
  );

  $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");

  $_SESSION['msg'] = "11";
  header( "Location:settings.php");
  exit;
} 
// Update delete intruction end 

?>

<style type="text/css">
  .field_lable {
    margin-bottom: 10px;
    margin-top: 10px;
    color: #666;
    padding-left: 15px;
    font-size: 14px;
    line-height: 24px;
  }
  .banner_ads_block .toggle_btn, .interstital_ad_item .toggle_btn{
    margin-top: 6px;
  }
  .lbl{
    left: 13px;
  }
  .video_setting_item{
   background: #f7f7f7;
   border:1px solid rgba(0, 0, 0, 0.1);
   margin-top:0px;
   padding:10px 20px;
   margin-bottom: 10px;
   border-radius:6px;	
 }
</style>
<div class="row">
  <div class="col-md-12">
  	<?php
   if(isset($_SERVER['HTTP_REFERER']))
   {
    echo '<a href="'.$_SERVER['HTTP_REFERER'].'"><h4 class="pull-left" style="font-size: 20px;color: #e91e63"><i class="fa fa-arrow-left"></i> Back</h4></a>';
  }
  ?>
  <div class="card">
   <div class="page_title_block">
    <div class="col-md-5 col-xs-12">
      <div class="page_title"><?=$page_title?></div>
    </div>
  </div>
  <div class="clearfix"></div>

  <div class="card-body mrg_bottom" style="padding: 0px">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" lass="active"><a href="#app_settings" aria-controls="app_settings" role="tab" data-toggle="tab">App Settings</a></li>
      <li role="presentation"><a href="#ad_settings" aria-controls="ad_settings" role="tab" data-toggle="tab">Ads Settings</a></li>
      <li role="presentation"><a href="#api_settings" aria-controls="api_settings" role="tab" data-toggle="tab">API Settings</a></li>
      <li role="presentation"><a href="#account_delete" aria-controls="account_delete" role="tab" data-toggle="tab">Delete Account Instructions</a></li>
      <li role="presentation"><a href="#api_privacy_policy" aria-controls="api_privacy_policy" role="tab" data-toggle="tab">App Privacy Policy</a></li>
      <li role="presentation"><a href="#app_update_popup" aria-controls="app_update_popup" role="tab" data-toggle="tab">App Update Popup</a></li>

    </ul>
    <div class="rows">
      <div class="col-md-12">
       <div class="tab-content">
         <div role="tabpanel" class="tab-pane active" id="app_settings">   
           <form action="" name="settings_from" method="post" class="form form-horizontal" enctype="multipart/form-data">
             <div class="section">
               <div class="section-body">
                 <div class="form-group">
                   <label class="col-md-3 control-label">App Name :-</label>
                   <div class="col-md-6">
                     <input type="text" name="app_name" id="app_name" value="<?php echo $settings_row['app_name'];?>" class="form-control">
                   </div>
                 </div>
                 <div class="form-group">
                   <label class="col-md-3 control-label">App Logo :- <p class="control-label-help">(Recommended resolution: 80X80, 90x90)</p></label>
                   <div class="col-md-6">
                     <div class="fileupload_block">
                      <input type="file" name="app_logo" id="fileupload" onchange="readURL(this)">
                      <?php if($settings_row['app_logo']!="") {?>
                       <div class="fileupload_img"><img type="image" id="app_logo" src="images/<?php echo $settings_row['app_logo'];?>" alt="image" style="width: 90px;" /></div>
                     <?php } else {?>
                       <div class="fileupload_img"><img id="app_logo" type="image" src="assets/images/portrait.jpg" alt="image" style="width: 90px;"/></div>
                     <?php }?>
                   </div>
                 </div>
               </div>
               <div class="form-group">
                 <label class="col-md-3 control-label">App Description :-</label>
                 <div class="col-md-6">

                   <textarea name="app_description" id="app_description" class="form-control"><?php echo $settings_row['app_description'];?></textarea>

                   <script>CKEDITOR.replace( 'app_description' );</script>
                 </div>
               </div>
               <div class="form-group">&nbsp;</div>                 
               <div class="form-group">
                 <label class="col-md-3 control-label">App Version :-</label>
                 <div class="col-md-6">
                   <input type="text" name="app_version" id="app_version" value="<?php echo $settings_row['app_version'];?>" class="form-control">
                 </div>
               </div>
               <div class="form-group">
                 <label class="col-md-3 control-label">Author :-</label>
                 <div class="col-md-6">
                   <input type="text" name="app_author" id="app_author" value="<?php echo $settings_row['app_author'];?>" class="form-control">
                 </div>
               </div>
               <div class="form-group">
                 <label class="col-md-3 control-label">Contact :-</label>
                 <div class="col-md-6">
                   <input type="text" name="app_contact" id="app_contact" value="<?php echo $settings_row['app_contact'];?>" class="form-control">
                 </div>
               </div>     
               <div class="form-group">
                 <label class="col-md-3 control-label">Email :-</label>
                 <div class="col-md-6">
                   <input type="text" name="app_email" id="app_email" value="<?php echo $settings_row['app_email'];?>" class="form-control">
                 </div>
               </div>                 
               <div class="form-group">
                 <label class="col-md-3 control-label">Website :-</label>
                 <div class="col-md-6">
                   <input type="text" name="app_website" id="app_website" value="<?php echo $settings_row['app_website'];?>" class="form-control">
                 </div>
               </div> 
               <div class="form-group">
                 <label class="col-md-3 control-label">Developed By :-</label>
                 <div class="col-md-6">
                   <input type="text" name="app_developed_by" id="app_developed_by" value="<?php echo $settings_row['app_developed_by'];?>" class="form-control">
                 </div>
               </div> 
               <div class="form-group">
                 <div class="col-md-9 col-md-offset-3">
                   <button type="submit" name="submit" class="btn btn-primary">Save</button>
                 </div>
               </div>
             </div>
           </div>
         </form>
       </div>

           <!-- ad settings -->
  
        <div role="tabpanel" class="tab-pane" id="ad_settings">
                <form action="" name="ad_settings" method="post" class="form form-horizontal" enctype="multipart/form-data">
                  <div class="section">
                    <div class="section-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="col-md-4 control-label">Ad Network:-</label>
                                <div class="col-md-8">
                                  <select name="ad_type" id="ad_type" class="select2">
                                    <option value="admob" <?php if ($settings_row['android_ad_network'] == 'admob') {
                                                            echo 'selected="selected"';
                                                          } ?>>Admob</option>
                                    <option value="facebook" <?php if ($settings_row['android_ad_network'] == 'facebook') {
                                                                echo 'selected="selected"';
                                                              } ?>>Facebook</option>
                                    <option value="startapp" <?php if ($settings_row['android_ad_network'] == 'startapp') {
                                                                echo 'selected="selected"';
                                                              } ?>>StartApp</option>
                                    <option value="unityds" <?php if ($settings_row['android_ad_network'] == 'unityds') {
                                                                echo 'selected="selected"';
                                                              } ?>>Unity Ads</option>
                                                        
                                    <option value="applovins" <?php if ($settings_row['android_ad_network'] == 'applovins') {
                                                                echo 'selected="selected"';
                                                              } ?>>AppLovin's MAX</option>
                                    <option value="wortise" <?php if ($settings_row['android_ad_network'] == 'wortise') {
                                                                echo 'selected="selected"';
                                                              } ?>>Wortise</option>                          
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group publisher_id">
                                <label class="col-md-4 control-label">Publisher ID :-</label>
                                <div class="col-md-8">
                                  <input type="text" name="publisher_id" id="publisher_id" value="<?php echo $settings_row['publisher_id']; ?>" class="form-control">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="col-md-4 control-label start_ads_id" style="display: none">StartApp App ID:-</label>
                                <div class="col-md-8 start_ads_id" style="display: none">
                                  <input type="text" name="start_ads_id" id="start_ads_id" value="<?php echo $settings_row['start_ads_id']; ?>" class="form-control">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="col-md-4 control-label unity_game_id" style="display: none">Unity Game ID:-</label>
                                <div class="col-md-8 unity_game_id" style="display: none">
                                  <input type="text" name="unity_game_id" id="unity_game_id" value="<?php echo $settings_row['unity_game_id']; ?>" class="form-control">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="banner_ads_block">
                                <div class="banner_ad_item">
                                  <label class="control-label">Banner Ads :-</label>
                                  <div class="row toggle_btn" style="position: relative;margin-top: -8px;">
                                    <input type="checkbox" id="chk_banner" name="banner_ad" value="true" class="cbx hidden" <?= ($settings_row['banner_ad'] == 'true') ? 'checked=""' : '' ?>>
                                    <label for="chk_banner" class="lbl"></label>
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <p class="field_lable labels" style="padding-left:15px;">Banner ID :-</p>
                                    <div class="col-md-12 banner_ad_id" style="display: none">
                                      <input type="text" name="banner_ad_id" id="banner_ad_id" value="<?php echo $settings_row['banner_ad_id']; ?>" class="form-control">
                                    </div>
                                    <div class="col-md-12 banner_facebook_id" style="display: none">
                                      <input type="text" name="banner_facebook_id" id="banner_facebook_id" value="<?php echo $settings_row['banner_facebook_id']; ?>" class="form-control">
                                    </div>

                                    <div class="col-md-12 banner_unity_id" style="display: none">
                                      <input type="text" name="banner_unity_id" id="banner_unity_id" value="<?php echo $settings_row['banner_unity_id']; ?>" class="form-control">
                                    </div>

                                    <div class="col-md-12 banner_applovin_id" style="display: none">
                                      <input type="text" name="banner_applovin_id" id="banner_applovin_id" value="<?php echo $settings_row['banner_applovin_id']; ?>" class="form-control">
                                    </div>

                                    <div class="col-md-12 banner_wortise_id" style="display: none">
                                      <input type="text" name="banner_wortise_id" id="banner_wortise_id" value="<?php echo $settings_row['banner_wortise_id']; ?>" class="form-control">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="interstital_ads_block">
                                <div class="interstital_ad_item">
                                  <label class="control-label">Interstitial Ads :-</label>
                                  <div class="row toggle_btn" style="position: relative;margin-top: -8px;">
                                    <input type="checkbox" id="chk_interstitial" name="interstital_ad" value="true" class="cbx hidden" <?php if ($settings_row['interstital_ad'] == 'true') { ?>checked <?php } ?> />
                                    <label for="chk_interstitial" class="lbl"></label>
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <p class="field_lable labels" style="padding-left:15px;">Interstitial Ad ID :-</p>
                                    <div class="col-md-12 interstital_ad_id" style="display: none">
                                      <input type="text" name="interstital_ad_id" id="interstital_ad_id" value="<?php echo $settings_row['interstital_ad_id']; ?>" class="form-control">
                                    </div>

                                    <div class="col-md-12 interstital_facebook_id" style="display: none">
                                      <input type="text" name="interstital_facebook_id" id="interstital_facebook_id" value="<?php echo $settings_row['interstital_facebook_id']; ?>" class="form-control">
                                    </div>

                                    <div class="col-md-12 interstitial_unity_id" style="display: none">
                                      <input type="text" name="interstitial_unity_id" id="interstitial_unity_id" value="<?php echo $settings_row['interstitial_unity_id']; ?>" class="form-control">
                                    </div>

                                    <div class="col-md-12 interstitial_applovin_id" style="display: none">
                                      <input type="text" name="interstitial_applovin_id" id="interstitial_applovin_id" value="<?php echo $settings_row['interstitial_applovin_id']; ?>" class="form-control">
                                    </div>

                                    <div class="col-md-12 interstitial_wortise_id" style="display: none">
                                      <input type="text" name="interstitial_wortise_id" id="interstitial_wortise_id" value="<?php echo $settings_row['interstitial_wortise_id']; ?>" class="form-control">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <p class="field_lable " style="padding-left:15px;">Interstitial Clicks :-</p>
                                    <div class="col-md-12">
                                      <input type="text" name="interstital_ad_click" id="interstital_ad_click" value="<?php echo $settings_row['interstital_ad_click']; ?>" class="form-control">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-4">
                              <div class="interstital_ads_block native_ads_block">
                                <div class="interstital_ad_item">
                                  <label class="control-label">Nativ Ads :-</label>
                                  <div class="row toggle_btn" style="position: relative;margin-top: -8px;">
                                    <input type="checkbox" id="chk_nativ" name="nativ_ad" value="true" class="cbx hidden" <?php if ($settings_row['nativ_ad'] == 'true') { ?>checked <?php } ?> />
                                    <label for="chk_nativ" class="lbl"></label>
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <p class="field_lable labels" style="padding-left:15px;">Nativ Ad ID :-</p>
                                    <div class="col-md-12 nativ_ad_id" style="display: none">
                                      <input type="text" name="nativ_ad_id" id="nativ_ad_id" value="<?php echo $settings_row['nativ_ad_id']; ?>" class="form-control">
                                    </div>

                                    <div class="col-md-12 nativ_facebook_id" style="display: none">
                                      <input type="text" name="nativ_facebook_id" id="nativ_facebook_id" value="<?php echo $settings_row['nativ_facebook_id']; ?>" class="form-control">
                                    </div>

                                    <div class="col-md-12 nativ_applovin_id" style="display: none">
                                      <input type="text" name="nativ_applovin_id" id="nativ_applovin_id" value="<?php echo $settings_row['nativ_applovin_id']; ?>" class="form-control">
                                    </div>

                                    <div class="col-md-12 nativ_wortise_id" style="display: none">
                                      <input type="text" name="nativ_wortise_id" id="nativ_wortise_id" value="<?php echo $settings_row['native_wortise_id']; ?>" class="form-control">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <p class="field_lable " style="padding-left:15px;">Nativ Ad Position :-</p>
                                    <div class="col-md-12">
                                      <input type="text" name="nativ_ad_click" id="nativ_ad_click" value="<?php echo $settings_row['nativ_ad_click']; ?>" class="form-control">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-9">
                          <button type="submit" name="admob_submit" class="btn btn-primary">Save</button>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="alert alert-danger alert-dismissible fade in mt-80" role="alert" style="margin-top:20px;">
                            <h4 id="oh-snap!-you-got-an-error!">Ads Instruction:<a class="anchorjs-link" href="#oh-snap!-you-got-an-error!"><span class="anchorjs-icon"></span></a></h4>
                            <p style="margin-bottom: 10px">
                              <i class="fa fa-hand-o-right"></i> Admob= Add all your ad unit id(Banner,Interstitial,Native)
                            </p>
                            <p style="margin-bottom: 10px">
                              <i class="fa fa-hand-o-right"></i> Facebook Audience Network=Use Facebook Audience Network then please select ad network Admob(Facebook Audience Network will switch to Bidding).<br /><br />
                              Follow this url to use Facebook Audience Network bidding with Admob, Follow Step-1 and Step-2 - as described in link.<br />
                              <a href="https://developers.google.com/admob/android/mediation/facebook?fbclid=IwAR0cZxXNjE0EY-TsWA1aNzM0oV3KAhf3zz4fUajoiESN8V2My6wA42xSBhU" target="_blank">Integrationg Facebook Audience Network with Mediation</a>
                            </p>
                            <p style="margin-bottom: 10px"><i class="fa fa-hand-o-right"></i> StartApp= Add startapp app id (Only require startapp app id does not required separate id)</p>
                            <p style="margin-bottom: 10px"><i class="fa fa-hand-o-right"></i> Unity Ads= Add Unity Game Id and other ad unit id(Only banner and interstitial ad support doest not support native ad)</p>
                            <p style="margin-bottom: 10px"><i class="fa fa-hand-o-right"></i> AppLovin's MAX= Add all your ad unit id(Banner,Interstitial,Native)</p>
                            <p style="margin-bottom: 10px"><i class="fa fa-hand-o-right"></i> Wortise= Add all your ad unit id(Banner,Interstitial,Native)  
                              <a href="https://dashboard.wortise.com/auth/sign-up?referrer=b8cf48ce-a1fe-4c76-b9f9-80c9a4732c21" target="_blank">Wortise Login Link</a></p>
                            <br />
                            <h4 id="oh-snap!-you-got-an-error!">Note:<a class="anchorjs-link" href="#oh-snap!-you-got-an-error!"><span class="anchorjs-icon"></span></a></h4>
                            <p style="margin-bottom: 10px"><i class="fa fa-hand-o-right"></i> AdMob= Add your admob App Id in <strong>Android Source Code strings.xml</strong> file.</p>
                            <p style="margin-bottom: 10px"><i class="fa fa-hand-o-right"></i> AppLovin's MAX= Add your Applovin Sdk Key in <strong>Android Source Code strings.xml</strong> file.</p>
                            <p style="margin-bottom: 10px"><i class="fa fa-hand-o-right"></i> Wortise= Add your wortise app id in <strong>Android Source Code strings.xml</strong> file.</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
        
<div role="tabpanel" class="tab-pane" id="app_update_popup">   
  <form action="" name="app_update_popup" method="post" class="form form-horizontal" enctype="multipart/form-data">
    <div class="section">
      <div class="section-body">            
        <div class="row">
          <div class="col-md-6">                
            <div class="admob_title">Android</div>
            <div class="form-group">
              <div class="col-md-12"> 
               <div class="video_setting_item">
                 <div class="row" style="padding: 0px;margin-top: 10px">
                  <label class="col-md-10 control-label" style="padding-top: 6px">App Update Popup Show/Hide:-
                   <p class="control-label-help" style="color:#F00">You can show/hide update popup from this option</p>
                 </label>
                 <div class="col-md-2">
                   <input type="checkbox" id="chk_update" name="app_update_status" value="true" class="cbx hidden" <?php if($settings_row['app_update_status']=='true'){ echo 'checked'; }?>/>
                   <label for="chk_update" class="lbl" style="left:13px;margin-top: 20px;"></label>
                 </div>
               </div>
             </div>
             <div class="video_setting_item">
               <div class="row" style="padding: 0px;margin-top: 10px">
                <label class="col-md-6 control-label" style="padding-top: 6px">New App Version Code:-
                  <a href="assets/images/android_version_code.png" target="_blank"><p class="control-label-help" style="color:#F00">How to get version code</p></a>
                </label>
                <div class="col-md-11">
                 <input type="number" min="1" name="app_new_version" id="app_new_version" required="" value="<?php echo $settings_row['app_new_version'];?>" class="form-control">								
               </div>
             </div>
           </div>
           <div class="video_setting_item">
             <div class="row" style="padding: 0px;margin-top: 10px">
              <label class="col-md-6 control-label" style="padding-top: 6px;margin-bottom:8px">Description:-</label>
              <div class="col-md-11">
                <textarea name="app_update_desc" class="form-control"><?php echo $settings_row['app_update_desc'];?></textarea>
              </div>
            </div>
          </div>
          <div class="video_setting_item">
           <div class="row" style="padding: 0px;margin-top: 10px">
            <label class="col-md-6 control-label" style="padding-top: 6px">App Link:-
              <p style="color: red">You will be redirect on this link after click on updaten</p>
            </label>
            <div class="col-md-11">
              <input type="text" name="app_redirect_url" id="app_redirect_url" required="" value="<?php echo $settings_row['app_redirect_url'];?>" class="form-control">
            </div>
          </div>
        </div>
        <div class="video_setting_item">
         <div class="row" style="padding: 0px;margin-top: 10px">
          <label class="col-md-10 control-label" style="padding-top: 6px">Cancel Option:-
           <p class="control-label-help" style="color:#F00">Cancel button option will show in app update popup</p>
         </label>
         <div class="col-md-2">
          <input type="checkbox" id="chk_cancel_update" name="cancel_update_status" value="true" class="cbx hidden" <?php if($settings_row['cancel_update_status']=='true'){ echo 'checked'; }?>/>
          <label for="chk_cancel_update" class="lbl" style="left:13px;margin-top: 20px;"></label>
        </div>
      </div>
    </div>
  </div>
</div>
</div>  

<div class="col-md-6">                
  <div class="admob_title">iOS</div>
  <div class="form-group">
    <div class="col-md-12"> 
     <div class="video_setting_item">
       <div class="row" style="padding: 0px;margin-top: 10px">
        <label class="col-md-10 control-label" style="padding-top: 6px">App Update Popup Show/Hide:-
         <p class="control-label-help" style="color:#F00">You can show/hide update popup from this option</p>
       </label>
       <div class="col-md-2">
         <input type="checkbox" id="chk_update_ios" name="app_update_status_ios" value="true" class="cbx hidden" <?php if($settings_row['app_update_status_ios']=='true'){ echo 'checked'; }?>/>
         <label for="chk_update_ios" class="lbl" style="left:13px;margin-top: 20px;"></label>
       </div>
     </div>
   </div>
   <div class="video_setting_item">
     <div class="row" style="padding: 0px;margin-top: 10px">
      <label class="col-md-6 control-label" style="padding-top: 6px">New App Version Code:-
        <a href="assets/images/android_version_code.png" target="_blank"><p class="control-label-help" style="color:#F00">How to get version code</p></a>
      </label>
      <div class="col-md-11">
       <input type="number" min="1" name="app_new_version_ios" id="app_new_version_ios" required="" value="<?php echo $settings_row['app_new_version_ios'];?>" class="form-control">								
     </div>
   </div>
 </div>
 <div class="video_setting_item">
   <div class="row" style="padding: 0px;margin-top: 10px">
    <label class="col-md-6 control-label" style="padding-top: 6px;margin-bottom:8px">Description:-
    </label>
    <div class="col-md-11">
      <textarea name="app_update_desc_ios" class="form-control"><?php echo $settings_row['app_update_desc_ios'];?></textarea>
    </div>
  </div>
</div>
<div class="video_setting_item">
 <div class="row" style="padding: 0px;margin-top: 10px">
  <label class="col-md-6 control-label" style="padding-top: 6px">App Link:-
    <p style="color: red">You will be redirect on this link after click on updaten</p>
  </label>
  <div class="col-md-11">
    <input type="text" name="app_redirect_url_ios" id="app_redirect_url_ios" required="" value="<?php echo $settings_row['app_redirect_url_ios'];?>" class="form-control">
  </div>
</div>
</div>

<div class="video_setting_item">
 <div class="row" style="padding: 0px;margin-top: 10px">
  <label class="col-md-10 control-label" style="padding-top: 6px">Cancel Option:-
   <p class="control-label-help" style="color:#F00">Cancel button option will show in app update popup</p>
 </label>
 <div class="col-md-2">
  <input type="checkbox" id="chk_cancel_update_ios" name="cancel_update_status_ios" value="true" class="cbx hidden" <?php if($settings_row['cancel_update_status_ios']=='true'){ echo 'checked'; }?>/>
  <label for="chk_cancel_update_ios" class="lbl" style="left:13px;margin-top: 20px;"></label>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>                        
<div class="form-group">
 <div class="col-md-9 col-md-offset-0" style="margin-top:15px;">
  <button type="submit" name="app_update_popup" class="btn btn-primary">Save</button>
</div>
</div>
</div>
</form>
</div>
<div role="tabpanel" class="tab-pane" id="api_settings">   
  <form action="" name="settings_api" method="post" class="form form-horizontal" enctype="multipart/form-data" id="api_form">
    <input type="hidden" name="length" value="45">
    <div class="section">
      <div class="section-body">
        <div class="form-group">
          <label class="col-md-3 control-label">Pagination Limit:-</label>
          <div class="col-md-6">
            <input type="number" name="api_page_limit" id="api_page_limit" value="<?php echo $settings_row['api_page_limit'];?>" class="form-control"> 
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Category List Order By:-</label>
          <div class="col-md-6">
            <select name="api_cat_order_by" id="api_cat_order_by" class="select2">
              <option value="cid" <?php if($settings_row['api_cat_order_by']=='cid'){?>selected<?php }?>>ID</option>
              <option value="category_name" <?php if($settings_row['api_cat_order_by']=='category_name'){?>selected<?php }?>>Name</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Category Post Order By:-</label>
          <div class="col-md-6">
            <select name="api_cat_post_order_by" id="api_cat_post_order_by" class="select2">
              <option value="ASC" <?php if($settings_row['api_cat_post_order_by']=='ASC'){?>selected<?php }?>>ASC</option>
              <option value="DESC" <?php if($settings_row['api_cat_post_order_by']=='DESC'){?>selected<?php }?>>DESC</option>
              
            </select>
          </div>
        </div>
        <br>
        <div class="form-group">
          <div class="col-md-9 col-md-offset-3">
            <button type="submit" name="api_submit" class="btn btn-primary">Save</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<br> 
<div role="tabpanel" class="tab-pane" id="account_delete"> 
 <div class="rows">
   <form action="" method="post" class="form form-horizontal" enctype="multipart/form-data">
     <div class="section">
       <div class="section-body">
        <?php 
        if(file_exists('delete_instruction.php'))
        {
         ?>
         <div class="form-group">
           <label class="col-md-3 control-label">Account Delete Instructions URL :-</label>
           <div class="col-md-9">
             <input type="text" readonly class="form-control" value="<?=getBaseUrl().'delete_instruction.php'?>">
           </div>
         </div>
       <?php } ?>
       <div class="form-group">
         <label class="col-md-3 control-label">Account Delete Instructions :-</label>
         <div class="col-md-9">
           <textarea name="account_delete_intruction" id="account_delete_intruction" class="form-control"><?php echo stripslashes($settings_row['account_delete_intruction']);?></textarea>
           <script>CKEDITOR.replace('account_delete_intruction');</script>
         </div>
       </div>
       <br/>
       <div class="form-group">
         <div class="col-md-9 col-md-offset-3">
           <button type="submit" name="account_delete" class="btn btn-primary">Save</button>
         </div>
       </div>
       <br>
     </div>
   </div>
 </form>
</div>
</div>
<div role="tabpanel" class="tab-pane" id="api_privacy_policy">   
  <form action="" name="api_privacy_policy" method="post" class="form form-horizontal" enctype="multipart/form-data">
    <div class="section">
      <div class="section-body">
       <?php 
       if(file_exists('privacy_policy.php'))
       {
        ?>
        <div class="form-group">
          <label class="col-md-3 control-label">App Privacy Policy URL :-</label>
          <div class="col-md-9">
            <input type="text" readonly class="form-control" value="<?=getBaseUrl().'privacy_policy.php'?>">
          </div>
        </div>
      <?php } ?>
      <div class="form-group">
        <label class="col-md-3 control-label">App Privacy Policy :-</label>
        <div class="col-md-9">
          <textarea name="app_privacy_policy" id="privacy_policy" class="form-control"><?php echo $settings_row['app_privacy_policy'];?></textarea>
          <script>CKEDITOR.replace( 'privacy_policy' );</script>
        </div>
      </div>
      <br>
      <div class="form-group">
        <div class="col-md-9 col-md-offset-3" style="margin-bottom:20px;">
          <button type="submit" name="app_pri_poly" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>
</form>
</div>
</div>
<div class="clearfix"></div>
</div>
</div>   
</div>
</div>
</div>
</div>

<?php include("includes/footer.php");?>       

<script type="text/javascript">

  $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
    localStorage.setItem('activeTab', $(e.target).attr('href'));
    document.title = $(this).text()+" | <?=APP_NAME?>";
  });

  var activeTab = localStorage.getItem('activeTab');
  if(activeTab){
    $('.nav-tabs a[href="' + activeTab + '"]').tab('show');
  }

  $("input[name='app_logo']").change(function() {
    var file = $(this);

    if (file[0].files.length != 0) {
      if (isImage($(this).val())) {
        render_upload_image(this, $(this).next('.fileupload_img').find("img"));
      } else {
        $(this).val('');
        $('.notifyjs-corner').empty();
        $.notify('Only jpg/jpeg, png, gif files are allowed!', {
          position: "top center",
          className: 'error'
        });
      }
    }
  });

  $(document).ready(function(e) {
    var adType = $("select[name='ad_type']").val();

    if (adType === 'admob') {
      $(".publisher_id").show();
      $(".banner_ad_id").show();
      $(".interstital_ad_id").show();
      $(".native_ads_block").show();
      $(".nativ_ad_id").show();
  
    } else if (adType === 'facebook') {
      $(".publisher_id").show();
      $(".banner_facebook_id").show();
      $(".interstital_facebook_id").show();
      $(".native_ads_block").show();
      $(".nativ_facebook_id").show();
      
    } else if (adType === 'startapp') {
      $('.start_ads_id').show();
      $('.labels').hide();
      $(".publisher_id").hide();
    } else if (adType === 'unityds') {
      $('.banner_unity_id').show();
      $('.interstitial_unity_id').show();
      $('.unity_game_id').show();
      $('.native_ads_block').hide();
      $(".publisher_id").hide();
    }
     else if (adType === 'applovins') {
      $('.banner_applovin_id').show();
      $('.interstitial_applovin_id').show();
      $('.nativ_applovin_id').show();
      $(".native_ads_block").show(); 
      $(".publisher_id").hide();
    }
    else if (adType === 'wortise') {
      $('.banner_wortise_id').show();
      $('.interstitial_wortise_id').show();
      $('.nativ_wortise_id').show();
      $(".native_ads_block").show(); 
      $(".publisher_id").hide();
    }
  });

  $("select[name='ad_type']").change(function(e) {
    if ($(this).val() === 'admob') {
      $(".publisher_id").show();
      $(".banner_ad_id").show();
      $(".interstital_ad_id").show();
      $(".nativ_ad_id").show();
      $(".native_ads_block").show();

      //banner ads
      $(".banner_facebook_id").hide();
      $('.banner_unity_id').hide();
      $('.banner_applovin_id').hide();
      $('.banner_wortise_id').hide();

      //interstital ads
      $(".interstital_facebook_id").hide();
      $(".interstitial_unity_id").hide();
      $(".interstitial_applovin_id").hide();
      $(".interstitial_wortise_id").hide();

      //nativ ads
      $(".nativ_facebook_id").hide();
      $(".nativ_applovin_id").hide();
      $(".nativ_wortise_id").hide();

   
      //start ads
      $('.start_ads_id').hide();
      $('.labels').show();
      $('.unity_game_id').hide();

    } else if ($(this).val() === 'facebook') {
      $(".publisher_id").show();
      $(".banner_facebook_id").show();
      $(".interstital_facebook_id").show();
      $(".nativ_facebook_id").show();
      $(".native_ads_block").show();
      
      //start ads
      $('.start_ads_id').hide();
      $('.labels').show();
      $('.unity_game_id').hide();

      //banner ads disable
      $(".banner_ad_id").hide();
      $(".banner_unity_id").hide();
      $('.banner_applovin_id').hide();
      $('.banner_wortise_id').hide();

      //interstital
      $(".interstital_ad_id").hide();
      $(".interstitial_unity_id").hide();
      $(".interstitial_applovin_id").hide();
      $(".interstitial_wortise_id").hide();

      //nativ
      $(".nativ_ad_id").hide();
      $(".nativ_applovin_id").hide();
      $(".nativ_wortise_id").hide();

    } else if ($(this).val() === 'startapp') {
      $(".publisher_id").hide();
      $('.start_ads_id').show();
      $('.labels').hide();
      $('.unity_game_id').hide();

      //banner ads
      $(".banner_ad_id").hide();
      $(".banner_facebook_id").hide();
      $('.banner_unity_id').hide();
      $('.banner_applovin_id').hide();
      $('.banner_wortise_id').hide();

      //interstitial ads 
      $(".interstital_ad_id").hide();
      $(".interstital_facebook_id").hide();
      $('.interstitial_unity_id').hide();
      $('.interstitial_applovin_id').hide();
      $('.interstitial_wortise_id').hide();

      //nativ ads 
      $(".nativ_ad_id").hide();
      $(".nativ_facebook_id").hide();
      $('.nativ_applovin_id').hide();
      $('.nativ_wortise_id').hide();

    } else if ($(this).val() === 'unityds') {
      $(".publisher_id").hide();
      $('.banner_unity_id').show();
      $('.interstitial_unity_id').show();
      $('.unity_game_id').show();
      //start ads
      $('.start_ads_id').hide();
      $('.labels').show();

      //disable native ads
      $('.native_ads_block').hide();

      //banner
      $(".banner_ad_id").hide();
      $(".banner_facebook_id").hide();
      $('.banner_applovin_id').hide();
      $('.banner_wortise_id').hide();

      //interstitial
      $(".interstital_facebook_id").hide();
      $(".interstital_ad_id").hide();
      $('.interstitial_applovin_id').hide();
      $('.interstitial_wortise_id').hide();

    } else if ($(this).val() === 'applovins') {
      $('.banner_applovin_id').show();
      $('.interstitial_applovin_id').show();
      $('.nativ_applovin_id').show();
      $(".native_ads_block").show();
      $(".publisher_id").hide();

      //start ads
      $('.start_ads_id').hide();
      $('.unity_game_id').hide();

      $('.labels').show();

      //bannner ads disabled
      $(".banner_ad_id").hide();
      $('.banner_facebook_id').hide();
      $(".banner_unity_id").hide();
      $('.banner_wortise_id').hide();

      //interstitial
      $('.interstital_ad_id').hide();
      $('.interstital_facebook_id').hide();
      $('.interstitial_unity_id').hide();
      $('.interstitial_wortise_id').hide();

      //nativ
      $('.nativ_ad_id').hide();
      $('.nativ_facebook_id').hide();
      $('.nativ_wortise_id').hide();
    }
    else if ($(this).val() === 'wortise') {
      $('.banner_wortise_id').show();
      $('.interstitial_wortise_id').show();
      $('.nativ_wortise_id').show();
      $(".native_ads_block").show();
      $(".publisher_id").hide();

      //start ads
      $('.start_ads_id').hide();
      $('.unity_game_id').hide();

      $('.labels').show();

      //bannner ads disabled
      $(".banner_ad_id").hide();
      $('.banner_facebook_id').hide();
      $(".banner_unity_id").hide();
      $('.banner_applovin_id').hide();

      //interstitial
      $('.interstital_ad_id').hide();
      $('.interstital_facebook_id').hide();
      $('.interstitial_unity_id').hide();
      $('.interstitial_applovin_id').hide();

      //nativ
      $('.nativ_ad_id').hide();
      $('.nativ_facebook_id').hide();
      $('.nativ_applovin_id').hide();
    }
  });
 

</script>