<?php
include 'includes/header.php';
?>

<?php
session_start();
session_unset();
$_SESSION['textarea'] = '';
$_SESSION['where'] = '';
$_SESSION['page'] = 'index';
$_SESSION['mode'] = '';
?>

<?php
include 'includes/sidebar.php';
?>

<?php
include 'includes/config.php';
$sql = "SELECT * FROM config";
$query = $dbcon->prepare($sql);
$query->execute();
$config = $query->fetch(PDO::FETCH_OBJ);
// foreach ($results as $config) {
?>

<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 2002 05:00:00 GMT"); // Date in the past
?>

<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>
                    ระบบรับสมัครนักเรียนออนไลน์ <?php echo $config->con_schoolname; ?>
                </h1>
            </div><!-- /.page-header -->



            <h1>กำหนดการรับสมัครคัดเลือกเข้าศึกษาต่อชั้น
                <?php if ($config->con_m1m4only == 0) { ?>ม.1 และ ม.4 <?php } ?>
            <?php if ($config->con_m1m4only == 1) { ?>ม.1 <?php } ?>
        <?php if ($config->con_m1m4only == 4) { ?>ม.4 <?php } ?>

    <br>ประจำปีการศึกษา <?php echo $config->con_year; ?>
            </h1>
            <h2><?php echo $config->con_typeadmission; ?></h2>

            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        <marquee behavior="" direction=""><h3>โปรดตรวจสอบข้อมูลแะดำเนินการชำระเงินให้เสร็จสิ้น ภายในวันที่ 23 ก.พ. 65 (*วันนี้) เวลา 16.30 น. เท่านั้น</h3></marquee>
                    </div>
                    <div data-type="countdown" data-id="3087199" class="tickcounter" style="width: 100%; position: relative; padding-bottom: 25%"><a href="//www.tickcounter.com/countdown/3087199/" title="เวลาที่เหลือ ก่อนปิดระบบรับสมัคร">เวลาที่เหลือ ก่อนปิดระบบรับสมัคร</a><a href="//www.tickcounter.com/" title="Countdown">Countdown</a></div><script>(function(d, s, id) { var js, pjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = "//www.tickcounter.com/static/js/loader.js"; pjs.parentNode.insertBefore(js, pjs); }(document, "script", "tickcounter-sdk"));</script>
                </div>
            </div>


            <div class="row">
                <div class="col col-lg-12 text-center">
                    <a href="img/newshowto.gif" target="_blank">
                        <img class="img-fluid" src="img/newshowto.gif?1" width="100%">
                    </a>
                    <a href="<?php echo $config->con_news; ?>" target="_blank">
                        <img class="img-fluid" src="<?php echo $config->con_news; ?>" width=100%">

                    </a>
                </div>
            </div>

            <div class="hr hr32 hr-dotted"></div>


            <?php echo base64_decode($config->con_contact); ?>
            <div class="hr hr32 hr-dotted"></div>
            <h4>แจ้งปัญหาการกรอกข้อมูลในระบบ<small class="text-danger">&nbsp;&nbsp;***(เจ้าหน้าที่ตอบในเวลาทำการ)</small></h4>
            <a href="https://lin.ee/4Q0PHom"><img height="50" border="0" src="img/line.gif"></a>
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<?php

// mysqli_close($dbcon);

include 'includes/footer.php';
?>