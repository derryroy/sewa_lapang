<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>

<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">
    <?php if ($this->session->userdata('admin_role') != 4) { ?>
        <!-- <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle lonceng" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <span class="badge badge-danger badge-counter"></span>
            </a>
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Alerts Center
                </h6>
                <div class="notif"></div>
            </div>
        </li> -->
    <?php } ?>

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $this->session->userdata('admin_name') ?></span>
            <img class="img-profile rounded-circle" src="<?php echo base_url(); ?>assets/back/img/undraw_profile.svg">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="<?php echo base_url(); ?>back/admin/profile">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Profile
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo base_url(); ?>back/admin/logout">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
            </a>
        </div>
    </li>
</ul>

<script>
    // $(document).ready(function() {
    //     notif();
    // });

    // function notif() {
    //     $.ajax({
    //         url: base_url + 'back/orders/order_notif',
    //         type: 'POST',
    //         data: {
    //             csrf_name: csrf_hash
    //         },
    //         dataType: 'JSON',
    //         success: function(data) {
    //             notif = '';
    //             i = 0;

    //             $.each(data.data, function(key, val) {
    //                 i++;
    //                 if (i <= 3) {
    //                     notif += '<a class="dropdown-item d-flex align-items-center small" href="' + base_url + 'back/orders/notif?id=' + val.id_order + '">' +
    //                         '<div class="mr-3"><div class="btn btn-info btn-circle btn-sm"><i class="fas fa-info-circle"></i></div></div>' +
    //                         '<div>' +
    //                         '<div class="text-gray-500">' + val.date + '</div>' +
    //                         val.id_order + ' | ' + val.clubname +
    //                         '</div>' +
    //                         '</a>';
    //                 }
    //             });

    //             count = data.data.length;

    //             if (count == 0) {
    //                 $('.lonceng').addClass('disabled');
    //             } else {
    //                 $('.lonceng').removeClass('disabled');
    //             }

    //             if (count > 3) {
    //                 count = '3+';
    //                 notif += '<a class="dropdown-item text-center small text-gray-500" href="' + base_url + 'back/orders/notif">Show All Alerts</a>';
    //             } else if (count <= 3) {
    //                 count = count;
    //             }

    //             $('.badge').text(count);
    //             $('.notif').html(notif);
    //         }
    //     });
    // }
</script>