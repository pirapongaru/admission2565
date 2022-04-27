<?php
$_SESSION['page'] = 'howto';
include 'includes/header.php';
include 'includes/sidebar.php';
?>



<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>
                    ขั้นตอนการสมัคร
                </h1>
            </div><!-- /.page-header -->

           


            <div class="row">
                <div class="col-12">
                    <h2 class="text-primary"> แนะนำขั้นตอนการสมัคร (ควรศึกษาก่อนทำการสมัคร) <small>*เลือกดูคู่มือจากวิดิโอ (1) หรือ (2) ก็ได้</small></h2>
                </div>
                <div class="col-12 col-md-6 text-center">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/jckooW-M4Jg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <h2 class="text-primary"> (1) </h2>
                    <hr style="height:3px;border-width:0;color:gray;background-color:green;">
                </div>
                <div class="col-12 col-md-6 text-center">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/mrJ8lLPOyu8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <h2 class="text-primary"> (2) </h2>
                    <hr style="height:3px;border-width:0;color:gray;background-color:green;">
                </div>
            </div>

            <!-- <div class="row">
                <div class="col-12">
                    <img class="img-fluid" src="img/newshowto.gif?1287" width="100%">
                    <hr style="height:3px;border-width:0;color:gray;background-color:green;">
                </div>
            </div> -->

            <!-- <div class="row">
                <div class="col-12 col-md-6 text-center">
                    <h2 class="text-primary"> 1. กรอกข้อมูล</h2><br>
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/Xw2EFJCSA7g" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <hr style="height:3px;border-width:0;color:gray;background-color:green;">
                </div>
                <div class="col-12 col-md-6 text-center">
                    <h2 class="text-primary"> 2. ตรวจสอบผลการสมัคร</h2><br>
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/-UJB-Oee-7o" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <hr style="height:3px;border-width:0;color:gray;background-color:green;">
                </div>
                <div class="col-12 col-md-6 text-center">
                    <h2 class="text-primary"> 3. ชำระค่าสมัคร</h2><br>
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/O_JbfIiLGdU" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <hr style="height:3px;border-width:0;color:gray;background-color:green;">
                </div>
                <div class="col-12 col-md-6 text-center">
                    <h2 class="text-primary"> 4. พิมพ์บัตรประจำตัวสอบ</h2><br>
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/aOmjM5Y3RFU" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <hr style="height:3px;border-width:0;color:gray;background-color:green;">
                </div>
            </div> -->




            <div class="hr hr32 hr-dotted"></div>


            <?php echo base64_decode($config->con_contact); ?>
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->










<?php include 'includes/footer.php'; ?>