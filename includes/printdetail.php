        <?php

        include_once 'mpdf/vendor/autoload.php';

        $mpdf = new \Mpdf\Mpdf([
            'fontdata' =>  [
                'sarabun' => [
                    'R' => 'THSarabunNew.ttf',
                    'I' => 'THSarabunNew Italic.ttf',
                    'B' => 'THSarabunNew Bold.ttf',
                    // 'R' => 'K2D-Regular.ttf',
                    // 'I' => 'K2D-Italic.ttf',
                    // 'B' => 'K2D-Bold.ttf',
                ]
            ],
            'default_font_size' => 16,
            'default_font' => 'Sarabun',
            'format' => 'A4'
        ]);


        $std_type = $row->type_name;
        if ($std_class == 'studentm1') {
            $std_regisclass = "ชั้นมัธยมศึกษาปีที่ 1";
        } else if ($std_class == 'studentm4') {
            $std_regisclass = "ชั้นมัธยมศึกษาปีที่ 4";
        }
        include 'includes/config.php';
        $sqlconfig = "SELECT * FROM config";
        $queryconfig = $dbcon->prepare($sqlconfig);
        // $query->bindParam(':std_id', $std_id, PDO::PARAM_STR);
        $queryconfig->execute();
        $rowconfig = $queryconfig->fetch(PDO::FETCH_OBJ); //ดึงค่าเดียว

        $std_testdate = $row->type_testdate;

        $html  = '<div style="position:absolute;top:-250px;left:0;right:0;text-align: center;"><img src="img/bgreport.jpg" width="1000" style="opacity:0.15;filter:alpha(opacity=20);">' . '</div>';
        $html .= '<div style="position:absolute;left:15;top:15px;"><img src="img/logo.png" border="5" width="105" height="105">' . '</div>';

        $html .= '<div style="position:absolute;top:260px;left:0;right:0;text-align: center;"><b>' .
            '- - - - - - - - - - - - - - - - - - - - - -  - - - - - - - - - - - - - ' .
            ' <small><i>ตัดตามแนวเส้นนี้</i></small> ' .
            '- - - - - - - - - - - - - - - - - - - - - -  - - - - - - - - - - - - - ' .
            '</b></div>';

        $html .= '<div style="  position:absolute;top:30px;left:0;right:0;text-align: center;"><font size=6><strong>' .
            'บัตรประจำตัวผู้สมัครสอบเข้าเรียนต่อ' . $std_regisclass .
            '</strong></font></div>';

        $html .= '<div style="  position:absolute;top:70px;left:0;right:0;text-align: center;"><font size=5><strong>' .
            $rowconfig->con_schoolname.'&nbsp;&nbsp;อำเภอคลองหลวง&nbsp;&nbsp;จังหวัดปทุมธานี' .
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
            $row->std_regisid .
            '</h2></div>';
        if ($row->std_regisroom == 0) {
            $html .= '<div style="position:absolute;left:535;top:85px;"><h3>' .
                'ห้องสอบ  -' . '</h3></div>';
        } else {
            $html .= '<div style="position:absolute;left:535;top:85px;"><h3>' .
                'ห้องสอบ' . '</h3></div>';
            $html .= '<div style="position:absolute;left:595;top:75px;"><h2>' .
                $row->std_regisroom .
                '</h2></div>';
        }

        $html .= '<div style="  position:absolute;top:117px;left:20;right:88;text-align: center;"><b>' . '_________________________________________________________________________' . '</b></div>';



        // รูปนักเรียน
        $html .= '<div style="position:absolute;left:669px;top:19px;"><img src="img/picstd2.jpg" border="5" width="102" height="119">' . '</div>';
        if (file_exists($row->std_photo)) {
            $html .= '<div style="position:absolute;left:670px;top:20px;"><img src="' . $row->std_photo . '" width="100" height="117"></div>';
        } else {
            $html .= '<div style="position:absolute;left:670px;top:20px;"><img src="stdphoto/nophoto.jpg" width="100" height="117" style="opacity:0.4;filter:alpha(opacity=40);"></div>';
        }
        // รูปนักเรียน
        $html .= '<div style="  position:absolute;top:150px;left:645;right:0;text-align: center;"><b>' .
            '______________' . '<br>ลงชื่อผู้สมัคร' .
            '</b></div>';


        $html .= '<div style="position:absolute;left:90;top:145px;"><font size=4><strong>' .
            'คำนำหน้า</strong>&nbsp;' . $row->std_prefix .
            '</font></div>';
        $html .= '<div style="position:absolute;left:240;top:145px;"><font size=4><strong>' .
            'ชื่อ</strong>&nbsp;' . $row->std_fname .
            '</font></div>';
        $html .= '<div style="position:absolute;left:390;top:145px;"><font size=4><strong>' .
            'นามสกุล</strong>&nbsp;' . $row->std_lname .
            '</font></div>';
        $html .= '<div style="position:absolute;left:90;top:170px;"><font size=4><strong>' .
            'กำลัง/สำเร็จการศึกษาจาก</strong>&nbsp;' . $row->std_eduschool . '&nbsp;&nbsp;&nbsp;<strong>จังหวัด</strong>&nbsp;' . $row->std_eduprovince .
            '</font></div>';
        $html .= '<div style="  position:absolute;top:178px;left:20;right:88;text-align: center;"><b>' . '_________________________________________________________________________' . '</b></div>';

        $html .= '<div style="position:absolute;left:90;top:200px;"><font size=5><strong>' .
            'ประเภทที่สมัคร</strong>&nbsp;' . $std_type .
            '</font></div>';
        $html .= '<div style="position:absolute;left:90;top:230px;"><font size=5><strong>' .
            $std_testdate . '</strong>&nbsp;' .
            '</font></div>';


        // $html .= '<div style="position:absolute;top:315px;left:0;right:0;text-align: center;"><img src="img/dt63.jpg" border="5" width="700">' . '</div>';
        // $html .= '<div style="position:absolute;top:850px;left:0;right:0;text-align: center;"><h3>' . 'ระบบรับสมัครออนไลน์ โรงเรียนสวนกุหลาบวิทยาลัย รังสิต<br>' .
        //     'เลขที่ 2/617 ม.ศุภาลัยบุรี หมู่ 1 ต.คลองสี่ อ.คลองหลวง จ.ปทุมธานี 12120<br>' .
        //     'โทรศัพท์ 0-2904-9803-5 โทรสาร 02-904-8809' .
        //     '</h3></div>';









        $mpdf->WriteHTML($html);
        $mpdf->Output();

        mysqli_close($dbcon);
        ?>

        <!-- เจอข้อมูล -->