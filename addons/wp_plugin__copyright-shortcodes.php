<?php
/*
Plugin Name: Copyright Shortcodes
Plugin URI: http://github.com/mircobabini/wp-copyright-shortcodes/
Description: Provides Shortcodes to display the Copyright line automagically, year by year.
Version: 1.0.1
Author: mirkolofio
Author URI: http://mircobabini.com
License: GPLv2
*/

/*  Copyright 2014  Mirco Babini  (Email : mirkolofio@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/* usage */
/* [copyright year=2014] */

/* result examples: */
/* © 2014, © 2014-2015 */

if( ! function_exists( 'do_shortcode_copyright' ) ){
    function do_shortcode_copyright( $atts ){
        $atts = shortcode_atts( array(
            'year' => date('Y'),
        ), $atts );

        $year = (int)$atts[ 'year' ];
        $this_year = date('Y');

        if( $year < $this_year ){
            $year = $year.'-'.$this_year;
        }

        return '&copy; '.$year;
    }
}
add_shortcode( 'copyright', 'do_shortcode_copyright' );

/* usage: [copy] */
/* result: © */
if( ! function_exists( 'do_shortcode_copy' ) ){
    function do_shortcode_copy(){
        return '&copy;';
    }
}
add_shortcode( 'copy', 'do_shortcode_copy' );

/* usage: [year] */
/* example result: 2014 */
if( ! function_exists( 'do_shortcode_year' ) ){
    function do_shortcode_year(){
        return date('Y');
    }
}
add_shortcode( 'year', 'do_shortcode_year' );

/* usage: [years by=2014], other attributes (opt): list="true/false", sep=", " */
/* example result: 2014, 2014-2016 or 2014, 2015, 2016 */ 
if( ! function_exists( 'do_shortcode_years' ) ){
    function do_shortcode_years( $atts ){
        $atts = shortcode_atts( array(
            'by' => date('Y'),
            'list'  => false,
            'sep'   => ', ',
        ), $atts );

        $year = (int)$atts[ 'by' ];
        $this_year = date('Y');

        $years = '';
        if( $year < $this_year ){
            if( $list ){
                $years_to_print = array();
                while( $this_year-- >= $year ){
                    $years_to_print[] = $this_year;
                }

                $years_to_print = array_reverse( $years_to_print );
                $years = implode( $sep, $years_to_print );
            }else{
                $years = $year.$sep.$this_year;
            }
        }else{
            $years = $year;
        }

        return $years;
    }
}
add_shortcode( 'years', 'do_shortcode_years' );

?>