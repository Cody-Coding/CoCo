<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if($g5['is_db_trans'] && file_exists($g5['locale_path'].'/include/ml/mobile/shop'.'/category.ml.php')) { include_once $g5['locale_path'].'/include/ml/mobile/shop'.'/category.ml.php'; return; }

function get_mshop_category($ca_id, $len)
{
    global $g5;

    $sql = " select ca_id, ca_name from {$g5['g5_shop_category_table']}
                where ca_use = '1' ";
    if($ca_id)
        $sql .= " and ca_id like '$ca_id%' ";
    $sql .= " and length(ca_id) = '$len' order by ca_order, ca_id ";

    return $sql;
}
?>

<button type="button" id="hd_ct"><?php echo _t('분류'); ?></button>
<div id="category">
    <div class="ct_wr">
        <ul class="cate_tab">
            <li><a href="#" class="ct_tab_sl">CATEGORY</a></li>
            <li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php">MY PAGE</a></li>
            <li><a href="<?php echo G5_SHOP_URL; ?>/cart.php">CART</a></li>
        </ul>
        <?php
        $mshop_ca_href = G5_SHOP_URL.'/list.php?ca_id=';
        $mshop_ca_res1 = sql_query(get_mshop_category('', 2));
        for($i=0; $mshop_ca_row1=sql_fetch_array($mshop_ca_res1); $i++) { $mshop_ca_row1['ca_name'] = _t($mshop_ca_row1['ca_name']);
            if($i == 0)
                echo '<ul class="cate">'.PHP_EOL;
        ?>
            <li>
                <a href="<?php echo $mshop_ca_href.$mshop_ca_row1['ca_id']; ?>"><?php echo get_text($mshop_ca_row1['ca_name']); ?></a>
                <?php
                $mshop_ca_res2 = sql_query(get_mshop_category($mshop_ca_row1['ca_id'], 4));
                if(sql_num_rows($mshop_ca_res2))
                    echo '<button class="sub_ct_toggle ct_op">'.get_text($mshop_ca_row1['ca_name']).' '._t('하위분류 열기').'</button>'.PHP_EOL;

                for($j=0; $mshop_ca_row2=sql_fetch_array($mshop_ca_res2); $j++) { $mshop_ca_row2['ca_name'] = _t($mshop_ca_row2['ca_name']);
                    if($j == 0)
                        echo '<ul class="sub_cate sub_cate1">'.PHP_EOL;
                ?>
                    <li>
                        <a href="<?php echo $mshop_ca_href.$mshop_ca_row2['ca_id']; ?>">- <?php echo get_text($mshop_ca_row2['ca_name']); ?></a>
                        <?php
                        $mshop_ca_res3 = sql_query(get_mshop_category($mshop_ca_row2['ca_id'], 6));
                        if(sql_num_rows($mshop_ca_res3))
                            echo '<button type="button" class="sub_ct_toggle ct_op">'.get_text($mshop_ca_row2['ca_name']).' '._t('하위분류 열기').'</button>'.PHP_EOL;

                        for($k=0; $mshop_ca_row3=sql_fetch_array($mshop_ca_res3); $k++) { $mshop_ca_row3['ca_name'] = _t($mshop_ca_row3['ca_name']);
                            if($k == 0)
                                echo '<ul class="sub_cate sub_cate2">'.PHP_EOL;
                        ?>
                            <li>
                                <a href="<?php echo $mshop_ca_href.$mshop_ca_row3['ca_id']; ?>">- <?php echo get_text($mshop_ca_row3['ca_name']); ?></a>
                                <?php
                                $mshop_ca_res4 = sql_query(get_mshop_category($mshop_ca_row3['ca_id'], 8));
                                if(sql_num_rows($mshop_ca_res4))
                                    echo '<button type="button" class="sub_ct_toggle ct_op">'.get_text($mshop_ca_row3['ca_name']).' '._t('하위분류 열기').'</button>'.PHP_EOL;

                                for($m=0; $mshop_ca_row4=sql_fetch_array($mshop_ca_res4); $m++) { $mshop_ca_row4['ca_name'] = _t($mshop_ca_row4['ca_name']);
                                    if($m == 0)
                                        echo '<ul class="sub_cate sub_cate3">'.PHP_EOL;
                                ?>
                                    <li>
                                        <a href="<?php echo $mshop_ca_href.$mshop_ca_row4['ca_id']; ?>">- <?php echo get_text($mshop_ca_row4['ca_name']); ?></a>
                                        <?php
                                        $mshop_ca_res5 = sql_query(get_mshop_category($mshop_ca_row4['ca_id'], 10));
                                        if(sql_num_rows($mshop_ca_res5))
                                            echo '<button type="button" class="sub_ct_toggle ct_op">'.get_text($mshop_ca_row4['ca_name']).' '._t('하위분류 열기').'</button>'.PHP_EOL;

                                        for($n=0; $mshop_ca_row5=sql_fetch_array($mshop_ca_res5); $n++) { $mshop_ca_row5['ca_name'] = _t($mshop_ca_row5['ca_name']);
                                            if($n == 0)
                                                echo '<ul class="sub_cate sub_cate4">'.PHP_EOL;
                                        ?>
                                            <li>
                                                <a href="<?php echo $mshop_ca_href.$mshop_ca_row5['ca_id']; ?>">- <?php echo get_text($mshop_ca_row5['ca_name']); ?></a>
                                            </li>
                                        <?php
                                        }

                                        if($n > 0)
                                            echo '</ul>'.PHP_EOL;
                                        ?>
                                    </li>
                                <?php
                                }

                                if($m > 0)
                                    echo '</ul>'.PHP_EOL;
                                ?>
                            </li>
                        <?php
                        }

                        if($k > 0)
                            echo '</ul>'.PHP_EOL;
                        ?>
                    </li>
                <?php
                }

                if($j > 0)
                    echo '</ul>'.PHP_EOL;
                ?>
            </li>
        <?php
        }

        if($i > 0)
            echo '</ul>'.PHP_EOL;
        else
            echo '<p>'._t('등록된 분류가 없습니다.').'</p>'.PHP_EOL;
        ?>
        <button type="button" class="pop_close"><span class="sound_only"><?php echo _t('카테고리'); ?> </span><?php echo _t('닫기'); ?></button>
    </div>
</div>

<script>
$(function (){
    var $category = $("#category");

    $("#hd_ct").on("click", function() {
        $category.css("display","block");
    });

    $("#category .pop_close").on("click", function(){
        $category.css("display","none");
    });

    $("button.sub_ct_toggle").on("click", function() {
        var $this = $(this);
        $sub_ul = $(this).closest("li").children("ul.sub_cate");

        if($sub_ul.size() > 0) {
            var txt = $this.text();

            if($sub_ul.is(":visible")) {
                txt = txt.replace(/<?php echo _t('닫기'); ?>$/, "<?php echo _t('열기'); ?>");
                $this
                    .removeClass("ct_cl")
                    .text(txt);
            } else {
                txt = txt.replace(/<?php echo _t('열기'); ?>$/, "<?php echo _t('닫기'); ?>");
                $this
                    .addClass("ct_cl")
                    .text(txt);
            }

            $sub_ul.toggle();
        }
    });
});
</script>