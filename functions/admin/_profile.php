<?php
# -----------------------------------------------------------------
# プロフィール画面のカスタマイズ
# -----------------------------------------------------------------
/**
 * プロフィール画面にナイスネームを追加
 * 参考サイト
 * https://xakuro.com/blog/wordpress/2579/
 */
add_action( 'show_user_profile', 'cmll_user_profile' );
add_action( 'edit_user_profile', 'cmll_user_profile' );
add_action( 'user_profile_update_errors', 'cmll_user_profile_update_errors', 20, 3 );

if(!function_exists('cmll_user_profile')) {
	function cmll_user_profile() {
		global $profileuser;
		?>
		<h2>ユーザー情報</h2>
		<table class="form-table" role="presentation">
		<tbody>
		<tr class="user-last-name-wrap">
			<th><label for="user_nicename">ナイスネーム</label></th>
			<td>
			<input type="text" name="user_nicename" id="user_nicename" value="<?php echo esc_attr( $profileuser->user_nicename ); ?>" class="regular-text" />
			<p class="description">ナイスネームは投稿者アーカイブページのスラッグとして使用されます。</p>
			</td>
		</tr>
		</tbody></table>
		<?php
	}
}

if(!function_exists('cmll_user_profile_update_errors')) {
	function cmll_user_profile_update_errors( $errors, $update, $user ) {
		if ( ! $update ) {
			return;
		}

		if ( empty( $user->ID ) ) {
			return;
		}

		check_admin_referer( 'update-user_' . $user->ID );
		if ( isset( $_POST['user_nicename'] ) ) {
			$user_nicename = sanitize_user( wp_unslash( $_POST['user_nicename'] ), true );

			if ( empty( $user_nicename ) ) {
				return;
			}
			$old_user_nicename = get_user_by( 'id', $user->ID )->user_nicename;
			if ( $user_nicename === $old_user_nicename ) {
				return;
			}
			if ( mb_strlen( $user_nicename ) > 50 ) {
				$errors->add( 'user_nicename_too_long', '<strong>エラー</strong>: ナイスネームは50文字以内にしてください。' );
				return;
			}
			if ( get_user_by( 'slug', $user_nicename ) ) {
				$errors->add( 'user_nicename_exists', '<strong>エラー</strong>: ナイスネームが同じ名前のものがすでに存在しています。別の名前にしてください。' );
				return;
			}
			$user->user_nicename = $user_nicename;
		}
	}
}
