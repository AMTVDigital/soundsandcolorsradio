<?php  
/**
  CUSTOM PLAYER
* Current show
**/

namespace ProradioElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

$this->start_controls_section(
	'pr_currentshow_section',
	[
		'label' => esc_html__( 'Current show', 'elementor-proradio' ),
	]
);	


	$this->add_control(
		'pr_currentshow__enable',
		[
			'label' => esc_html__( 'Display current show', 'proradio-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'return_value' => '1',
		]
	);
	
	$this->add_control(
		'schedulefilter',
		[
			'label' => esc_html__( 'Schedule filter', 'proradio-elementor' ),
			'type' => \Elementor\Controls_Manager::SELECT2,
			'label_block' => true,
			'options' => proradio_elementor_get_terms_array('schedulefilter'),
			'condition' => [
				'pr_currentshow__enable' => '1',
			],
		]
	);

	$this->add_control(
		'pr_currentshow__refresh',
		[
			'label' => esc_html__( 'Auto refresh show at timed interval', 'proradio-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'return_value' => '1',
			'condition' => [
				'pr_currentshow__enable' => '1',
			],
		]
	);



	$this->add_control(
		'pr_currentshow__art',
		[
			'label' => esc_html__( 'Display show thumbnail', 'proradio-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'return_value' => '1',
			'condition' => [
				'pr_currentshow__enable' => '1',
			],
		]
	);

	$this->add_control(
		'pr_currentshow__art_size',
		[
			'label' => esc_html__( 'Image size', 'elementor-proradio' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'multiple' => false,
			'default' => 'proradio-squared-s',
			'options' =>[
				
				'proradio-squared-s' 	=>	esc_html__( "Squared small", "elementor-proradio"),
				'proradio-squared-m' 	=>	esc_html__( "Squared medium", "elementor-proradio"),
				'post-thumbnail' => esc_html__( "Thumbnail", "proradio"),
				'medium' => esc_html__( "Medium", "proradio"),
				'large' => esc_html__( "Large", "proradio"),
			],
			'conditions' => [
			    'relation' => 'and',
			    'terms' => [
			        [
			            'name' => 'pr_currentshow__enable',
			            'operator' => '==',
			            'value' => '1'
			        ],
			        [
			            'name' => 'pr_currentshow__art',
			            'operator' => '==',
			            'value' => '1'
			        ]
			    ]
			]
		]
	);

	$this->add_responsive_control(
		'pr_currentshow__art_width',
		[
			'label' => esc_html__( 'Size', 'elementor-proradio' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'range' => [
				'px' => [
					'min' => 20,
					'max' => 1000,
				],
			],
			'devices' => [ 'desktop', 'tablet', 'mobile' ],
			'desktop_default' => [
				'size' => 50,
				'unit' => 'px',
			],
			'tablet_default' => [
				'size' => 50,
				'unit' => 'px',
			],
			'mobile_default' => [
				'size' => 50,
				'unit' => 'px',
			],
			'selectors' => [
				'{{WRAPPER}} .proradio-customplayer__showart img' => 'max-width: {{SIZE}}{{UNIT}};height: auto;'
			],

			'conditions' => [
			    'relation' => 'and',
			    'terms' => [
			        [
			            'name' => 'pr_currentshow__enable',
			            'operator' => '==',
			            'value' => '1'
			        ],
			        [
			            'name' => 'pr_currentshow__art',
			            'operator' => '==',
			            'value' => '1'
			        ]
			    ]
			]
		]
	);

	$this->add_responsive_control(
		'pr_currentshow__art-radius',
		[
			'label' => esc_html__( 'Border radius', 'elementor-proradio' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 500,
				],
			],
			'devices' => [ 'desktop', 'tablet', 'mobile' ],
			'desktop_default' => [
				'size' => 5,
				'unit' => 'px',
			],
			'tablet_default' => [
				'size' => 5,
				'unit' => 'px',
			],
			'mobile_default' => [
				'size' => 5,
				'unit' => 'px',
			],
			'selectors' => [
				'{{WRAPPER}} .proradio-customplayer__showart img  ' => 'border-radius: {{SIZE}}{{UNIT}};',
			],
			'conditions' => [
			    'relation' => 'and',
			    'terms' => [
			        [
			            'name' => 'pr_currentshow__enable',
			            'operator' => '==',
			            'value' => '1'
			        ],
			        [
			            'name' => 'pr_currentshow__art',
			            'operator' => '==',
			            'value' => '1'
			        ]
			    ]
			]
		]
	);

	/**
	*	===========================================
	*	Show title
	*	===========================================
	*/
	$this->add_control(
		'pr_currentshow__title',
		[
			'label' => esc_html__( 'Display show title', 'proradio-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'return_value' => '1',
			'condition' => [
				'pr_currentshow__enable' => '1',
			],
		]
	);
	$this->add_group_control(
		Group_Control_Typography::get_type(),
		[
			'name' => 'pr_currentshow__title_typo',
			'label' => esc_html__( 'Title typography', 'erplayer' ),
			'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .proradio-customplayer__showtitle',
			'exclude' => [],
			'conditions' => [
			    'relation' => 'and',
			    'terms' => [
			        [
			            'name' => 'pr_currentshow__enable',
			            'operator' => '==',
			            'value' => '1'
			        ],
			        [
			            'name' => 'pr_currentshow__title',
			            'operator' => '==',
			            'value' => '1'
			        ]
			    ]
			]
		]
	);

	/**
	*	===========================================
	*	Show subtitle
	*	===========================================
	*/
	$this->add_control(
		'pr_currentshow__subtitle',
		[
			'label' => esc_html__( 'Display subtitle', 'proradio-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'return_value' => '1',
			'condition' => [
				'pr_currentshow__enable' => '1',
			],
		]
	);
	$this->add_group_control(
		Group_Control_Typography::get_type(),
		[
			'name' => 'pr_currentshow__subt_typo',
			'label' => esc_html__( 'Subtitle typography', 'erplayer' ),
			'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .proradio-customplayer__subtitle',
			'exclude' => [],
			'conditions' => [
			    'relation' => 'and',
			    'terms' => [
			        [
			            'name' => 'pr_currentshow__enable',
			            'operator' => '==',
			            'value' => '1'
			        ],
			        [
			            'name' => 'pr_currentshow__subtitle',
			            'operator' => '==',
			            'value' => '1'
			        ]
			    ]
			]
		]
	);


	$this->add_control(
		'pr_currentshow__time',
		[
			'label' => esc_html__( 'Display time', 'proradio-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'return_value' => '1',
			'condition' => [
				'pr_currentshow__enable' => '1',
			],
		]
	);


	$this->add_responsive_control(
		'pr_currentshow__contentpaddings',
		[
			'label' => __( 'Text padding', 'kentha-elementor' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'default' =>[
				'isLinked' => false,
				],
			'selectors' => [
				'{{WRAPPER}} .proradio-customplayer__showcontents' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'condition' => [
				'pr_currentshow__enable' => '1',
			],
		]
	);



	$this->add_control(
		'pr_currentshow__contentpaddings-display-as',
		[
			'label' => esc_html__( 'Display as', 'elementor-proradio' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'multiple' => false,
			'default' => 'row',
			'options' =>[
				'row' => esc_html__( "Row", "proradio"),
				'column' 	=>	esc_html__( "Column", "elementor-proradio"),
			],
			'selectors' => [
				'{{WRAPPER}} .proradio-customplayer__show  ' => 'flex-direction: {{VALUE}};',
			],
		]
	);

	$this->add_control(
		'pr_currentshow_alignment',
		[
			'label' => esc_html__( 'Alignment', 'elementor-proradio' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'multiple' => false,
			'options' =>[
				'' => esc_html__( "Default", "proradio"),
				'left' 	=>	esc_html__( "Left", "elementor-proradio"),
				'right'	=>	esc_html__( "Right", "elementor-proradio"),
				'center'	=>	esc_html__( "Center", "elementor-proradio"),
			],
			'selectors' => [
				'{{WRAPPER}} .proradio-customplayer__show , {{WRAPPER}} .proradio-customplayer__show  * ' => 'text-align: {{VALUE}};',
				'{{WRAPPER}} .proradio-customplayer__show  ' =>'align-items:  {{VALUE}};justify-content:  {{VALUE}};',
			],
		]
	);


	$this->add_responsive_control(
		'pr_currentshow_spacearound',
		[
			'label' => __( 'Space around', 'kentha-elementor' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'default' =>[
				'isLinked' => false,
				],
			'selectors' => [
				'{{WRAPPER}} .proradio-customplayer__show' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'condition' => [
				'pr_currentshow__enable' => '1',
			],
		]
	);





$this->end_controls_section();
?>