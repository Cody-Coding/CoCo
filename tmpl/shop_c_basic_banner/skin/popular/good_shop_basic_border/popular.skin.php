<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

global $is_admin;
?>

<link rel="stylesheet" href="<?php echo $popular_skin_url ?>/style.css">

<!-- 인기검색어 시작 -->
<section id="popular_aside">
  <div>
    <header>
        <h2><?php echo _t('인기검색어'); ?></h2>
        <?php if ($is_admin == 'super' || $is_auth) {  ?><a href="<?php echo G5_ADMIN_URL."/popular_list.php"; ?>" class="btn_admin"><?php echo _t('인기검색어 관리'); ?></a><?php }  ?>
    </header>
    <ul>
        <?php
        if( isset($list) && is_array($list) ){
            for ($i=0; $i<count($list); $i++) {
            ?>
                <li><a href="<?php echo G5_BBS_URL ?>/search.php?sfl=wr_subject&amp;sop=and&amp;stx=<?php echo urlencode($list[$i]['pp_word']) ?>"><?php echo get_text($list[$i]['pp_word']); ?></a></li>
            <?php
            }   //end for
        }   //end if
        ?>
    </ul>
  </div>
</section>
<!-- 인기검색어 끝 -->
