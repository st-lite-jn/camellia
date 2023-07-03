<?php
//======================================================================
// クエリーに応じてパンくずリストを生成
//======================================================================



function cmll_shortcode_content_label() {
    global $cmll_title;

    $content_label = $cmll_title["content-label"];
    $content_title_html = null;
	$content_title_html .= "
                <section class='is-layout-constrained wp-block-group cmll-title__item is-post'>
                    <h1>{$content_label}</h1>
                </section>
                        ";
    $content_title_html = preg_replace('/(\t|\r\n|\r|\n)/s', '', $content_title_html);
    return $content_title_html;
 }

add_shortcode( "display-content-label", "cmll_shortcode_content_label" );
