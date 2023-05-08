<?php
/*
Plugin Name: Flashing Text Elementor Widget
Plugin URI: https://webinwordpress.com/
Description: A custom widget for Elementor that displays a flashing text.
Version: 1.0
Author: Bharat
Author URI: https://webinwordpress.com/
*/

class Flashing_Text_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'flashing-text';
    }

    public function get_title() {
        return __( 'Flashing Text', 'plugin-name' );
    }

    public function get_icon() {
        return 'fa fa-bolt';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'plugin-name' ),
            ]
        );

        $this->add_control(
            'text',
            [
                'label' => __( 'Text', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Flashing Text',
                'placeholder' => __( 'Enter your flashing text', 'plugin-name' ),
            ]
        );

        $this->add_control(
            'speed',
            [
                'label' => __( 'Speed (in milliseconds)', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => '500',
                'placeholder' => __( 'Enter the speed in milliseconds', 'plugin-name' ),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        echo '<span class="flashing-text" data-speed="' . $settings['speed'] . '">' . $settings['text'] . '</span>';
    }

    protected function _content_template() {
        ?>
        <#
        view.addInlineEditingAttributes( 'text', 'none' );
        view.addInlineEditingAttributes( 'speed', 'none' );
        #>

        <span class="flashing-text" data-speed="{{ settings.speed }}"><#= settings.text #></span>
        <?php
    }
}

function register_flashing_text_widget() {
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Flashing_Text_Widget() );
}
add_action( 'elementor/widgets/widgets_registered', 'register_flashing_text_widget' );

function enqueue_flashing_text_scripts() {
    wp_enqueue_script(
        'flashing-text-script',
        plugin_dir_url( __FILE__ ) . 'flashing-text.js',
        array( 'jquery' ),
        '1.0',
        true
    );
}
add_action( 'wp_enqueue_scripts', 'enqueue_flashing_text_scripts' );
