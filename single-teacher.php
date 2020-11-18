<?php

get_header();
if (have_posts()):
    the_post();

    $users = get_users([
        'role' => 'teacher',
        'fields' => 'all_with_meta'
    ]);
    ?>
    <div class="container container_fixed container_full-width_m-less content-box">
        <?php
        the_title('<h1>', '</h1>'); ?>
        <div class="content">
            <?php
            foreach ($users as $user): ?>
                <?php
                $userdata = get_user_meta($user->ID);
                var_dump($userdata['description'][0]); ?>
                <?php
                var_dump($user->data->user_login); ?>
            <?php
            endforeach; ?>
            <?php
            the_content(); ?>
        </div>
    </div>
<?php
endif;
get_footer();
