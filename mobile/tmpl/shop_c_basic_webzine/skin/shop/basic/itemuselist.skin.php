<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<!-- 전체 상품 사용후기 목록 시작 { -->
<form method="get" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
<div id="sps_sch">
    <a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>"><?php echo _t('전체보기'); ?></a>
    <label for="sfl" class="sound_only"><?php echo _t('검색항목'); ?></label>
    <select name="sfl" id="sfl" required>
        <option value=""><?php echo _t('선택'); ?></option>
        <option value="b.it_name"   <?php echo get_selected($sfl, "b.it_name"); ?>><?php echo _t('상품명'); ?></option>
        <option value="a.it_id"     <?php echo get_selected($sfl, "a.it_id"); ?>><?php echo _t('상품코드'); ?></option>
        <option value="a.is_subject"<?php echo get_selected($sfl, "a.is_subject"); ?>><?php echo _t('후기제목'); ?></option>
        <option value="a.is_content"<?php echo get_selected($sfl, "a.is_content"); ?>><?php echo _t('후기내용'); ?></option>
        <option value="a.is_name"   <?php echo get_selected($sfl, "a.is_name"); ?>><?php echo _t('작성자명'); ?></option>
        <option value="a.mb_id"     <?php echo get_selected($sfl, "a.mb_id"); ?>><?php echo _t('작성자아이디'); ?></option>
    </select>
    <label for="stx" class="sound_only"><?php echo _t('검색어'); ?><strong class="sound_only"> <?php echo _t('필수'); ?></strong></label>
    <input type="text" name="stx" value="<?php echo $stx; ?>" id="stx" required class="required frm_input" size="10">
    <input type="submit" value="<?php echo _t('검색'); ?>" class="btn_submit">
</div>
</form>

<div id="sps">

    <!-- <p><?php echo _t($config['cf_title']); ?> 전체 사용후기 목록입니다.</p> -->

    <?php
    $thumbnail_width = 500;

    for ($i=0; $row=sql_fetch_array($result); $i++)
    {
        $num = $total_count - ($page - 1) * $rows - $i;
        $star = get_star($row['is_score']);

        $is_content = get_view_thumbnail(conv_content($row['is_content'], 1), $thumbnail_width);

        $row2 = sql_fetch(" select it_name from {$g5['g5_shop_item_table']} where it_id = '{$row['it_id']}' ");
        $it_href = G5_SHOP_URL."/item.php?it_id={$row['it_id']}";

        if ($i == 0) echo '<ol>';
    ?>
    <li>

        <div class="sps_img">
            <a href="<?php echo $it_href; ?>">
                <?php echo get_itemuselist_thumbnail($row['it_id'], $row['is_content'], 70, 70); ?>
                <span><?php echo _t($row2['it_name']); ?></span>
            </a>
        </div>

        <section class="sps_section">
            <h2><?php echo _t(get_text($row['is_subject'])); ?></h2>

            <dl class="sps_dl">
                <dt><?php echo _t('작성자'); ?></dt>
                <dd><?php echo get_text($row['is_name']); ?></dd>
                <dt><?php echo _t('작성일'); ?></dt>
                <dd><?php echo substr($row['is_time'],0,10); ?></dd>
                <dt><?php echo _t('평가점수'); ?></dt>
                <dd><img src="<?php echo G5_SHOP_URL; ?>/img/s_star<?php echo $star; ?>.png" alt="<?php echo _t('별'); ?><?php echo $star; ?><?php echo _t('개'); ?>"></dd>
            </dl>

            <div id="sps_con_<?php echo $i; ?>" style="display:none;">
                <?php echo $is_content; // 사용후기 내용 ?>
            </div>

            <div class="sps_con_btn"><button class="sps_con_<?php echo $i; ?>"><?php echo _t('보기'); ?></button></div>
        </section>

    </li>
    <?php }
    if ($i > 0) echo '</ol>';
    if ($i == 0) echo '<p id="sps_empty">'._t('자료가 없습니다.').'</p>';
    ?>
</div>

<?php echo get_paging($config['cf_mobile_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

<script>
$(function(){
    // 사용후기 더보기
    $(".sps_con_btn button").click(function(){
        var $con = $(this).parent().prev();
        if($con.is(":visible")) {
            $con.slideUp();
            $(this).text("<?php echo _t('보기'); ?>");
        } else {
            $(".sps_con_btn button").text("<?php echo _t('보기'); ?>");
            $("div[id^=sps_con]:visible").hide();
            $con.slideDown(
                function() {
                    // 이미지 리사이즈
                    $con.viewimageresize2();
                }
            );
            $(this).text("<?php echo _t('닫기'); ?>");
        }
    });
});
</script>
<!-- } 전체 상품 사용후기 목록 끝 -->
