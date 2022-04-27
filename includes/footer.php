<div class="footer">
    <div class="footer-inner">
        <div class="footer-content">
            <small>Copyright &copy; <a href="https://www.pirapong.com/teacher" target="_blank">ครูพีระพงษ์ ปรีดาชม</a> โรงเรียนสวนกุหลาบวิทยาลัย รังสิต 2020</small>
        </div>
    </div>
</div>
<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">กลับด้านบน
    <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
</a>
</div><!-- /.main-container -->

<!-- basic scripts -->

<!--[if !IE]> -->
<?php
if ($_SESSION['uploadphoto'] != '1') { ?>
    <script src="assets/js/jquery-2.1.4.min.js"></script>
<?php  }
$_SESSION['uploadphoto'] = '0';
?>



<!-- <![endif]-->

<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
<script type="text/javascript">
    if ('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
</script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->

<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
        <![endif]-->
<!-- <script src="assets/js/jquery-2.1.4.min.js"></script> -->
<script src="assets/js/chosen.jquery.min.js"></script>
<script src="assets/js/jquery-ui.custom.min.js"></script>
<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="assets/js/jquery.easypiechart.min.js"></script>
<script src="assets/js/jquery.sparkline.index.min.js"></script>
<script src="assets/js/jquery.flot.min.js"></script>
<script src="assets/js/jquery.flot.pie.min.js"></script>
<script src="assets/js/jquery.flot.resize.min.js"></script>

<!-- ace scripts -->
<script src="assets/js/ace-elements.min.js"></script>
<script src="assets/js/ace.min.js"></script>

<!-- inline scripts related to this page -->

</body>

<script type="text/javascript">
    $(document).ready(function() {
        $("form").bind("keypress", function(e) {
            if (e.keyCode == 13) {
                <?php if ($_SESSION['textarea'] == '1') { ?>
                    return true;
                <?php
                } else {
                ?>
                    return false;
                <?php
                }
                ?>
            }
        });
    });
    $('form').attr('autocomplete', 'off');
</script>

<script>
$('input[type=number]').on('mousewheel', function(e) {
  $(e.target).blur();
});
</script>


</html>