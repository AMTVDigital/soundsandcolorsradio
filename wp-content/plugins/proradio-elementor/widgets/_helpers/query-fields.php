<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.1.4
*/

namespace ProradioElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;


add_action('elementor/element/before_section_end', function( $section, $section_id, $args ) {


	if( $section_id == 'proradio_elementor_section_query_global' ){
			$section->add_control(
				'include_by_id',
				[
					'label' => esc_html__( 'Posts by ID, comma separated list of numeric IDs', 'proradio-elementor' ),
					'description' => esc_html__("Display only the contents with these IDs. All other parameters will be ignored.", 'proradio-elementor'),
					'type' => Controls_Manager::TEXT,
				]
			);
			$section->add_control(
				'items_per_page',
				[
					'label' => esc_html__( 'Max items', 'proradio-elementor' ),
					'type' => Controls_Manager::NUMBER,
					'min' => 1,
					'max' => 20,
					'step' => 1,
					'default' => 5,
				]
			);
			
			$section->add_control(
				'orderby',
				[
					'label' => esc_html__( 'Order by', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'multiple' => false,
					'options' =>[
						'date' => esc_html__( 'Date', 'proradio-elementor' ),
						'ID' => esc_html__( 'Post ID', 'proradio-elementor' ),
						'author' => esc_html__( 'Author', 'proradio-elementor' ),
						'title' => esc_html__( 'Title', 'proradio-elementor' ),
						'modified' => esc_html__( 'Last modified date', 'proradio-elementor' ),
						'parent' => esc_html__( 'Post/page parent ID', 'proradio-elementor' ),
						'comment_count' => esc_html__( 'Number of comments', 'proradio-elementor' ),
						'menu_order' => esc_html__( 'Menu order', 'proradio-elementor' ),
						'meta_value' => esc_html__( 'Meta value', 'proradio-elementor' ),
						'rand' => esc_html__( 'Random', 'proradio-elementor' ),
					],
				]
			);
			$section->add_control(
				'order',
				[
					'label' => esc_html__( 'Order', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'multiple' => false,
					'options' =>[
						'DESC' => esc_html__( 'Descending', 'proradio' ),
						'ASC' => esc_html__( 'Ascending', 'proradio' ),
					],
				]
			);
			$section->add_control(
				'meta_key',
				[
					'label' => esc_html__( 'Meta key', 'proradio-elementor' ),
					'description' => esc_html__("Order based on this meta key", 'proradio-elementor'),
					'type' => Controls_Manager::TEXT,
					'condition' => [
						'orderby' => 'meta_value',
					],
				]
			);
			$section->add_control(
				'offset',
				[
					'label' => esc_html__( 'Offset', 'proradio-elementor' ),
					'description' => esc_html__('Number of grid elements to displace or pass over.', 'proradio-elementor'),
					'type' => Controls_Manager::TEXT,
				]
			);
			$section->add_control(
				'exclude',
				[
					'label' => esc_html__( 'Exclude', 'proradio-elementor' ),
					'description' => esc_html__('Comma-separated list of IDs to exclude', 'proradio-elementor'),
					'type' => Controls_Manager::TEXT,
				]
			);
	}
}, 10, 3 );