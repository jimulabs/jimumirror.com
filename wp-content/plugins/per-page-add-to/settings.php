<?php
function perpageath_config(){
  $currenturl = 'http';
   if (isset($_SERVER['HTTPS']) && $_SERVER["HTTPS"] == "on") {$currenturl .= "s";}
   $currenturl .= "://";
   if ($_SERVER["SERVER_PORT"] != "80") {
	$currenturl .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
   } else {
	$currenturl .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
  }
  $htmlfile = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'evonapluginconfig'.DIRECTORY_SEPARATOR.'everyheadpage.html';
  ?>
  <div class="wrap">
  <h2><?php _e('Insert HTML on every page', 'per-page-ath'); ?></h2>
  <h3><?php _e('Everything you put in here will be inserted into the &lt;head&gt; tag on every page. Ideal for favicons!', 'per-page-ath'); ?></h3>
  <?php
  if(!file_exists($htmlfile)){
	  if($htmlcreatehandle = fopen($htmlfile, 'x')){
		  fwrite($htmlcreatehandle, "");
		  fclose($htmlcreatehandle);
	  }else{
		  printf(__("Error creating %s! Is the underlying folder writable?", 'per-page-ath'), $htmlfile);
	  }
  }
  if(isset($_POST['html'])){
	  if($htmlwritehandle = fopen($htmlfile, 'w')){
		  fwrite($htmlwritehandle, stripslashes_deep($_POST['html']));
		  fclose($htmlwritehandle);
		  printf(__("Succesfully edited %s!", 'per-page-ath'), $htmlfile);
	  }else{printf(__("Error writing HTML to %s. Is this file writable?", 'per-page-ath'), $htmlfile);}
  }
  if($htmlhandle = fopen($htmlfile, 'r')){
	  if(filesize($htmlfile) > 0){
		$html = fread($htmlhandle, filesize($htmlfile));
	  }else{
		  $html = "";
	  }
	  fclose($htmlhandle);
	  ?>
	  <form method="post" action="<?php echo $currenturl; ?>">
	  <textarea style="white-space:pre; width:80%; min-width:600px; height:300px;" name="html"><?php echo $html; ?></textarea>
	  <?php
	  submit_button();
  }else{printf(__("Error reading HTML from file %s. Is this file readable?", 'per-page-ath'), $htmlfile);}
  echo "</form></div>";
}
?>