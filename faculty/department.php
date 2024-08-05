<!DOCTYPE html>

<html>

<head>
  <link rel="shortcut icon" HREF="img/dtu.png" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>DTU Exam</title>
  <?php include('./includes/css2.php') ?>
</head>

<body class="md-skin pace-done">

  <div id="wrapper">

    <?php include('sidenav.php'); ?>

    <div id="page-wrapper" class="gray-bg">
      <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">

          <?php include('topnav.php');  ?>
        </nav>
      </div>
      <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
          <h2>Fac. Dean</h2>
          <ol class="breadcrumb">
            <li>
              <a href="index.php">Home</a>
            </li>

            <li class="active">
              <strong>Department lists</strong>
            </li>
          </ol>
        </div>
        <div class="col-lg-2">

        </div>
      </div>
      <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
          <div class="col-lg-12">
            <div class="ibox float-e-margins">
              <div class="ibox-title">
                &nbsp;&nbsp;&nbsp;
                <button class="btn  btn-sm btn-primary btn-rounded btn-outline" data-toggle="modal" id='add_de' data-target="#add_department"><span class="fa fa-plus"></span>&nbsp;Department</button>
                <div class="ibox-tools">
                  <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                  </a>
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-wrench"></i>
                  </a>

                  <a class="close-link">
                    <i class="fa fa-times"></i>
                  </a>
                </div>
              </div>
              <div class="ibox-content">

                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover dataTables-example">
                    <thead>
                      <tr>
                        <th>Dept. ID</th>
                        <th>Department Name</th>
                        <th>Update</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <!-- <tbody>
                      <?php
                      $tbl_name = "tbl_department";
                      $faculty_id = $_SESSION['faculty_id'];
                      $where = "faculty_id = $faculty_id";
                      $query = $obj->select_data($tbl_name, $where);
                      $res = $obj->execute_query($conn, $query);
                      $count_rows = $obj->num_rows($res);
                      if ($count_rows > 0) {
                        while ($row = $obj->fetch_data($res)) {
                      ?>
                          <tr class="gradeX">

                            <td>
                              <?php echo $row['dept_id'] ?>
                            </td>
                            <td>
                              <?php echo $row['department_name'] ?>
                            </td>

                            <td class="center"><a class="edit-data" id='<?php echo $row['dept_id'] ?>'><i class="fa fa-pencil fa-lg text-blue"></i> </a></td>
                            <td class="center"><a id="delete_department" data-id="<?php echo $row['dept_id']; ?>"><i class="fa fa-trash fa-lg"></i> </a></td>
                          </tr>
                      <?php }
                      } else
                        echo "no data";
                      ?>

                    </tbody> -->
                    <tfoot>
                      <tr>
                        <th>Dept. ID</th>
                        <th>Department Name</th>
                        <th>Update</th>
                        <th>Delete</th>
                      </tr>
                    </tfoot>
                  </table>

                </div>

              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal inmodal fade" id="add_department" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title">Add Department</h4>
        </div>
        <div class="modal-body">
          <form method="POST" id="insert_form">
            <div class="form-group"><label>Department Name</label>
              <input class="form-control input-sm validate[required]" name="insert_dept_name" id="insert_dept_name" type="text" placeholder=" Enter Department Name">
            </div>
            <div id="add_information" class="form-group"></div>
            <input type="hidden" name="dept_id" id="dept_id" value="" />
            <input type="submit" name="insert" value="Insert Department" id="insert" class="btn  btn-outline  btn-success btn-rounded" />
          </form>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div class="middle-box text-center loginscreen animated fadeInDown" style="width:300px;">
  </div>
  <?php include("./includes/scripts2.php") ?>


  <!-- Page-Level Scripts -->
  <script>
    $(document).ready(function() {

      var dataTable = $('.dataTables-example').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
          url: "<?php echo SITEURL; ?>faculty/get_department.php",
          type: "POST",
          data: {
            action: 'fetch',
            page: 'department'
          }
        },
        "columnDefs": [{
          "targets": [0, 3],
          "orderable": false,
        }],
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [{
            extend: 'copy'
          },
          {
            extend: 'csv'
          },
          {
            extend: 'excel',
            title: 'ExampleFile'
          },
          {
            extend: 'pdf',
            title: 'ExampleFile'
          },

          {
            extend: 'print',
            customize: function(win) {
              $(win.document.body).addClass('white-bg');
              $(win.document.body).css('font-size', '10px');

              $(win.document.body).find('table')
                .addClass('compact')
                .css('font-size', 'inherit');
            }
          }
        ]

      });

      /* Init DataTables */
      var oTable = $('#editable').DataTable();

      /* Apply the jEditable handlers to the table */
      oTable.$('td').editable('http://webapplayers.com/example_ajax.php', {
        "callback": function(sValue, y) {
          var aPos = oTable.fnGetPosition(this);
          oTable.fnUpdate(sValue, aPos[0], aPos[1]);
        },
        "submitdata": function(value, settings) {
          return {
            "row_id": this.parentNode.getAttribute('id'),
            "column": oTable.fnGetPosition(this)[2]
          };
        },

        "width": "90%",
        "height": "100%"
      });
      $('#insert').on("click", function(event) {
        event.preventDefault();
        $.ajax({
          url: "<?php echo SITEURL; ?>faculty/department_add.php",
          data: $('#insert_form').serialize(),
          type: 'POST',
          cache: false,
          beforeSend: function() {
            //$("#insert").val("Inserting");
          },
          complete: function(response, status) {
            if (status != "error" && status != "timeout") {
              //$("#insert").val("Inserted");
              $('#add_information').html(response.responseText);
              $('.dataTables-example').DataTable().ajax.reload();
              // $("#add_faculty").modal('toggle');

            }
          },
          error: function(responseObj) {
            alert("Something went wrong while processing your request.\n\nError => " +
              responseObj.responseText);
          }
        });

      });

      $('#add_de').on('click', function() {
        $("#insert").val("Insert Department");
        $('#insert_form')[0].reset();

      });
      $(document).on('click', '#delete_department', function() {
        var faculty_id = $(this).data('id');
        confirmDelete(faculty_id);
        e.preventDefault();

      });
      $(document).on('click', '.edit-data', function() {
        var id = $(this).attr("id");
        $.ajax({
          url: "<?php echo SITEURL; ?>faculty/department_fetch.php",
          method: "POST",
          data: {
            dept_id: id
          },
          dataType: "json",
          success: function(data) {
            $('#insert_dept_name').val(data.department_name);
            $('#dept_id').val(data.dept_id);
            $('#insert').val("Update department");
            // alert($('#deanid').attr("value"));
            $('#add_department').modal('show');
          },
          error: function(responseObj) {
            alert("Something went wrong while processing your request.\n\nError => " +
              responseObj.responseText);
          }
        });
      });
    });

    // function fnClickAddRow() {
    //   $('#editable').dataTable().fnAddData([
    //     "Custom row",
    //     "New row",
    //     "New row",
    //     "New row",
    //     "New row"
    //   ]);

    // }
    function confirmDelete(userid) {
      swal({
          title: "Are you sure?",
          text: "You will not be able to undo this.",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "green",
          cancelButtonColor: "red",
          confirmButtonText: "Delete!",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm) {
          if (isConfirm) {
            $.ajax({
              url: '<?php echo SITEURL ?>faculty/department_delete.php',
              type: "POST",
              data: {
                id: userid
              },
              dataType: "json",
              success: function(response) {
                swal("Done!", response.message, response.status);
                $('.dataTables-example').DataTable().ajax.reload();
              }
            });
          } else {
            swal("Cancelled", "Operation cancelled! :)", "error");
          }
        })
    }
  </script>

</body>

</html>