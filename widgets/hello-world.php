<?php
namespace ElementorHelloWorld\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Hello_World extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'hello-world';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Hello World', 'elementor-hello-world' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'siva-plugins' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'elementor-hello-world' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'elementor-hello-world' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'elementor-hello-world' ),
				'type' => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'Subtitle',
			[
				'label' => __( 'SubTitle', 'elementor-hello-world' ),
				'type' => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'gallery',
			[
				'label' => __( 'Add Images', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'default' => [],
			]
		);
		
		
		


		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'elementor-hello-world' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => __( 'Typography', 'elementor-hello-world' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'elementor-hello-world' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: {{VALUE}}',
				],
			]
		);
		
		
		
		
		
		$this->add_control(
			'width',
			[
				'label' => __( 'Width', 'elementor-hello-world' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .box' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'show_title',
			[
				'label' => __( 'Show Title', 'elementor-hello-world' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'elementor-hello-world' ),
				'label_off' => __( 'Hide', 'elementor-hello-world' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		
		
	
		

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_advanced',
			[
				'label' => __( 'Opacity Change', 'elementor-hello-world' ),
				'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);
		
		$this->add_control(
			'title_color1', 
			[
				'label' => __( 'Title Color', 'elementor-hello-world' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'transparent',
			[
				'label' => __( 'Enable', 'elementor-hello-world' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'elementor-hello-world' ),
				'label_off' => __( 'Off', 'elementor-hello-world' ),
				'return_value' => 'yes',
				'default' => '',
				'frontend_available' => true,
				'prefix_class'  => 'opacity-siva-border-',
				'selectors' => [
					'{{WRAPPER}} .title2' => 'color: {{VALUE}}',
				],
			]
		);
		
		
		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		
		echo '<div class = "selector-demo">';
		echo '<div class="title div33 el">';
		echo $settings['title'];
		echo '<div class = "box" style="background-color:blue; width: ' . $settings['width']['size'] . $settings['width']['unit'] . '">';
		echo 'Hello';
		echo '</div>';
		echo '</div>';
		
		echo '<div class = "wrapper">
		Hello Circle
		</div>';
		
       if ( 'yes' === $settings['show_title'] ) {
		echo '<div class="title div34 el">';
		echo $settings['Subtitle'];
		echo '</div>';
		echo '<div class="title2 div35 el">';
		echo $settings['Subtitle'];
		echo '</div>';
		}
        
		foreach ( $settings['gallery'] as $image ) {
			echo '<img class = "siva_image_drag" src="' . $image['url'] . '">';
		}
		
		echo '</div>';
		echo '<div class="selector-demo">';
		echo '<div class = "div33 el"> Anime Demo</div> <div class = "div34 el"> Anime Demo</div> <div class = "div35 el"> Anime Demo</div>';
		echo $settings['class'];
		echo '</div>';
		
		
		
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _content_template() {
		?>
		<div class = "selector-demo">
		<div class="title div33 el">
			{{{ settings.title }}}
			<div class="box" style=" background-color:blue;width: {{ settings.width.size }}{{ settings.width.unit }}">
			Hello
			</div>
		</div>
		
		<div class = "wrapper">
		Hey Circle
		</div>
		
		<# if ( 'yes' === settings.show_title ) { #>
			<div class="title div34 el">{{{ settings.Subtitle }}}</div>
		<# } #>
		<div class="title2 div35 el">{{{ settings.Subtitle }}}</div>
		
		<# _.each( settings.gallery, function( image ) { #>
			<img class = "siva_image_drag" src="{{ image.url }}">
		<# }); #>
		</div>
		<div class = "selector-demo">
		<div class = "div33 el"> Anime Demo</div> <div class = "div34 el"> Anime Demo</div> <div class = "div35 el"> Anime Demo</div>
		{{{settings.class}}}
		</div>
		<?php
	}
}
