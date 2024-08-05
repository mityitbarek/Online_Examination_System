<script>
  window.addEventListener('load', function() {

    $.ajax({
      url: '<?php echo SITEURL; ?>teacher/ajax_teacher.php',
      method: "POST",
      data: {
        page: "activate_exam_request",
        action: "fetch",
      },
      success: function(data) {
        alert(data);
        // alert(jQuery.parseJSON(data).drop_down_component)
      },
    });


  });
</script>