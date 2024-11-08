<?= $this->extend('admin/template/template'); ?>
<?= $this->Section('content'); ?>

<style>
    /* Styling untuk search tampilan B */
    .form {
        --input-bg: #FFF;
        --padding: 1.5em;
        --rotate: 80deg;
        --gap: 2em;
        --icon-change-color: #F2BF02;
        --height: 50px;
        width: 600px;
        /* Sesuaikan dengan tampilan A */
        padding-inline-end: 1em;
        background: var(--input-bg);
        position: relative;
        border-radius: 30px;
        /* Sesuaikan border-radius dari tampilan A */
        margin: 0 auto;
    }

    .form label {
        display: flex;
        align-items: center;
        width: 100%;
        height: var(--height);
    }

    .form input {
        width: 100%;
        padding-inline-start: calc(var(--padding) + var(--gap));
        outline: none;
        background: none;
        border: 0;
        font-size: 0.9rem;
    }

    .form svg {
        color: #111;
        transition: 0.3s cubic-bezier(.4, 0, .2, 1);
        position: absolute;
        height: 17px;
        /* Sesuaikan ukuran icon */
    }

    .icon {
        position: absolute;
        left: var(--padding);
        transition: 0.3s cubic-bezier(.4, 0, .2, 1);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .swap-off {
        transform: rotate(-80deg);
        opacity: 0;
        visibility: hidden;
    }

    .close-btn {
        background: none;
        border: none;
        right: calc(var(--padding) - var(--gap));
        box-sizing: border-box;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #111;
        padding: 0.1em;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        transition: 0.3s;
        opacity: 0;
        transform: scale(0);
        visibility: hidden;
    }

    .form input:focus~.icon {
        transform: rotate(var(--rotate)) scale(1.3);
    }

    .form input:focus~.icon .swap-off {
        opacity: 1;
        transform: rotate(-80deg);
        visibility: visible;
        color: var(--icon-change-color);
    }

    .form input:focus~.icon .swap-on {
        opacity: 0;
        visibility: visible;
    }

    .form input:valid~.icon {
        transform: scale(1.3) rotate(var(--rotate))
    }

    .form input:valid~.icon .swap-off {
        opacity: 1;
        visibility: visible;
        color: var(--icon-change-color);
    }

    .form input:valid~.icon .swap-on {
        opacity: 0;
        visibility: visible;
    }

    .form input:valid~.close-btn {
        opacity: 1;
        visibility: visible;
        transform: scale(1);
        transition: 0s;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .form {
            width: 250px;
            --height: 45px;
        }
    }

    .table-hover tbody tr:hover {
        background-color: #f2f2f2;
    }

    .table thead th {
        background-color: #f8f9fa;
        font-weight: bold;
        border-bottom: 2px solid #dee2e6;
        text-align: center;
        white-space: nowrap;
    }

    .table tbody td {
        padding: 12px;
        vertical-align: middle;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Tooltip for long content */
    .tooltip-text {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* Adding fixed width for certain columns */
    .col-fixed {
        width: 150px;
    }

    .text-wrap {
        white-space: normal;
        max-height: 100px;
        overflow-y: auto;
    }

    .btn-sm {
        font-size: 0.8rem;
        padding: 4px 8px;
    }

    /* Adding fixed width for certain columns */
    .col-fixed {
        width: 300px;
    }

    .text-truncate-multiline {
        display: -webkit-box;
        -webkit-line-clamp: 5;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 1.2;
        /* Sesuaikan jarak antar-baris */
    }
</style>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0" style="color: #03AADE;">List Produk</h1>
            </div>

            <!-- Tengahkan form search -->
            <div class="col d-flex justify-content-center">
                <form class="form" action="<?= base_url('admin-search-produk') ?>" method="GET">
                    <label for="search">
                        <input required="" autocomplete="off" placeholder="cari produk" name="keyword" id="keyword" type="text">
                        <div class="icon">
                            <svg stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="swap-on">
                                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-linejoin="round" stroke-linecap="round"></path>
                            </svg>
                            <svg stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="swap-off">
                                <path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-linejoin="round" stroke-linecap="round"></path>
                            </svg>
                        </div>
                        <button type="reset" class="close-btn">
                            <svg viewBox="0 0 20 20" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" fill-rule="evenodd"></path>
                            </svg>
                        </button>
                    </label>
                </form>
            </div>

            <div class="col-auto">
                <a href="<?= base_url('admin-add-produk') ?>" class="btn text-white" style="background-color: #03AADE;"> + Tambah Data Produk</a>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-auto">
                <?php if (!empty($keyword)): ?>
                    <p>Menampilkan hasil pencarian untuk: <strong><?= esc($keyword) ?></strong></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="tab-content">
            <div class="tab-pane fade show active">
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover table-bordered mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="text-center" valign="middle">No</th>
                                        <th class="text-center" valign="middle">Nama Member</th>
                                        <th class="text-center" valign="middle">Foto Produk</th>
                                        <th class="text-center" valign="middle">Nama Produk</th>
                                        <th class="text-center valign-middle col-fixed">Deskripsi Produk</th>
                                        <th class="text-center" valign="middle">HS Code</th>
                                        <th class="text-center" valign="middle">Minimum Order</th>
                                        <th class="text-center" valign="middle">Kapasitas Produksi Per Bulan</th>
                                        <th class="text-center" valign="middle">Aksi</th>
                                    </tr>
                                </thead>
                                <?php if (empty($hasilPencarian)): ?>
                                    <tbody>
                                        <tr>
                                            <td colspan="9" class="text-center">Tidak ada Produk yang ditemukan.</td>
                                        </tr>
                                    </tbody>
                            </table>
                        <?php else: ?>
                            <tbody>
                                <?php $start = ($page - 1) * $perPage + 1; ?>
                                <?php foreach ($hasilPencarian as $item) : ?>
                                    <tr>
                                        <td class="text-center" valign="middle"><?= $start++ ?></td>
                                        <td class="text-center" valign="middle"><?= $item['username_member'] ?></td>
                                        <td class="align-middle">
                                            <img src="<?= base_url('img/' . $item['foto_produk']) ?>" class="img-thumbnail">
                                        </td>
                                        <td class="text-center" valign="middle"><?= $item['nama_produk'] ?></td>
                                        <td class="text-center align-middle col-fixed">
                                            <div class="text-truncate-multiline" data-bs-toggle="tooltip" title="<?= $item['deskripsi_produk'] ?>">
                                                <?= $item['deskripsi_produk'] ?>
                                            </div>
                                        </td>
                                        <td class="text-center" valign="middle"><?= $item['hs_code'] ?></td>
                                        <td class="text-center" valign="middle"><?= $item['minimum_order_qty'] ?></td>
                                        <td class="text-center" valign="middle"><?= $item['kapasitas_produksi_bln'] ?></td>
                                        <td class="text-center align-middle">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <a href="<?= base_url('admin-delete-produk/' . $item['id_produk']) ?>" class="btn btn-sm text-white me-2" style="background-color: #F2BF02;">
                                                    Hapus
                                                </a>
                                                <a href="<?= base_url('admin-edit-produk/' . $item['id_produk']) ?>" class="btn btn-sm text-white" style="background-color: #03AADE;">
                                                    Ubah
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            </table>
                            <div class="mt-2">
                                <?= $pager->links('default', 'bootstrap_pagination') ?>
                            </div>
                        <?php endif; ?>
                        </div><!--//table-responsive-->
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div><!--//tab-pane-->
        </div><!--//tab-content-->
    </div><!--//container-xl-->
</div><!--//app-content-->


<?= $this->endSection('content') ?>