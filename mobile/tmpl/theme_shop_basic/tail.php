<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(G5_COMMUNITY_USE === false) {
    include_once(G5_THEME_MSHOP_PATH.'/shop.tail.php');
    return;
}
?>
    </div>
</div>

<hr>

<?php echo poll('theme/basic'); // 설문조사 ?>

<hr>

<div id="ft">
    <?php echo popular('theme/basic'); // 인기검색어 ?>
    <?php echo visit('theme/basic'); // 방문자수 ?>
    <div id="ft_copy">
        <div id="ft_company">
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company"><?php echo _t('회사소개'); ?></a>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy"><?php echo _t('개인정보처리방침'); ?></a>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision"><?php echo _t('서비스이용약관'); ?></a>
        </div>
        Copyright &copy; <b><?php echo _t($config['cf_title']); ?>.</b> All rights reserved.<br>
        <a href="#"><?php echo _t('상단으로'); ?></a>
    </div>
</div>

<?php
if(G5_DEVICE_BUTTON_DISPLAY && G5_IS_MOBILE) { ?>
<a href="<?php echo get_device_change_url(); ?>" id="device_change"><?php echo _t('PC 버전으로 보기'); ?></a>
<?php
}

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_THEME_MOBILE_PATH."/tail.sub.php");
?>
