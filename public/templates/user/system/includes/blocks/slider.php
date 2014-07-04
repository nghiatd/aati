<?php $result = $this->slider; ?>
<div class="slider-wrapper theme-default">
    <div id="slider" class="nivoSlider">
    	<?php
    		foreach ($result as $slider) {
    	?>
    		<a href="<?php echo $slider['url']; ?>"><img src="<?php echo 'http://'.URL_CONFIG.$slider['image']; ?>" data-thumb="<?php echo 'http://'.URL_CONFIG.$slider['image']; ?>" alt="<?php echo $slider['name']; ?>" /></a>
    	<?php }?>
    </div>    
</div>