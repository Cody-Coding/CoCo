<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" media="screen">', 0);

?>
<style>
	.myphoto img, .myphoto i { width:<?php echo $photo_size;?>px; height:<?php echo $photo_size;?>px; }
</style>
<form name="fphotoform" class="form" role="form" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" name="mode" value="u">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">My Photo</h3>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-2 col-sm-3 text-center">
					<div class="myphoto">
						<?php echo ($myphoto) ? '<img src="'.$myphoto.'" alt="">' : '<i class="fa fa-user"></i>'; ?>
					</div>
				</div>
				<div class="col-lg-10 col-sm-9">
					<p>
						회원사진은 이미지(gif/jpg/png) 파일만 가능하며, 등록시 자동 리사이즈됩니다.
					</p>
					<p><input type=file name="mb_icon2"></p>

					<?php if ($is_photo) { ?>
						<!-- <p><label><input type="checkbox" name="del_mb_icon2" value="1"> 삭제하기</label></p> -->
						<input type="hidden" name="del_mb_icon2" value="1">
						<button type="submit" class="btn btn-color btn-sm">삭제</button>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>

	<div class="text-center">
		<button type="submit" class="btn btn-color btn-sm">등록</button>
		<a type="button" class="btn btn-black btn-sm" href="/fittingroom.php">닫기</a>
	</div>		
</form>

<script>

function refreshParent(){
    	window.opener.location.reload(true);
}

$(function() {
	window.resizeTo(320, 440);

	

	$("body").attr("onunload", "javascript:refreshParent()");
});
</script>
