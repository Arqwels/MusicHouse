<?php
$images = ['slider1.jpeg', 'slider2.jpeg', 'slider3.jpeg', 'slider4.jpeg'];
foreach ($images as $image) {
  echo '<div class="slide"><img src="assets/images/' . $image . '" alt="Slide"></div>';
}
