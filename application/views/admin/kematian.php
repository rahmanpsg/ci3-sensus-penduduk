<?php $this->load->view('admin/header') ?>
<link href="<?= base_url('/assets/vendor/perfect-scrollbar/perfect-scrollbar.css') ?>" rel="stylesheet" media="all">
<link rel="stylesheet" href="<?= base_url('/assets/vendor/bootstrap-table/bootstrap-table.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/assets/vendor/bootstrap-validator/bootstrapValidator.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/assets/vendor/bootstrap-select/css/bootstrap-select.min.css') ?>">
<!-- PAGE CONTENT-->
<div class="page-content--bgf7" id="app">

    <!-- STATISTIC CHART-->
    <section class="statistic-chart">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title-5 m-b-35">Data Kematian</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div id="toolbar" class="table-data__tool">
                        <div class="table-data__tool-left">
                            <button class="au-btn au-btn-icon au-btn--blue2 au-btn--small" onclick="tambahData()">
                                <i class="zmdi zmdi-plus"></i>Tambah Data</button>
                            <button id="btnUbah" disabled class="au-btn au-btn-icon au-btn--green au-btn--small" onclick="editData()">
                                <i class="zmdi zmdi-edit"></i>Ubah Data</button>
                            <button id="btnHapus" disabled class="au-btn au-btn-icon au-btn--red au-btn--small" onclick="hapusData()">
                                <i class="zmdi zmdi-delete"></i>Hapus Data</button>
                        </div>

                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table id="myTable" class="table table-data3 table-borderless" data-toggle="table" data-url='<?= $TBL_URL ?>' data-toolbar="#toolbar" data-pagination="true" data-search="true" data-click-to-select="true" data-unique-id="nik">
                            <thead>
                                <tr>
                                    <th data-field="state" data-checkbox="true"></th>
                                    <th data-field="no" data-formatter="indexFormatter" class="text-center">#</th>
                                    <th data-field="nik">NIK</th>
                                    <th data-field="nama">Nama</th>
                                    <th data-field="tanggal" data-formatter="tglFormatter" data-sortable="true">Tanggal</th>
                                    <th data-field="tempat">Tempat</th>
                                    <th data-field="penyebab">Penyebab</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- END DATA TABLE -->
                    <!-- MODAL -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">Medium Modal</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="myForm" onsubmit="return false" class="form-horizontal">
                                    <div class="modal-body">
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="nik" class=" form-control-label">NIK</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <select class="selectpicker show-tick form-control" data-style="btn-outline-secondary" data-live-search="true" id="nik" name="nik" title="- Pilih NIK">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="nama" class=" form-control-label">Nama</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="nama" placeholder="Pilih NIK" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="tanggal" class=" form-control-label">Tanggal</label>
                                            </div>
                                            <div class="col-12 col-md-9 inpDate">
                                                <input type="date" name="tanggal" id="tanggal" placeholder="Masukkan tanggal kematian" class="form-control" data-bv-notempty="true" data-bv-notempty-message="Tanggal tidak boleh kosong">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="tempat" class=" form-control-label">Tempat</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <textarea name="tempat" id="tempat" placeholder="Masukkan tempat" class="form-control" data-bv-notempty="true" data-bv-notempty-message="Tempat tidak boleh kosong"></textarea>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="penyebab" class="form-control-label">Penyebab</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <textarea name="penyebab" id="penyebab" placeholder="Masukkan penyebab" class="form-control" data-bv-notempty="true" data-bv-notempty-message="Penyebab tidak boleh kosong"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" id="btnSubmit" class="btn btn-link text-white">
                                            <i class="fa fa-save"></i> Simpan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- END MODAL -->
                </div>
            </div>
        </div>
    </section>
    <!-- END STATISTIC CHART-->

    <?php $this->load->view('admin/footer') ?>
    <script src="<?= base_url('/assets/vendor/moment/moment.min.js') ?>"></script>
    <script src="<?= base_url('/assets/vendor/bootstrap-table/bootstrap-table.min.js') ?>"></script>
    <script src="<?= base_url('/assets/vendor/bootstrap-table/bootstrap-table-id-ID.js') ?>"></script>
    <script src="<?= base_url('/assets/vendor/bootstrap-validator/bootstrapValidator.min.js') ?>"></script>
    <script src="<?= base_url('/assets/vendor/bootstrap-validator/id_ID.js') ?>"></script>
    <script src="<?= base_url('/assets/vendor/sweetalert/sweetalert.min.js') ?>"></script>
    <script src="<?= base_url('/assets/vendor/jquery-serializeObject.js') ?>"></script>
    <script src="<?= base_url('/assets/vendor/bootstrap-select/js/bootstrap-select.min.js') ?>"></script>
    <script src="<?= base_url('/assets/vendor/bootstrap-select/js/defaults-id_ID.min.js') ?>"></script>

    <script>
        let $table = $('#myTable')
        let $form = $('#myForm')
        let $modal = $('#myModal')
        let $modalLabel = $('#myModalLabel');

        const getDataSelection = (field) => {
            return $table.bootstrapTable('getSelections').length > 0 ? $table.bootstrapTable('getSelections')[0][field] : undefined
        }

        $(document).ready(() => {
            $form.bootstrapValidator({
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'fa fa-exclamation-circle',
                    validating: 'fa fa-spin fa-spinner'
                },
                excluded: ':disabled',
                fields: {
                    nik: {
                        validators: {
                            notEmpty: {
                                message: 'NIK belum dipilih'
                            },
                            remote: {
                                url: '<?= base_url('api/validator') ?>',
                                delay: 1000,
                                data: function(validator) {
                                    return {
                                        validator: 'kematian',
                                        default: getDataSelection('nik'),
                                        nik: getDataSelection('nik')
                                    };
                                },
                                message: 'NIK telah terdaftar pada data kematian'
                            }
                        }
                    }
                }
            })

            $table.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function() {
                $('#btnHapus').prop('disabled', !$table.bootstrapTable('getSelections').length);
            });

            $table.on('check.bs.table uncheck.bs.table', function() {
                if ($table.bootstrapTable('getSelections').length == 1) {
                    $('#btnUbah').prop('disabled', !$table.bootstrapTable('getSelections').length);
                } else {
                    $('#btnUbah').prop('disabled', true);
                }
            });

            $.ajax('<?= base_url('api/nik') ?>', {
                data: {
                    get: 'list'
                }
            }).then(res => {
                const _createOpt = (list) => {
                    let opt = [];

                    list.map(v => {
                        opt.push(`<option value="${v.nik}" data-subtext="${v.nama}">${v.nik}</option>`)
                    })

                    return opt
                }

                $('#nik').append(_createOpt(res).join('')).selectpicker('refresh')
            })
        })

        $('#nik').on('change', () => {
            const nama = $('#nik option:selected').data('subtext')

            $('#nama').val(nama)
        })

        function tambahData() {
            $form.bootstrapValidator('resetForm', true);
            $form.trigger('reset');
            $modal.modal('toggle')
            $modalLabel.text('Form Tambah Data Kematian')

            $('.selectpicker').selectpicker('refresh')

            $table.bootstrapTable('uncheckAll')
            $('#btnUbah').prop('disabled', true);
        }

        function editData() {
            $form.bootstrapValidator('resetForm', true);
            $form.trigger('reset');
            $modal.modal('toggle')
            $modalLabel.text('Form Ubah Data Kematian')

            const data = $table.bootstrapTable('getSelections')[0];

            $.each(data, function(i, val) {
                $('#' + i).val(val);
            });

            $('.selectpicker').selectpicker('refresh')
        }

        function hapusData() {
            const list = $table.bootstrapTable('getSelections').map(v => v.nik.toString())

            swal({
                    text: `${list.length} data kematian akan dihapus?`,
                    icon: "warning",
                    buttons: {
                        cancel: {
                            text: "Batal",
                            value: null,
                            visible: true
                        },
                        confirm: {
                            text: "OK",
                            closeModal: false
                        }
                    }
                })
                .then(hapus => {
                    if (hapus === null) return

                    $.ajax('<?= base_url('api/deleteKematian') ?>', {
                        method: 'post',
                        data: {
                            list
                        }
                    }).then(res => {
                        swal(res.message, {
                            icon: res.error ? 'error' : 'success',
                            buttons: false,
                            timer: 2000,
                        });

                        if (res.error) return

                        list.forEach(nik => {
                            $table.bootstrapTable('removeByUniqueId', nik);
                        });

                        $('#btnHapus').prop('disabled', true)
                        $('#btnUbah').prop('disabled', true);
                    }).catch(err => {
                        console.log(err);
                        if (err) {
                            swal("Terjadi masalah di server", "The AJAX request failed!", "error");
                        } else {
                            swal.stopLoading();
                            swal.close();
                        }
                    })
                })
        }

        $('#btnSubmit').on('click', (e) => {
            e.preventDefault();

            $form.data('bootstrapValidator').validate();

            const hasErr = $form.find(".has-error").length;

            if (hasErr > 0) return

            const aksi = $modalLabel.text().split(' ')[1]

            const data = $form.serializeObject()

            if (aksi == 'Tambah') {
                $.ajax('<?= base_url('api/kematian') ?>', {
                    method: 'post',
                    data
                }).then(res => {
                    swal(res.message, {
                        icon: res.error ? 'error' : 'success',
                        buttons: false,
                        timer: 2000,
                    });

                    if (res.error) return

                    $modal.modal('toggle');

                    res.data['nama'] = $('#nama').val()

                    $table.bootstrapTable('append', res.data);
                })
            } else {
                data['where'] = $table.bootstrapTable('getSelections')[0].nik

                $.ajax('<?= base_url('api/updateKematian') ?>', {
                    method: 'post',
                    data
                }).then(res => {
                    swal(res.message, {
                        icon: res.error ? 'error' : 'success',
                        buttons: false,
                        timer: 2000,
                    });

                    if (res.error) return

                    $modal.modal('toggle');

                    res.data['nama'] = $('#nama').val()

                    $table.bootstrapTable('updateByUniqueId', {
                        id: data['where'],
                        row: res.data
                    });
                })
            }
        })

        function indexFormatter(val, row, index) {
            return index + 1;
        }

        function tglFormatter(val) {
            moment.locale('id')
            return moment(val).format('D MMMM YYYY')
        }
    </script>
    </body>

    </html>
    <!-- end document-->