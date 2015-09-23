# WP Boilerplate for Child Themes

This is a full-featured child theme boilerplate to start with.

## Author
Mirco Babini <mirkolofio@gmail.com> for [SED Web](http://sedweb.it)

Latest version: v0.1.26-beta

## Website
<http://sedweb.it>

## Installation
1. unzip into your themes folder and rename like your-child-theme-name
1. edit style.css to inherit parent theme
1. require wpctb-config.php into the wp-config.php
1. check wpctb-config.php and tune it to suit your needs
1. check functions.php and tune it to suit your needs
1. replace the .htaccess with the one into the wordpress directory (tune it)
1. place the robots.txt into the root of your website (tune it)

This configuration already supports: browser caching, gzip compression. We also suggest the super-simple Autoptimize + WP Super Cache configuration (*). And some tweaks thanks to the build-in wp-thumb/wp-mobile-detect plugins (check the flatsome.lightweight-slideshows.php example).

| Feature       | Provided by    |
|---------------|----------------|
| Desktop Cache | WP Super Cache (*) |
| Mobile Cache  | W3 Total Cache |
| Minify HTML   | Autoptimize (*) |
| Minify CSS    | Autoptimize (*) |
| Combine CSS   | Autoptimize (*) |
| Combine JS    | Autoptimize (*) |
| GZIP          | built-in (wpctb) |
| Browser Caching    | built-in (wpctb) |
| Image Optimization | wp-thumb + wp-mobile-detect |
| Minify HTML Plus   | [(wtf?)](http://www.wpfastestcache.com/) |
| Combine JS Plus    | [(wtf?)](http://www.wpfastestcache.com/) |
| Cache Statics      | [(wtf?)](http://www.wpfastestcache.com/) |
| Delete Cache Logs  | [(wtf?)](http://www.wpfastestcache.com/) |

#### Support
- Issues: ...
- Others: ...

#### Thanks
- [_child](https://github.com/ahmadawais/_child)
- [bones](https://github.com/eddiemachado/bones/)
- [WP Explorer](http://www.wpexplorer.com/)
- [WP jQuery Plus](https://wordpress.org/plugins/wp-jquery-plus/)
- [WP Mobile Detect](https://wordpress.org/plugins/wp-mobile-detect/)
- [WP Thumb](https://wordpress.org/plugins/wp-thumb/)
- [Luca Iaconelli](https://gist.github.com/LuXDAmore/)
- check into the code for more references

#### License? WTFPL
![WTFPL](http://www.wtfpl.net/wp-content/uploads/2012/12/wtfpl-strip.jpg)
