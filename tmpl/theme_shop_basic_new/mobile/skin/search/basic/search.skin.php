<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$search_skin_url.'/style.css">', 0);
?>

<form name="fsearch" onsubmit="return fsearch_submit(this);" method="get">
<input type="hidden" name="srows" value="<?php echo $srows ?>">
<fieldset id="sch_res_detail">
    <legend><?php echo _t('상세검색'); ?></legend>
    <div class="sch_wr">
        <?php echo $group_select ?>
        <script>document.getElementById("gr_id").value = "<?php echo $gr_id ?>";</script>

        <label for="sfl" class="sound_only"><?php echo _t('검색조건'); ?></label>
        <select name="sfl" id="sfl">
            <option value="wr_subject||wr_content"<?php echo get_selected($_GET['sfl'], "wr_subject||wr_content") ?>><?php echo _t('제목+내용'); ?></option>
            <option value="wr_subject"<?php echo get_selected($_GET['sfl'], "wr_subject") ?>><?php echo _t('제목'); ?></option>
            <option value="wr_content"<?php echo get_selected($_GET['sfl'], "wr_content") ?>><?php echo _t('내용'); ?></option>
            <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id") ?>><?php echo _t('회원아이디'); ?></option>
            <option value="wr_name"<?php echo get_selected($_GET['sfl'], "wr_name") ?>><?php echo _t('이름'); ?></option>
        </select>

        <label for="stx" class="sound_only"><?php echo _t('검색어'); ?><strong class="sound_only"> <?php echo _t('필수'); ?></strong></label>
        <input type="text" name="stx" id="stx" value="<?php echo $text_stx ?>" class="frm_input" required  maxlength="20">
        <button type="submit" class="btn_submit" value="<?php echo _t('검색'); ?>"><i class="fa fa-search" aria-hidden="true"></i></button>

        <script>
        function fsearch_submit(f)
        {
            if (f.stx.value.length < 2) {
                alert("<?php echo _t('검색어는 두글자 이상 입력하십시오.'); ?>");
                f.stx.select();
                f.stx.focus();
                return false;
            }

            // 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
            var cnt = 0;
            for (var i=0; i<f.stx.value.length; i++) {
                if (f.stx.value.charAt(i) == ' ')
                    cnt++;
            }

            if (cnt > 1) {
                alert("<?php echo _t('빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.'); ?>");
                f.stx.select();
                f.stx.focus();
                return false;
            }

            f.action = "";
            return true;
        }
        </script>
    </div>
    <div>
        <input type="radio" value="or" <?php echo ($sop == "or") ? "checked" : ""; ?> id="sop_or" name="sop">
        <label for="sop_or">OR</label>
        <input type="radio" value="and" <?php echo ($sop == "and") ? "checked" : ""; ?> id="sop_and" name="sop">
        <label for="sop_and">AND</label>
    </div>
</fieldset>
</form>

<div id="sch_result">

    <?php
    if ($stx) {
        if ($board_count) {
    ?>
    <section id="sch_res_ov">
        <h2><strong class="sch_word"><?php echo $stx ?></strong> <?php echo _t('전체검색 결과'); ?></h2>
        <dl>
            <dt><?php echo _t('게시판'); ?></dt>
            <dd><strong><?php echo $board_count ?><?php echo _t('개'); ?></strong></dd>
            <dt><?php echo _t('게시물'); ?></dt>
            <dd><strong><?php echo number_format($total_count) ?><?php echo _t('개'); ?></strong></dd>
        </dl>
        <p><?php echo number_format($page) ?>/<?php echo number_format($total_page) ?> <?php echo _t('페이지 열람 중'); ?></p>
    </section>
    <?php
        }
    }
    ?>

    <?php
    if ($stx) {
        if ($board_count) {
     ?>
    <ul id="sch_res_board">
        <li><a href="?<?php echo $search_query ?>&amp;gr_id=<?php echo $gr_id ?>" <?php echo $sch_all ?>><?php echo _t('전체게시판'); ?></a></li>
        <?php echo $str_board_list; ?>
    </ul>
    <?php
        } else {
     ?>
    <div class="empty_list"><?php echo _t('검색된 자료가 하나도 없습니다.'); ?></div>
    <?php } }  ?>

    <hr>
    <div class="list_01">
    <?php if ($stx && $board_count) { ?><section class="sch_res_list"><?php }  ?>
    <?php
    $k=0;
    for ($idx=$table_index, $k=0; $idx<count($search_table) && $k<$rows; $idx++) {
     ?>
        <h2><a href="./board.php?bo_table=<?php echo $search_table[$idx] ?>&amp;<?php echo $search_query ?>"><?php echo _t($bo_subject[$idx]) ?> <?php echo _t('게시판 내 결과'); ?></a></h2>
        <ul>
        <?php
        for ($i=0; $i<count($list[$idx]) && $k<$rows; $i++, $k++) {
            if ($list[$idx][$i]['wr_is_comment'])
            {
                $comment_def = '<span class="cmt_def"><i class="fa fa-commenting-o" aria-hidden="true"></i><span class="sound_only">'._t('댓글').'</span></span> ';
                $comment_href = '#c_'.$list[$idx][$i]['wr_id'];
            }
            else
            {
                $comment_def = '';
                $comment_href = '';
            }
         ?>
            <li>
                <div  class="sch_res_title">
                    <a href="<?php echo $list[$idx][$i]['href'] ?><?php echo $comment_href ?>"><?php echo $comment_def ?><?php echo $list[$idx][$i]['subject'] ?></a>
                    <a href="<?php echo $list[$idx][$i]['href'] ?><?php echo $comment_href ?>" target="_blank" class="sch_res_new"><i class="fa fa-share-square-o" aria-hidden="true"></i><span class="sound_only"><?php echo _t('새창'); ?></span></a>
                </div>
                <p><?php echo $list[$idx][$i]['content'] ?></p>
                <div class="sch_res_info">
                    <?php echo $list[$idx][$i]['name'] ?>
                    <span class="sch_datetime"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $list[$idx][$i]['wr_datetime'] ?></span>
                </div>
            </li>
        <?php }  ?>
        </ul>
        <div class="sch_more"><a href="./board.php?bo_table=<?php echo $search_table[$idx] ?>&amp;<?php echo $search_query ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i> <strong><?php echo _t($bo_subject[$idx]) ?></strong> <?php echo _t('결과 더보기'); ?></a></div>

        <hr>
    <?php }  ?>

    <?php if ($stx && $board_count) {  ?></section><?php }  ?>
    </div>

    <?php echo $write_pages ?>

</div>