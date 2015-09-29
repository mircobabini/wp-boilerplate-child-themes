<?php
// rename as maintenance.php and place into wp-content
header( 'HTTP/1.1 503 Service Unavailable', true, 503 );
header( 'Content-Type: text/html; charset=utf-8' );

require ABSPATH.'/wp-includes/l10n.php';
require ABSPATH.'/wp-includes/plugin.php';
require ABSPATH.'/wp-includes/formatting.php';
require ABSPATH.'/wp-includes/pomo/translations.php';

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
    <h1>Briefly unavailable for scheduled maintenance. Check back in <?php echo human_time_diff( $upgrading ) ?>.</h1>
</body>
</html>
<?php die(); ?>

