<?php $menu = $this->menu; ?>
<ul>
    <?php
        $i=0;
        foreach ($menu as $m) {
            if($i==(count($menu)-1)){
                echo "<li><a href=\"".$this->url(array ( 'action'=> $m['link'],'controller'=> 'index', 'module'=> 'default') ,null,true)."\">".$m['name']."</a></li>";
                break;
            }
            if($i++==0){
                echo "<li class=\"home\"><a href=\"".$this->url(array ( 'action'=> $m['link'],'controller'=> 'index', 'module'=> 'default') ,null,true)."\">".$m['name']."</a></li>";
                echo "<li class=\"separate\"></li>";
            }else{
                echo "<li><a href=\"".$this->url(array ( 'action'=> $m['link'],'controller'=> 'index', 'module'=> 'default') ,null,true)."\">".$m['name']."</a></li>";
                echo "<li class=\"separate\"></li>";
            }
        }
    ?>
</ul>