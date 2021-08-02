<?php
//error_reporting(E_ALL ^E_NOTICE);
/**
 * custom theme functions
 *
 * @package		styles/fullPage
 * @author		Patrick Konstandin <support@flatcore.org>
 *
 */

/* theme_text_parser extends the basic text_parser */

function theme_text_parser($str) {
	
	$str = theme_replacer($str);

	return $str;
}


function theme_replacer($string) {
	
	$string = str_replace('[spacer]', '<hr class="spacer">', $string);
	$string = str_replace('[shadow]', '<hr class="hr-shadow">', $string);
	
	// replace [fullPage=labelname]
	$string = preg_replace_callback(
	    '~\[fullPage\=(.*?)\]~si',
	    function ($m) {
		    return fullPagebyLabel($m[1]);
	    },
	    $string
	);

	return $string;	
}


function fp_get_sections($label_id) {
	
	global $languagePack;
	global $db_content;

	$get_sections = $db_content->select("fc_textlib", "*", [
		"AND" => [
			"textlib_labels" => $label_id,
			"textlib_lang" => "$languagePack",
			"textlib_keywords[~]" => "section"
			],
			"ORDER" => [
				"textlib_priority" => "DESC"
			]
	]);
	
	return $get_sections;
	
}

function fp_get_slides($label_id,$slide_key) {
	
	global $languagePack;
	global $db_content;

	$get_slides = $db_content->select("fc_textlib", "*", [
		"AND" => [
			"textlib_labels" => $label_id,
			"textlib_lang" => "$languagePack",
			"textlib_keywords[~]" => "$slide_key"
			],
			"ORDER" => [
				"textlib_priority" => "DESC"
			]
	]);
	
	return $get_slides;
	
}



function fullPagebyLabel($label) {
	
	global $languagePack;
	global $db_content;
	
	
	/* get the id from label name */
	$label_id = $db_content->get("fc_labels", "label_id", [
		"label_title" => "$label"
	]);	
	
	
	$get_sections = fp_get_sections($label_id);
	$cnt_sections = count($get_sections);
	
	
	$get_header = $db_content->get("fc_textlib", "*", [
		"AND" => [
			"textlib_labels" => $label_id,
			"textlib_lang" => "$languagePack",
			"textlib_name" => "fp_header"
			]
	]);
	
	
	$inline_styles = '<style>';
	
	for($i=0;$i<$cnt_sections;$i++) {
		
		$slide_key = 'slide'.($i+1);
		$get_slides = fp_get_slides($label_id,$slide_key);
		$cnt_slides = count($get_slides);
		
		/* check for background image */
		if($get_sections[$i]['textlib_images'] != '') {
			$bg = explode('<->', $get_sections[$i]['textlib_images']);
			$bg = str_replace('../', '/', $bg[0]);
			
			$inline_styles .= '#section'.$i.' { background-image: url('.$bg.');	}';
			
		}
		
		$section .= '<div class="section '.$get_sections[$i]['textlib_classes'].'" id="section'.$i.'">';
		
		if($cnt_slides > 0) {
			/* this section has slides */
			for($x=0;$x<$cnt_slides;$x++) {
				
				/* check for background image */
				if($get_slides[$x]['textlib_images'] != '') {
					$bg = explode('<->', $get_slides[$x]['textlib_images']);
					$bg = str_replace('../', '/', $bg[0]);
					$inline_styles .= '#slide'.$x.' { background-image: url('.$bg.');	}';
				}
				
				
				$section .= '<div class="slide '.$get_slides[$x]['textlib_classes'].'" id="slide'.$x.'">';
				$section .= '<div class="section-inner">';
				$section .= '<h2>'.$get_slides[$x]['textlib_title'].'</h2>';
				$section .= '<div class="teaser">'.$get_slides[$x]['textlib_content'].'</div>';
				$section .= '</div>';
				$section .= '</div>';
			}
			
		} else {
			/* print section */			
			$section .= '<div class="section-inner"  '.$inline_style.'>';
			if($i==0) {
				$section .= '<h1>'.$get_sections[$i]['textlib_title'].'</h1>';
			} else {
				$section .= '<h2>'.$get_sections[$i]['textlib_title'].'</h2>';
			}
			
			$section .= '<div class="teaser">'.$get_sections[$i]['textlib_content'].'</div>';
			$section .= '</div>';
		}
	
		$section .= '</div>';
	
	}
	
	$inline_styles .= '</style>';
	
	if($get_header != '') {
		$show_header  = '<div id="header">';
		$show_header .= $get_header['textlib_content'];
		$show_header .= '</div>';
	}
	
	$sections = '<div id="fullpage">'.$section.'</div>';
	
	
	return $show_header.$sections.$inline_styles;
}




?>