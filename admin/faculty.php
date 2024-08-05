<!DOCTYPE html>

<html>

<head>
  <link rel="shortcut icon" HREF="img/dtu.png" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>DTU Examination</title>
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
          <h2>Admin</h2>
          <ol class="breadcrumb">
            <li>
              <a href="index.php">Home</a>
            </li>

            <li class="active">
              <strong>Faculty lists</strong>
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
                <button class="btn  btn-sm btn-primary btn-rounded btn-outline" data-toggle="modal" id='add_fa' data-target="#add_faculty"><span class="fa fa-plus"></span>&nbsp;Faculty</button>
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
                  <table id="data-faculty" class="table table-striped table-bordered table-hover dataTables-example">
                    <thead>
                      <tr>
                        <th>Faculty ID</th>
                        <th>Faculty Name</th>
                        <th>Descrition</th>
                        <th>Location</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>

                  </table>

                </div>

              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal inmodal fade" id="add_faculty" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title">Add Faculty</h4>
        </div>
        <div class="modal-body">
          <form method="POST" id="insert_form" novalidate="novalidate">
            <div class="form-group"><label>Faculty Name</label>
              <input class="form-control input-sm  " name="insert_faculty_name" id="insert_name" type="text" placeholder=" Enter Faculty Name" required>
            </div>

            <div class="form-group"><label>Description</label>
              <input class="input-sm validate[required]  form-control" name="insert_faculty_description" id="insert_descritpion" type="text" placeholder=" Enter Faculty Description" required>
            </div>

            <div class="form-group"><label>Location</label>
              <input class="input-sm form-control" name="insert_faculty_location" id="insert_location" type="text" placeholder="Enter Faculty Location" required>
            </div>
            <div id="add_information" class="form-group"></div>
            <input type="hidden" name="faculty_id" id="faculty_id" value="" />
            <input type="submit" name="insert" value="Insert Faculty" id="insert" class="btn  btn-outline btn-lg btn-success btn-rounded" />
          </form>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div class="middle-box text-center loginscreen animated fadeInDown" style="width:300px;">
  </div>
  <?php include("./includes/scripts2.php") ?>


  <!-- Page-Level Scripts -->
  <script>
    $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-sm';
    $(document).ready(function() {
      var dataTable = $('#data-faculty').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
          url: "<?php echo SITEURL; ?>admin/get_faculty.php",
          type: "POST",
          data: {
            action: 'fetch',
            page: 'faculty'
          }
        },
        "columnDefs": [{
          "targets": [0, 5],
          "orderable": false,
        }],
        "dom": '<"html5buttons"B>lTfgitp',
        "buttons": [{
            "extend": 'copy'
          },
          {
            extend: 'csv'
          },
          {
            extend: 'excel',
            title: 'faculties'
          },
          {
            extend: 'pdf',
            title: 'faculties'
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
        ],
      });

      dataTable.$('td').editable('http://webapplayers.com/example_ajax.php', {
        "callback": function(sValue, y) {
          var aPos = dataTable.fnGetPosition(this);
          dataTable.fnUpdate(sValue, aPos[0], aPos[1]);
        },
        "submitdata": function(value, settings) {
          return {
            "row_id": this.parentNode.getAttribute('id'),
            "column": dataTable.fnGetPosition(this)[2]
          };
        },

        "width": "90%",
        "height": "100%"
      });
      $('#insert').on("click", function(event) {
        event.preventDefault();

        $.ajax({
          url: "<?php echo SITEURL; ?>admin/faculty_add.php",
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
              $("#add_faculty").modal('toggle');
              $('#data-faculty').DataTable().ajax.reload();
              // $('#add_faculty').modal('hide');
            }
          },
          error: function(responseObj) {
            alert("Something went wrong while processing your request.\n\nError => " +
              responseObj.responseText);
          }
        });

      });

      $('#add_fa').on('click', function() {
        $("#insert").val("Insert Faculty");
        $('#insert_form')[0].reset();

      });
      $(document).on('click', '#delete_faculty', function() {
        var faculty_id = $(this).data('id');
        confirmDelete(faculty_id);
        e.preventDefault();

      });
      $(document).on('click', '.edit-data', function() {
        var id = $(this).attr("id");
        $.ajax({
          url: "<?php echo SITEURL; ?>admin/faculty_fetch.php",
          method: "POST",
          data: {
            dean_id: id
          },
          dataType: "json",
          success: function(data) {
            $('#insert_name').val(data.faculty_name);
            $('#insert_descritpion').val(data.Description);
            $('#insert_location').val(data.Location);
            $('#faculty_id').val(data.id);
            $('#insert').val("Update Faculty");
            // alert($('#deanid').attr("value"));
            $('#add_faculty').modal('show');
          },
          error: function(responseObj) {
            alert("Something went wrong while processing your request.\n\nError => " +
              responseObj.responseText);
          }
        });
      });

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
                url: '<?php echo SITEURL ?>admin/faculty_delete.php',
                type: "POST",
                data: {
                  id: userid
                },
                dataType: "json",
                success: function() {
                  swal("Done!", "Operation successful!", "success");
                  $('#data-faculty').DataTable().ajax.reload();
                }
              });
            } else {
              swal("Cancelled", "Operation cancelled! :)", "error");
            }
          })
      }

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
  </script>

</body>

</html>