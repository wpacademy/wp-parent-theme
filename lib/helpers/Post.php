<?php

namespace Roots\ParentTheme\Helpers;

class Post {

    /**
     * Returns posts based on the provided arguments.
     *
     * @param $args
     * @return array
     */
    public static function all($args) {

        $posts = [];
        $i = 0;

        $q = new \WP_Query( $args );

        if ($q->have_posts()) {
            while ($q->have_posts()) {
                $q->the_post();

                $posts[$i] = [
                    'id' => get_the_ID(),
                    'permalink' => get_permalink(),
                    'title' => get_the_title(),
                    'excerpt' => get_the_excerpt(),
                    'content' => get_the_content(),
                    'date' => get_the_time('Y-m-d H:i:s'),
                    'category' => [
                        'id' => get_the_category(get_the_ID())[0]->cat_ID,
                        'name' => get_the_category(get_the_ID())[0]->name
                    ]
                ];

                if ( has_post_thumbnail() ) {
                    $posts[$i]['img'] = [
                        'thumbnail' => wp_get_attachment_image_src( get_post_thumbnail_id($posts[$i]['id']), 'thumbnail' )[0],
                        'medium' => wp_get_attachment_image_src( get_post_thumbnail_id($posts[$i]['id']), 'medium' )[0]
                    ];
                }

                $i++;
            }
        }

        return $posts;
    }

    /**
     * Returns a post based on the provided id.
     *
     * @param $id
     * @return array
     */
    public static function getById($id) {

        $post = [];

        $q = new \WP_Query( ['p' => $id, 'post_type' => 'post'] );

        if ($q->have_posts()) {
            while ($q->have_posts()) {
                $q->the_post();

                $post = [
                    'id' => get_the_ID(),
                    'permalink' => get_permalink(),
                    'title' => get_the_title(),
                    'excerpt' => get_the_excerpt(),
                    'content' => get_the_content(),
                    'date' => get_the_time('Y-m-d H:i:s'),
                    'category' => [
                        'id' => get_the_category(get_the_ID())[0]->cat_ID,
                        'name' => get_the_category(get_the_ID())[0]->name
                    ]
                ];

                if ( has_post_thumbnail() ) {
                    $post['img'] = [
                        'thumbnail' => wp_get_attachment_image_src( get_post_thumbnail_id($post['id']), 'thumbnail' )[0],
                        'medium' => wp_get_attachment_image_src( get_post_thumbnail_id($post['id']), 'medium' )[0]
                    ];
                }
            }
        }

        return $post;
    }

    /**
     * Returns a post based on the provided offset.
     *
     * @param int $offset
     * @param array $cond
     * @return mixed
     */
    public static function getByOffset($offset = 0, $cond = []) {
        $args = array('posts_per_page' => 1, 'offset' => $offset);
        if ( !empty($cond) ) {
            $args = array_merge($args, $cond);
        }
        $q = new \WP_Query( $args );
        if ($q->have_posts()) {
            while ($q->have_posts()) {
                $q->the_post();
                $id = get_the_ID();
                return self::getById($id);
            }
        }
    }

}