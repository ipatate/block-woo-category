<?php

namespace GMBlockWooCategory;

/**
 * Plugin Name:       Gm Woo Category
 * Description:       This plugin allows you to display category Woocommerce in a block.
 * Requires at least: 5.7
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Faramaz Patrick <infos@goodmotion.fr>
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       gm-woo-category
 *
 * @package           goodmotion
 */



function block_init()
{
	register_block_type_from_metadata(__DIR__, [
		"render_callback" => __NAMESPACE__ . '\render_callback',
		'attributes' => [
			'category' => [
				'type' => "string",
			],
		]
	]);
}
add_action('init', __NAMESPACE__ . '\block_init');


function render_callback($attributes, $content)
{
	if ($attributes['category'] !== null) {
		$category = get_term($attributes['category']);
		if ($category) {
			$link = get_term_link($category->term_id);
			// icon
			$iconId = get_term_meta($category->term_id, 'gm-woo-icon', true);
			$icon = $iconId ? wp_get_attachment_url($iconId) : null;
			$thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
			$image = wp_get_attachment_url($thumbnail_id);
			$html = '';
			$html .= '<div class="gm-woo-category">';
			$html .= '<h2><a href="' . $link . '" title="' . $category->name . '">' . $category->name;
			$html .= '<span>';
			if ($icon) {
				$html .= '<span><img src="' . $icon . '" alt=""/></span>';
			}
			$html .= '</span>';
			$html .= '</a></h2>';
			$html .= '<a href="' . $link . '" title="' . $category->name . '">';
			if ($image) {
				$html .= '<img src="' . $image . '" alt=""/>';
			}
			$html .= '</a>';
			$html .= '</div>';

			return $html;
		}
	}
	return 'Choose a category on panel';
}
