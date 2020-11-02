<?php  

namespace ProradioElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Icons_Manager;
class Icons_Control_Test_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'icons_test_widget';
	}

	public function get_title() {
		return __( 'Icons Test Widget', 'text-domain' );
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => __( 'Icon', 'text-domain' ),
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="my-icon-wrapper">
			<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
		</div>
		<?php
	}

	protected function _content_template() {
		?>

		<div class="my-icon-wrapper">
			{{{ iconHTML.value }}}
		</div>
		<?php
	}
}