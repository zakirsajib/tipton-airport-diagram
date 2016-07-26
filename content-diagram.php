<div class="map-container" align=center> 
	<map name="map1"> 
		<area class='image-link-1' alt="A Jet Fuel" href="#" shape="rect" coords="591,516,621,543" />
	    <area class='image-link-2' alt="Hangar 85" href="#" shape="rect" coords="796,414,824,441" />
	    <area class='image-link-3' alt="Hangar 84" href="#" shape="rect" coords="724,252,757,290" />
	    <area class='image-link-4' alt="Hangar 80" href="#" shape="rect" coords="687,205,722,234" />
	    <area class='image-link-5' alt="Terminal" href="#" shape="rect" coords="726,130,756,167" />
	    <area class='image-link-6' alt="Hangar 90" href="#" shape="rect" coords="577,66,608,97" />
	    <area class='image-link-7' alt="New Hangars" href="#" shape="rect" coords="442,95,477,129" />
	    <area class='image-link-8' alt="100LL Fuel" href="#" shape="rect" coords="432,160,465,191" />
	    <area class='image-link-9' alt="Transient Parking" href="#" shape="rect" coords="372,203,399,242" />
	</map> 


<div class="panzoom">
    <img id="map" src="<?php the_field('upload_tipton_airport_diagram')?>" alt="map of Tipton airport" border=0 usemap="#map1">
	
	<div class="jet"><i class="fa fa-times-circle" aria-hidden="true"></i><img id="jet" src="<?php the_field('location_thumbnail_image_one')?>" alt="A Jet Fuel"></div>
	<div class="hangar85"><i class="fa fa-times-circle" aria-hidden="true"></i><img id="hangar85" src="<?php the_field('location_image_two')?>" height="1800" alt="hangar85"></div>
	<div class="hangar84"><i class="fa fa-times-circle" aria-hidden="true"></i><img id="hangar84" src="<?php the_field('location_image_three')?>" height="1800" alt="hangar84"></div>
	<div class="hangar80"><i class="fa fa-times-circle" aria-hidden="true"></i><img id="hangar80" src="<?php the_field('location_image_four')?>" alt="hangar80"></div>
	<div class="terminal"><i class="fa fa-times-circle" aria-hidden="true"></i><img id="terminal" src="<?php the_field('location_image_five')?>" alt="terminal"></div>
	<div class="hangar90"><i class="fa fa-times-circle" aria-hidden="true"></i><img id="hangar90" src="<?php the_field('location_image_six')?>" alt="hangar90"></div>
	<div class="newhangars"><i class="fa fa-times-circle" aria-hidden="true"></i><img id="newhangars" src="<?php the_field('location_image_seven')?>" alt="newhangars"></div>
	<div class="llfuel"><i class="fa fa-times-circle" aria-hidden="true"></i><img id="llfuel" src="<?php the_field('location_image_eight')?>" alt="100llfuel"></div>
	<div class="parking"><i class="fa fa-times-circle" aria-hidden="true"></i><img id="parking" src="<?php the_field('location_image_nine')?>" alt="transient parking"></div>

</div>

<div class="zoomin"><img src="<?php echo get_template_directory_uri()?>/images/plus.png" alt=""/></div>
<div class="zoomout"><img src="<?php echo get_template_directory_uri()?>/images/minus.png" alt=""/></div>
<div class="reset"><img src="<?php echo get_template_directory_uri()?>/images/reset.png" alt=""/></div>
</div>