<script>
  $(function(){
    $('#navMenu').addClass('active');
    $('#sideMenu').nestable();
    $('#tampilJsonSideMenu').html(window.JSON.stringify($('#sideMenu').nestable('serialize')));
    $('#sideMenu').on('change', function() {
      $('#tampilJsonSideMenu').val(window.JSON.stringify($('#sideMenu').nestable('serialize')));      
    });
  });

  function confirmdelete(linkdelete) {
              alertify.confirm("Apakah anda yakin akan  menghapus data tersebut?", function() {
                location.href = "<?= base_url();?>/"+linkdelete;
              }, function() {
                alertify.error("Penghapusan data dibatalkan.");
              });
              $(".ajs-header").html("Konfirmasi");
              return false;
            }
</script>