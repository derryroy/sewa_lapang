<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manage Admin</h1>
</div>

<!-- DataTales -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <button class="btn btn-sm btn-success text-xs float-right" data-toggle="modal" data-target="#addAdmin"><i class="fas fa-user-plus"></i> Add Admin</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="adminData" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="col-sm-1">No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Date Add</th>
                        <th class="col-sm-1">Option</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<?php include 'admin_add.php'; ?>
<?php include 'admin_edit.php'; ?>

<!-- Modal Delete Admin -->
<div class="modal fade" id="deleteAdmin" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" name="delete_admin_id" hidden>
                Apakah anda yakin ingin menghapus?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary text-xs" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger text-xs" onclick="admin_delete()">Delete</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/back/js/page/admin.js"></script>