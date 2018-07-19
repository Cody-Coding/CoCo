<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_CONTENTS_SKIN_URL.'/style.css">', 0);
?>

<!-- 위시리스트 간략 보기 시작 { -->
<aside id="swish">
    <h2><?php echo _t('위시리스트'); ?></h2>

    <ul>
    <?php
    if($g5['is_db_trans'] && file_exists($g5['locale_path'].'/include/skin.contents.boxwish.skin.inc.php')) {
        include_once $g5['locale_path'].'/include/skin.contents.boxwish.skin.inc.php';
    } else {
        $hsql  = " select a.it_id, b.it_name from {$g5['g5_contents_wish_table']} a, {$g5['g5_contents_item_table']} b ";
        $hsql .= " where a.mb_id = '{$member['mb_id']}' and a.it_id  = b.it_id order by a.wi_id desc ";
    }
    $hresult = sql_query($hsql);
    for ($i=0; $row=sql_fetch_array($hresult); $i++)
    {
        echo '<li>';
        $it_name = get_text(_t($row['it_name']));
        // 이미지로 할 경우
        //$it_name = cm_get_it_image($row[it_id], 50, 50, true);
        echo '<a href="'.G5_CONTENTS_URL.'/wishlist.php">'.$it_name.'</a>';
        echo '</li>';
    }

    if ($i==0)
        echo '<li id="swish_empty">'._t('위시리스트 없음').'</li>'.PHP_EOL;
?>
    </ul>

</aside>
<!-- } 위시리스트 간략 보기 끝 -->
