
<?php
require_once('header.php');
$arrField = array('*');
$arrData = $objControl->getRecords('website_master', null, NULL, 'website_id', $arrField);

for($intIndex = 0; $intIndex < count($arrData); $intIndex++)
{
	$arrRecords[$arrData[$intIndex]['site_option']] = $arrData[$intIndex]['option_value'];
}

?>
<div>
	<ul class="breadcrumb">
		<li>
			<a href="#">Home</a> <span class="divider">/</span>
		</li>

		<li>
			Website
		</li>
	</ul>
</div>
<div class="row-fluid">		
	<div class="box span12">

		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i>Website Master</h2>

		</div>
		<div class="box-content">
			<form class="form-horizontal" method="post" action="controller/routes.php">
				<input type="hidden" name="hid_action" id="hid_action" value="create_website" />
				
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="focusedInput">Website  title:</label>
						<div class="controls">
							<input class="input-xlarge focused" id="website_name" name="website_name" type="text" value="<?php echo (isset($arrRecords['website_name']) ? $arrRecords['website_name'] : ''); ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput">Logo:</label>
						<div class="controls">
							<img src="<?php echo (isset($arrRecords['site_logo'])?$arrRecords['site_logo']:'images/logo.png')?>" onclick="showModal();" id="banner" width="250px" height="75px" />
							<input class="hidden" id="site_logo" name="site_logo" type="text" value="<?php echo (isset($arrRecords['site_logo']) ? $arrRecords['site_logo'] : ''); ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput">Theme:</label>
						<div class="controls">
							<ul class="thumbnails gallery">
								<?php for ($i = 1; $i <= 3; $i++)
								{ ?>
									<li id="theme-<?php echo $i ?>" class="thumbnail">
										<a style="background:url(img/gallery/thumbs/<?php echo $i ?>.jpg)" title="Theme <?php echo $i ?>" href="img/gallery/<?php echo $i ?>.jpg"><img class="grayscale" src="img/gallery/thumbs/<?php echo $i ?>.jpg" alt=" Theme <?php echo $i ?>"></a>
									</li>
									
								<?php } ?>
							</ul>
							<input type="hidden" name="theme" id="theme" value=""/>
						</div>
						
					</div>


					

                                        <div class="control-group">
                                            <label class="control-label" >Facebook:</label>
                                            <div class="controls">
                                                <input type="text"  value="<?php echo  $arrRecords['facebook']; ?>"     id="facebook" name="facebook" /> 
                                            </div>
                                        </div> 
                                        <div class="control-group">
                                               <label class="control-label" >Twitter:</label>
                                            <div class="controls">
                                                <input type="text"  value="<?php echo $arrRecords['twitter']; ?>"     id="facebook" name="twitter" /> 
                                            </div>
                                        </div>
                                        <div class="control-group">
                                               <label class="control-label" >Google +:</label>
                                            <div class="controls">
                                                <input type="text"  value="<?php echo $arrRecords['google']; ?>"     id="facebook" name="google" /> 
                                            </div>
                                        </div>
                                        <div class="control-group">
                                               <label class="control-label" >Youtube:</label>
                                            <div class="controls">
                                                <input type="text"  value="<?php echo $arrRecords['youtube']; ?>"     id="facebook" name="youtube" /> 
                                            </div>
                                        </div>
                                        <div class="control-group">
                                               <label class="control-label" >Phone#:</label>
                                            <div class="controls">
                                                <input type="text"  value="<?php echo $arrRecords['phone']; ?>"     id="facebook" name="phone" /> 
                                            </div>
                                        </div>
					   <div class="control-group">
                                               <label class="control-label" >Skype:</label>
                                            <div class="controls">
                                                <input type="text"  value="<?php echo $arrRecords['skype']; ?>"     id="facebook" name="skype" /> 
                                            </div>
                                        </div>
                                    
                  
						
					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Save changes</button>
						<button type="button" class="btn" onclick="javascript:history.go(-1)">Cancel</button>
					</div>
				</fieldset>
			</form>

		</div>         

	</div><!--/span-->
</div>
<script>
function showModal(){ window.open('http://localhost/RainmakerMD/admin/elfinder/elfinder2.html',"","width=800, height=420")}
function showImage(file){ $('#banner').attr('src',file); $('#site_logo').val(file);}
</script>	<?php

require_once('footer.php');
?>
