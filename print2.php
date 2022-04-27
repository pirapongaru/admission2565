<?php
if ($_GET['std_class'] != 'studentm1' && $_GET['std_class'] != 'studentm4') {
?>

    <?php
    include 'includes/header.php';
    ?>

    <?php
    session_start();
    session_unset();
    $_SESSION['where'] = '';
    $_SESSION['page'] = 'print';
    ?>

    <?php
    include 'includes/sidebar.php';
    ?>


    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                <div class="page-header">
                    <h1>
                        พิมพ์บัตรประจำตัวสอบ (สำหรับผู้ที่ผ่านการตรวจสอบแล้ว)
                    </h1>
                </div><!-- /.page-header -->
                <div class="row cnbox">
                    <div class="col col-lg-7 cnbox bg-info text-center">

                        <form action="print2.php" method="GET">
                            <!-- <input type="radio" name="std_class" value="studentm1">ชั้น ม.1
                            <input type="radio" name="std_class" value="studentm4">ชั้น ม.4 -->

                            <h1 class="text-primary">เลือกระดับชั้น</h1><br>
                            <label>
                                <input type="radio" name="std_class" value="studentm1" class="ace input-lg">
                                <span class="lbl bigger-180"> ชั้นมัธยมศึกษาปีที่ 1 </span>
                            </label><br><br>
                            <label>
                                <input type="radio" name="std_class" value="studentm4" class="ace input-lg">
                                <span class="lbl bigger-180"> ชั้นมัธยมศึกษาปีที่ 4 </span>
                            </label><br><br>


                            <input type="text" name="std_id" class="ace input-lg" placeholder="- กรอกเลขบัตรประชาชน -"><br><br>
                            <button type="submit" class="btn btn-lg btn-primary">พิมพ์ใบสมัคร</button><br><br>
                        </form>
                    </div>
                </div>

                <div class="alert">
                <img src="img/covid19-2.jpg" width="60%">
                </div>




                <div class="row cnbox">
                    <div class="col col-lg-7 cnbox bg-info text-center">

                        <img src="img/regis63-3.jpg" width="100%">
                    </div>
                </div>



            </div>
        </div>
    </div>


    <?php
    include 'includes/footer.php';
    ?>

<?php
} else {
?>

    <?php
    include 'connectdb.php';
    $std_id = $_GET['std_id'];
    $std_class = $_GET['std_class'];
    $sql = "SELECT * FROM " . $std_class . " WHERE std_id='$std_id' AND std_status='1'";
    $result = mysqli_query($dbcon, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($result->num_rows == 0) {

    ?>
        <!-- ไม่เจอข้อมูล -->
        <?php
        include 'includes/header.php';
        ?>

        <?php
        session_start();
        session_unset();
        $_SESSION['where'] = '';
        $_SESSION['page'] = 'print';
        ?>

        <?php
        include 'includes/sidebar.php';
        ?>


        <div class="main-content">
            <div class="main-content-inner">
                <div class="page-content">
                    <div class="page-header">
                        <h1>
                            พิมพ์บัตรประจำตัวสอบ (สำหรับผู้ที่ผ่านการตรวจสอบแล้ว)
                        </h1>
                    </div><!-- /.page-header -->
                    <div class="row cnbox">
                        <div class="col col-lg-5 cnbox bg-info text-center">

                            <form action="print2.php" method="GET">
                                <!-- <input type="radio" name="std_class" value="studentm1">ชั้น ม.1
                            <input type="radio" name="std_class" value="studentm4">ชั้น ม.4 -->

                                <h1 class="text-primary">เลือกระดับชั้น</h1><br>
                                <label>
                                    <input type="radio" name="std_class" value="studentm1" class="ace input-lg">
                                    <span class="lbl bigger-180"> ชั้นมัธยมศึกษาปีที่ 1 </span>
                                </label><br><br>
                                <label>
                                    <input type="radio" name="std_class" value="studentm4" class="ace input-lg">
                                    <span class="lbl bigger-180"> ชั้นมัธยมศึกษาปีที่ 4 </span>
                                </label><br><br>


                                <input type="text" name="std_id" class="ace input-lg" placeholder="- กรอกเลขบัตรประชาชน -"><br><br>
                                <button type="submit" class="btn btn-lg btn-primary">พิมพ์ใบสมัคร</button><br><br>
                            </form>
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">
                                    <i class="ace-icon fa fa-times"></i>
                                </button>
                                <strong>ไม่สามารถดำเนินการได้!</strong>&nbsp;เนื่องจากไม่พบข้อมูลในระบบ หรือ ข้อมูลยังไม่ผ่านการตรวจสอบ
                                <br>
                            </div><br><br>
                        </div>
                    </div>



                </div>
            </div>
        </div>


        <?php
        include 'includes/footer.php';
        ?>

        <!-- ไม่เจอข้อมูล -->


    <?php
    } else {
    ?>

        <!-- เจอข้อมูล -->

        <?php
        require 'connectdb.php';
        date_default_timezone_set('Asia/Bangkok');
        $std_timeprint = date("Y-m-d H:i:s");
        session_start();

        $sql = "SELECT * FROM " . $std_class . " WHERE std_id='$std_id'";
        $result = mysqli_query($dbcon, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        //&nbsp;
        ?>

        <?php

        require_once __DIR__ . '/mpdf/vendor/autoload.php';

        /*$mpdf = new \Mpdf\Mpdf([
	'default_font_size' => 16,
	'default_font' => 'sarabun',
  'format' => 'A4'
]);*/
        $mpdf = new \Mpdf\Mpdf([
            'tempDir' => __DIR__ . '/custom/temp/dir/path',
            'default_font_size' => 16,
            'default_font' => 'sarabun',
            'format' => 'A4'
        ]);

        if ($row['std_type'] == "13") {
            $std_type = "นักเรียนในเขตพื้นที่บริการ";
            $std_regisclass = "ชั้นมัธยมศึกษาปีที่ 1";
            $std_testdate = "สอบข้อเขียนวันที่ 6 มิถุนายน 2563";
        } else if ($row['std_type'] == "14") {
            $std_type = "นักเรียนนอกเขตพื้นที่บริการ";
            $std_regisclass = "ชั้นมัธยมศึกษาปีที่ 1";
            $std_testdate = "สอบข้อเขียนวันที่ 6 มิถุนายน 2563";
        } else if ($row['std_type'] == "15") {
            $std_type = "นักเรียนความสามารถพิเศษ";
            $std_regisclass = "ชั้นมัธยมศึกษาปีที่ 1";
            $std_testdate = "สอบภาคปฏิบัติวันที่ 2 มิถุนายน 2563 และ สอบข้อเขียนวันที่ 6 มิถุนายน 2563";
        } else if ($row['std_type'] == "44") {
            $std_type = "นักเรียน (ส.ก.ร.)";
            $std_regisclass = "ชั้นมัธยมศึกษาปีที่ 4";
            $std_testdate = "สอบข้อเขียนวันที่ 7 มิถุนายน 2563";
        } else if ($row['std_type'] == "45") {
            $std_type = "นักเรียนทั่วไป";
            $std_regisclass = "ชั้นมัธยมศึกษาปีที่ 4";
            $std_testdate = "สอบข้อเขียนวันที่ 7 มิถุนายน 2563";
        } else if ($row['std_type'] == "46") {
            $std_type = "นักเรียนความสามารถพิเศษ";
            $std_regisclass = "ชั้นมัธยมศึกษาปีที่ 4";
            $std_testdate = "สอบภาคปฏิบัติวันที่ 3 มิถุนายน 2563 และ สอบข้อเขียนวันที่ 7 มิถุนายน 2563";
        }



        $html  = '<div style="position:absolute;top:-250px;left:0;right:0;text-align: center;"><img src="img/bgreport.jpg" width="1000" style="opacity:0.15;filter:alpha(opacity=20);">' . '</div>';
        $html .= '<div style="position:absolute;left:15;top:15px;"><img src="img/skrlogo.png" border="5" width="105" height="105">' . '</div>';

        $html .= '<div style="position:absolute;top:260px;left:0;right:0;text-align: center;"><b>' .
            '- - - - - - - - - - - - - - - - - - - - - -  - - - - - - - - - - - - - ' .
            ' <small><i>ตัดตามแนวเส้นนี้</i></small> ' .
            '- - - - - - - - - - - - - - - - - - - - - -  - - - - - - - - - - - - - ' .
            '</b></div>';

        $html .= '<div style="  position:absolute;top:30px;left:0;right:0;text-align: center;"><font size=6><strong>' .
            'บัตรประจำตัวผู้สมัครสอบเข้าเรียนต่อ' . $std_regisclass .
            '</strong></font></div>';

        $html .= '<div style="  position:absolute;top:70px;left:0;right:0;text-align: center;"><font size=5><strong>' .
            'โรงเรียนสวนกุหลาบวิทยาลัย&nbsp;รังสิต&nbsp;&nbsp;อำเภอคลองหลวง&nbsp;&nbsp;จังหวัดปทุมธานี' .
            '</strong></font></div>';

        $html .= '<div style="  position:absolute;top:80px;left:20;right:40;text-align: center;"><b>' . '___________________________________________________________________' . '</b></div>';
        $html .= '<div style="position:absolute;left:105;top:85px;">' .
            '<h3>เลขบัตรประชาชน</h3>' . '</div>';
        $html .= '<div style="position:absolute;left:230;top:85px;"><h3>' .
            substr($std_id, 0, 1) . '-' . substr($std_id, 1, 4) . '-' . substr($std_id, 5, 5) .
            '-' . substr($std_id, 10, 2) . '-' . substr($std_id, 12, 1) . '</h3></div>';
        $html .= '<div style="position:absolute;left:380;top:85px;"><h3>' .
            'เลขที่ผู้สมัคร' . '</h3></div>';
        $html .= '<div style="position:absolute;left:470;top:75px;"><h2>' .
            $row['std_regisid'] .
            '</h2></div>';
        $html .= '<div style="position:absolute;left:535;top:85px;"><h3>' .
            'ห้องสอบ' . '</h3></div>';
        $html .= '<div style="position:absolute;left:595;top:75px;"><h2>' .
            $row['std_regisroom'] .
            '</h2></div>';
        $html .= '<div style="  position:absolute;top:117px;left:20;right:88;text-align: center;"><b>' . '_________________________________________________________________________' . '</b></div>';



        // รูปนักเรียน
        $html .= '<div style="position:absolute;left:669px;top:19px;"><img src="img/picstd2.jpg" border="5" width="102" height="119">' . '</div>';
        if (file_exists($row['std_photo'])) {

            $html .= '<div style="position:absolute;left:670px;top:20px;"><img src="' . $row['std_photo'] . '" width="100" height="117"></div>';
        } else {
            $html .= '<div style="position:absolute;left:670px;top:20px;"><img src="stdphoto/nophoto.jpg" width="100" height="117" style="opacity:0.4;filter:alpha(opacity=40);"></div>';
        }
        // รูปนักเรียน
        $html .= '<div style="  position:absolute;top:150px;left:645;right:0;text-align: center;"><b>' .
            '______________' . '<br>ลงชื่อผู้สมัคร' .
            '</b></div>';


        $html .= '<div style="position:absolute;left:90;top:145px;"><font size=4><strong>' .
            'คำนำหน้า</strong>&nbsp;' . $row['std_prefix'] .
            '</font></div>';
        $html .= '<div style="position:absolute;left:240;top:145px;"><font size=4><strong>' .
            'ชื่อ</strong>&nbsp;' . $row['std_fname'] .
            '</font></div>';
        $html .= '<div style="position:absolute;left:390;top:145px;"><font size=4><strong>' .
            'นามสกุล</strong>&nbsp;' . $row['std_lname'] .
            '</font></div>';
        $html .= '<div style="position:absolute;left:90;top:170px;"><font size=4><strong>' .
            'กำลัง/สำเร็จการศึกษาจาก</strong>&nbsp;' . $row['std_eduschool'] . '&nbsp;&nbsp;&nbsp;<strong>จังหวัด</strong>&nbsp;' . $row['std_eduprovince'] .
            '</font></div>';
        $html .= '<div style="  position:absolute;top:178px;left:20;right:88;text-align: center;"><b>' . '_________________________________________________________________________' . '</b></div>';

        $html .= '<div style="position:absolute;left:90;top:200px;"><font size=5><strong>' .
            'ประเภทที่สมัคร</strong>&nbsp;' . $std_type .
            '</font></div>';
        $html .= '<div style="position:absolute;left:90;top:230px;"><font size=5><strong>' .
            $std_testdate . '</strong>&nbsp;' .
            '</font></div>';
        // $html .= '<div style="position:absolute;left:550;top:150px;"><font size=5><strong>' .
        //     'ประเภทที่สมัคร</strong>&nbsp;' . '</font><font size=5>' . $std_type .
        //     '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
        //     '</font></div>';


        $html .= '<div style="position:absolute;top:315px;left:0;right:0;text-align: center;"><img src="img/dt63.jpg" border="5" width="700">' . '</div>';
        $html .= '<div style="position:absolute;top:850px;left:0;right:0;text-align: center;"><h3>' .'ระบบรับสมัครออนไลน์ โรงเรียนสวนกุหลาบวิทยาลัย รังสิต<br>'.
        'เลขที่ 2/617 ม.ศุภาลัยบุรี หมู่ 1 ต.คลองสี่ อ.คลองหลวง จ.ปทุมธานี 12120<br>'.
        'โทรศัพท์ 0-2904-9803-5 โทรสาร 02-904-8809'.
         '</h3></div>';











        // $html .= '<div style="  position:absolute;top:880px;left:0;right:0;text-align: center;"><font size=6><strong>' .
        //     'บัตรประจำตัวผู้สมัครสอบเข้าเรียนต่อชั้นมัธยมศึกษาปีที่ 1' .
        //     '</strong></font></div>';
        // $html .= '<div style="  position:absolute;top:920px;left:0;right:0;text-align: center;"><font size=5><strong>' .
        //     'โรงเรียนสวนกุหลาบวิทยาลัย&nbsp;รังสิต&nbsp;&nbsp;อำเภอคลองหลวง&nbsp;&nbsp;จังหวัดปทุมธานี' .
        //     '</strong></font></div>';

        // $html .= '<div style="  position:absolute;top:930px;left:0;right:30;text-align: center;"><b>' . '_______________________________________________________________________' . '</b></div>';


        // $html .= '<div style="position:absolute;left:100;top:935px;">' .
        //     '<h3>เลขบัตรประชาชน</h3>' . '</div>';
        // $html .= '<div style="position:absolute;left:230;top:935px;"><h3>' .
        //     substr($std_id, 0, 1) . '-' . substr($std_id, 1, 4) . '-' . substr($std_id, 5, 5) .
        //     '-' . substr($std_id, 10, 2) . '-' . substr($std_id, 12, 1) . '</h3></div>';
        // $html .= '<div style="position:absolute;left:385;top:935px;"><h3>' .
        //     'เลขที่ผู้สมัคร' . '</h3></div>';
        // $html .= '<div style="position:absolute;left:475;top:935px;"><h3>' .
        //     $row['std_regisid'] .
        //     '</h3></div>';
        // $html .= '<div style="position:absolute;left:530;top:935px;"><h3>' .
        //     'ห้องสอบ' . '</h3></div>';
        // $html .= '<div style="position:absolute;left:595;top:935px;"><h3>' .
        //     $row['std_regisroom'] .
        //     '</h3></div>';

        // $html .= '<div style="  position:absolute;top:967px;left:0;right:30;text-align: center;"><b>' . '_______________________________________________________________________' . '</b></div>';










        // $html .= '<div style="position:absolute;left:220;top:990px;"><font size=4><strong>' .
        //     'ชื่อ</strong>&nbsp;' . $row['std_fname'] .
        //     '</font></div>';
        // $html .= '<div style="position:absolute;left:400;top:990px;"><font size=4><strong>' .
        //     'นามสกุล</strong>&nbsp;' . $row['std_lname'] .
        //     '</font></div>';

        // $html .= '<div style="position:absolute;left:80;top:1015px;"><font size=4><strong>' .
        //     'กำลัง/สำเร็จการศึกษาจาก</strong>&nbsp;' . $row['std_eduschool'] .
        //     '</font>';
        // $html .= '<font size=4><strong>' .
        //     '&nbsp;&nbsp;&nbsp;จังหวัด</strong>&nbsp;' . $row['std_eduprovince'] .
        //     '</font></div>';

        // $html .= '<div style="position:absolute;left:80;top:1040px;"><font size=5><strong>' .
        //     'ประเภทที่สมัคร</strong>&nbsp;' . '</font><font size=4>' . $type .
        //     '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
        //     '</font><font size=5><strong>สอบวันที่ 7 มีนาคม พ.ศ.2563 </strong>&nbsp;' .
        //     '</font></div>';

        // $html .= '<div style="position:absolute;left:80;top:1070px;"><font size=5><strong>' .
        //     'บันทึกเพิ่มเติม</strong>&nbsp;' . '____________________________________________' .
        //     '</font></div>';


        // $html .= '<div style="position:absolute;left:685;top:900px;"><img src="img/picstd2.jpg" border="5" width="90" height="116">' . '</div>';
        // $html .= '<div style="  position:absolute;top:1035px;left:665;right:0;text-align: center;"><b>' .
        //     '______________' . '<br>ลงชื่อผู้สมัคร' .
        //     '</b></div>';


        $mpdf->WriteHTML($html);
        //$mpdf->WriteHTML('<h1>Hello world!</h1>');
        //$mpdf->Output('report/req/'.$row['std_id'].'.pdf','F');
        $mpdf->Output('report/' . $row['std_id'] . '.pdf', 'I');

        mysqli_close($dbcon);
        ?>









        <!-- เจอข้อมูล -->

    <?php
    }
    ?>
<?php
}
?>