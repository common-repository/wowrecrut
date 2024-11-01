<?php
/*
Plugin Name: WoW Recrut
Plugin URI: http://www.gnomx.at/wowrecrut
Description: WoW Recrutment Widget 
Version: 0.1.2
Author: Sirlon
Author URI: http://www.gnomx.at

*/

/*  
	Copyright
	----------
	
	wowrecrut©2009 by Gnomx.at.
	
    This file is part of wowrecrut.

    wowrecrut is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    wowrecrut is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with wowrecrut.  If not, see <http://www.gnu.org/licenses/>.
*/

define( 'WOWRECRUT_VERSION', '0.1.2' );

if ( ! defined( 'WOWRECRUT_PLUGIN_NAME' ) )
	define( 'WOWRECRUT_PLUGIN_NAME', 'wowrecrut');

if ( ! defined( 'WOWRECRUT_PLUGIN_DIR' ) )
	define( 'WOWRECRUT_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . plugin_basename( dirname( __FILE__ ) ) );

if ( ! defined( 'WOWRECRUT_PLUGIN_URL' ) )
	define( 'WOWRECRUT_PLUGIN_URL', WP_PLUGIN_URL . '/' . plugin_basename( dirname( __FILE__ ) ) );
	
if ( ! defined( 'WOWRECRUT_ICON_SIZE' ) )
	define( 'WOWRECRUT_ICON_SIZE', 11 );
	
$wowRecrutStyles = array (
				0 => array (
						'name' => 'Dark Rect',
						'css' => WOWRECRUT_PLUGIN_URL.'/wowrecrut.css',
						'isize' => 11,
						'active' => 1
							),
				1 => array (
						'name' => 'WoWr Light',
						'css' => WOWRECRUT_PLUGIN_URL.'/wowrlight/wowrlight.css',
						'isize' => 20,
						'active' => 0
							),
 						);
$WoWclasses = array(
			0 => array (
					'name' 	=> 'Death knight',
					'tag' 	=> 'dk',
					'tree1' => 'Blood',
					'tree2' => 'Frost',
					'tree3' => 'Unholy',
					'color' => '#C41F3B'
			),
			
			1 => array (
					'name' 	=> 'Druid',
					'tag' 	=> 'druid',
					'tree1' => 'Balance',
					'tree2' => 'Feral',
					'tree3' => 'Restoration',
					'color' => '#FF7D0A'
			),
			
			2 => array (
					'name' 	=> 'Hunter',
					'tag' 	=> 'hunter',
					'tree1' => 'Marksmanship',
					'tree2' => 'Beast Mastery',
					'tree3' => 'Survival',
					'color' => '#ABD473'
			),
			
			3 => array (
					'name' 	=> 'Mage',
					'tag' 	=> 'mage',
					'tree1' => 'Arcane',
					'tree2' => 'Fire',
					'tree3' => 'Frost',
					'color' => '#69CCF0'
			),
			
			4 => array (
					'name' 	=> 'Paladin',
					'tag' 	=> 'paladin',
					'tree1' => 'Holy',
					'tree2' => 'Retribution',
					'tree3' => 'Protection',
					'color' => '#F58CBA'
			),
			
			5 => array (
					'name' 	=> 'Priest',
					'tag' 	=> 'priest',
					'tree1' => 'Discipline',
					'tree2' => 'Holy',
					'tree3' => 'Shadow',
					'color' => '#fff'
			),
			
			6 => array (
					'name' 	=> 'Rogue',
					'tag' 	=> 'rogue',
					'tree1' => 'Assassination',
					'tree2' => 'Combat',
					'tree3' => 'Subtlety',
					'color' => '#FFF569'
			),
			
			7 => array (
					'name' 	=> 'Shaman',
					'tag' 	=> 'shaman',
					'tree1' => 'Elemental',
					'tree2' => 'Enhancement',
					'tree3' => 'Restoration',
					'color' => '#2459FF'
			),
			
			8 => array (
					'name' 	=> 'Warlock',
					'tag' 	=> 'warlock',
					'tree1' => 'Afflication',
					'tree2' => 'Demon',
					'tree3' => 'Destruction',
					'color' => '#9482C9'
			),
			
			9 => array (
					'name' 	=> 'Warrior',
					'tag' 	=> 'warrior',
					'tree1' => 'Arms',
					'tree2' => 'Fury',
					'tree3' => 'Protection',
					'color' => '#C79C6E'
			)

				);


class wowrecrut_Widget extends WP_Widget {
	
	function wowrecrut_Widget()
	{
		$widget_ops = array('classname' => 'wowrecrut', 'description' => 'WoW Recruitment Widget' );
		parent::WP_Widget(false, $name = 'WoW Recruitment', $widget_ops);
	}
	
	 function widget($args, $instance)
	{
		extract($args, EXTR_SKIP);
		
		global $WoWclasses;
		global $wowRecrutStyles;
		
		
		
		$title = $instance['title'];
		$rtext = $instance['rtext'];
		$style = $instance['style'];
		
		if(empty($style))
			$style = 0;
		
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }
		if( !empty( $rtext ) ) echo "<p>".$rtext."</p>";
		echo "<ul style=\"list-style:none\" >";
		$ccounter = 0;
		for ($i = 0; $i < count($WoWclasses); $i++)
		{
			$t1 = $instance[$WoWclasses[$i]['tag'].'tree1'];
			$t2 = $instance[$WoWclasses[$i]['tag'].'tree2'];
			$t3 = $instance[$WoWclasses[$i]['tag'].'tree3'];
			
			if($t1 == 1 || $t2 == 1 || $t3 == 1) 
			{
				$t1sel = '';
				$t2sel = '';
				$t3sel = '';
				
				$ih = $i * $wowRecrutStyles[$style]['isize'];
				
				if( $t1 == 1)
					$t1sel = 'need';
				
				if( $t2 == 1)
					$t2sel = 'need';
				
				if( $t3 == 1)
					$t3sel = 'need';
				?>
					<li class="wowr-class" id="<?php echo 'wowr-'.$WoWclasses[$i]['tag']; ?>" title="<?php echo $WoWclasses[$i]['name']; ?>">
						<a class="wowr-skill <?php echo $t1sel; ?>" href="JavaScript:Void(0)" title="<?php echo $WoWclasses[$i]['tree1']; ?>" style="background-position:0px -<?php echo $ih; ?>px"></a>
						<a class="wowr-skill <?php echo $t2sel; ?>" href="JavaScript:Void(0)" title="<?php echo $WoWclasses[$i]['tree2']; ?>" style="background-position:-<?php echo $wowRecrutStyles[$style]['isize']; ?>px -<?php echo $ih; ?>px"></a>
						<a class="wowr-skill <?php echo $t3sel; ?>" href="JavaScript:Void(0)" title="<?php echo $WoWclasses[$i]['tree3']; ?>" style="background-position:-<?php echo $wowRecrutStyles[$style]['isize']*2; ?>px -<?php echo $ih; ?>px"></a>
					</li>
				<?php
				$ccounter++;
			}
			
		}
			
			if($ccounter == 0)
				echo "<li>No Recruitment</li>";
				
		echo "<li style=\"clear:both\"></li></ul>";
		echo $after_widget; 
	}

	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		
		global $WoWclasses;
		
		$instance['title']	= strip_tags($new_instance['title']);
		$instance['rtext']	= $new_instance['rtext'];
		$instance['style']	= $new_instance['style'];
		
		for ($i = 0; $i < count($WoWclasses); $i++)
		{
			$instance[$WoWclasses[$i]['tag'].'tree1']= (bool) $new_instance[$WoWclasses[$i]['tag'].'tree1'];
			$instance[$WoWclasses[$i]['tag'].'tree2']= (bool) $new_instance[$WoWclasses[$i]['tag'].'tree2'];
			$instance[$WoWclasses[$i]['tag'].'tree3']= (bool) $new_instance[$WoWclasses[$i]['tag'].'tree3'];
		}
		
		return $instance;
	}
	
	function form($instance) 
	{
		$style = get_option('wowrecrut-style');
		
		if(empty($style)) {
			add_option('wowrecrut-style', 0);
			$style = 0;
		}
		//Defaults
				$instance = wp_parse_args( (array) $instance, array( 
		            'title' => 'Recruitment', 
		           	'rtext' => 'We are looking for the following classes:',
		           	'style' => 0,
		           	 ) );
		            
		           
		$title = esc_attr($instance['title']);
		$rtext = esc_attr($instance['rtext']);
		$rstyle = esc_attr($instance['style']);
		
		if($rstyle <> $style) {
			update_option('wowrecrut-style', $rstyle);
			$style = $rstyle;
		}
		
		
		global $WoWclasses;
		global $wowRecrutStyles;
		
		$wowRecrutStyles[$style]['active'] = 1;
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id('rtext'); ?>">Looking for Text <textarea class="widefat" rows="7" cols="20" id="<?php echo $this->get_field_id('rtext'); ?>" name="<?php echo $this->get_field_name('rtext'); ?>" ><?php echo $rtext; ?></textarea> </label></p>
            <p>
            <label for="<?php echo $this->get_field_id('style'); ?>">Style <select id="<?php echo $this->get_field_id('style'); ?>" class="widefat" name="<?php echo $this->get_field_name('style'); ?>"><?php
            	for ($i = 0; $i < count($wowRecrutStyles); $i++) { ?>
            	<option value="<?php echo $i; ?>" <?php if($style == $i) { echo"selected=\"1\"";} ?>><?php echo $wowRecrutStyles[$i]['name']; ?></option>
            	<?php } ?>
            </select></label>
            </p>       
        <?php
       
        for ($i = 0; $i < count($WoWclasses); $i++)
        {
        	
        	?>
        		<p>
        			<h3 style="color: <?php echo $WoWclasses[$i]['color']; ?>;margin-bottom: 3px; text-shadow: 1px 1px 2px #666"><?php echo $WoWclasses[$i]['name']; ?></h3>
        			<label for="<?php echo $this->get_field_id($WoWclasses[$i]['tag'].'tree1'); ?>" >
        			<input id="<?php echo $this->get_field_id($WoWclasses[$i]['tag'].'tree1'); ?>" name="<?php echo $this->get_field_name($WoWclasses[$i]['tag'].'tree1'); ?>" type="checkbox" value="1"  <?php checked(true, $instance[$WoWclasses[$i]['tag'].'tree1']); ?> />
        			<?php echo $WoWclasses[$i]['tree1']; ?>
        			</label>
        			<label for="<?php echo $this->get_field_id($WoWclasses[$i]['tag'].'tree2'); ?>" >
        			<input id="<?php echo $this->get_field_id($WoWclasses[$i]['tag'].'tree2'); ?>" name="<?php echo $this->get_field_name($WoWclasses[$i]['tag'].'tree2'); ?>" type="checkbox" value="1"  <?php checked(true, $instance[$WoWclasses[$i]['tag'].'tree2']); ?> />
        			<?php echo $WoWclasses[$i]['tree2']; ?>
        			</label><br />
        			<label for="<?php echo $this->get_field_id($WoWclasses[$i]['tag'].'tree3'); ?>" >
        			<input id="<?php echo $this->get_field_id($WoWclasses[$i]['tag'].'tree3'); ?>" name="<?php echo $this->get_field_name($WoWclasses[$i]['tag'].'tree3'); ?>" type="checkbox" value="1" <?php checked(true, $instance[$WoWclasses[$i]['tag'].'tree3']); ?> />
        			<?php echo $WoWclasses[$i]['tree3']; ?>
        			</label>
        		</p>
        	<?php
        }
        
        
	} 
}

function wowrecrut_add_style($name, $css, $isize)
{
	global $wowRecrutStyles;
	
	$temparr = array (
				'name' => $name,
				'css' => $css,
				'$isize' => $isize,
				'active' => 0
				);
	array_push($wowRecrutStyles, $temparr);
}

function wowrecrut_init_widget()
{
	return register_widget('wowrecrut_Widget');
}

function wowrecrut_add_header()
{
	global $wowRecrutStyles;
	
	$style = get_option('wowrecrut-style');
	
	if(empty($style)) {
		add_option('wowrecrut-style', 0);
		$style = 0;
	}
	
	echo "\n<link rel=\"stylesheet\" type=\"text/css\" href=\"".$wowRecrutStyles[$style]['css']."\" />";
}

add_action('widgets_init', 'wowrecrut_init_widget');
add_action('wp_head', 'wowrecrut_add_header');
