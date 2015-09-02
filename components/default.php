<?php
// force perfect jpg images (compression set to 100% instead of 90% i.e. no compression at all)
// someone said that with 80%/85% you may not even notice the difference
// after changing, consider using Regenerate Thumbnails plugin to affect even old images
add_filter( 'jpeg_quality', function(){ return 100; } );
add_filter( 'wp_editor_set_quality', function(){ return 100; } );
