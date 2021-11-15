<div class="container-fluid">

  <!-- start page title -->
  <div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0 font-size-18">Tambah Ormawa</h4>

        <div class="page-title-right">
          <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Ormawa</a></li>
            <li class="breadcrumb-item active">Tambah</li>
          </ol>
        </div>

      </div>
    </div>
  </div>
  <!-- end page title -->

 
 <!-- Buat Kodenya di sini -->
 <div class="row">
 	<div class="col-md-12">
 		<div class="card">
 			<div class="card-header">
 				<h3 class="card-title">Tambah Ormawa</h3>
 			</div>

 			<div class="card-body">
 				<!-- Form DI sisi -->
 				<form action="" id="form">
 					<select name="" id="">
 						<option value="null">Ormawa Universitas</option>

 						<?php foreach ($collection as $value): ?>
 							<option value=""></option>
 						<?php endforeach ?>
 					</select>
 				</form>
 			</div>
 		</div>
 	</div>
 </div>
 <!-- ./End Kode -->


</div>


<script>
  $(document).ready(function() {
    $('#form').submit(function(e) {
      e.preventDefault();
      $.LoadingOverlay("show");
      var me = $(this);
      $.ajax({
        url: '<?= base_url("Ormawa/proses_tambah_ormawa") ?>',
        type: 'post',
        data: me.serialize(),
        dataType: 'json',
        success: function(response) {
          $.LoadingOverlay("hide");
          if (response.error != '' || response.error != null) {
            $('.alert-login').removeClass('d-none').text(response.error)
          } else {
            $('.alert-login').addClass('d-none').text('')
          }
          if (response.success == true) {
            $('.invalid-feedback').remove();
            $('.form-control').removeClass('is-invalid')
              .removeClass('is-valid')
              .addClass('is-valid')

            swal.fire('Berhasil', 'Proses login berhasil!', 'success').then(function() {
              window.location = response.redirect;
            })
          } else {
            $.each(response.message, function(key, value) {
              var element = $('#' + key);
              element.parent()
                .find('.invalid-feedback').remove();
              element.removeClass('is-invalid')
                .removeClass('is-valid')
                .addClass(value.length > 0 ? 'is-invalid' : 'is-valid');
              element.parent().append(value);
            })
          }
        }
      })
    })
  });
</script>