<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php echo $this->headTitle();?>
<?php echo $this->headLink();?>
<?php echo $this->headMeta();?>
<?php echo $this->headScript();?>

</head>

<body>
    <input type="hidden" value="<?php echo $_SERVER['SERVER_NAME'];  ?>" id="baseUrl"/>
    <input type="hidden" value="<?php echo $_SERVER['DOCUMENT_ROOT'];?>" id="documentRoot"/>
    <input type="hidden" value="<?php echo $_SESSION['menu']['level'];?>" id="levelMenu"/>
	<!-- Dandelion Customizer (remove if not needed) -->
    <?php $setting = $this->setting[0]; ?>
    <div id="da-customizer">
    	<div id="da-customizer-content">
        	<ul>
            	<li>
                	<span class="da-customizer-title">Background Pattern</span>
                    <span id="da-customizer-body-bg"></span>
                </li>
                <li>
                	<span>Header Pattern</span>
                    <span id="da-customizer-header-bg"></span>
                </li>
                <li>
                	<span>
                    	Layout
                        <span title="This functionality can only provide you the CSS for background and header patterns. Instructions to switch between fixed or fluid layout can be found in the documentation." class="da-tooltip-w da-customizer-tooltip">
                    		[?]
                        </span>
                    </span>
                    <ul id="da-customizer-layouts" class="clearfix">
                    	<li>
                        	<input type="radio" id="da-customizer-fluid" name="da-layout" checked="checked" />
                        	<label for="da-customizer-fluid">Fluid</label>
                        </li>
                    	<li>
                        	<input type="radio" id="da-customizer-fixed" name="da-layout" />
                            <label for="da-customizer-fixed">Fixed</label>
                        </li>
                    </ul>
                </li>
            </ul>
            <div id="da-customizer-button">
            	<button class="da-button red">Get CSS</button>
            </div>
        </div>
        <span id="da-customizer-pulldown"></span>
    </div>
    
    <!-- Main Wrapper. Set this to 'fixed' for fixed layout and 'fluid' for fluid layout' -->
	<div id="da-wrapper" class="fluid">
        <?php $admininfo = $this->admininfo; ?>
        <!-- Header -->
        <div id="da-header">
        
        	<div id="da-header-top">
                
                <!-- Container -->
                <div class="da-container clearfix">
                    
                    <!-- Logo Container. All images put here will be vertically centere -->
                    <div id="da-logo-wrap">
                        <div id="da-logo" style="padding:10px 0px;">
                            <div id="da-logo-img">
                                <a href="<?php echo $setting['website'];?>">
                                    <img src="<?php echo 'http://'.URL_CONFIG.$setting['logo']; ?>" width="120" height="89" alt="Dandelion Admin" />
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Header Toolbar Menu -->
                    <div id="da-header-toolbar" class="clearfix">
                        <div id="da-user-profile">
                            <div id="da-user-avatar">
                                <img src="images/pp.jpg" alt="" />
                            </div>
                            <div id="da-user-info">
                                
                                <span class="da-user-title"><?php echo $admininfo->fullname; ?></span>
                            </div>
                            <ul class="da-header-dropdown">
                                <li class="da-dropdown-caret">
                                    <span class="caret-outer"></span>
                                    <span class="caret-inner"></span>
                                </li>
                                <li class="da-dropdown-divider"></li>
                                <li><a href="<?php echo $this->url(array ('controller'=> 'index', 'action'=> 'index', 'module'=> 'admin') ) ?>">Dashboard</a></li>
                                <li class="da-dropdown-divider"></li>
                                <li><a href="#">Profile</a></li>
                                <li><a href="#">Settings</a></li>
                                <li><a href="#">Change Password</a></li>
                                <li ><a href="<?php echo $this->url(array ('controller'=> 'index', 'action'=> 'logout', 'module'=> 'admin') ) ?>" id="close">Log out</a></li>
                            </ul>
                        </div>
                        <div id="da-header-button-container">
                        	<ul>
                            	<li class="da-header-button logout">
                                	<a title="Logout" href="<?php echo $this->url(array ('controller'=> 'index', 'action'=> 'logout', 'module'=> 'admin') ) ?>">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                                    
                </div>
            </div>
            
            <div id="da-header-bottom">
                <!-- Container -->
                <div class="da-container clearfix">                	
                    <!-- Breadcrumbs -->
                    <div id="da-breadcrumb">
                        <ul>
                            <li class="active"><span><img src="images/icons/black/16/home.png" alt="Home" />Dashboard</span></li>
                        </ul>
                    </div>
                    
                </div>
            </div>
        </div>
	