<?php
include 'includes/header.php';
?>
<?php
session_start();
$mclass = 'm4';
$_SESSION['page'] = 'm4-1';
$_SESSION['uploadphoto'] = '1';
$_SESSION['mode'] = 'add'; //โหมดเพิ่มข้อมูลใหม่
if ($_SESSION['where'] != 'm4') {
  header("Location: index.php");
}
$std_id = $_SESSION['std_id'];
?>
<?php
include "includes/sidebar.php";
?>




<?php



if (isset($_POST["image"])) {
  $data = $_POST["image"];
  $image_array_1 = explode(";", $data);
  $image_array_2 = explode(",", $image_array_1[1]);
  $data = base64_decode($image_array_2[1]);
  $imageName =  'stdphoto/' . $mclass . '/' . $std_id . '.jpg';
  file_put_contents($imageName, $data);
  // echo '<img src="'.$imageName.'" class="img-thumbnail" id="capt" />';
}

?>



<div class="main-content">
  <div class="main-content-inner">
    <div class="page-content">



      <div class="row cnbox">
        <div class="col col-lg-12 cnbox bg-success">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">หน้าหลัก</a></li>
                <li class="breadcrumb-item"><a href="<?php echo $mclass; ?>start.php">ชั้นมัธยมศึกษาปีที่ <?php echo substr($mclass, -1, 1); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">กรอกข้อมูล</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>

      <form action="<?php echo $mclass; ?>finish.php" method="POST" enctype="multipart/form-data">
        <div class="row cnbox">
          <div class="col col-lg-12 cnbox bg-success text-center">

            <h1>สมัครเข้าศึกษาต่อชั้นมัธยมศึกษาปีที่ <?php echo substr($mclass, -1, 1); ?></h1>
            <h2>เลือกประเภทที่ตรงกับข้อมูลนักเรียน</h2>
            <br>

            <?php
            $type_class = "ชั้นมัธยมศึกษาปีที่ " . substr($mclass, -1, 1);
            $num = 1;
            $sql = "SELECT * FROM registype WHERE type_status=1 AND type_class=:type_class";
            $query = $dbcon->prepare($sql);
            $query->bindParam(':type_class', $type_class, PDO::PARAM_STR);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            ?>
            <div class="row"><?php
                              foreach ($results as $row) { ?>

                <?php
                                if ($row->type_id == '15' || $row->type_id == '46') {
                                  // ปิด
                                  $type_close = 'display:none;';
                                  // เปิด
                                  // $type_close ='';
                                } else {
                                  $type_close = '';
                                }

                ?>


                <div class="col-12 col-sm-12 col-md-4">
                  <div class="alert alert-info" role="alert" style="<?php echo $type_close; ?>">
                    <label>
                      <input type="radio" class="ace input-lg" name="std_type" value="<?php echo $row->type_id ?>" onclick="showform<?php echo $num ?>();">
                      <span class="lbl bigger-120"> <?php echo $row->type_name ?></span>
                    </label>
                  </div>
                </div>
                <script>
                  function showform<?php echo $num ?>() {
                    document.getElementById('startform').style.display = 'block';

                    <?php if ($row->type_talent == 1) { ?>
                      document.getElementById('formtalent').style.display = 'block';
                      document.getElementById("std_talentname").required = true;
                      document.getElementById("std_talent").required = true;
                    <?php
                                } else { ?>
                      document.getElementById('formtalent').style.display = 'none';
                      document.getElementById("std_talentname").required = false;
                      document.getElementById("std_talent").required = false;
                    <?php
                                }
                    ?>

                    <?php if ($row->type_onet == 1) { ?>
                      document.getElementById('formonet').style.display = 'block';
                    <?php
                                } else { ?>
                      document.getElementById('formonet').style.display = 'none';
                    <?php
                                }
                    ?>

                    <?php if ($row->type_doc == 1) { ?>
                      document.getElementById('formdoc').style.display = 'block';
                    <?php
                                } else { ?>
                      document.getElementById('formdoc').style.display = 'none';
                    <?php
                                }
                    ?>
                    <?php if ($row->type_cer == 1) { ?>
                      document.getElementById('formcer').style.display = 'block';
                    <?php
                                } else { ?>
                      document.getElementById('formcer').style.display = 'none';
                    <?php
                                }
                    ?>

                    <?php if ($row->type_plan == 1) { ?>
                      document.getElementById('formplan').style.display = 'block';
                      document.getElementById("plan1").required = true;
                      document.getElementById("plan2").required = true;
                      document.getElementById("plan3").required = true;
                      document.getElementById("plan4").required = true;
                    <?php
                                } else { ?>
                      document.getElementById('formplan').style.display = 'none';
                      document.getElementById("plan1").required = false;
                      document.getElementById("plan2").required = false;
                      document.getElementById("plan3").required = false;
                      document.getElementById("plan4").required = false;
                    <?php
                                }
                    ?>

                  }
                </script>
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
            <div class="col col-lg-12 cnbox bg-success">
              <!-- <h3 class="text-center">กรอกข้อมูลนักเรียน</h3> -->
              <div class="row">
                <div class="col col-12 col-md-6" style="border-style: hidden double hidden hidden;border-color: #ffc1c1;">
                  <!-- คอลัมน์ 1 -->

                  <p class="alert alert-info text-right" style="font-size: 25px;">ข้อมูลนักเรียน</p>
                  <label>รหัสบัตรประชาชน</label><i class="text-danger">*</i>
                  <input type="text" class="form-control w100" value="<?php echo $std_id; ?>" name="std_id" readonly>

                  <div class="row">
                    <div class="col col-12 col-md-3">
                      <label>วันที่เกิด</label></label><i class="text-danger">*</i>
                      <select type="number" class="form-control w100" name="std_dayb" required>
                        <option value disabled selected>- วันที่ -</option>
                        <?php
                        for ($i = 1; $i <= 31; $i++) {
                          echo '<option>' . $i . '</option>';
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col col-12 col-md-3">
                      <label>เดือนเกิด</label></label><i class="text-danger">*</i>
                      <select type="text" class="form-control w100" name="std_monthb" required>
                        <option value disabled selected>- เดือน -</option>
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
                      <label>ปีเกิด</label></label><i class="text-danger">*</i>
                      <select type="number" class="form-control w100" name="std_yearb" required>
                        <option value disabled selected>- ปี -</option>
                        <?php
                        $thisyear = date("Y") + 543;
                        for ($i = $thisyear - 25; $i <= $thisyear; $i++) {
                          echo '<option>' . $i . '</option>';
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col col-12 col-md-3">
                      <label>อายุ</label></label><i class="text-danger">*</i>
                      <select type="text" class="form-control w100" name="std_age" required>
                        <option value disabled selected>- อายุ -</option>
                        <?php
                        for ($i = 11; $i <= 25; $i++) {
                          echo '<option>' . $i . '</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col col-12 col-md-3">
                      <label>คำนำหน้า</label><i class="text-danger">*</i>
                      <select type="text" class="form-control w100" name="std_prefix" required>
                        <option value disabled selected>- เลือก -</option>
                        <option>เด็กชาย</option>
                        <option>เด็กหญิง</option>
                        <option>นาย</option>
                        <option>นางสาว</option>
                      </select>
                    </div>
                    <div class="col col-12 col-md-4">
                      <label>ชื่อ</label><i class="text-danger">*</i>
                      <input type="text" class="form-control w100" name="std_fname" placeholder="- ชื่อภาษาไทย -" required>
                    </div>
                    <div class="col col-12 col-md-5">
                      <label>นามสกุล</label><i class="text-danger">*</i>
                      <input type="text" class="form-control w100" name="std_lname" placeholder="- นามสกุลภาษาไทย -" required>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col col-12 col-md-4">
                      <label>ศาสนา</label>
                      <input type="text" class="form-control w100" value="พุทธ" name="std_religion">
                    </div>
                    <div class="col col-12 col-md-4">
                      <label>เชื้อชาติ</label>
                      <input type="text" class="form-control w100" value="ไทย" name="std_race">
                    </div>
                    <div class="col col-12 col-md-4">
                      <label>สัญชาติ</label>
                      <input type="text" class="form-control w100" value="ไทย" name="std_nation">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col col-12 col-md-5">
                      <label>หมู่เลือด</label><i class="text-danger">*</i>
                      <select type="text" class="form-control w100" name="std_blood" required>
                        <option value disabled selected>- เลือก -</option>
                        <option>A</option>
                        <option>B</option>
                        <option>O</option>
                        <option>AB</option>
                        <option>ไม่ทราบ</option>
                      </select>
                    </div>
                    <div class="col col-12 col-md-7">
                      <label>เบอร์โทรที่สามารถติดต่อนักเรียนได้</label><i class="text-danger">*</i>
                      <input type="text" class="form-control w100" placeholder="- ระบุเพียง 1 หมายเลขเท่านั้น -" name="std_phone" required>
                    </div>
                  </div>



                  <div id="formplan" style="display:none;">
                    <div class="hr dotted hr-double"></div>
                    <p class="alert alert-info text-right" style="font-size: 25px;">เลือกลำดับแผนการเรียน
                      <br>
                      <font size="2">(**เลือก 4 ลำดับห้ามซ้ำกัน)</font>
                    </p>
                    <!-- <a href="stddoc/plan64.pdf" target="_blank">
                      <h5>รายละเอียดเกณฑ์การพิจารณาแผนการเรียน!! </h5>
                    </a> -->
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
                            document.getElementById('plan4_' + i).disabled = false;
                            document.getElementById("plan4block").style.display = 'block';
                          }
                        }
                        document.getElementById('plan4_' + id).style.display = 'none';
                        document.getElementById('plan4_' + id).disabled = true;
                        document.getElementById("plan4").selectedIndex = 0;
                      }
                    </script>

                    <div id="plan1block">
                      <label>เลือกลำดับ 1</label>
                      <select id="plan1" class="form-control" data-placeholder="- เลือก -" name="std_plan1" onchange="hide_plan1(this.value)">
                        <option value="" disabled selected>- เลือก -</option>
                        <?php
                        foreach ($resultsplan as $row) {
                        ?>
                          <option value="<?php echo $row->plan_id; ?>"><?php echo $row->plan_name; ?></option>
                        <?php
                        }
                        ?>

                      </select>
                    </div>
                    <div id="plan2block" style="display:none;">
                      <label>เลือกลำดับ 2</label>
                      <select id="plan2" class="form-control" data-placeholder="- เลือก -" name="std_plan2" onchange="hide_plan2(this.value)">
                        <option value="" disabled selected>- เลือก -</option>
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
                      <select id="plan3" class="form-control" data-placeholder="- เลือก -" name="std_plan3" onchange="hide_plan3(this.value)">
                        <option value="" disabled selected>- เลือก -</option>
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
                      <select id="plan4" class="form-control" data-placeholder="- เลือก -" name="std_plan4">
                        <option value="" disabled selected>- เลือก -</option>
                        <?php
                        foreach ($resultsplan as $row) {
                        ?>
                          <option id="plan4_<?php echo $row->plan_id; ?>" value="<?php echo $row->plan_id; ?>"><?php echo $row->plan_name; ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="hr dotted hr-double"></div>
                  <p class="alert alert-info text-right" style="font-size: 25px;">ข้อมูลการศึกษา</p>
                  <label>ปัจจุบันสำเร็จการศึกษาจาก (ชื่อโรงเรียนเดิม)</label><i class="text-danger">*</i>
                  <input type="text" class="form-control w100" placeholder="ระบุชื่อโรงเรียนเดิม" name="std_eduschool" required>
                  <div class="row">
                    <div class="col col-12 col-md-6">
                      <label>อำเภอ รร.เดิม</label>
                      <input type="text" class="form-control w100" placeholder="ระบุอำเภอโรงเรียนเดิม" name="std_edudistrict">
                    </div>
                    <div class="col col-12 col-md-6">
                      <label>จังหวัด รร.เดิม</label><i class="text-danger">*</i>
                      <select class="form-control" required="" #id="form-field-select-3" data-placeholder="- กรุณาเลือกจังหวัด -" #style="height: 40px;" name="std_eduprovince" required>
                        <option value="" disabled selected>- กรุณาเลือกจังหวัด -</option>
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
                      <label>บ้านเลขที่</label><i class="text-danger">*</i>
                      <input type="text" class="form-control w100" name="std_homenum" required>
                    </div>
                    <div class="col col-12 col-md-3">
                      <label>หมู่ที่</label>
                      <input type="number" class="form-control w100" name="std_homevill">
                    </div>
                    <div class="col col-12 col-md-6">
                      <label>ตำบล/แขวง</label><i class="text-danger">*</i>
                      <input type="text" class="form-control w100" name="std_homesubdistrict" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col col-12 col-md-6">
                      <label>อำเภอ/เขต</label><i class="text-danger">*</i>
                      <input type="text" class="form-control w100" name="std_homedistrict" required>
                    </div>
                    <div class="col col-12 col-md-6">
                      <label>จังหวัด</label><i class="text-danger">*</i>
                      <select class="form-control" #id="form-field-select-3" data-placeholder="- กรุณาเลือกจังหวัด -" #style="height: 40px;" name="std_homeprovince" required aria-required="">
                        <option value="" disabled selected>- กรุณาเลือกจังหวัด -</option>
                        <?php
                        include 'includes/provicelist.php';
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col col-12 col-md-6">
                      <label>รหัสไปรษณีย์</label>
                      <input type="number" class="form-control w100" name="std_homeposcode">
                    </div>
                  </div>


                  <div class="hr dotted hr-double"></div>

                  <p class="alert alert-info text-right" style="font-size: 25px;">ข้อมูลบิดา - มารดา</p>
                  <div class="row">
                    <div class="col col-12 col-md-6">
                      <label>ชื่อ-นามสกุล บิดา</label><i class="text-danger">*</i>
                      <input type="text" class="form-control w100" name="std_father_name" placeholder="- ชื่อ-นามสกุล บิดา ภาษาไทย -" required>
                    </div>
                    <div class="col col-12 col-md-6">
                      <label>อาชีพ บิดา</label>
                      <input type="text" class="form-control w100" name="std_father_career">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col col-12 col-md-6">
                      <label>สถานที่ทำงาน บิดา</label>
                      <input type="text" class="form-control w100" name="std_father_work" placeholder="- ระบุสั้นๆ เช่น ชื่อบริษัท... หรือชื่อจังหวัด.. -">
                    </div>
                    <div class="col col-12 col-md-6">
                      <label>เบอร์โทรศัพท์ บิดา</label><i class="text-danger">*</i>
                      <input type="text" class="form-control w100" name="std_father_phone" placeholder="- กรอกเพียง1หมายเลขที่สามารถติดต่อได้ -">
                    </div>
                  </div>
                  <div class="hr dotted hr-double"></div>
                  <div class="row">
                    <div class="col col-12 col-md-6">
                      <label>ชื่อ-นามสกุล มารดา</label><i class="text-danger">*</i>
                      <input type="text" class="form-control w100" name="std_mother_name" placeholder="- ชื่อ-นามสกุล มารดา ภาษาไทย -" required>
                    </div>
                    <div class="col col-12 col-md-6">
                      <label>อาชีพ มารดา</label>
                      <input type="text" class="form-control w100" name="std_mother_career">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col col-12 col-md-6">
                      <label>สถานที่ทำงาน มารดา</label>
                      <input type="text" class="form-control w100" name="std_mother_work" placeholder="- ระบุสั้นๆ เช่น ชื่อบริษัท... หรือชื่อจังหวัด.. -">
                    </div>
                    <div class="col col-12 col-md-6">
                      <label>เบอร์โทรศัพท์ มารดา</label><i class="text-danger">*</i>
                      <input type="text" class="form-control w100" name="std_mother_phone" placeholder="- กรอกเพียง1หมายเลขที่สามารถติดต่อได้ -">
                    </div>
                  </div>
                  <div class="hr dotted hr-double"></div>

                  <p class="alert alert-info text-right" style="font-size: 25px;">ข้อมูลผู้ปกครอง</p>

                  <div class="row">
                    <div class="radio">
                      <label class="mt-3">ผู้ปกครอง<i class="text-danger">*</i> :</label><label>
                        <input type="radio" class="ace w50" name="std_parent_relation" value="บิดา" checked onclick="hideparent();">
                        <span class="lbl bigger-100">&nbsp;บิดา</span>
                      </label>
                      <label>
                        <input type="radio" class="ace" name="std_parent_relation" value="มารดา" onclick="hideparent();">
                        <span class="lbl bigger-100">&nbsp;มารดา</span>
                      </label>
                      <label>
                        <input type="radio" class="ace" name="std_parent_relation" value="0" onclick="showparent();">
                        <span class="lbl bigger-100">&nbsp;บุคคลอื่น</span>
                      </label>
                    </div>
                  </div>

                  <div id="parent" style="display:none;">
                    <input type="text" class="form-control w100" placeholder="**ระบุความสัมพันธ์นักเรียนกับผู้ปกครอง เช่น ปู่ ย่า ตา ยาย ..." name="std_parent_relation_orther">
                    <div class="row">
                      <div class="col col-12 col-md-6">
                        <label>ชื่อ-นามสกุล ผู้ปกครอง</label><i class="text-danger">*</i>
                        <input type="text" class="form-control w100" name="std_parent_name" placeholder="- ชื่อ-นามสกุล ผู้ปกครอง ภาษาไทย -">
                      </div>
                      <div class="col col-12 col-md-6">
                        <label>อาชีพ ผู้ปกครอง</label>
                        <input type="text" class="form-control w100" name="std_parent_career">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-12 col-md-6">
                        <label>สถานที่ทำงาน ผู้ปกครอง</label>
                        <input type="text" class="form-control w100" name="std_parent_work" placeholder="- ระบุสั้นๆ เช่น ชื่อบริษัท... หรือชื่อจังหวัด.. -">
                      </div>
                      <div class="col col-12 col-md-6">
                        <label>เบอร์โทรศัพท์ ผู้ปกครอง</label><i class="text-danger">*</i>
                        <input type="text" class="form-control w100" name="std_parent_phone" placeholder="- กรอกเพียง1หมายเลขที่สามารถติดต่อได้ -">
                      </div>
                    </div>
                  </div>
                  <div class="hr dotted hr-double"></div>


                  <div id="formtalent" style="display:none;">
                    <p class="alert alert-info text-right" style="font-size: 25px;">ความสามารถพิเศษ</p>
                    <label>ความสามารถพิเศษ (ตามเกณฑ์ที่โรงเรียนประกาศไว้)</label>
                    <!-- <a #href="https://drive.google.com/open?id=18GkPDG946ujpZ5HM2rvnlG05hUCxM15W" target="_blank">(ดูรายละเอียดได้ที่ประกาศรับสมัคร ข้อที่ 7.3)</a></label> -->

                    <!-- <input type="text" class="form-control" name="std_talent"> -->
                    <select class="form-control mb-5" id="std_talent" data-placeholder="- เลือก -" name="std_talent" aria-required="">
                      <option value="" disabled selected>- เลือก -</option>
                      <option>ด้านดนตรีไทย</option>
                      <option>ด้านดนตรีสากล</option>
                      <option>ด้านนาฏศิลป์</option>
                      <option>ด้านศิลปะ</option>
                      <option>ด้านการขับร้อง</option>
                      <option>ด้านกีฬา</option>
                    </select>


                    <label style="padding-top: 10px;">โปรดระบุความสามารถพิเศษ 1 อย่าง ตามประเภทที่เลือกไว้ด้านบน (เช่น "ตะกร้อ")</label><i class="text-danger">*</i>

                    <input type="text" id="std_talentname" class="form-control w100" placeholder="ความสามารถพิเศษ" name="std_talentname">
                    <div class="hr dotted hr-double"></div>






                    <div class="row text-center">
                      <div class="col-12 bg-info" style="text-align:center;margin: 5px;border: 2px solid #bce8f1;">
                        <h4>อัพโหลดหลักฐานความสามารถพิเศษ</h4>
                        <h5>เช่น ภาพถ่าย เกียรติบัตร อื่นๆ...</h5>
                      </div>
                    </div>
                    <div class="bg-danger" style="width:300px;text-align:center;margin: 0 auto;border: 2px solid #bce8f1;">
                      <input type="file" id="upload_doc0" name="std_doctalent" accept="image/png, image/jpeg, image/jpg, image/bmp, application/pdf">
                      <h4 class="text-primary"><b>หลักฐานความสามารถพิเศษ</b></h4>
                    </div>
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


                  <p class="alert alert-info text-right" style="font-size: 25px;">รูปถ่ายชุดนักเรียนหน้าตรง
                    <br>
                    <font size="2">สวมเครื่องแบบนักเรียนปัจจุบัน</font>
                  </p>
                  <div class="row justify-content-md-center">
                    <div class="col-12 col-md-6 text-center">

                      <div style="height: 230px;width: 200px; text-align:center;margin: 0 auto;border: 2px solid #bce8f1;background-color: #fff;">
                        <img src="stdphoto/photoex.png" height="230px" width="200px">
                      </div>
                      <p style="padding-top: 5px;font-size:large;color: #716b6b;">ตัวอย่างรูปถ่าย</p>
                    </div>
                    <div class="col-12 col-md-6 text-center">
                      <div style="height: 230px;width: 200px; text-align:center;margin: 0 auto;border: 2px solid #bce8f1;background-color: #fff;">
                        <div id="uploaded_image" class=""></div>
                      </div>
                      <p style="padding-top: 5px;font-size:large;font-weight: bold;">รูปนักเรียน</p>
                    </div>
                  </div>
                  <div class="hr dotted" style="border: 1px solid #fff;"></div>

                  <div class="row justify-content-md-center mt-3" style="width: 80%;margin: 0 auto;padding-top: 1em;font-size:20px;">
                    <!-- <input type="file" id="upload_image" accept="image/png, image/jpeg, image/bmp"> -->
                    <label>อัพโหลดรูปถ่ายหน้าตรง <br><b>สวมเครื่องแบบนักเรียนปัจจุบัน</b></label>
                    <input type="file" id="upload_image" accept="image/png, image/jpeg, image/jpg, image/bmp">

                  </div>
                  <div class="hr dotted hr-double" style="border: 2px solid #bce8f1;"></div>


                  <div id="formcer" style="display:none;">
                    <p class="alert alert-info text-right" style="font-size: 25px;">อัพโหลดเอกสาร<br>
                      <font size="2">(ใช้รูปภาพหรือPDFเท่านั้น ขนาดไม่เกิน 3MB)</font>
                    </p>








                    <div class="row text-center">
                      <div class="col-12 bg-info" style="text-align:center;margin: 5px;border: 2px solid #bce8f1;">
                        <h4>ใบรับรองการเป็นนักเรียน(ปพ.7) <b><u>หรือ</u></b> ระเบียนผลการเรียน(ปพ.1)</h4>
                        <h5 class="text-danger">-<u>ถ้ามี 1 หน้า ให้แนบไฟล์เฉพาะหมายเลข ( 1 ) </u><br><br>-<u>ถ้ามี 2 หน้า ให้แนบไฟล์ทั้งหมายเลข ( 1 ) และ ( 2 )</u></h5>
                      </div>
                      <div class="col col-12 col-md-6" style="border-style: hidden double hidden hidden;border-color: #ffc1c1;">
                        <div class="bg-danger" style="width: 90%; text-align:center;margin: 0 auto;border: 2px solid #bce8f1;">
                          <input type="file" id="upload_doc1" name="std_doccer" accept="image/png, image/jpeg, image/jpg, image/bmp, application/pdf">
                          <h2 class="text-primary" style="margin-top: 0px;">( 1 )</h2>
                          <h5 class="text-primary"><b>ใบรับรองหรือระเบียนผลการเรียน</b></h5>
                        </div><br>

                      </div>
                      <div class="col col-12 col-md-6">
                        <div class="bg-danger" style="width: 90%; text-align:center;margin: 0 auto;border: 2px solid #bce8f1;">
                          <input type="file" id="upload_doc2" name="std_doccer_2" accept="image/png, image/jpeg, image/jpg, image/bmp, application/pdf">
                          <h2 class="text-primary" style="margin-top: 0px;">( 2 )</h2>
                          <h5 class="text-primary"><b>ใบรับรองหรือระเบียนผลการเรียน</b></h5>
                        </div>
                      </div>
                    </div>
                    <!-- <center><p style="padding-top: 5px;font-size:large;"><u>ตัวอย่าง</u></p></center> -->
                    <div class="row text-center">
                      <div class="col col-12 col-md-6" style="border-style: hidden double hidden hidden;border-color: #ffc1c1;">
                        <div style="border-style: solid solid solid solid;border-color: #a1a1a1;padding-bottom: 10px;">
                          <p style="padding-top: 5px;font-size:large;">คลิกรูปเพื่อดูตัวอย่างผลการเรียนปพ.1</p>

                          <a href="#" data-toggle="modal" data-target=".cer1">
                            <img src="stddoc/cer01.jpg" width="40%" style="border:2px solid black">
                          </a>
                          <div class="modal fade cer1" tabindex="-1" role="dialog">
                            <div class="modal-dialog">
                              <div class="modal-content text-center">
                                <img src="stddoc/cer01.jpg" style="max-width: 90vw;max-height: 90vh;">
                              </div>
                            </div>
                          </div>

                          <a href="#" data-toggle="modal" data-target=".cer2">
                            <img src="stddoc/cer02.jpg" width="40%" style="border:2px solid black">
                          </a>
                          <div class="modal fade cer2" tabindex="-1" role="dialog">
                            <div class="modal-dialog">
                              <div class="modal-content text-center">
                                <img src="stddoc/cer02.jpg" style="max-width: 90vw;max-height: 90vh;">
                              </div>
                            </div>
                          </div>
                          <br><br>
                          <div style="border-style: solid hidden hidden hidden;border-color: #a1a1a1;"></div>

                          
                          <a target="_blank" href="https://online.skr.ac.th/grade/login.php">
                            <p style="padding-top: 5px;font-size:large;">
                              สำหรับนักเรียนของ สกร.<br>สามารถดาวน์โหลดที่นี่ คลิก!!
                            </p>
                          </a>
                          <a href="#" data-toggle="modal" data-target=".cer4">
                            <img src="stddoc/cer04.jpg" width="40%" style="border:2px solid black">
                          </a>
                          <div class="modal fade cer4" tabindex="-1" role="dialog">
                            <div class="modal-dialog">
                              <div class="modal-content text-center">
                                <img src="stddoc/cer04.jpg" style="max-width: 90vw;max-height: 90vh;">
                              </div>
                            </div>
                          </div>


                        </div>


                      </div>





                      <div class="col col-12 col-md-6">
                        <div style="border-style: solid solid solid solid;border-color: #a1a1a1;padding-bottom: 10px;">
                          <p style="padding-top: 5px;font-size:large;">คลิกรูปเพื่อดูตัวอย่างใบรับรองการเป็นนักเรียน</p>

                          <a href="#" data-toggle="modal" data-target=".cer3">
                            <img src="stddoc/cer03.jpg" width="40%" style="border:2px solid black">
                          </a>
                          <div class="modal fade cer3" tabindex="-1" role="dialog">
                            <div class="modal-dialog">
                              <div class="modal-content text-center">
                                <img src="stddoc/cer03.jpg" style="max-width: 90vw;max-height: 90vh;">
                              </div>
                            </div>
                          </div>


                        </div>
                      </div>
                    </div>
                    <div class="hr dotted hr-double" style="border: 2px solid #bce8f1;"></div>


                  </div>




                  <div id="formdoc" style="display:none;">

                    <div class="row text-center">
                      <div class="col-12 bg-info" style="text-align:center;margin: 5px;border: 2px solid #bce8f1;">
                        <h4>สำเนาทะเบียนบ้าน</h4>
                      </div>

                    </div>
                    <div class="row">
                      <div class="col col-12 col-md-5">
                        <div class="text-center">
                          <h4>ตัวอย่างสำเนาทะเบียนบ้าน</h4>
                          <!-- <img src="stddoc/home-ex.jpg" width="90%" style="border:2px solid black"> -->
                          <a href="#" data-toggle="modal" data-target=".home1">
                            <img src="stddoc/home-ex.jpg" width="90%" style="border:2px solid black">
                          </a>
                          <div class="modal fade home1" tabindex="-1" role="dialog">
                            <div class="modal-dialog">
                              <div class="modal-content text-center">
                                <img src="stddoc/home-ex.jpg" style="max-width: 90vw;max-height: 90vh;">
                              </div>
                            </div>
                          </div>
                        </div><br><br>
                      </div>
                      <div class="col col-12 col-md-7">

                        <div class="row text-center">
                          <div class="bg-danger" style="width: 90%; text-align:center;margin: 0 auto;border: 2px solid #bce8f1;">
                            <input type="file" id="upload_doc3" name="std_dochome1" accept="image/png, image/jpeg, image/jpg, image/bmp, application/pdf">
                            <h4 class="text-primary"><b>สำเนาทะเบียนบ้าน นักเรียน</b></h4>
                          </div><br>
                        </div>

                        <div class="row text-center">
                          <div class="bg-danger" style="width: 90%; text-align:center;margin: 0 auto;border: 2px solid #bce8f1;">
                            <input type="file" id="upload_doc4" name="std_dochome2" accept="image/png, image/jpeg, image/jpg, image/bmp, application/pdf">
                            <h4 class="text-primary"><b>สำเนาทะเบียนบ้าน บิดา</b></h4>
                          </div><br>
                        </div>

                        <div class="row text-center">
                          <div class="bg-danger" style="width: 90%; text-align:center;margin: 0 auto;border: 2px solid #bce8f1;">
                            <input type="file" id="upload_doc5" name="std_dochome3" accept="image/png, image/jpeg, image/jpg, image/bmp, application/pdf">
                            <h4 class="text-primary"><b>สำเนาทะเบียนบ้าน มารดา</b></h4>
                          </div>
                        </div>

                        <div id="parentdoc" style="display:none;">
                          <div class="row text-center"><br>
                            <div class="bg-danger" style="width: 90%; text-align:center;margin: 0 auto;border: 2px solid #bce8f1;">
                              <input type="file" id="upload_doc6" name="std_dochome4" accept="image/png, image/jpeg, image/jpg, image/bmp, application/pdf">
                              <h4 class="text-primary"><b>สำเนาทะเบียนบ้าน ผู้ปกครอง</b></h4>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div id="formonet" style="display:none;">
                    <div class="hr dotted hr-double" style="border: 2px solid #bce8f1;"></div>

                    <div class="row text-center">
                      <div class="col-12 bg-info" style="text-align:center;margin: 5px;border: 2px solid #bce8f1;">
                        <h4>ใบแสดงผลคะแนน O-NET ปีการศึกษา&nbsp;<?php echo $thisyear - 1; ?> </h4>
                      </div>
                      <div class="col col-12 col-md-5">
                        <h5><a href="http://www.newonetresult.niets.or.th/Individualweb/notice/frEnquireStudentGraphScore.aspx" target="_blank">
                            คลิกที่นี่เพื่อดาวน์โหลดจากเว็บสทศ.</a><br>ตัวอย่างใบแสดงผลคะแนน O-NET</h5>
                        <img src="stddoc/onet-ex.jpg" width="80%" style="border:2px solid black"><br><br>
                      </div>
                      <div class="col col-12 col-md-7">
                        <div class="bg-danger" style="width:90%;text-align:center;margin: 0 auto;border: 2px solid #bce8f1;">
                          <input type="file" id="upload_doc7" name="std_doconet" accept="image/png, image/jpeg, image/jpg, image/bmp, application/pdf">
                          <h4 class="text-primary"><b>ใบแสดงผลคะแนน O-NET<br>ปีการศึกษา&nbsp;<?php echo $thisyear - 1; ?></b></h4>
                        </div>
                      </div>
                    </div>
                    <div class="hr dotted hr-double" style="border: 2px solid #bce8f1;"></div>
                  </div>


















                  <div class="row text-center">
                    <div class="col-12 bg-info" style="text-align:center;margin: 5px;border: 2px solid #bce8f1;">
                      <h4>เอกสารอื่นๆ (*ถ้ามีเพิ่มเติม)</h4>
                      <!-- <h5 class="text-danger">-<u>เอกสารอื่นๆ</u><br><br>-<u>ถ้ามี 2 หน้า ให้แนบไฟล์ทั้งหมายเลข ( 1 ) และ ( 2 )</u></h5> -->
                    </div>
                    <div class="col col-12 col-md-6">
                      <div class="bg-danger" style="width: 90%; text-align:center;margin: 0 auto;border: 2px solid #bce8f1;">
                        <input type="file" id="upload_doc8" name="std_doccer_3" accept="image/png, image/jpeg, image/jpg, image/bmp, application/pdf">
                        <!-- <h2 class="text-primary" style="margin-top: 0px;">( 1 )</h2> -->
                        <h5 class="text-primary"><b>เอกสารอื่นๆ</b></h5>
                      </div><br>

                    </div>
                    <div class="col col-12 col-md-6">
                      <div class="bg-danger" style="width: 90%; text-align:center;margin: 0 auto;border: 2px solid #bce8f1;">
                        <input type="file" id="upload_doc9" name="std_doccer_4" accept="image/png, image/jpeg, image/jpg, image/bmp, application/pdf">
                        <!-- <h2 class="text-primary" style="margin-top: 0px;">( 2 )</h2> -->
                        <h5 class="text-primary"><b>เอกสารอื่นๆ</b></h5>
                      </div>
                    </div>
                  </div>





















                  <!-- คอลัมน์ 2 -->
                </div>

              </div>
            </div>
          </div>


          <div class="row cnbox">
            <div class="col col-lg-12 cnbox bg-success text-center">

              <div style="width:80%;text-align:center;margin: 0 auto;">
                <label>
                  <input type="checkbox" class="ace input-lg" name="confirm" value="1" required #oninvalid="this.setCustomValidity('โปรดคลิกที่เครื่องหมาย เพื่อยืนยันข้อมูล')">
                  <span class="lbl bigger-150 text-primary" #style="color: #dff0d8;"> ยืนยันข้อมูล</span>
                </label>
                <br><span class="lbl bigger-130 text-danger">ข้อความและเอกสารข้างต้นเป็นจริงทุกประการ <br>หากข้อมูลเป็นเท็จทางโรงเรียนมีสิทธิ์<u><b>ตัดสิทธิ์การสมัคร</b></u>เข้าเรียนในครั้งนี้ของท่าน และ<u><b>ดำเนินคดีตามกฏหมาย</b></u>
                  <br>เพื่อให้เจ้าหน้าที่ตรวจสอบข้อมูลได้ถูกต้องรวดเร็ว <u><b>โปรดตรวจสอบข้อมูลให้ครบถ้วนชัดเจนตามความจริง</b></u></span>
              </div>


            </div <div class="row cnbox">
            <div class="col col-lg-12 cnbox bg-success text-center">

              <div style="text-align:center;margin: 0 auto;">
                <button class="btn btn-block btn-info" type="submit" style="text-align:center;margin: 0 auto;font-size: 20px;">
                  <i class="ace-icon fa fa-floppy-o bigger-160"></i>&nbsp;&nbsp;บันทึกข้อมูล&nbsp;&nbsp;</button>

              </div>


            </div>
          </div>

        </div>
      </form>

      <!-- อัพรูป -->
      <!-- modal crop -->
      <div id="uploadimageModal" class="modal" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header text-center">

              <h4 class="modal-title">โปรดเลือกส่วนของรูปถ่าย<br>
                <font color="red">**ให้พอดีกับกรอบสี่เหลี่ยมด้านใน</font>
              </h4>
              <!-- <div align="center">
                <img src="stdphoto/photoex.png">
                <br>ตัวอย่าง
              </div> -->
            </div>
            <div class="modal-body">
              <div class="row text-center">
                <!-- <div class="col col-12 col-md-6 text-center"> -->
                <div id="image_demo" #style="width:350px; margin-top:30px"></div>
                <!-- </div> -->
              </div>
              <div class="row text-center">
                <div class="col col-12 col-md-12" #style="padding-top:30px;">

                  <button class="btn btn-lg btn-success crop_image" onClick=reload();>ยืนยัน</button>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <!-- modal crop -->

    </div>
  </div>
</div>




<!-- อัพรูป -->
<!-- <script>
        $('#userpic').fileapi({
          url: 'http://rubaxa.org/FileAPI/server/ctrl.php',
          accept: 'image/*',
          imageSize: {
            minWidth: 200,
            minHeight: 200
          },
          elements: {
            active: {
              show: '.js-upload',
              hide: '.js-browse'
            },
            preview: {
              el: '.js-preview',
              width: 200,
              height: 200
            },
            progress: '.js-progress'
          },
          onSelect: function(evt, ui) {
            var file = ui.files[0];
            if (!FileAPI.support.transform) {
              alert('Your browser does not support Flash :(');
            } else if (file) {
              $('#popup').modal({
                closeOnEsc: true,
                closeOnOverlayClick: false,
                onOpen: function(overlay) {
                  $(overlay).on('click', '.js-upload', function() {
                    $.modal().close();
                    $('#userpic').fileapi('upload');
                  });
                  $('.js-img', overlay).cropper({
                    file: file,
                    bgColor: '#fff',
                    maxSize: [$(window).width() - 100, $(window).height() - 100],
                    minSize: [200, 200],
                    selection: '90%',
                    onSelect: function(coords) {
                      $('#userpic').fileapi('crop', file, coords);
                    }
                  });
                }
              }).open();
            }
          }
        });
      </script> -->
<!-- อัพรูป -->
<!-- upload image script -->
<script>
  $(document).ready(function() {

    $image_crop = $('#image_demo').croppie({
      enableExif: true,
      viewport: {
        width: 200,
        height: 230,
        type: 'square' //circle
      },
      boundary: {
        width: 250,
        height: 280
      }
    });

    $('#upload_image').on('change', function() {
      var reader = new FileReader();
      reader.onload = function(event) {
        $image_crop.croppie('bind', {
          url: event.target.result
        }).then(function() {
          console.log('jQuery bind complete');
        });
      }
      reader.readAsDataURL(this.files[0]);
      $('#uploadimageModal').modal('show');
    });

    $('.crop_image').click(function(event) {
      $image_crop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
      }).then(function(response) {
        $.ajax({
          url: "<?php echo $mclass; ?>frm.php",
          type: "POST",
          data: {
            "image": response
          },
          success: function(data) {
            $('#uploadimageModal').modal('hide');
            imgsrc = "<img id='capt' src='stdphoto/<?php echo $mclass; ?>/<?php echo $std_id; ?>.jpg'>"
            $('#uploaded_image').html(imgsrc);
            reload();
          }
        });
      })
    });
  });
</script>
<!-- upload image script -->
<img src="">
<script type="text/javascript">
  function reload() {
    img = document.getElementById("capt");
    img.src = "stdphoto/<?php echo $mclass; ?>/" + "<?php echo $std_id; ?>" + ".jpg?" + Math.random();
  }
</script>




<?php
include "includes/footer.php";
?>

<script type="text/javascript">
  function hideparent() {
    document.getElementById('parent').style.display = 'none';
    document.getElementById('parentdoc').style.display = 'none';
  }

  function showparent() {
    document.getElementById('parent').style.display = 'block';
    document.getElementById('parentdoc').style.display = 'block';
  }
</script>
<script>
  $('#upload_image , #id-input-file-1 , #id-input-file-2').ace_file_input({
    // style: 'well',
    no_file: 'คลิกเลือกรูปที่นี่ <<==',
    btn_choose: 'เลือกรูปหน้าตรง',
    btn_change: 'เปลี่ยน',
    droppable: false,
    onchange: null,
    // thumbnail: false,
    icon_remove: null, //| true | large
    whitelist: 'gif|png|jpg|jpeg',
    blacklist: 'exe|php',
    //onchange:''
    //
  });
  $('#upload_doc0,#upload_doc1,#upload_doc2,#upload_doc3,#upload_doc4,#upload_doc5,#upload_doc6,#upload_doc7,#upload_doc8,#upload_doc9').ace_file_input({
    style: 'well',
    btn_choose: 'คลิกเพื่อเลือกไฟล์',
    btn_change: null,
    no_icon: 'ace-icon fa fa-cloud-upload',
    droppable: false,
    maxSize: 3145728,
    alert: 'asdasd',
    allowExt: ["jpeg", "jpg", "png", "gif", "pdf"],
    allowMime: ["image/jpg", "image/jpeg", "image/png", "image/gif", "application/pdf"],
    thumbnail: 'large'
  });
  $('#upload_doc0,#upload_doc1,#upload_doc2,#upload_doc3,#upload_doc4,#upload_doc5,#upload_doc6,#upload_doc7,#upload_doc8,#upload_doc9').on('file.error.ace', function(ev, info) {
    if (info.error_count['ext'] || info.error_count['mime']) alert('กรุณาเลือกไฟล์รูปภาพ หรือ ไฟล์PDF เท่านั้น');
    if (info.error_count['size']) alert('ไฟล์มีขนาดใหญ่เกินไป!! กรุณาอัพโหลดไฟล์ที่มีขนาดน้อยกว่า 3MB');

    //you can reset previous selection on error
    //ev.preventDefault();
    //file_input.ace_file_input('reset_input');
  });
</script>







<!-- pop up check file -->