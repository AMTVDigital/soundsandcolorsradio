<?php  

namespace ProradioElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Control_Dimensions;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

$this->start_controls_section(
'section_button',
[
	'label' => esc_html__( 'Button', 'elementor-proradio' ),
]
);

$this->add_control(
	'display_button',
	[
		'label' => esc_html__( 'Display button', 'proradio-elementor' ),
		'type' => Controls_Manager::SWITCHER,
		'return_value' => '1',
		'default' => '1',
	]
);


$this->add_control(
	'pr_btn_position',
	[
		'label' => esc_html__( 'Button position', 'elementor-proradio' ),
		'type' => \Elementor\Controls_Manager::SELECT,
		'multiple' => false,
		'default' => '1',
		'options' =>[
			"1" 	=> 	esc_html__( "Top","elementor-proradio"),
			"2" 	=> 	esc_html__( "Middle","elementor-proradio"),
			"3" 	=> 	esc_html__( "Last","elementor-proradio"),
		],
		'condition' => [
			'display_button' => '1',
		],
	]
);



$this->add_control(
	'text',
	[
		'label' => esc_html__( 'Button label', 'elementor-proradio' ),
		'type' => Controls_Manager::TEXT,
		'default' => 'Radio',
		'condition' => [
			'display_button' => '1',
		],
	]
);

$this->add_control(
	'playradio',
	[
		'label' => esc_html__( 'Play radio channel', 'proradio-elementor' ),
		'type' => Controls_Manager::SWITCHER,
		'return_value' => '1',
		'default' => '1',
		'condition' => [
			'display_button' => '1',
		],
	]
);

$this->add_control(
	'proradio_showicon',
	[
		'label' => esc_html__( 'Add icon', 'proradio-elementor' ),
		'type' => Controls_Manager::SWITCHER,
		'return_value' => '1',
		'default' => false,
		'conditions' => [
		    'relation' => 'and',
		    'terms' => [
		        [
		            'name' => 'playradio',
		            'operator' => '==',
		            'value' => '1'
		        ],
		        [
		            'name' => 'display_button',
		            'operator' => '==',
		            'value' => '1'
		        ]
		    ]
		]
	]
);

$this->add_control(
	'link',
	[
		'label' => esc_html__( 'Button link', 'elementor-proradio' ),
		'type' => Controls_Manager::TEXT,
		'conditions' => [
		    'relation' => 'and',
		    'terms' => [
		        [
		            'name' => 'playradio',
		            'operator' => '==',
		            'value' => '0'
		        ],
		        [
		            'name' => 'display_button',
		            'operator' => '==',
		            'value' => '1'
		        ]
		    ]
		]
	]
);

$this->add_control(
	'radio_id',
	[
		'label' => esc_html__( 'Play a radio channel on click', 'elementor-proradio' ),
		'type' => \Elementor\Controls_Manager::SELECT2,
		'label_block' => true,
		'multiple' => false,
		'options' => elementor_proradio_autocomplete('radiochannel'),
		'conditions' => [
		    'relation' => 'and',
		    'terms' => [
		        [
		            'name' => 'playradio',
		            'operator' => '==',
		            'value' => '1'
		        ],
		        [
		            'name' => 'display_button',
		            'operator' => '==',
		            'value' => '1'
		        ]
		    ]
		]
	]
);
$this->add_control(
	'target',
	[
		'label' => esc_html__( 'Button target', 'elementor-proradio' ),
		'type' => \Elementor\Controls_Manager::SELECT,
		'multiple' => false,
		'options' =>[
			'' => esc_html__('Default', 'elementor-proradio'),
			'_blank' => esc_html__('New tab', 'elementor-proradio'),
			'popup' => esc_html__('Popup', 'elementor-proradio')
		],
		'conditions' => [
		    'relation' => 'and',
		    'terms' => [
		        [
		            'name' => 'playradio',
		            'operator' => '==',
		            'value' => '0'
		        ],
		        [
		            'name' => 'display_button',
		            'operator' => '==',
		            'value' => '1'
		        ]
		    ]
		]
	]
);

$this->add_responsive_control(
	'popup_w',
	[
		'label' => __( 'Popup width', 'elementor-proradio' ),
		'type' => \Elementor\Controls_Manager::SLIDER,
		'range' => [
			'px' => [
				'min' => 180,
				'max' => 1600,
			],
		],
		'default' => [
			'unit' => 'px',
			'size' => 300,
		],
		'devices' => [ 'desktop' ],
	
		'conditions' => [
		    'relation' => 'and',
		    'terms' => [
		        [
		            'name' => 'target',
		            'operator' => '==',
		            'value' => 'popup'
		        ],
		        [
		            'name' => 'display_button',
		            'operator' => '==',
		            'value' => '1'
		        ]
		    ]
		]
	]
);
$this->add_responsive_control(
	'popup_h',
	[
		'label' => __( 'Popup height', 'elementor-proradio' ),
		'type' => \Elementor\Controls_Manager::SLIDER,
		'range' => [
			'px' => [
				'min' => 180,
				'max' => 1600,
			],
		],
		'default' => [
			'unit' => 'px',
			'size' => 300,
		],
		'devices' => [ 'desktop' ],
	

		'conditions' => [
		    'relation' => 'and',
		    'terms' => [
		        [
		            'name' => 'target',
		            'operator' => '==',
		            'value' => 'popup'
		        ],
		        [
		            'name' => 'display_button',
		            'operator' => '==',
		            'value' => '1'
		        ]
		    ]
		]
	]
);

$this->add_control(
	'style',
	[
		'label' => esc_html__( 'Style', 'elementor-proradio' ),
		'type' => \Elementor\Controls_Manager::SELECT,
		'multiple' => false,
		'options' =>[
			"proradio-btn-default" 	=> 	esc_html__( "Default","elementor-proradio"),
			"proradio-btn-primary" 	=> 	esc_html__( "Primary","elementor-proradio"),
			"proradio-btn__white" 	=> 	esc_html__( "White","elementor-proradio"),
			"proradio-btn__bold" 	=> 	esc_html__( "Bold","elementor-proradio"),
			"proradio-btn__txt" 	=> 	esc_html__( "Text only","elementor-proradio")
		],
		'condition' => [
			'display_button' => '1',
		],
	]
);

$this->add_control(
	'alignment',
	[
		'label' => esc_html__( 'Alignment', 'elementor-proradio' ),
		'type' => \Elementor\Controls_Manager::SELECT,
		'multiple' => false,
		'options' =>[
			'' => esc_html__( "Default", "proradio"),
			'alignleft' 	=>	esc_html__( "Left", "elementor-proradio"),
			'alignright'	=>	esc_html__( "Right", "elementor-proradio"),
			'aligncenter'	=>	esc_html__( "Center", "elementor-proradio"),
		],
		'condition' => [
			'display_button' => '1',
		],
	]
);


$this->add_responsive_control(
	'btn-size',
	[
		'label' => esc_html__( 'Size', 'elementor-proradio' ),
		'type' => \Elementor\Controls_Manager::SLIDER,
		'range' => [
			'px' => [
				'min' => 0,
				'max' => 32,
			],
		],
		'devices' => [ 'desktop', 'tablet', 'mobile' ],
		'selectors' => [
			'{{WRAPPER}} .proradio-btn' => 'font-size: {{SIZE}}{{UNIT}};',
		],
		'condition' => [
			'display_button' => '1',
		],
	]
);


$this->add_responsive_control(
		'pr_btn_padding',
		[
			'label' => __( 'Padding', 'kentha-elementor' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'default' =>[
				// 'top' => 14,
				// 'right' => 14,
				// 'bottom' => 14,
				// 'left' => 14,
				'isLinked' => false,
				],
			'selectors' => [
				'{{WRAPPER}} .proradio-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);


$this->add_responsive_control(
	'btn-radius',
	[
		'label' => esc_html__( 'Border-radius', 'elementor-proradio' ),
		'type' => \Elementor\Controls_Manager::SLIDER,
		'range' => [
			'px' => [
				'min' => 0,
				'max' => 100,
			],
		],
		'devices' => [ 'desktop', 'tablet', 'mobile' ],
		'selectors' => [
			'{{WRAPPER}} .proradio-btn' => 'border-radius: {{SIZE}}{{UNIT}};',
		],
		'condition' => [
			'display_button' => '1',
		],
	]
);
$this->add_control(
	'proradio-btn-bg',
	[
		'label' => esc_html__( 'Background', 'elementor-proradio' ),
		'type' => \Elementor\Controls_Manager::COLOR,
		'selectors' => [
			'{{WRAPPER}} .proradio-btn' => 'background-color: {{VALUE}} !important;',
		],
		'condition' => [
			'display_button' => '1',
		],
	]
);
$this->add_control(
	'proradio-btn-txt',
	[
		'label' => esc_html__( 'Text color', 'elementor-proradio' ),
		'type' => \Elementor\Controls_Manager::COLOR,
		'selectors' => [
			'{{WRAPPER}} .proradio-btn' => 'color: {{VALUE}} !important;',
		],
		'condition' => [
			'display_button' => '1',
		],
	]
);

$this->add_control(
	'proradio-btn-icon',
	[
		'label' => esc_html__( 'Icon color', 'elementor-proradio' ),
		'type' => \Elementor\Controls_Manager::COLOR,
		'selectors' => [
			'{{WRAPPER}} i' => 'color: {{VALUE}} !important;',
		],

		'conditions' => [
		    'relation' => 'and',
		    'terms' => [
		        [
		            'name' => 'proradio_showicon',
		            'operator' => '==',
		            'value' => '1'
		        ],
		        [
		            'name' => 'display_button',
		            'operator' => '==',
		            'value' => '1'
		        ]
		    ]
		]
	]
);

$this->add_group_control(
	\Elementor\Group_Control_Border::get_type(),
	[
		'name' => 'border',
		'label' => __( 'Border', 'plugin-domain' ),
		'selector' => '{{WRAPPER}} .proradio-btn',
		'condition' => [
			'display_button' => '1',
		],
	]
);



$this->add_control(
	'proradio-btn-bgh',
	[
		'label' => esc_html__( 'Background hover', 'elementor-proradio' ),
		'type' => \Elementor\Controls_Manager::COLOR,
		'selectors' => [
			'{{WRAPPER}} .proradio-btn:hover' => 'background-color: {{VALUE}} !important;',
		],
		'condition' => [
			'display_button' => '1',
		],
	]
);
$this->add_control(
	'proradio-btn-bch',
	[
		'label' => esc_html__( 'Border hover', 'elementor-proradio' ),
		'type' => \Elementor\Controls_Manager::COLOR,
		'selectors' => [
			'{{WRAPPER}} .proradio-btn:hover' => 'border-color: {{VALUE}} !important;',
		],
		'condition' => [
			'display_button' => '1',
		],
	]
);
$this->add_control(
	'proradio-btn-txthov',
	[
		'label' => esc_html__( 'Text color hover', 'elementor-proradio' ),
		'type' => \Elementor\Controls_Manager::COLOR,
		'selectors' => [
			'{{WRAPPER}} .proradio-btn:hover' => 'color: {{VALUE}} !important;',
		],
		'condition' => [
			'display_button' => '1',
		],
	]
);
$this->add_control(
	'proradio-btn-iconh',
	[
		'label' => esc_html__( 'Icon color hover', 'elementor-proradio' ),
		'type' => \Elementor\Controls_Manager::COLOR,
		'selectors' => [
			'{{WRAPPER}} .proradio-btn:hover .proradio-btn__icon ' => 'color: {{VALUE}} !important;',
		],
		'conditions' => [
		    'relation' => 'and',
		    'terms' => [
		        [
		            'name' => 'proradio_showicon',
		            'operator' => '==',
		            'value' => '1'
		        ],
		        [
		            'name' => 'display_button',
		            'operator' => '==',
		            'value' => '1'
		        ]
		    ]
		]
	]
);


$this->add_responsive_control(
		'pr_btn_spacearound',
		[
			'label' => __( 'Space around', 'kentha-elementor' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'default' =>[
				// 'top' => 14,
				// 'right' => 14,
				// 'bottom' => 14,
				// 'left' => 14,
				'isLinked' => false,
				],
			'selectors' => [
				'{{WRAPPER}} .proradio-customplayer__button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'condition' => [
				'display_button' => '1',
			],
		]
	);

$this->end_controls_section();
?>