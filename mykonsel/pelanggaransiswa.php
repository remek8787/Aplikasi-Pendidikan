  <div class='row'>
        <div class='col-md-12'>
        <div class='box box-solid'>
            <div class='box-header with-border '>
                <h4 class='box-title'> Pelanggaran Siswa</h4>
                <div class='box-tools pull-right '>
                    <a href="?pg=inputbk" class="btn btn-sm btn-success"><i class="fas fa-plus fa-fw"></i> Tambah</a>
                </div>
            </div>
            <div class='box-body'>
                <div class='table-responsive'>
                    <table style="font-size: 12px" id='example' class='table  table-hover'>
                        <thead>
                            <tr>
                                <th width='5%'>No</th>
                                <th width="10%">Tanggal</th>
                                <th width="10%">NIS</th>
                                <th width="20%">Nama Siswa</th>
                                <th>Keterangan</th>
                                <th width="5%">Poin</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "select * from bk_siswa WHERE tapel='$setting[tp]' ORDER BY tanggal DESC LIMIT 5");
                            $no = 0;
                            while ($bk = mysqli_fetch_array($query)) {
							$siswa=fetch($koneksi,'siswa_ptm',['nis'=>$bk['nis']]);
                                $no++;
                              
                            ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= date('d-m-Y',strtotime($bk['tanggal'])) ?>
                                <td><?= $siswa['nis'] ?></td>
                                <td><b style="color:blue"><?= $siswa['nama'] ?></b></td>
                                <td><?= $bk['ket'] ?></td>
                                <td><?= $bk['poin'] ?></td>
                                <td>
                                    <a href="?pg=inputbk&ac=edit&id=<?= $bk['id'] ?>" class="btn btn-xs btn-success" data-placement="top" data-toggle="tooltip" data-original-title="Edit"><i class="fas fa-edit"></i></a>
                                    <button data-id="<?= $bk['id'] ?>" class="hapus btn-xs btn btn-danger"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
$('#example1').on('click', '.hapus', function()
{
    var id = $(this).data('id');
    console.log(id);
    swal(
    {
        title: 'Maaf Dilarang Hapus Data',
        text: 'silahkan gunakan menu Reset',
        showConfirmButton: false,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'iya, hapus'
    }).then((result) =>
    {
        if(result.value)
        {
            $.ajax(
            {
                url: 'bk/crud_bk.php?pg=hapus_siswa',
                method: "POST",
                data: 'id=' + id,
                success: function(data)
                {
                    Swal.fire(
                    {
                        title: '<a href="#" class="sandik" style="color:red;">Data berhasil dihapus</a>',
                        showConfirmButton: false,
                        animation: false,
                        customClass: 'animated tada',
                        imageUrl: '../dist/img/sandik_kecil.gif',
                        footer: '<a href="#"><b style="color:red">Sistem Administrasi Pendidik (SANDIK)</b></a>'
                    });
                    setTimeout(function()
                    {
                        window.location.reload();
                    }, 2000);
                }
            });
        }
        return false;
    })
    
});
    </script>
        