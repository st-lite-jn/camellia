<?php
# -----------------------------------------------------------------
# コメント機能のカスタマイズ
# -----------------------------------------------------------------
/**
 * コメント一覧のカスタマイズ
 */
if ( ! class_exists( 'cmll_Walker_Comment' ) ) {
class cmll_Walker_Comment extends Walker_Comment {

	//閉じタグの制御
	public function end_el( &$output, $comment, $depth = 0, $args = array() ) {
		if ( 'div' === $args['style'] ) {
			$output .= "";
		} else {
			$output .= "</li><!-- #comment-## -->\n";
		}
	}
	function html5_comment( $comment, $depth, $args ) {
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
		$commenter = wp_get_current_commenter();
		if ( $commenter['comment_author_email'] ) {
			$moderation_note = __( 'Your comment is awaiting moderation.' );
		} else {
			$moderation_note = __( 'Your comment is awaiting moderation. This is a preview, your comment will be visible after it has been approved.' );
		}
		$comment_author = $comment->comment_author_url
						? "<a class='p-comment__meta__author' href='{$comment->comment_author_url}'>{$comment->comment_author}</a>"
						: "<span class='p-comment__meta__author'>{$comment->comment_author}</span>";

	?>
		<article id="comment-<?php comment_ID(); ?>" class="p-comment">
		<?php if ( '0' == $comment->comment_approved ) : ?>
			<em class="comment-awaiting-moderation"><?php echo $moderation_note; ?></em>
		<?php endif; ?>
			<!-- コメント本文 -->
			<div class="p-comment__body">
			<?php
				$comment_text = nl2br(esc_html(get_comment_text()));
				echo "<p>{$comment_text}</p>";
			?>
			</div>
			<div class="p-comment__meta u-mt--8">
				<figure class="p-comment__meta__avatar"><?php echo get_avatar( $comment, $args['avatar_size'] );?></figure>
				<?php echo $comment_author; ?>
				<time class="p-comment__meta__date"><?php echo get_comment_date( '', $comment ); ?></time>
				<?php //edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
			</div>
			<!-- //p-comment__meta -->
			<?php
				comment_reply_link(
					array_merge(
						$args,
						array(
							'reply_text' => '返信する',
							'depth' => $depth,
							'before'    => '<nav class="p-comment-reply u-mt--8">',
							'after'     => '</nav>',
							'max_depth' => $args['max_depth']
						)
					)
				);
			?>
		</article>
		<!-- //コメント-->
		<?php if($depth > 1):?></<?php echo $tag;?>><?php endif;?>
		<?php if($this->has_children):?><<?php echo $tag;?> class="is-child u-mt--12 u-ml--12"><?php endif;?>

	<?php
		}
	}
}

add_filter( 'comment_form_default_fields', 'cmll_comment_form_fields' );
add_filter( 'comment_form_defaults', 'cmll_custom_comment_form' );
/**
 * コメント投稿フォームの修正
 */
if(!function_exists("cmll_comment_form_fields")) {
	function cmll_comment_form_fields($fields) {

		$commenter = wp_get_current_commenter();
		$comment_author = esc_attr( $commenter['comment_author'] );
		$comment_email = esc_attr(  $commenter['comment_author_email'] );

		$req_class = get_option( 'require_name_email' ) ? "<span class=\"p-comment-form__required\">*</span>" : '' ;
		$req_aria = get_option( 'require_name_email' ) ? " aria-required='true' " : '';

		$fields =  array(
			"author" => "
				<div class='p-comment-form is-author'>
					<div class='p-comment-form__label'>
						<label for='author'>名前{$req_class}</label>
					</div>
					<div class='p-comment-form__input'>
						<input id='author' name='author' type='text' value='{$comment_author}' size='30' {$req_aria} />
					</div>
				</div>",
			"email" => "
				<div class='p-comment-form is-email'>
					<div class='p-comment-form__label'>
						<label for='email'>Email{$req_class}</label>
					</div>
					<div class='p-comment-form__input'>
						<input id='email' name='email' type='email' value='{$comment_email}' size='30' {$req_aria} />
					</div>
				</div>",
			"url" => "
				<div class='p-comment-form is-url'>
					<div class='p-comment-form__label'>
						<label for='url'>Webサイト</label>
					</div>
					<div class='p-comment-form__input'>
						<input id='url' name='url' type='url' value='' size='30' maxlength='200' />
					</div>
				</div>",
			"cookies" => "
				<div class='p-comment-form is-cookies'>
					<input id='wp-comment-cookies-consent' name='wp-comment-cookies-consent' type='checkbox' value='yes' />
					<label for='wp-comment-cookies-consent' class='p-comment-form__label-for-check'>次回のコメントで使用するためブラウザーに自分の名前、メールアドレス、サイトを保存する。</label>
				</div>",
		);

		return $fields;
	}
}
function cmll_custom_comment_form( $args ) {

	$args["comment_field"] = "
			<div class='p-comment-form is-comment'>
				<div class='p-comment-form__label'>
					<label for='comment'>コメント</label>
				</div>
				<div class='p-comment-form__input'>
					<textarea id='comment' name='comment' class='p-comment-form__comment' cols='45' rows='8' maxlength='65525' required='required'></textarea>
				</div>
			</div>";
	$args['comment_notes_after'] = '';
	$args['label_submit'] = 'コメントを送信する';
	return $args;
}
