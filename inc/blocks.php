<?php

function acf_init_sm_blocks()
{
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name' => 'about-author',
            'title' => __('Об авторе'),
            'render_template' => 'template-parts/blocks/about-author/about-author.php',
            'enqueue_style' => get_template_directory_uri() . '/template-parts/blocks/about-author/about-author.min.css',
            'category' => 'formatting',
            'keywords' => array('автор', 'об авторе'),
            'supports' => array(
                'align' => false,
            )
        ));

        acf_register_block_type(array(
            'name' => 'about-webinar',
            'title' => __('О мастер классе'),
            'render_template' => 'template-parts/blocks/about-webinar/about-webinar.php',
            'category' => 'formatting',
            'keywords' => array('мастер', 'класс'),
            'supports' => array(
                'align' => false,
            )
        ));

        acf_register_block_type(array(
            'name' => 'course-contents',
            'title' => __('Содержание'),
            'render_template' => 'template-parts/blocks/course-contents/course-contents.php',
            'category' => 'formatting',
            'keywords' => array('содержание'),
            'supports' => array(
                'align' => false,
            )
        ));
    }
}

add_action('acf/init', 'acf_init_sm_blocks');
