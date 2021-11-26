<div class="container-fluid">

  <!-- start page title -->
  <div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0 font-size-18">Data Ormawa</h4>

        <div class="page-title-right">
          <a href="<?= base_url('ormawa/add') ?>" class="btn btn-primary btn-sm waves-effect waves-light">
            <i class="bx bx-plus mr-2"></i> Tambah
          </a>
        </div>

      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table id="table-list" class="table table-hover table-striped">
              <thead class="table-light">
                <tr>
                  <th width="5%">#</th>
                  <th width="10%">Logo</th>
                  <th width="20%">Nama Ormawa</th>
                  <th width="20%">Fakultas</th>
                  <th width="20%">Pengurus</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function() {
    let target = "<?= $url ?>";

    const getParam = () => {
      const query = {}
      return $.param(query)
    }

    const query = (d) => {}

    const getParamDetail = () => {
      const query = {}
      return $.param_detail(query)
    }

    const initiateDatatables = () => {
      $("#table-list").DataTable({
        autoWidth: false,
        scrollX: true,
        "processing": true,
        "serverSide": true,
        "info": true,
        "deferRender": true,
        "language": {
          "searchPlaceholder": "Tekan 'Enter' untuk pencarian.",
          "processing": 'Prosesing Data'
        },
        "ajax": {
          "url": `${target}/json`,
          "type": 'POST',
          "data": query
        },
        "columnDefs": [{
          "targets": [0, 1],
          "orderable": false,
        }],
      });
    }
    // MEMANGGIL FUNCTION
    initiateDatatables();

    $(".dataTables_filter input")
      .unbind() // Unbind previous default bindings
      .bind("keyup", function(e) { // Bind our desired behavior
        // If the length is 3 or more characters, or the user pressed ENTER, search
        if (e.keyCode == 13) {
          // Call the API search function
          $("#table-list").DataTable().search(this.value).draw();
        }
        return;
      });

    $('.dataTables_filter input[type="search"]').css({
      'width': '20em',
      'display': 'inline-block'
    });

    // LIST FUNCTION 
    function refresh() {
      $('#table-list').DataTable().ajax.reload();
    }

    $(document).on('click', '.tambah', function(e) {
      e.preventDefault();
      $.ajax({
        url: "<?php echo base_url($this->class.'/add')?>",
        type: "POST",
        success: (html) => {
          $(".load-view").html(html);
          $('#header').hide();
        },
        error: (e) => {
          alert(`${e.status} - ${e.statusText}`);
        }
      });
    });

    $(document).on('click', '.edit', function(e) {
      e.preventDefault();
      $.ajax({
        url: "<?php echo base_url($this->class.'/edit')?>",
        type: "POST",
        data: {
          id: $(this).data('id')
        },
        success: (html) => {
          $(".load-view").html(html);
          $('#header').hide();
        },
        error: (e) => {
          alert(`${e.status} - ${e.statusText}`);
        }
      });
    });

    $(document).on('click', '.delete', function(e) {
      e.preventDefault();
      if (confirm("Yakin hapus data ini ?")) {
        $.ajax({
          url: "<?php echo base_url($this->class.'/delete')?>",
          type: "POST",
          dataType: 'json',
          data: {
            id: $(this).data('id')
          },
          success: function(response) {
            alert(response.message);
            if (response.status == '200') {
              location.reload();
            } else {
              return false;
            }
          },
          error: (e) => {
            alert(`${e.status} - ${e.statusText}`);
          }
        });
      }
    });

  });
</script>