<?php
# -----------------------------------------------------------------
# タクソノミー（カテゴリ・タグ含む）管理画面のカスタマイズ
# -----------------------------------------------------------------
/**
* 親カテゴリを非表示化
*/
// function cmll_parent_cat_disable() {
// 	if(isset($_GET['taxonomy'])) {
// 		$taxonomy = $_GET['taxonomy'];
// 	} else {
// 		$taxonomy = "";
// 	}
// echo <<< EOM
// <script>
// window.addEventListener("DOMContentLoaded",function(){
// 	const termParentWraps = document.querySelectorAll(".term-parent-wrap,.term-parent-wrap");
// 	termParentWraps.forEach(termParentWrap => termParentWrap.style.display="none");
// });
// </script>
// EOM;
// }
// add_action('admin_head-edit-tags.php', 'cmll_parent_cat_disable');
// add_action('admin_head-term.php', 'cmll_parent_cat_disable');
