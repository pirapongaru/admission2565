<?php
session_start();
// if ($_SESSION['admindo'] != 'm1' && $_SESSION['admindo'] != 'm4') {
//     session_destroy();
//     header("Location: ../admin.php");
// }
include 'connectdb.php';
$query = "SELECT * FROM studentm4 INNER JOIN registype ON studentm4.std_type=registype.type_id ORDER BY std_type ASC";
$result = mysqli_query($dbcon, $query);
?>

<?php
include '../includes/header.php';
// include '../sidebar.php';
?>

<html>

<head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <!-- <script src="assets2/jquery.min.js"></script> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <!-- <link rel="stylesheet" href="assets2/bootstrap.min.css" /> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- <script src="assets2/bootstrap.min.js"></script> -->
    <script src="jquery.tabledit.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

    <!-- <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
    <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>









</head>

<body>
    <div class="container-fluid">
        <br />
        <br />
        <br />
        <div class="table-responsive">
            <a href="allm1.php" class="btn btn-primary">
                <i class="ace-icon fa fa fa-pencil-square-o bigger-100"></i>ม.1
            </a>
            <a href="allm4.php" class="btn btn-primary">
                <i class="ace-icon fa fa fa-pencil-square-o bigger-100"></i>ม.4
            </a>
            <a href="../adminm4.php" class="btn btn-warning">
                <i class="ace-icon fa fa fa-pencil-square-o bigger-100"></i>กลับ
            </a>
            <h3 align="center">รายชื่อนักเรียนที่สมัครเข้าศึกษาต่อ<br>ชั้นมัธยมศึกษาปีที่ 4</h3><br />
            <table id="editable_table" class="table table-bordered table-striped text-center" style="width:99%;">
                <thead>
                    <tr>
                        <th #width="10%">เลขบัตรประชาชน</th>
                        <th #width="10%">วันเกิด</th>
                        <th #width="10%">เดือนเกิด</th>
                        <th #width="10%">ปีเกิด</th>
                        <th #width="5%">รหัส</th>
                        <th #width="20%">ประเภท</th>
                        <th #width="5%">เลขประจำตัวสอบ</th>
                        <th #width="5%">หมายเลขห้องสอบ</th>
                        <th #width="5%">คำนำหน้า</th>
                        <th #width="10%">ชื่อ</th>
                        <th #width="10%">นามสกุล</th>
                        <th #width="10%">เบอร์โทร</th>
                        <th #width="5%">สถานะ</th>
                        <th #width="25%">Comment</th>
                        <th #width="5%">เบอร์บิดา</th>
                        <th #width="5%">เบอร์มารดา</th>
                        <th #width="5%">เบอร์ผปค.</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        // if ($row["std_type"] == '44') {
                        //     $std_type_text = 'นักเรียน(ส.ก.ร.)';
                        // } else if ($row["std_type"] == '45') {
                        //     $std_type_text = 'นักเรียนทั่วไป';
                        // } else if ($row["std_type"] == '46') {
                        //     $std_type_text = 'นักเรียนความสามารถพิเศษ';
                        // }
                        if ($row['std_type'] != substr($row['std_regisid'], 0, 2) && $row['std_regisid'] != '0') {
                            $checktype = 'text-danger bigger-150';
                        } else {
                            $checktype = 'text-success bigger-150';
                        }
                        echo '
                            <tr>
                            <td class="bigger-100">' . $row["std_id"] . '</td>
                            <td class="bigger-100">' . $row["std_dayb"] . '</td>
                            <td class="bigger-100">' . $row["std_monthb"] . '</td>
                            <td class="bigger-100">' . $row["std_yearb"] . '</td>
                            <td class="text-success bigger-120">' . $row["std_type"] . '</td>
                            <td class="bigger-100">' . $row["type_name"] . '</td>
                            <td class="' . $checktype . '">' . $row["std_regisid"] . '</td>
                            <td class="text-success bigger-150">' . $row["std_regisroom"] . '</td>
                            <td class="text-right bigger-100">' . $row["std_prefix"] . '</td>
                            <td class="text-left bigger-100">' . $row["std_fname"] . '</td>
                            <td class="text-left bigger-100">' . $row["std_lname"] . '</td>
                            <td>' . $row["std_phone"] . '</td>
                            <td class="bigger-130">' . $row["std_status"] . '</td>
                            <td class="text-left bigger-120">' . $row["std_comment"] . '</td>
                            <td>' . $row["std_father_phone"] . '</td>
                            <td>' . $row["std_mother_phone"] . '</td>
                            <td>' . $row["std_parent_phone"] . '</td>
                            </tr>
                            ';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

<script>
    $(document).ready(function() {
        $('#editable_table').Tabledit({
            url: 'actionm4.php',
            columns: {
                identifier: [0, "std_id"],
                editable: [
                    [1, 'std_dayb'],
                    [2, 'std_monthb'],
                    [3, 'std_yearb'],
                    [4, 'std_type'],
                    [6, 'std_regisid'],
                    [7, 'std_regisroom'],
                    [8, 'std_prefix'],
                    [9, 'std_fname'],
                    [10, 'std_lname'],
                    [11, 'std_phone'],
                    [12, 'std_status'],
                    [13, 'std_comment']
                ]
            },
            restoreButton: false,
            onSuccess: function(data, textStatus, jqXHR) {
                if (data.action == 'delete') {
                    $('#' + data.std_id).remove();
                }
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#editable_table').DataTable({
            "pageLength": 10,
            "order": [
                [6, "desc"]
            ],
            dom: 'Bfrtip',
            // buttons: [
            //     'copy', 'csv', 'excel', 'pdf', 'print'
            // ]
            buttons: [{
                extend: 'excelHtml5',
                title: 'รายชื่อรับสมัครนักเรียน ม.4'
            }, {
                extend: 'print',
                title: 'รายชื่อรับสมัครนักเรียน ม.4'
            }, 'copy']
        });
    });
</script>

<?php
// $std_id_del = $data . std_id;
// include '../includes/config.php';
// $sql = "SELECT * FROM studentm4 WHERE std_id=:std_id";
// $query = $dbcon->prepare($sql);
// $query->bindParam(':std_id', $std_id_del, PDO::PARAM_INT);
// $query->execute();
// $row = $query->fetch(PDO::FETCH_OBJ);
// if (file_exists($row->std_photo)) {
//     unlink($row->std_photo);
// }
// if (file_exists($row->std_doctalent)) {
//     unlink($row->std_doctalent);
// }
// if (file_exists($row->std_doccer)) {
//     unlink($row->std_doccer);
// }
// if (file_exists($row->std_doccer_2)) {
//     unlink($row->std_doccer_2);
// }
// if (file_exists($row->std_dochome1)) {
//     unlink($row->std_dochome1);
// }
// if (file_exists($row->std_dochome2)) {
//     unlink($row->std_dochome2);
// }
// if (file_exists($row->std_dochome3)) {
//     unlink($row->std_dochome3);
// }
// if (file_exists($row->std_dochome4)) {
//     unlink($row->std_dochome4);
// }
// if (file_exists($row->std_doconet)) {
//     unlink($row->std_doconet);
// }
// if (file_exists($row->std_doconet)) {
//     unlink($row->std_doconet);
// }
?>