<script type="text/javascript">
    jQuery(document).ready(function() {
        var levelmenu = jQuery("#levelMenu").val();
        jQuery("#da-main-nav>ul>li").each(function(index){
            if((levelmenu-1)==index){
                jQuery("#da-main-nav>ul>li").removeClass('active');
                jQuery(this).addClass('active');
            }
        });
    });
    
</script>

 <!-- Sidebar -->
                <div id="da-sidebar">
                
                    <!-- Main Navigation -->
                    <div id="da-main-nav" class="da-button-container">
                        <ul>
                            <li class="active">
                            <a href="<?php echo $this->url(array ('controller'=> 'index', 'action'=> 'index', 'module'=> 'admin') ) ?>">
                                <!-- Icon Container -->
                                <span class="da-nav-icon">
                                    <img src="images/icons/black/32/home.png" alt="Dashboard" />
                                    </span>
                                Dashboard
                                </a>
                            </li>
                            
                            
                            
                            <li>
                            <a href="<?php echo $this->url(array ('controller'=> 'index', 'action'=> 'user', 'module'=> 'admin') ) ?>">
                                <!-- Icon Container -->
                                <span class="da-nav-icon">
                                    <img src="images/icons/black/32/admin_user.png" alt="Icons" />
                                    </span>
                                    User Management
                                </a>
                            </li>
                            <li>
                            <a href="<?php echo $this->url(array ('controller'=> 'index', 'action'=> 'admin', 'module'=> 'admin') ) ?>">
                                <!-- Icon Container -->
                                <span class="da-nav-icon">
                                    <img src="images/icons/admin.png" alt="Icons" />
                                    </span>
                                    Admin Management
                                </a>
                            </li>
                            <li>
                            <a href="#">
                                <!-- Icon Container -->
                                <span class="da-nav-icon">
                                    <img src="images/icons/black/32/connect.png" alt="Icons" />
                                    </span>
                                    About Management
                                </a>
                                <ul class="" style="display: block; ">
                                    <li><a href="<?php echo $this->url(array ('controller'=> 'index', 'action'=> 'about', 'module'=> 'admin') ) ?>">About</a></li>
                                    <li><a href="<?php echo $this->url(array ('controller'=> 'index', 'action'=> 'typeabout', 'module'=> 'admin') ) ?>">Type About</a></li>
                                </ul>
                            </li>
                            <li>
                            <a href="<?php echo $this->url(array ('controller'=> 'index', 'action'=> 'connect', 'module'=> 'admin') ) ?>">
                                <!-- Icon Container -->
                                <span class="da-nav-icon">
                                    <img src="images/icons/black/32/connect.png" alt="Icons" />
                                    </span>
                                    Community Management
                                </a>
                                <ul class="" style="display: block; ">
                                    <li><a href="<?php echo $this->url(array ('controller'=> 'index', 'action'=> 'community', 'module'=> 'admin') ) ?>">Community</a></li>
                                    <li><a href="<?php echo $this->url(array ('controller'=> 'index', 'action'=> 'typecommunity', 'module'=> 'admin') ) ?>">Type Community</a></li>
                                </ul>
                            </li>
                            <li>
                            <a href="<?php echo $this->url(array ('controller'=> 'index', 'action'=> 'conferences', 'module'=> 'admin') ) ?>">
                                <!-- Icon Container -->
                                <span class="da-nav-icon">
                                    <img src="images/icons/black/32/connect.png" alt="Icons" />
                                    </span>
                                    Conferences Management
                                </a>
                            </li>
                            <li>
                            <a href="<?php echo $this->url(array ('controller'=> 'index', 'action'=> 'publications', 'module'=> 'admin') ) ?>">
                                <!-- Icon Container -->
                                <span class="da-nav-icon">
                                    <img src="images/icons/black/32/connect.png" alt="Icons" />
                                    </span>
                                    Publications Management
                                </a>
                            </li>
                            <li>
                            <a href="<?php echo $this->url(array ('controller'=> 'index', 'action'=> 'membership', 'module'=> 'admin') ) ?>">
                                <!-- Icon Container -->
                                <span class="da-nav-icon">
                                    <img src="images/icons/black/32/connect.png" alt="Icons" />
                                    </span>
                                    Membership Management
                                </a>
                                <ul class="" style="display: block; ">
                                    <li><a href="<?php echo $this->url(array ('controller'=> 'index', 'action'=> 'membership', 'module'=> 'admin') ) ?>">Membership</a></li>
                                    <li><a href="<?php echo $this->url(array ('controller'=> 'index', 'action'=> 'typemembership', 'module'=> 'admin') ) ?>">Type Membership</a></li>
                                </ul>
                            </li>
                            <li>
                            <a href="<?php echo $this->url(array ('controller'=> 'index', 'action'=> 'connect', 'module'=> 'admin') ) ?>">
                                <!-- Icon Container -->
                                <span class="da-nav-icon">
                                    <img src="images/icons/black/32/connect.png" alt="Icons" />
                                    </span>
                                    Connect Management
                                </a>
                            </li>
                            
                            <li>
                            <a href="<?php echo $this->url(array ('controller'=> 'index', 'action'=> 'slider', 'module'=> 'admin') ) ?>">
                                <!-- Icon Container -->
                                <span class="da-nav-icon">
                                    <img src="images/icons/black/32/sliders.png" alt="Icons" />
                                    </span>
                                    Slider Management
                                </a>
                            </li>
                            <li>
                            <a href="<?php echo $this->url(array ('controller'=> 'index', 'action'=> 'link', 'module'=> 'admin') ) ?>">
                                <!-- Icon Container -->
                                <span class="da-nav-icon">
                                    <img src="images/icons/black/32/link.png" alt="Icons" />
                                    </span>
                                    Link Management
                                </a>
                            </li>
                            <li>
                            <a href="<?php echo $this->url(array ('controller'=> 'index', 'action'=> 'menu', 'module'=> 'admin') ) ?>">
                                <!-- Icon Container -->
                                <span class="da-nav-icon">
                                    <img src="images/icons/black/32/menu.png" alt="Icons" />
                                    </span>
                                    Menu Management
                                </a>
                            </li>
                            <li>
                            <a href="<?php echo $this->url(array ('controller'=> 'index', 'action'=> 'news', 'module'=> 'admin') ) ?>">
                                <!-- Icon Container -->
                                <span class="da-nav-icon">
                                    <img src="images/icons/black/32/news.png" alt="Icons" />
                                    </span>
                                    News Management
                                </a>
                            </li>
                            <li>
                            <a href="<?php echo $this->url(array ('controller'=> 'index', 'action'=> 'sponsors', 'module'=> 'admin') ) ?>">
                                <!-- Icon Container -->
                                <span class="da-nav-icon">
                                    <img src="images/icons/black/32/customer.png" alt="Icons" />
                                    </span>
                                    Sponsors Management
                                </a>
                            </li>
                            <li>
                            <a href="<?php echo $this->url(array ('controller'=> 'index', 'action'=> 'setting', 'module'=> 'admin') ) ?>">
                                <!-- Icon Container -->
                                <span class="da-nav-icon">
                                    <img src="images/icons/black/32/cog_5.png" alt="Icons" />
                                    </span>
                                    Setting Management
                                </a>
                            </li>
                            <li>
                            <a href="<?php echo $this->url(array ('controller'=> 'index', 'action'=> 'file', 'module'=> 'admin') ) ?>">
                                <!-- Icon Container -->
                                <span class="da-nav-icon">
                                    <img src="images/icons/black/32/file_cabinet.png" alt="File Handling" />
                                    </span>
                                File Handling
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                </div>