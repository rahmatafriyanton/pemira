<div class="modal-body">
  <div class="row gx-5 m-3">
    <?php foreach ($peserta as $key => $value): ?>
      <div class="col-md-6 text-center">
        <?php if ($value['is_a'] == 'ketua'): ?>
          <h5 for="">Ketua</h5>
        <?php else: ?>
          <h5 for="">Wakil Ketua</h5>
        <?php endif ?>

        <?php if ($value['photo'] == null || $value['photo'] == ''): ?>
          <img src="https://www.clipartmax.com/png/middle/92-925246_window-cleaning-placeholder-icon-png.png" class="img_placeholder img-fluid img-thumbnail" style="max-height:150px!important;min-height:150px!important;" alt="">
          <input class="form-control photo" type="hidden" value="" name="photo[]" onkeyup="change_image(this)">
        <?php else: ?>
          <img src="<?= base_url().$value['photo'] ?>" class="img_placeholder img-fluid img-thumbnail" style="max-height:150px!important;min-height:150px!important" alt="">
          <input class="form-control photo" type="hidden" value="<?= to_base64(base_url($value['photo'])) ?>" name="photo[]" onkeyup="change_image(this)">
        <?php endif ?>
        <input type="hidden" name="is_a[]" value="<?= $value['is_a'] ?>">
        <input type="hidden" name="nim[]" value="<?= $value['nim'] ?>">

        <div class="my-3 text-center">
          <input type="file" class="photo_input" id="photo_input_<?= $key ?>" accept="image/png, image/gif, image/jpeg" onchange="set_base64(this)" hidden />
          <label for="photo_input_<?= $key ?>" class="btn btn-success btn-sm shadow-0 my-3">Pilih Foto</label>
          <?php if ($value['photo'] == null || $value['photo'] == ''): ?>
            <button type="button" class="btn btn-danger btn-sm d-none btn_hapus" onclick="hapus_gambar(this)">Hapus</button>
          <?php else: ?>
            <button type="button" class="btn btn-danger btn-sm btn_hapus" onclick="hapus_gambar(this)">Hapus</button>
          <?php endif ?>
        </div>
      </div>
    <?php endforeach ?>

    <input type="hidden" name="pemilihan_id" value="<?= $peserta[0]['pemilihan_id'] ?>">
    <input type="hidden" name="peserta_id" value="<?= $peserta[0]['peserta_id'] ?>">
    <div class="col-md-12">
      <div class="form-group mb-3">
        <label for="">Visi</label>
        <textarea name="visi" id="visi" class="form-control summernote"><?= ($visi_misi != null) ? $visi_misi[0]['visi'] : ''; ?></textarea>
      </div>
      <div class="form-group mb-3">
        <label for="">Misi</label>
        <textarea name="misi" id="misi" class="form-control summernote"><?= ($visi_misi != null) ? $visi_misi[0]['misi'] : ''; ?></textarea>
      </div>
    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Batal</button>
  <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
</div>



<script>
  $(document).ready(function() {
    $('.summernote').summernote({
      height: '200px'
    })
  });
  function getBase64(file) {
    return new Promise((resolve, reject) => {
      const reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = () => resolve(reader.result);
      reader.onerror = error => reject(error);
    });
  }

  function set_base64(file) {
    getBase64(file.files[0]).then(
      function(data) {
        parent = $(file).parent()
        console.log("DATAAA", $(file).parent())
        parent.parent().find('.img_placeholder').attr('src', data)
        parent.parent().find('.form-control').val(data)
        parent.find('.btn_hapus').removeClass('d-none')
        // $('.img_placeholder').attr('src', data)
      }
    );
  }

  function change_image(file) {
    parent = $(file).parent()
    parent.find('.img_placeholder').attr('src', $(file).val())
    parent.find('.btn_hapus').removeClass('d-none')
  }

  function hapus_gambar(file) {
    parent = $(file).parent()
    parent.parent().find('.img_placeholder').attr('src', 'https://www.clipartmax.com/png/middle/92-925246_window-cleaning-placeholder-icon-png.png')
    parent.find('.btn_hapus').addClass('d-none')
    parent.parent().find('.form-control').val('')
  }
</script>