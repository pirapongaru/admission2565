<?php
include 'includes/header.php';
?>
<?php
session_start();
$mclass='m4';
$_SESSION['page'] = 'm4-2';
$_SESSION['uploadphoto'] = '1';
$_SESSION['mode'] = 'update'; //โหมดแก้ไขข้อมูล
if ($_SESSION['where'] != 'm4' && $_SESSION['where'] != 'edit') {
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
  $imageName =  'stdphoto/'.$mclass.'/' . $std_id . '.jpg';
  file_put_contents($imageName, $data);
  // echo '<img src="'.$imageName.'" class="img-thumbnail" id="capt" />';

}

?>

<?php
$sqlstd = "SELECT * FROM student$mclass WHERE std_id=:std_id";
$querystd = $dbcon->prepare($sqlstd);
$querystd->bindParam(':std_id', $std_id, PDO::PARAM_INT);
$querystd->execute();
$rowstd = $querystd->fetch(PDO::FETCH_OBJ);
// foreach ($resultsstd as $rowstd) {
?>

<div class="main-content">
  <div class="main-content-inner">
    <div class="page-content">

      <?php
      // echo "<pre>";
      // print_r($_SESSION);
      // echo "</pre>";
      ?>

      <div class="row cnbox">
        <div class="col col-lg-10 cnbox bg-success">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">หน้าหลัก</a></li>
                <li class="breadcrumb-item active" aria-current="page">แก้ไขข้อมูล</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>

      <form action="<?php echo $mclass; ?>finish.php" method="POST" enctype="multipart/form-data">
        <div class="row cnbox">
          <div class="col col-lg-10 cnbox bg-success text-center">

            <h1>สมัครเข้าศึกษาต่อชั้นมัธยมศึกษาปีที่ <?php echo substr($mclass,-1,1); ?></h1>
            <h2>เลือกประเภทที่ตรงกับข้อมูลนักเรียน</h2><br>

            <?php
            $type_class = "ชั้นมัธยมศึกษาปีที่ ".substr($mclass,-1,1);
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
if($row->type_id=='15'||$row->type_id=='46'){
// ปิด
$type_close ='display:none;'; 
// เปิด
// $type_close ='';
}else{
  $type_close ='';
}

?>

                <div class="col-12 col-sm-12 col-md-4">
                  <div class="alert alert-info" role="alert" style="<?php echo $type_close; ?>">
                    <label>
                      <input type="radio" class="ace input-lg" name="std_type" value="<?php echo $row->type_id; ?>" onclick="showform<?php echo $num; ?>()" <?php if ($rowstd->std_type == $row->type_id) {
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

        <!-- <body onload="showform1()"></body> -->


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
                  <input type="text" class="form-control w100" value="<?php echo $rowstd->std_id; ?>" name="std_id" readonly>

                  <div class="row">
                    <div class="col col-12 col-md-3">
                      <label>วันที่เกิด</label></label>
                      <select type="number" class="form-control w100" name="std_dayb" required>
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
                      <select type="text" class="form-control w100" id="std_monthb" name="std_monthb" required>
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
                      <select type="number" class="form-control w100" name="std_yearb" required>
                        <option selected><?php echo $rowstd->std_yearb; ?></option>
                        <option disabled>-----</option>
                        <?php
                        $thisyear = date("Y") + 543;
                        for ($i = $thisyear - 25; $i <= $thisyear; $i++) {
                          echo '<option>' . $i . '</option>';
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col col-12 col-md-3">
                      <label>อายุ</label>
                      <select type="text" class="form-control w100" name="std_age" required>
                        <option selected><?php echo $rowstd->std_age; ?></option>
                        <option disabled>-----</option>
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
                      <label>คำนำหน้า</label>
                      <select type="text" class="form-control w100" name="std_prefix" required>
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
                      <input type="text" class="form-control w100" name="std_fname" value="<?php echo $rowstd->std_fname; ?>" required>
                    </div>
                    <div class="col col-12 col-md-5">
                      <label>นามสกุล</label>
                      <input type="text" class="form-control w100" name="std_lname" value="<?php echo $rowstd->std_lname; ?>" required>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col col-12 col-md-4">
                      <label>ศาสนา</label>
                      <input type="text" class="form-control w100" value="<?php echo $rowstd->std_religion; ?>" name="std_religion">
                    </div>
                    <div class="col col-12 col-md-4">
                      <label>เชื้อชาติ</label>
                      <input type="text" class="form-control w100" value="<?php echo $rowstd->std_race; ?>" name="std_race">
                    </div>
                    <div class="col col-12 col-md-4">
                      <label>สัญชาติ</label>
                      <input type="text" class="form-control w100" value="<?php echo $rowstd->std_nation; ?>" name="std_nation">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col col-12 col-md-5">
                      <label>หมู่เลือด</label>
                      <select type="text" class="form-control w100" name="std_blood" required>
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
                      <input type="text" class="form-control w100" value="<?php echo $rowstd->std_phone; ?>" name="std_phone" required>
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
                  <input type="text" class="form-control w100" value="<?php echo $rowstd->std_eduschool; ?>" name="std_eduschool" required>
                  <div class="row">
                    <div class="col col-12 col-md-6">
                      <label>อำเภอ รร.เดิม</label>
                      <input type="text" class="form-control w100" value="<?php echo $rowstd->std_edudistrict; ?>" name="std_edudistrict">
                    </div>
                    <div class="col col-12 col-md-6">
                      <label>จังหวัด รร.เดิม</label>
                      <select class="form-control" required="" name="std_eduprovince" required>
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
                      <input type="text" class="form-control w100" value="<?php echo $rowstd->std_homenum; ?>" name="std_homenum" required>
                    </div>
                    <div class="col col-12 col-md-3">
                      <label>หมู่ที่</label>
                      <input type="number" class="form-control w100" value="<?php echo $rowstd->std_homevill; ?>" name="std_homevill">
                    </div>
                    <div class="col col-12 col-md-6">
                      <label>ตำบล/แขวง</label>
                      <input type="text" class="form-control w100" value="<?php echo $rowstd->std_homesubdistrict; ?>" name="std_homesubdistrict" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col col-12 col-md-6">
                      <label>อำเภอ/เขต</label>
                      <input type="text" class="form-control w100" value="<?php echo $rowstd->std_homedistrict; ?>" name="std_homedistrict" required>
                    </div>
                    <div class="col col-12 col-md-6">
                      <label>จังหวัด</label>
                      <select class="form-control" name="std_homeprovince" required aria-required="">
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
                      <input type="number" class="form-control w100" value="<?php echo $rowstd->std_homeposcode; ?>" name="std_homeposcode">
                    </div>
                  </div>


                  <div class="hr dotted hr-double"></div>

                  <p class="alert alert-info text-right" style="font-size: 25px;">ข้อมูลบิดา - มารดา</p>
                  <div class="row">
                    <div class="col col-12 col-md-6">
                      <label>ชื่อ-นามสกุล บิดา</label>
                      <input type="text" class="form-control w100" value="<?php echo $rowstd->std_father_name; ?>" name="std_father_name" required>
                    </div>
                    <div class="col col-12 col-md-6">
                      <label>อาชีพ บิดา</label>
                      <input type="text" class="form-control w100" value="<?php echo $rowstd->std_father_career; ?>" name="std_father_career">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col col-12 col-md-6">
                      <label>สถานที่ทำงาน บิดา</label>
                      <input type="text" class="form-control w100" value="<?php echo $rowstd->std_father_work; ?>" name="std_father_work">
                    </div>
                    <div class="col col-12 col-md-6">
                      <label>เบอร์โทรศัพท์ บิดา</label>
                      <input type="text" class="form-control w100" value="<?php echo $rowstd->std_father_phone; ?>" name="std_father_phone">
                    </div>
                  </div>
                  <div class="hr dotted hr-double"></div>
                  <div class="row">
                    <div class="col col-12 col-md-6">
                      <label>ชื่อ-นามสกุล มารดา</label>
                      <input type="text" class="form-control w100" value="<?php echo $rowstd->std_mother_name; ?>" name="std_mother_name" required>
                    </div>
                    <div class="col col-12 col-md-6">
                      <label>อาชีพ มารดา</label>
                      <input type="text" class="form-control w100" value="<?php echo $rowstd->std_mother_career; ?>" name="std_mother_career">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col col-12 col-md-6">
                      <label>สถานที่ทำงาน มารดา</label>
                      <input type="text" class="form-control w100" value="<?php echo $rowstd->std_mother_work; ?>" name="std_mother_work">
                    </div>
                    <div class="col col-12 col-md-6">
                      <label>เบอร์โทรศัพท์ มารดา</label>
                      <input type="text" class="form-control w100" value="<?php echo $rowstd->std_mother_phone; ?>" name="std_mother_phone">
                    </div>
                  </div>
                  <div class="hr dotted hr-double"></div>

                  <p class="alert alert-info text-right" style="font-size: 25px;">ข้อมูลผู้ปกครอง</p>

                  <div class="row">
                    <div class="radio">
                      <label class="mt-3">ผู้ปกครอง :</label><label>
                        <input type="radio" class="ace w50" name="std_parent_relation" value="บิดา" onclick="hideparent();" <?php if ($rowstd->std_parent_relation == "บิดา") {
                                                                                                                              echo "checked";
                                                                                                                            } ?>>
                        <span class="lbl bigger-100">&nbsp;บิดา</span>
                      </label>
                      <label>
                        <input type="radio" class="ace" name="std_parent_relation" value="มารดา" onclick="hideparent();" <?php if ($rowstd->std_parent_relation == "มารดา") {
                                                                                                                            echo "checked";
                                                                                                                          } ?>>
                        <span class="lbl bigger-100">&nbsp;มารดา</span>
                      </label>
                      <label>
                        <input type="radio" class="ace" name="std_parent_relation" value="0" onclick="showparent();" <?php if ($rowstd->std_parent_relation != "บิดา" && $rowstd->std_parent_relation != "มารดา") {
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
                    <input type="text" class="form-control w100" value="<?php echo $rowstd->std_parent_relation; ?>" name="std_parent_relation_orther">
                    <div class="row">
                      <div class="col col-12 col-md-6">
                        <label>ชื่อ-นามสกุล ผู้ปกครอง</label>
                        <input type="text" class="form-control w100" value="<?php echo $rowstd->std_parent_name; ?>" name="std_parent_name" #placeholder="- ชื่อ-นามสกุล ผู้ปกครอง ภาษาไทย -">
                      </div>
                      <div class="col col-12 col-md-6">
                        <label>อาชีพ ผู้ปกครอง</label>
                        <input type="text" class="form-control w100" value="<?php echo $rowstd->std_parent_career; ?>" name="std_parent_career">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-12 col-md-6">
                        <label>สถานที่ทำงาน ผู้ปกครอง</label>
                        <input type="text" class="form-control w100" value="<?php echo $rowstd->std_parent_work; ?>" name="std_parent_work" #placeholder="- ระบุสั้นๆ เช่น ชื่อบริษัท... หรือชื่อจังหวัด.. -">
                      </div>
                      <div class="col col-12 col-md-6">
                        <label>เบอร์โทรศัพท์ ผู้ปกครอง</label>
                        <input type="text" class="form-control w100" value="<?php echo $rowstd->std_parent_phone; ?>" name="std_parent_phone" #placeholder="- กรอกเพียง1หมายเลขที่สามารถติดต่อได้ -">
                      </div>
                    </div>
                  </div>
                  <div class="hr dotted hr-double"></div>


                  <div id="formtalent" style="display:none;">
                    <p class="alert alert-info text-right" style="font-size: 25px;">ความสามารถพิเศษ</p>
                    <label>ความสามารถพิเศษ (ตามเกณฑ์ที่โรงเรียนประกาศไว้)</label>
                    <!-- <a #href="https://drive.google.com/open?id=18GkPDG946ujpZ5HM2rvnlG05hUCxM15W" target="_blank">(ดูรายละเอียดได้ที่ประกาศรับสมัคร ข้อที่ 7.3)</a></label> -->

                    <!-- <input type="text" class="form-control" name="std_talent"> -->
                    <select class="form-control" #id="form-field-select-3" name="std_talent" aria-required="">
                      <option selected><?php echo $rowstd->std_talent; ?></option>
                      <option disabled>-----</option>
                      <option>ด้านดนตรีไทย</option>
                      <option>ด้านดนตรีสากล</option>
                      <option>ด้านนาฏศิลป์</option>
                      <option>ด้านศิลปะ</option>
                      <option>ด้านการขับร้อง</option>
                      <option>ด้านกีฬา</option>
                    </select>


                    <label style="padding-top: 10px;">โปรดระบุความสามารถพิเศษ 1 อย่าง ตามประเภทที่เลือกไว้ด้านบน (เช่น "ตะกร้อ")</label><i class="text-danger">*</i>
                   
                   <input type="text" id="std_talentname" class="form-control w100" value="<?php echo $rowstd->std_talentname; ?>" name="std_talentname">
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
                      <?php
                      if (file_exists($rowstd->std_doctalent)) {
                      ?>
                        <div style="text-align:right;margin-right: 5px;background-color: #cbf9fa;border-top: double #e96b6b;">
                          <i class="menu-icon fa fa-check-circle-o text-success bigger-180"></i>
                          <i class="text-success bigger-120">มีเอกสารในระบบแล้ว</i>
                          <a href="<?php echo $rowstd->std_doctalent; ?>" target="_blank" class="badge badge-primary">ดูเอกสาร&nbsp;<i class="fa fa-hand-o-left"></i></a>
                          <br><i class="text-danger bigger-110">อัพโหลดใหม่!! ถ้าต้องการแก้ไข</i>
                        </div>
                      <?php } ?>
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


                  <p class="alert alert-info text-right" style="font-size: 25px;">รูปถ่ายชุดนักเรียนหน้าตรง</p>
                  <div class="row justify-content-md-center">
                    <div style="height: 230px;width: 200px; text-align:center;margin: 0 auto;border: 2px solid #bce8f1;background-color: #fff;background-image: url('<?php echo $rowstd->std_photo . '?' . (rand(10, 100)); ?>');">
                      <div id="uploaded_image" class=""></div>
                    </div>

                  </div>

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
                        <h4>ใบรับรองการเป็นนักเรียน(ปพ.7) <br>หรือ ระเบียนผลการเรียน(ปพ.1)</h4>
                        <h5 class="text-danger">-<u>ถ้ามี 1 ไฟล์ให้อัพเฉพาะหมายเลข ( 1 ) </u><br>-<u>ถ้ามี 2 ไฟล์ให้อัพทั้งหมายเลข ( 1 ) และ ( 2 )</u></h5>
                      </div>
                      <div class="col col-12 col-md-6">
                        <div class="bg-danger" style="width: 90%; text-align:center;margin: 0 auto;border: 2px solid #bce8f1;">
                          <input type="file" id="upload_doc1" name="std_doccer" accept="image/png, image/jpeg, image/jpg, image/bmp, application/pdf">
                          <h2 class="text-primary" style="margin-top: 0px;">( 1 )</h2>
                          <h5 class="text-primary"><b>ใบรับรองหรือระเบียนผลการเรียน</b></h5>
                          <?php
                          if (file_exists($rowstd->std_doccer)) {
                          ?>
                            <div style="text-align:right;margin-right: 5px;background-color: #cbf9fa;border-top: double #e96b6b;">
                              <i class="menu-icon fa fa-check-circle-o text-success bigger-180"></i>
                              <i class="text-success bigger-120">มีเอกสารในระบบแล้ว</i>
                              <a href="<?php echo $rowstd->std_doccer. '?' . date("y-m-d-h-i-s"); ?>" target="_blank" class="badge badge-primary">ดูเอกสาร&nbsp;<i class="fa fa-hand-o-left"></i></a>
                              <br><i class="text-danger bigger-110">อัพโหลดใหม่!! ถ้าต้องการแก้ไข</i>
                            </div>
                          <?php } ?>
                        </div><br>

                      </div>
                      <div class="col col-12 col-md-6">
                        <div class="bg-danger" style="width: 90%; text-align:center;margin: 0 auto;border: 2px solid #bce8f1;">
                          <input type="file" id="upload_doc2" name="std_doccer_2" accept="image/png, image/jpeg, image/jpg, image/bmp, application/pdf">
                          <h2 class="text-primary" style="margin-top: 0px;">( 2 )</h2>
                          <h5 class="text-primary"><b>ใบรับรองหรือระเบียนผลการเรียน</b></h5>
                          <?php
                          if (file_exists($rowstd->std_doccer_2)) {
                          ?>
                            <div style="text-align:right;margin-right: 5px;background-color: #cbf9fa;border-top: double #e96b6b;">
                              <i class="menu-icon fa fa-check-circle-o text-success bigger-180"></i>
                              <i class="text-success bigger-120">มีเอกสารในระบบแล้ว</i>
                              <a href="<?php echo $rowstd->std_doccer_2. '?' . date("y-m-d-h-i-s"); ?>" target="_blank" class="badge badge-primary">ดูเอกสาร&nbsp;<i class="fa fa-hand-o-left"></i></a>
                              <br><i class="text-danger bigger-110">อัพโหลดใหม่!! ถ้าต้องการแก้ไข</i>
                            </div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>


                    <div class="row text-center">
<center>ตัวอย่างปพ.1</center>
<div class="col-lg-6">
<a href="stddoc/cer01.jpg" target="_blank"><img src="stddoc/cer01.jpg" width="90%"></a>
</div>
<div class="col-lg-6">
<a href="stddoc/cer02.jpg" target="_blank"><img src="stddoc/cer02.jpg" width="90%"></a>

</div>
</div>
<div class="row text-center">
<center>ตัวอย่างใบรับรองการเป็นนักเรียน ปพ.7</center>
<div class="col-lg-3"></div>
<div class="col-lg-6">
<a href="stddoc/cer03.jpg" target="_blank"><img src="stddoc/cer03.jpg" width="90%"></a>
</div>
<div class="col-lg-3"></div>
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
                          <a href="stddoc/home-ex.jpg" target="_blank"><img src="stddoc/home-ex.jpg" width="90%" style="border:2px solid black"></a>
                        </div><br><br>
                      </div>
                      <div class="col col-12 col-md-7">

                        <div class="row text-center">
                          <div class="bg-danger" style="width: 90%; text-align:center;margin: 0 auto;border: 10px solid #bce8f1;">
                            <input type="file" id="upload_doc3" name="std_dochome1" accept="image/png, image/jpeg, image/jpg, image/bmp, application/pdf">
                            <h4 class="text-primary"><b>สำเนาทะเบียนบ้าน นักเรียน</b></h4>
                            <?php
                            if (file_exists($rowstd->std_dochome1)) {
                            ?>
                              <div style="text-align:right;margin-right: 5px;background-color: #cbf9fa;border-top: double #e96b6b;">
                                <i class="menu-icon fa fa-check-circle-o text-success bigger-180"></i>
                                <i class="text-success bigger-120">มีเอกสารในระบบแล้ว</i>
                                <a href="<?php echo $rowstd->std_dochome1. '?' . date("y-m-d-h-i-s"); ?>" target="_blank" class="badge badge-primary">ดูเอกสาร&nbsp;<i class="fa fa-hand-o-left"></i></a>
                                <br><i class="text-danger bigger-110">อัพโหลดใหม่!! ถ้าต้องการแก้ไข</i>
                              </div>
                            <?php } ?>
                          </div><br>
                        </div>

                        <div class="row text-center">
                          <div class="bg-danger" style="width: 90%; text-align:center;margin: 0 auto;border: 2px solid #bce8f1;">
                            <input type="file" id="upload_doc4" name="std_dochome2" accept="image/png, image/jpeg, image/jpg, image/bmp, application/pdf">
                            <h4 class="text-primary"><b>สำเนาทะเบียนบ้าน บิดา</b></h4>
                            <?php
                            if (file_exists($rowstd->std_dochome2)) {
                            ?>
                              <div style="text-align:right;margin-right: 5px;background-color: #cbf9fa;border-top: double #e96b6b;">
                                <i class="menu-icon fa fa-check-circle-o text-success bigger-180"></i>
                                <i class="text-success bigger-120">มีเอกสารในระบบแล้ว</i>
                                <a href="<?php echo $rowstd->std_dochome2. '?' . date("y-m-d-h-i-s"); ?>" target="_blank" class="badge badge-primary">ดูเอกสาร&nbsp;<i class="fa fa-hand-o-left"></i></a>
                                <br><i class="text-danger bigger-110">อัพโหลดใหม่!! ถ้าต้องการแก้ไข</i>
                              </div>
                            <?php } ?>
                          </div><br>
                        </div>

                        <div class="row text-center">
                          <div class="bg-danger" style="width: 90%; text-align:center;margin: 0 auto;border: 2px solid #bce8f1;">
                            <input type="file" id="upload_doc5" name="std_dochome3" accept="image/png, image/jpeg, image/jpg, image/bmp, application/pdf">
                            <h4 class="text-primary"><b>สำเนาทะเบียนบ้าน มารดา</b></h4>
                            <?php
                            if (file_exists($rowstd->std_dochome3)) {
                            ?>
                              <div style="text-align:right;margin-right: 5px;background-color: #cbf9fa;border-top: double #e96b6b;">
                                <i class="menu-icon fa fa-check-circle-o text-success bigger-180"></i>
                                <i class="text-success bigger-120">มีเอกสารในระบบแล้ว</i>
                                <a href="<?php echo $rowstd->std_dochome3. '?' . date("y-m-d-h-i-s"); ?>" target="_blank" class="badge badge-primary">ดูเอกสาร&nbsp;<i class="fa fa-hand-o-left"></i></a>
                                <br><i class="text-danger bigger-110">อัพโหลดใหม่!! ถ้าต้องการแก้ไข</i>
                              </div>
                            <?php } ?>
                          </div>
                        </div>

                        <!-- <div id="parentdoc" style="display:none;"> -->
                        <div id="parentdoc" <?php if ($rowstd->std_parent_relation != "บิดา" && $rowstd->std_parent_relation != "มารดา") {
                                              echo 'style="display:block;"';
                                            } else {
                                              echo 'style="display:none;"';
                                            }
                                            ?>>
                          <div class="row text-center"><br>
                            <div class="bg-danger" style="width: 90%; text-align:center;margin: 0 auto;border: 2px solid #bce8f1;">
                              <input type="file" id="upload_doc6" name="std_dochome4" accept="image/png, image/jpeg, image/jpg, image/bmp, application/pdf">
                              <h4 class="text-primary"><b>สำเนาทะเบียนบ้าน ผู้ปกครอง</b></h4>
                              <?php
                              if (file_exists($rowstd->std_dochome4)) {
                              ?>
                                <div style="text-align:right;margin-right: 5px;background-color: #cbf9fa;border-top: double #e96b6b;">
                                  <i class="menu-icon fa fa-check-circle-o text-success bigger-180"></i>
                                  <i class="text-success bigger-120">มีเอกสารในระบบแล้ว</i>
                                  <a href="<?php echo $rowstd->std_dochome4. '?' . date("y-m-d-h-i-s"); ?>" target="_blank" class="badge badge-primary">ดูเอกสาร&nbsp;<i class="fa fa-hand-o-left"></i></a>
                                  <br><i class="text-danger bigger-110">อัพโหลดใหม่!! ถ้าต้องการแก้ไข</i>
                                </div>
                              <?php } ?>
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
                        <h4>ใบแสดงผลคะแนน O-NET ปีการศึกษา&nbsp;<?php echo $thisyear - 1; ?></h4>
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
                          <?php
                          if (file_exists($rowstd->std_doconet)) {
                          ?>
                            <div style="text-align:right;margin-right: 5px;background-color: #cbf9fa;border-top: double #e96b6b;">
                              <i class="menu-icon fa fa-check-circle-o text-success bigger-180"></i>
                              <i class="text-success bigger-120">มีเอกสารในระบบแล้ว</i>
                              <a href="<?php echo $rowstd->std_doconet; ?>" target="_blank" class="badge badge-primary">ดูเอกสาร&nbsp;<i class="fa fa-hand-o-left"></i></a>
                              <br><i class="text-danger bigger-110">อัพโหลดใหม่!! ถ้าต้องการแก้ไข</i>
                            </div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                    <div class="hr dotted hr-double" style="border: 2px solid #bce8f1;"></div>
                  </div>










                  <div class="row text-center">
                      <div class="col-12 bg-info" style="text-align:center;margin: 5px;border: 2px solid #bce8f1;">
                      <h4>เอกสารอื่นๆ</h4>
                        <!-- <h5 class="text-danger">-<u>ถ้ามี 1 ไฟล์ให้อัพเฉพาะหมายเลข ( 1 ) </u><br>-<u>ถ้ามี 2 ไฟล์ให้อัพทั้งหมายเลข ( 1 ) และ ( 2 )</u></h5> -->
                      </div>
                      <div class="col col-12 col-md-6">
                        <div class="bg-danger" style="width: 90%; text-align:center;margin: 0 auto;border: 2px solid #bce8f1;">
                          <input type="file" id="upload_doc8" name="std_doccer_3" accept="image/png, image/jpeg, image/jpg, image/bmp, application/pdf">
                          <h2 class="text-primary" style="margin-top: 0px;">( 1 )</h2>
                          <!-- <h5 class="text-primary"><b>ใบรับรองหรือระเบียนผลการเรียน</b></h5> -->
                          <?php
                          if (file_exists($rowstd->std_doccer_3)) {
                          ?>
                            <div style="text-align:right;margin-right: 5px;background-color: #cbf9fa;border-top: double #e96b6b;">
                              <i class="menu-icon fa fa-check-circle-o text-success bigger-180"></i>
                              <i class="text-success bigger-120">มีเอกสารในระบบแล้ว</i>
                              <a href="<?php echo $rowstd->std_doccer_3. '?' . date("y-m-d-h-i-s"); ?>" target="_blank" class="badge badge-primary">ดูเอกสาร&nbsp;<i class="fa fa-hand-o-left"></i></a>
                              <br><i class="text-danger bigger-110">อัพโหลดใหม่!! ถ้าต้องการแก้ไข</i>
                            </div>
                          <?php } ?>
                        </div><br>

                      </div>
                      <div class="col col-12 col-md-6">
                        <div class="bg-danger" style="width: 90%; text-align:center;margin: 0 auto;border: 2px solid #bce8f1;">
                          <input type="file" id="upload_doc9" name="std_doccer_4" accept="image/png, image/jpeg, image/jpg, image/bmp, application/pdf">
                          <h2 class="text-primary" style="margin-top: 0px;">( 2 )</h2>
                          <!-- <h5 class="text-primary"><b>ใบรับรองหรือระเบียนผลการเรียน</b></h5> -->
                          <?php
                          if (file_exists($rowstd->std_doccer_4)) {
                          ?>
                            <div style="text-align:right;margin-right: 5px;background-color: #cbf9fa;border-top: double #e96b6b;">
                              <i class="menu-icon fa fa-check-circle-o text-success bigger-180"></i>
                              <i class="text-success bigger-120">มีเอกสารในระบบแล้ว</i>
                              <a href="<?php echo $rowstd->std_doccer_4. '?' . date("y-m-d-h-i-s"); ?>" target="_blank" class="badge badge-primary">ดูเอกสาร&nbsp;<i class="fa fa-hand-o-left"></i></a>
                              <br><i class="text-danger bigger-110">อัพโหลดใหม่!! ถ้าต้องการแก้ไข</i>
                            </div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>












                  <!-- คอลัมน์ 2 -->
                </div>

              </div>
            </div>
          </div>


          <div class="row cnbox">
            <div class="col col-lg-10 cnbox bg-success text-center">

              <div style="width:80%;text-align:center;margin: 0 auto;">
                <label>
                  <input type="checkbox" class="ace input-lg" name="confirm" value="1" required #oninvalid="this.setCustomValidity('โปรดคลิกที่เครื่องหมาย เพื่อยืนยันข้อมูล')">
                  <span class="lbl bigger-150 text-primary" #style="color: #dff0d8;"> ยืนยันแก้ไขข้อมูล</span>
                </label>
                <br><span class="lbl bigger-130 text-danger">ข้อความและเอกสารข้างต้นเป็นจริงทุกประการ <br>หากข้อมูลเป็นเท็จทางโรงเรียนมีสิทธิ์<u>ตัดสิทธิ์การสมัคร</u>เข้าเรียนในครั้งนี้ของท่าน และ<u>ดำเนินคดีตามกฏหมาย</u>
                  <br>เพื่อให้เจ้าหน้าที่ตรวจสอบข้อมูลได้ถูกต้องรวดเร็ว <u>โปรดตรวจสอบข้อมูลให้ครบถ้วนชัดเจนตามความจริง</u></span>

              </div>


            </div <div class="row cnbox">
            <div class="col col-lg-10 cnbox bg-success text-center">

              <div style="text-align:center;margin: 0 auto;">
                <button class="btn btn-block btn-warning" type="submit" style="text-align:center;margin: 0 auto;font-size: 20px;">
                  <i class="ace-icon fa fa-pencil-square-o bigger-160"></i>&nbsp;&nbsp;ยืนยันการแก้ไขข้อมูล&nbsp;&nbsp;</button>

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
            <div class="modal-header">

              <h4 class="modal-title">โปรดเลือกส่วนของรูปถ่าย</h4>
              <div align="center">
                <img src="stdphoto/photoex.png">
                <br>ตัวอย่าง
              </div>
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
        width: 300,
        height: 300
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
          url: "<?php echo $mclass; ?>editdata.php",
          type: "POST",
          data: {
            "image": response
          },
          success: function(data) {
            $('#uploadimageModal').modal('hide');
            imgsrc = "<img id='capt' src='stdphoto/<?php echo $mclass; ?>/<?php echo $std_id; ?>.jpg'>";
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
    document.getElementById("upload_image").value = "";

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
    no_file: 'คลิกเลือกรูปที่นี่',
    btn_choose: 'เลือก',
    btn_change: 'เปลี่ยน',
    droppable: false,
    onchange: null,
    //thumbnail: false,
    icon_remove: null, //| true | large
    whitelist: 'gif|png|jpg|jpeg',
    blacklist: 'exe|php',
    //onchange:''
    //
  });
  $('#upload_doc0,#upload_doc1,#upload_doc2,#upload_doc3,#upload_doc4,#upload_doc5,#upload_doc6,#upload_doc7,#upload_doc8,#upload_doc9').ace_file_input({
    style: 'well',
    btn_choose: 'คลิกที่นี่เพื่อเลือกไฟล์',
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
<script>
  // function validateForm() {
  //   var a1 = document.forms["std_form"]["std_dochome1"].value;
  //   var a2 = document.forms["std_form"]["std_dochome2"].value;
  //   var a3 = document.forms["std_form"]["std_dochome3"].value;
  //   var a4 = document.forms["std_form"]["std_doccer"].value;
  //   var a5 = document.forms["std_form"]["std_doconet"].value;
  //   if (a1 == "" || a2 == "" || a3 == "" || a4 == "" || a5 == "") {
  //     alert("กรุณาอัพไฟล์เอกสารให้ครบ!!");
  //     return false;
  //   }
  // }
</script>
<!-- pop up check file -->
<?php

//} 
?>