<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"></meta>
<?php echo $this->headTitle(). "\n";?>
<?php echo $this->headLink(). "\n";?>
<?php echo $this->headMeta(). "\n";?>
<?php echo $this->headScript();?>
</head>

<body>
	<form action="" method="post">
    <input type="hidden" value="<?php echo $_SERVER['SERVER_NAME'];  ?>" id="baseUrl"/>
	</form>
    <?php $setting = $this->setting[0];?>
	<div id="main">
    	<div id="header">
        	<a href="<?php echo $setting['website']; ?>" id="logo"><img src="<?php echo 'http://'.URL_CONFIG.$setting['logo']; ?>" alt="AATI" /></a>
            <div id="search">
                <form action="http://www.google.com.vn/search" method="get">
                	<input type="text" name="q" id="input_search" size="31" maxlength="255" />
                    <input type="submit" name="btn_search" id="btn_search" value="" />
                    <input type="hidden" name="domains" value="http://google.com.vn"/>
                    <input type="hidden" name="sitesearch" value="google.com.vn"/>
                </form>
            </div>
            <div id="menu_top">
            	<?php echo $this->render('/includes/blocks/menu.php'); ?>
            </div>
        </div>
        <div id="sliders">
        	<?php echo $this->render('/includes/blocks/slider.php'); ?>
        </div>
	