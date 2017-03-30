<div id="simpleFadeSlideShow_container">
	<div id="simpleFadeSlideShow_images">
	<?php foreach ($images as $image){
		if (is_array($image) && isset($image['src'])){
			$text = (isset($image['text']))?$image['text']:'';
			$link = (isset($image['href']))?'<a href="'.$image['href'].'" title="'.$image['text'].'">':'';
			$endLink = (!empty($link))?'</a>':'';
			echo "\n<div>".$link."<img src='".$image['src']."' alt='".$text."' width='".$this->width."' height='".$this->height."' />".$endLink."</div>";
		}
		if (is_string($image)){
			echo "\n<div><img src='".$image."' alt='".$image."' width='".$this->width."' height='".$this->height."' /></div>";
		}
	} ?>
	</div>
</div>
