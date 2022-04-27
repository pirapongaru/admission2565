<form name="std_form" method="POST" enctype="multipart/form-data">
    <!-- onsubmit="return validateForm()" -->



    <?php
    $classshow = $_SESSION['classhow'];

    if ($classshow == 'm1') {
        $sqlstd = "SELECT * FROM studentm1 WHERE std_id=:std_id";
    } else if ($classshow == 'm4') {
        $sqlstd = "SELECT * FROM studentm4 WHERE std_id=:std_id";
    }
    $querystd = $dbcon->prepare($sqlstd);
    $querystd->bindParam(':std_id', $std_id, PDO::PARAM_INT);
    $querystd->execute();
    $rowstd = $querystd->fetch(PDO::FETCH_OBJ);
    // foreach ($resultsstd as $rowstd) {
    ?>

    <div class="row cnbox">
        <div class="col col-lg-10 cnbox bg-success text-center">

            <h1>ตรวจสอบข้อมูลการสมัคร</h1>
            <h2>ประเภทที่สมัคร</h2><br>

            <?php
            if ($classshow == 'm1') {
                $type_class = "ชั้นมัธยมศึกษาปีที่ 1";
            } else if ($classshow == 'm4') {
                $type_class = "ชั้นมัธยมศึกษาปีที่ 4";
            }
            $num = 1;
            $sql = "SELECT * FROM registype WHERE type_status=1 AND type_class=:type_class";
            $query = $dbcon->prepare($sql);
            $query->bindParam(':type_class', $type_class, PDO::PARAM_STR);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);

            ?>
            <div class="row"><?php
                                foreach ($results as $row) { ?>
                    <div class="col-12 col-sm-12 col-md-4">
                        <div class="alert alert-info" role="alert">
                            <label>
                                <input disabled type="radio" class="ace input-lg" name="std_type" value="<?php echo $row->type_id; ?>" onclick="showform<?php echo $num; ?>()" <?php if ($rowstd->std_type == $row->type_id) {
                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                }
                                                                                                                                                                                ?>>


                                <span class="lbl bigger-120"> <?php echo $row->type_name; ?></span>

                            </label>
                        </div>

                    </div>
                    <script>
                        function showform<?php echo $num; ?>() {
                            document.getElementById('startform').style.display = 'block';


                            <?php if ($row->type_talent == 1) { ?>
                                document.getElementById('formtalent').style.display = 'block';
                            <?php
                                    } else { ?>
                                document.getElementById('formtalent').style.display = 'none';
                            <?php
                                    }
                            ?>



                            <?php if ($row->type_doc == 1) { ?>
                                document.getElementById('formdocfile').style.display = 'block';
                            <?php
                                    } else { ?>
                                document.getElementById('formdocfile').style.display = 'none';
                            <?php
                                    }
                            ?>


                            <?php if ($row->type_plan == 1) { ?>
                                document.getElementById('formplan').style.display = 'block';
                                document.getElementById('formplanold').style.display = 'block';
                                document.getElementById("plan1").selectedIndex = <?php echo substr($rowstd->std_plan, 0, 1); ?>;
                                document.getElementById("plan2").selectedIndex = <?php echo substr($rowstd->std_plan, 1, 1); ?>;
                                document.getElementById("plan3").selectedIndex = <?php echo substr($rowstd->std_plan, 2, 1); ?>;
                                document.getElementById("plan4").selectedIndex = <?php echo substr($rowstd->std_plan, 3, 1); ?>;
                                document.getElementById("plan1show").selectedIndex = <?php echo substr($rowstd->std_plan, 0, 1); ?>;
                                document.getElementById("plan2show").selectedIndex = <?php echo substr($rowstd->std_plan, 1, 1); ?>;
                                document.getElementById("plan3show").selectedIndex = <?php echo substr($rowstd->std_plan, 2, 1); ?>;
                                document.getElementById("plan4show").selectedIndex = <?php echo substr($rowstd->std_plan, 3, 1); ?>;
                                document.getElementById("plan1req").required = true;
                                document.getElementById("plan2req").required = true;
                                document.getElementById("plan3req").required = true;
                                document.getElementById("plan4req").required = true;
                            <?php
                                    } else { ?>
                                document.getElementById('formplan').style.display = 'none';
                                document.getElementById("plan1req").required = false;
                                document.getElementById("plan2req").required = false;
                                document.getElementById("plan3req").required = false;
                                document.getElementById("plan4req").required = false;
                            <?php
                                    }
                            ?>

                        }
                    </script>
                    <?php if ($rowstd->std_type == $row->type_id) {
                                        echo '<body onload="showform' . $num . '()"></body>';
                                    }
                    ?>
                <?php

                                    $num = $num + 1;
                                }
                ?>

            </div>
        </div>
    </div>










    <div id="startform" style="display:none;">
        <link rel="stylesheet" href="assets/css/inputwidth.css" />

        <div class="row cnbox">
            <div class="col col-lg-10 cnbox bg-success">
                <!-- <h3 class="text-center">กรอกข้อมูลนักเรียน</h3> -->
                <div class="row">
                    <div class="col col-12 col-md-6" style="border-style: hidden double hidden hidden;border-color: #ffc1c1;">
                        <!-- คอลัมน์ 1 -->

                        <p class="alert alert-info text-right" style="font-size: 25px;">ข้อมูลนักเรียน</p>
                        <label>รหัสบัตรประชาชน</label>
                        <input disabled type="text" class="form-control w100" value="<?php echo $rowstd->std_id; ?>" name="std_id" readonly>

                        <div class="row">
                            <div class="col col-12 col-md-3">
                                <label>วันที่เกิด</label></label>
                                <select disabled type="number" class="form-control w100" name="std_dayb" disabled>
                                    <option selected><?php echo $rowstd->std_dayb; ?></option>
                                    <option disabled>-----</option>
                                    <?php
                                    for ($i = 1; $i <= 31; $i++) {
                                        echo '<option>' . $i . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col col-12 col-md-3">
                                <label>เดือนเกิด</label></label>
                                <select disabled type="text" class="form-control w100" id="std_monthb" name="std_monthb" disabled>
                                    <option selected><?php echo $rowstd->std_monthb; ?></option>
                                    <option disabled>-----</option>
                                    <option>มกราคม</option>
                                    <option>กุมภาพันธ์</option>
                                    <option>มีนาคม</option>
                                    <option>เมษายน</option>
                                    <option>พฤษภาคม</option>
                                    <option>มิถุนายน</option>
                                    <option>กรกฎาคม</option>
                                    <option>สิงหาคม</option>
                                    <option>กันยายน</option>
                                    <option>ตุลาคม</option>
                                    <option>พฤศจิกายน</option>
                                    <option>ธันวาคม</option>
                                </select>
                            </div>
                            <div class="col col-12 col-md-3">
                                <label>ปีเกิด</label>
                                <select disabled type="number" class="form-control w100" name="std_yearb" disabled>
                                    <option selected><?php echo $rowstd->std_yearb; ?></option>
                                    <option disabled>-----</option>
                                    <?php
                                    $thisyear = date("Y") + 543;
                                    for ($i = $thisyear - 18; $i <= $thisyear; $i++) {
                                        echo '<option>' . $i . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col col-12 col-md-3">
                                <label>อายุ</label>
                                <select disabled type="text" class="form-control w100" name="std_age" disabled>
                                    <option selected><?php echo $rowstd->std_age; ?></option>
                                    <option disabled>-----</option>
                                    <?php
                                    for ($i = 11; $i <= 18; $i++) {
                                        echo '<option>' . $i . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-12 col-md-3">
                                <label>คำนำหน้า</label>
                                <select disabled type="text" class="form-control w100" name="std_prefix" required>
                                    <option selected><?php echo $rowstd->std_prefix; ?></option>
                                    <option disabled>-----</option>
                                    <option>เด็กชาย</option>
                                    <option>เด็กหญิง</option>
                                    <option>นาย</option>
                                    <option>นางสาว</option>
                                </select>
                            </div>
                            <div class="col col-12 col-md-4">
                                <label>ชื่อ</label>
                                <input disabled type="text" class="form-control w100" name="std_fname" value="<?php echo $rowstd->std_fname; ?>" required>
                            </div>
                            <div class="col col-12 col-md-5">
                                <label>นามสกุล</label>
                                <input disabled type="text" class="form-control w100" name="std_lname" value="<?php echo $rowstd->std_lname; ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-12 col-md-4">
                                <label>ศาสนา</label>
                                <input disabled type="text" class="form-control w100" value="<?php echo $rowstd->std_religion; ?>" name="std_religion">
                            </div>
                            <div class="col col-12 col-md-4">
                                <label>เชื้อชาติ</label>
                                <input disabled type="text" class="form-control w100" value="<?php echo $rowstd->std_race; ?>" name="std_race">
                            </div>
                            <div class="col col-12 col-md-4">
                                <label>สัญชาติ</label>
                                <input disabled type="text" class="form-control w100" value="<?php echo $rowstd->std_nation; ?>" name="std_nation">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-12 col-md-5">
                                <label>หมู่เลือด</label>
                                <select disabled type="text" class="form-control w100" name="std_blood" required>
                                    <option selected><?php echo $rowstd->std_blood; ?></option>
                                    <option disabled>-----</option>
                                    <option>A</option>
                                    <option>B</option>
                                    <option>O</option>
                                    <option>AB</option>
                                    <option>ไม่ทราบ</option>
                                </select>
                            </div>
                            <div class="col col-12 col-md-7">
                                <label>เบอร์โทรที่สามารถติดต่อนักเรียนได้</label>
                                <input disabled type="text" class="form-control w100" value="<?php echo $rowstd->std_phone; ?>" name="std_phone" required>
                            </div>
                        </div>



                        <div id="formplan" style="display:none;">
                            <div class="hr dotted hr-double"></div>
                            <p class="alert alert-info text-right" style="font-size: 25px;">เลือกลำดับแผนการเรียน
                                <br>
                                <font size="2">(**เลือก 4 ลำดับห้ามซ้ำกัน)</font>
                            </p>
                            <?php
                            include 'includes/config.php';
                            $sqlplan = "SELECT * FROM stdplan";
                            $queryplan = $dbcon->prepare($sqlplan);
                            $queryplan->execute();
                            $resultsplan = $queryplan->fetchAll(PDO::FETCH_OBJ);
                            ?>

                            <script>
                                //มา่โค๊ดตัดลำดับ
                                var x1 = 0;
                                var x2 = 0;

                                function hide_plan1(id) {
                                    var i = 1;
                                    x1 = id;
                                    var plannum = <?php echo $queryplan->rowCount();  ?>;
                                    for (i = 1; i <= plannum; i++) {
                                        if (i != x1) {
                                            document.getElementById('plan2_' + i).style.display = 'block';
                                            document.getElementById('plan3_' + i).style.display = 'block';
                                            document.getElementById('plan4_' + i).style.display = 'block';
                                            document.getElementById("plan2block").style.display = 'block';
                                            document.getElementById('plan2_' + i).disabled = false;
                                            document.getElementById('plan3_' + i).disabled = false;
                                            document.getElementById('plan4_' + i).disabled = false;
                                            // document.createElement("plan2_"+i);
                                        }
                                    }
                                    document.getElementById('plan2_' + id).style.display = 'none';
                                    document.getElementById('plan3_' + id).style.display = 'none';
                                    document.getElementById('plan4_' + id).style.display = 'none';
                                    document.getElementById('plan2_' + id).disabled = true;
                                    document.getElementById('plan3_' + id).disabled = true;
                                    document.getElementById('plan4_' + id).disabled = true;
                                    document.getElementById("plan2").selectedIndex = 0;
                                    document.getElementById("plan3").selectedIndex = 0;
                                    document.getElementById("plan4").selectedIndex = 0;
                                    document.getElementById("plan3block").style.display = 'none';
                                    document.getElementById("plan4block").style.display = 'none';

                                }

                                function hide_plan2(id) {

                                    var i = 1;
                                    var plannum = <?php echo $queryplan->rowCount();  ?>;
                                    for (i = 1; i <= plannum; i++) {
                                        if (i != x1 && i != id) {
                                            document.getElementById('plan3_' + i).style.display = 'block';
                                            document.getElementById('plan4_' + i).style.display = 'block';
                                            document.getElementById("plan3block").style.display = 'block';
                                            document.getElementById('plan3_' + i).disabled = false;
                                            document.getElementById('plan4_' + i).disabled = false;
                                        }
                                    }
                                    x2 = id;
                                    document.getElementById('plan3_' + id).style.display = 'none';
                                    document.getElementById('plan4_' + id).style.display = 'none';
                                    document.getElementById('plan3_' + id).disabled = true;
                                    document.getElementById('plan4_' + id).disabled = true;
                                    document.getElementById("plan3").selectedIndex = 0;
                                    document.getElementById("plan4").selectedIndex = 0;
                                    document.getElementById("plan4block").style.display = 'none';
                                }

                                function hide_plan3(id) {
                                    var i = 1;
                                    var plannum = <?php echo $queryplan->rowCount();  ?>;
                                    for (i = 1; i <= plannum; i++) {
                                        if (i != x1 && i != x2 && i != id) {
                                            document.getElementById('plan4_' + i).style.display = 'block';
                                            document.getElementById("plan4block").style.display = 'block';
                                            document.getElementById('plan4_' + i).disabled = false;
                                        }
                                    }
                                    document.getElementById('plan4_' + id).style.display = 'none';
                                    document.getElementById('plan4_' + id).disabled = true;
                                    document.getElementById("plan4").selectedIndex = 0;
                                }
                            </script>

                            <script>
                                function formplanedit() {
                                    document.getElementById('formplanedit').style.display = 'block';
                                    document.getElementById('formplaneditshow').style.display = 'none';
                                    document.getElementById("plan1").selectedIndex = 0;
                                    document.getElementById("plan2").selectedIndex = 0;
                                    document.getElementById("plan3").selectedIndex = 0;
                                    document.getElementById("plan4").selectedIndex = 0;
                                }
                            </script>


                            <div id="formplanold" style="display:block;">
                                <a class="btn btn-sm btn-primary btn-block" onclick="formplanedit()">คลิกที่นี่ เพื่อต้องการแก้ไขการเลือกแผนการเรียน</a>
                            </div>




                            <!-- สำหรับโชว์ขอเก่าไม่ส่งค่า -->
                            <div id="formplaneditshow" style="display:block;">
                                <label>เลือกลำดับ 1</label>
                                <select id="plan1show" class="form-control" disabled>
                                    <option value="" disabled>- เลือก -</option>
                                    <?php
                                    foreach ($resultsplan as $row) {
                                    ?>
                                        <option><?php echo $row->plan_name; ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>
                                <label>เลือกลำดับ 2</label>
                                <select id="plan2show" class="form-control" disabled>
                                    <option value="" disabled>- เลือก -</option>
                                    <?php
                                    foreach ($resultsplan as $row) {
                                    ?>
                                        <option><?php echo $row->plan_name; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <label>เลือกลำดับ 3</label>
                                <select id="plan3show" class="form-control" disabled>
                                    <option value="" disabled>- เลือก -</option>
                                    <?php
                                    foreach ($resultsplan as $row) {
                                    ?>
                                        <option><?php echo $row->plan_name; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <label>เลือกลำดับ 4</label>
                                <select id="plan4show" class="form-control" disabled>
                                    <option value="" disabled>- เลือก -</option>
                                    <?php
                                    foreach ($resultsplan as $row) {
                                    ?>
                                        <option><?php echo $row->plan_name; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <!-- สำหรับโชว์ขอเก่าไม่ส่งค่า -->


                            <!-- เลือกลำดับจริงใส่ค่าเดิมแล้วซ่อนไว้ -->
                            <div id="formplanedit" style="display:none;">
                                <label>เลือกลำดับ 1</label>
                                <select id="plan1" class="form-control" id="plan1req" data-placeholder="- เลือก -" name="std_plan1" onchange="hide_plan1(this.value)">
                                    <option value="" disabled>- เลือก -</option>
                                    <?php
                                    foreach ($resultsplan as $row) {
                                    ?>
                                        <option value="<?php echo $row->plan_id; ?>"><?php echo $row->plan_name; ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>
                                <div id="plan2block" style="display:none;">
                                    <label>เลือกลำดับ 2</label>
                                    <select id="plan2" class="form-control" id="plan2req" data-placeholder="- เลือก -" name="std_plan2" onchange="hide_plan2(this.value)">
                                        <option value="" disabled>- เลือก -</option>
                                        <?php
                                        foreach ($resultsplan as $row) {
                                        ?>
                                            <option id="plan2_<?php echo $row->plan_id; ?>" value="<?php echo $row->plan_id; ?>"><?php echo $row->plan_name; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="plan3block" style="display:none;">
                                    <label>เลือกลำดับ 3</label>
                                    <select id="plan3" class="form-control" id="plan3req" data-placeholder="- เลือก -" name="std_plan3" onchange="hide_plan3(this.value)">
                                        <option value="" disabled>- เลือก -</option>
                                        <?php
                                        foreach ($resultsplan as $row) {
                                        ?>
                                            <option id="plan3_<?php echo $row->plan_id; ?>" value="<?php echo $row->plan_id; ?>"><?php echo $row->plan_name; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="plan4block" style="display:none;">
                                    <label>เลือกลำดับ 4</label>
                                    <select id="plan4" class="form-control" id="plan4req" data-placeholder="- เลือก -" name="std_plan4">
                                        <option value="" disabled>- เลือก -</option>
                                        <?php
                                        foreach ($resultsplan as $row) {
                                        ?>
                                            <option id="plan4_<?php echo $row->plan_id; ?>" value="<?php echo $row->plan_id; ?>"><?php echo $row->plan_name; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!-- เลือกลำดับจริงใส่ค่าเดิมแล้วซ่อนไว้ -->
                            </div>


                        </div>





                        <div class="hr dotted hr-double"></div>
                        <p class="alert alert-info text-right" style="font-size: 25px;">ข้อมูลการศึกษา</p>
                        <label>ปัจจุบันสำเร็จการศึกษาจาก (ชื่อโรงเรียนเดิม)</label>
                        <input disabled type="text" class="form-control w100" value="<?php echo $rowstd->std_eduschool; ?>" name="std_eduschool" required>
                        <div class="row">
                            <div class="col col-12 col-md-6">
                                <label>อำเภอ รร.เดิม</label>
                                <input disabled type="text" class="form-control w100" value="<?php echo $rowstd->std_edudistrict; ?>" name="std_edudistrict">
                            </div>
                            <div class="col col-12 col-md-6">
                                <label>จังหวัด รร.เดิม</label>
                                <select class="form-control" required="" name="std_eduprovince" disabled>
                                    <option selected><?php echo $rowstd->std_eduprovince; ?></option>
                                    <option disabled>-----</option>
                                    <?php
                                    include 'includes/provicelist.php';
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="hr dotted hr-double"></div>

                        <p class="alert alert-info text-right" style="font-size: 25px;">ข้อมูลที่อยู่นักเรียน</p>
                        <div class="row">
                            <div class="col col-12 col-md-3">
                                <label>บ้านเลขที่</label>
                                <input disabled type="text" class="form-control w100" value="<?php echo $rowstd->std_homenum; ?>" name="std_homenum" required>
                            </div>
                            <div class="col col-12 col-md-3">
                                <label>หมู่ที่</label>
                                <input disabled type="number" class="form-control w100" value="<?php echo $rowstd->std_homevill; ?>" name="std_homevill">
                            </div>
                            <div class="col col-12 col-md-6">
                                <label>ตำบล/แขวง</label>
                                <input disabled type="text" class="form-control w100" value="<?php echo $rowstd->std_homesubdistrict; ?>" name="std_homesubdistrict" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-12 col-md-6">
                                <label>อำเภอ/เขต</label>
                                <input disabled type="text" class="form-control w100" value="<?php echo $rowstd->std_homedistrict; ?>" name="std_homedistrict" required>
                            </div>
                            <div class="col col-12 col-md-6">
                                <label>จังหวัด</label>
                                <select disabled class="form-control" name="std_homeprovince" required aria-required="">
                                    <option selected><?php echo $rowstd->std_homeprovince; ?></option>
                                    <option disabled>-----</option>
                                    <?php
                                    include 'includes/provicelist.php';
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-12 col-md-6">
                                <label>รหัสไปรษณีย์</label>
                                <input disabled type="number" class="form-control w100" value="<?php echo $rowstd->std_homeposcode; ?>" name="std_homeposcode">
                            </div>
                        </div>


                        <div class="hr dotted hr-double"></div>

                        <p class="alert alert-info text-right" style="font-size: 25px;">ข้อมูลบิดา - มารดา</p>
                        <div class="row">
                            <div class="col col-12 col-md-6">
                                <label>ชื่อ-นามสกุล บิดา</label>
                                <input disabled type="text" class="form-control w100" value="<?php echo $rowstd->std_father_name; ?>" name="std_father_name" required>
                            </div>
                            <div class="col col-12 col-md-6">
                                <label>อาชีพ บิดา</label>
                                <input disabled type="text" class="form-control w100" value="<?php echo $rowstd->std_father_career; ?>" name="std_father_career">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-12 col-md-6">
                                <label>สถานที่ทำงาน บิดา</label>
                                <input disabled type="text" class="form-control w100" value="<?php echo $rowstd->std_father_work; ?>" name="std_father_work">
                            </div>
                            <div class="col col-12 col-md-6">
                                <label>เบอร์โทรศัพท์ บิดา</label>
                                <input disabled type="text" class="form-control w100" value="<?php echo $rowstd->std_father_phone; ?>" name="std_father_phone">
                            </div>
                        </div>
                        <div class="hr dotted hr-double"></div>
                        <div class="row">
                            <div class="col col-12 col-md-6">
                                <label>ชื่อ-นามสกุล มารดา</label>
                                <input disabled type="text" class="form-control w100" value="<?php echo $rowstd->std_mother_name; ?>" name="std_mother_name" required>
                            </div>
                            <div class="col col-12 col-md-6">
                                <label>อาชีพ มารดา</label>
                                <input disabled type="text" class="form-control w100" value="<?php echo $rowstd->std_mother_career; ?>" name="std_mother_career">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-12 col-md-6">
                                <label>สถานที่ทำงาน มารดา</label>
                                <input disabled type="text" class="form-control w100" value="<?php echo $rowstd->std_mother_work; ?>" name="std_mother_work">
                            </div>
                            <div class="col col-12 col-md-6">
                                <label>เบอร์โทรศัพท์ มารดา</label>
                                <input disabled type="text" class="form-control w100" value="<?php echo $rowstd->std_mother_phone; ?>" name="std_mother_phone">
                            </div>
                        </div>
                        <div class="hr dotted hr-double"></div>

                        <p class="alert alert-info text-right" style="font-size: 25px;">ข้อมูลผู้ปกครอง</p>

                        <div class="row">
                            <div class="radio">
                                <label class="mt-3">ผู้ปกครอง :</label><label>
                                    <input disabled type="radio" class="ace w50" name="std_parent_relation" value="บิดา" onclick="hideparent();" <?php if ($rowstd->std_parent_relation == "บิดา") {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } ?>>
                                    <span class="lbl bigger-100">&nbsp;บิดา</span>
                                </label>
                                <label>
                                    <input disabled type="radio" class="ace" name="std_parent_relation" value="มารดา" onclick="hideparent();" <?php if ($rowstd->std_parent_relation == "มารดา") {
                                                                                                                                                    echo "checked";
                                                                                                                                                } ?>>
                                    <span class="lbl bigger-100">&nbsp;มารดา</span>
                                </label>
                                <label>
                                    <input disabled type="radio" class="ace" name="std_parent_relation" value="0" onclick="showparent();" <?php if ($rowstd->std_parent_relation != "บิดา" && $rowstd->std_parent_relation != "มารดา") {
                                                                                                                                                echo "checked";
                                                                                                                                            } ?>>
                                    <span class="lbl bigger-100">&nbsp;บุคคลอื่น</span>
                                </label>
                            </div>
                        </div>


                        <div id="parent" <?php if ($rowstd->std_parent_relation != "บิดา" && $rowstd->std_parent_relation != "มารดา") {
                                                echo 'style="display:block;"';
                                            } else {
                                                echo 'style="display:none;"';
                                            }
                                            ?>>
                            <input disabled type="text" class="form-control w100" value="<?php echo $rowstd->std_parent_relation; ?>" name="std_parent_relation_orther">
                            <div class="row">
                                <div class="col col-12 col-md-6">
                                    <label>ชื่อ-นามสกุล ผู้ปกครอง</label>
                                    <input disabled type="text" class="form-control w100" value="<?php echo $rowstd->std_parent_name; ?>" name="std_parent_name" #placeholder="- ชื่อ-นามสกุล ผู้ปกครอง ภาษาไทย -">
                                </div>
                                <div class="col col-12 col-md-6">
                                    <label>อาชีพ ผู้ปกครอง</label>
                                    <input disabled type="text" class="form-control w100" value="<?php echo $rowstd->std_parent_career; ?>" name="std_parent_career">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-12 col-md-6">
                                    <label>สถานที่ทำงาน ผู้ปกครอง</label>
                                    <input disabled type="text" class="form-control w100" value="<?php echo $rowstd->std_parent_work; ?>" name="std_parent_work" #placeholder="- ระบุสั้นๆ เช่น ชื่อบริษัท... หรือชื่อจังหวัด.. -">
                                </div>
                                <div class="col col-12 col-md-6">
                                    <label>เบอร์โทรศัพท์ ผู้ปกครอง</label>
                                    <input disabled type="text" class="form-control w100" value="<?php echo $rowstd->std_parent_phone; ?>" name="std_parent_phone" #placeholder="- กรอกเพียง1หมายเลขที่สามารถติดต่อได้ -">
                                </div>
                            </div>
                        </div>
                        <div class="hr dotted hr-double"></div>


                        <div id="formtalent" style="display:none;">
                            <p class="alert alert-info text-right" style="font-size: 25px;">ความสามารถพิเศษ</p>
                            <label>ความสามารถพิเศษ (ตามเกณฑ์ที่โรงเรียนประกาศไว้)</label>
                            <!-- <a #href="https://drive.google.com/open?id=18GkPDG946ujpZ5HM2rvnlG05hUCxM15W" target="_blank">(ดูรายละเอียดได้ที่ประกาศรับสมัคร ข้อที่ 7.3)</a></label> -->

                            <!-- <input disabled type="text" class="form-control" name="std_talent"> -->
                            <select disabled class="form-control" #id="form-field-select-3" name="std_talent" aria-required="">
                                <option selected><?php echo $rowstd->std_talent; ?></option>
                                <option disabled>-----</option>
                                <option>ด้านดนตรีไทย</option>
                                <option>ด้านดนตรีสากล</option>
                                <option>ด้านนาฏศิลป์</option>
                                <option>ด้านศิลปะ</option>
                                <option>ด้านการขับร้อง</option>
                                <option>ด้านกีฬา</option>
                            </select>
                            <div class="hr dotted hr-double"></div>


                        </div>

                        <!-- คอลัมน์ 1 -->
                    </div>
                    <div class="col col-12 col-md-6">
                        <!-- คอลัมน์ 2 -->




                        <!-- อัพรูป -->
                        <script src="js/jquery.min.js"></script>
                        <!-- <script src="js/bootstrap.min.js"></script> -->
                        <script src="js/croppie.js"></script>
                        <!-- <link rel="stylesheet" href="js/bootstrap.min.css" /> -->
                        <link rel="stylesheet" href="js/croppie.css" />


                        <p class="alert alert-info text-right" style="font-size: 25px;">รูปถ่ายชุดนักเรียนหน้าตรง</p>
                        <div class="row justify-content-md-center">
                            <div style="height: 230px;width: 200px; text-align:center;margin: 0 auto;border: 2px solid #bce8f1;background-color: #fff;background-image: url('<?php echo $rowstd->std_photo . '?' . (rand(10, 100)); ?>');">
                                <div id="uploaded_image" class=""></div>
                            </div>

                        </div>

                        <div class="hr dotted hr-double" style="border: 2px solid #bce8f1;"></div>







                        <!-- เอกสารทั้งหมด ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

                        <div id="formdocfile" style="display:none;">
                            <p class="alert alert-info text-right" style="font-size: 25px;">เอกสารทั้งหมด</p>
                            <div class="row text-center">
                                <div class="col-12 bg-info" style="text-align:center;margin: 5px;border: 2px solid #bce8f1;">
                                    <h4>ใบรับรองการเป็นนักเรียน(ปพ.7) <br>หรือ ระเบียนผลการเรียน(ปพ.1)</h4>
                                    <?php
                                    if (file_exists($rowstd->std_doccer)) {
                                        if (substr($rowstd->std_doccer, -3) == "pdf") { ?>
                                            <embed src="<?php echo $rowstd->std_doccer; ?>" type="application/pdf" width="90%" height="600" />
                                        <?php
                                        } else {
                                        ?>
                                            <img src="<?php echo $rowstd->std_doccer; ?>" width="90%">
                                    <?php
                                        }
                                    } else {
                                        echo '<img src="stddoc/nofile.png" width="20%"><br>ไม่พบเอกสารนี้<br>';
                                    }
                                    ?>
                                    <?php
                                    if (file_exists($rowstd->std_doccer_2)) {
                                        if (substr($rowstd->std_doccer_2, -3) == "pdf") { ?>
                                            <embed src="<?php echo $rowstd->std_doccer_2; ?>" type="application/pdf" width="90%" height="600" />
                                        <?php
                                        } else {
                                        ?>
                                            <img src="<?php echo $rowstd->std_doccer_2; ?>" width="90%">
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>

                                <div class="col-12 bg-info" style="text-align:center;margin: 5px;border: 2px solid #bce8f1;">
                                    <h3>สำเนาทะเบียนบ้าน นักเรียน</h3>
                                    <?php
                                    if (file_exists($rowstd->std_dochome1)) {
                                        if (substr($rowstd->std_dochome1, -3) == "pdf") { ?>
                                            <embed src="<?php echo $rowstd->std_dochome1; ?>" type="application/pdf" width="90%" height="600" />
                                        <?php
                                        } else {
                                        ?>
                                            <img src="<?php echo $rowstd->std_dochome1; ?>" width="90%">
                                    <?php
                                        }
                                    } else {
                                        echo '<img src="stddoc/nofile.png" width="20%"><br>ไม่พบเอกสารนี้<br>';
                                    }
                                    ?>
                                </div>

                                <div class="col-12 bg-info" style="text-align:center;margin: 5px;border: 2px solid #bce8f1;">
                                    <h3>สำเนาทะเบียนบ้าน บิดา</h3>
                                    <?php
                                    if (file_exists($rowstd->std_dochome2)) {
                                        if (substr($rowstd->std_dochome2, -3) == "pdf") { ?>
                                            <embed src="<?php echo $rowstd->std_dochome2; ?>" type="application/pdf" width="90%" height="600" />
                                        <?php
                                        } else {
                                        ?>
                                            <img src="<?php echo $rowstd->std_dochome2; ?>" width="90%">
                                    <?php
                                        }
                                    } else {
                                        echo '<img src="stddoc/nofile.png" width="20%"><br>ไม่พบเอกสารนี้<br>';
                                    }
                                    ?>
                                </div>

                                <div class="col-12 bg-info" style="text-align:center;margin: 5px;border: 2px solid #bce8f1;">
                                    <h3>สำเนาทะเบียนบ้าน มารดา</h3>
                                    <?php
                                    if (file_exists($rowstd->std_dochome3)) {
                                        if (substr($rowstd->std_dochome3, -3) == "pdf") { ?>
                                            <embed src="<?php echo $rowstd->std_dochome3; ?>" type="application/pdf" width="90%" height="600" />
                                        <?php
                                        } else {
                                        ?>
                                            <img src="<?php echo $rowstd->std_dochome3; ?>" width="90%">
                                    <?php
                                        }
                                    } else {
                                        echo '<img src="stddoc/nofile.png" width="20%"><br>ไม่พบเอกสารนี้<br>';
                                    }
                                    ?>
                                </div>
                                <?php
                                if ($rowstd->std_parent_relation != 'บิดา' && $rowstd->std_parent_relation != 'มารดา') { ?>
                                    <div class="col-12 bg-info" style="text-align:center;margin: 5px;border: 2px solid #bce8f1;">
                                        <h3>สำเนาทะเบียนบ้าน ผู้ปกครอง</h3>
                                        <?php
                                        if (file_exists($rowstd->std_dochome4)) {
                                            if (substr($rowstd->std_dochome4, -3) == "pdf") { ?>
                                                <embed src="<?php echo $rowstd->std_dochome4; ?>" type="application/pdf" width="90%" height="600" />
                                            <?php
                                            } else {
                                            ?>
                                                <img src="<?php echo $rowstd->std_dochome4; ?>" width="90%">
                                        <?php
                                            }
                                        } else {
                                            echo '<img src="stddoc/nofile.png" width="20%"><br>ไม่พบเอกสารนี้<br>';
                                        }
                                        ?>
                                    </div>
                                <?php
                                }
                                ?>

                                <div class="col-12 bg-info" style="text-align:center;margin: 5px;border: 2px solid #bce8f1;">
                                    <h3>ใบแสดงผลคะแนน O-NET</h3>
                                    <?php
                                    if (file_exists($rowstd->std_doconet)) {
                                        if (substr($rowstd->std_doconet, -3) == "pdf") { ?>
                                            <embed src="<?php echo $rowstd->std_doconet; ?>" type="application/pdf" width="90%" height="600" />
                                        <?php
                                        } else {
                                        ?>
                                            <img src="<?php echo $rowstd->std_doconet; ?>" width="90%">
                                    <?php
                                        }
                                    } else {
                                        echo '<img src="stddoc/nofile.png" width="20%"><br>ไม่พบเอกสารนี้<br>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- เอกสารทั้งหมด ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->





                        <!-- คอลัมน์ 2 -->
                    </div>

                </div>
            </div>
        </div>

    </div>
</form>