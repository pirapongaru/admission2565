<?php
session_start();
include 'connectdb.php';
$query = "SELECT * FROM studentm1 ORDER BY std_type ASC";
$result = mysqli_query($dbcon, $query);
?>

<?php
include '../header.php';
// include '../sidebar.php';
?>
<!-- <link rel="stylesheet" href="assets/css/fonts.skr.css" />
<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" /> -->

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
            <a href="pirapong1.php" class="btn btn-primary">
                <i class="ace-icon fa fa fa-pencil-square-o bigger-100"></i>???.1
            </a>
            <a href="pirapong2.php" class="btn btn-primary">
                <i class="ace-icon fa fa fa-pencil-square-o bigger-100"></i>???.4
            </a>
            <a href="../adminm1.php" class="btn btn-warning">
                <i class="ace-icon fa fa fa-pencil-square-o bigger-100"></i>????????????
            </a>
            <h3 align="center">?????????????????????????????????????????????????????????????????????????????????????????????????????????<br>????????????????????????????????????????????????????????? 1</h3><br />
            <table id="editable_table" class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th width="10%">??????????????????????????????????????????</th>
                        <th width="5%">????????????</th>
                        <th width="15%">??????????????????</th>
                        <th width="5%">??????????????????????????????????????????</th>
                        <th width="5%">??????????????????????????????????????????</th>
                        <th width="5%">????????????????????????</th>
                        <th width="10%">????????????</th>
                        <th width="10%">?????????????????????</th>
                        <th width="10%">????????????????????????</th>
                        <th width="10%">???????????????</th>
                        <th width="25%">Comment</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        if ($row["std_type"] == '13') {
                            $std_type_text = '?????????????????????????????????????????????????????????';
                        } else if ($row["std_type"] == '14') {
                            $std_type_text = '????????????????????????????????????????????????????????????';
                        } else if ($row["std_type"] == '15') {
                            $std_type_text = '?????????????????????????????????????????????????????????????????????';
                        }
                        if ($row['std_type'] != substr($row['std_regisid'], 0, 2)&&$row['std_regisid']!='0') {
                            $checktype = 'text-danger bigger-150';
                        }else{
                            $checktype = 'text-success bigger-150';
                        }
                        echo '
                        <tr>
                        <td class="bigger-120">' . $row["std_id"] . '</td>
                        <td class="text-success bigger-150">' . $row["std_type"] . '</td>
                        <td class="bigger-120">' . $std_type_text . '</td>
                        <td class="'.$checktype.'">' . $row["std_regisid"] . '</td>
                        <td class="text-success bigger-150">' . $row["std_regisroom"] . '</td>
                        <td class="text-right bigger-120">' . $row["std_prefix"] . '</td>
                        <td class="text-left bigger-130">' . $row["std_fname"] . '</td>
                        <td class="text-left bigger-130">' . $row["std_lname"] . '</td>
                        <td>' . $row["std_phone"] . '</td>
                        <td class="bigger-130">' . $row["std_status"] . '</td>
                        <td class="text-left bigger-120">' . $row["std_comment"] . '</td>
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
            url: 'actionm1.php',
            columns: {
                identifier: [0, "std_id"],
                editable: [
                    [1, 'std_type'],
                    [3, 'std_regisid'],
                    [4, 'std_regisroom'],
                    [5, 'std_prefix'],
                    [6, 'std_fname'],
                    [7, 'std_lname'],
                    [8, 'std_phone'],
                    [9, 'std_status'],
                    [10, 'std_comment']
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
            "pageLength": 18,
            "order": [[ 3, "desc" ]],
            dom: 'Bfrtip',
            // buttons: [
            //     'copy', 'csv', 'excel', 'pdf', 'print'
            // ]
            buttons: [{
                    extend: 'excelHtml5',
                    title: '?????????????????????????????????????????????????????????????????????2563(???.1)'
                },{
                    extend: 'print',
                    title: '?????????????????????????????????????????????????????????????????????2563(???.1)'
                },'copy'
            ]
        });
    });
</script>