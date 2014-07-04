<!-- Content -->
        <div id="da-content">
            
            <!-- Container -->
            <div class="da-container clearfix">
                
	            <!-- Sidebar Separator do not remove -->
                <div id="da-sidebar-separator"></div>
                
                <!-- ======================= menu(start) ========================== -->
				<?php echo $this->render('/includes/blocks/menu.php');?>
				<!-- ======================= menu(end) ========================== -->
                
                
                
                <!-- Main Content Wrapper -->
                <div id="da-content-wrap" class="clearfix">
                
                	<!-- Content Area -->
                	<div id="da-content-area">
                		<?php echo $this->layout()->content;?>
                    </div>
                    
                </div>
                
            </div>
            
        </div>