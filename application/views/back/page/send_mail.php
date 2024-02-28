<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Send Mail</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3"></div>
    <div class="card-body">
        <div class="col-sm-12">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Date</label>
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="input-group date" id="date_mail" data-target-input="nearest">
                        <input type="text" name="date_mail" class="form-control form-control-sm datetimepicker-input text-xs" data-target="#date_mail" />
                        <div class="input-group-append" data-target="#date_mail" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar text-xs"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-lg-2">
                    <button class="btn btn-sm btn-info text-xs" onclick="get_data()"><i class="fas fa-filter"></i> Filter</button>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Email To</label>
                <div class="col-sm-10">
                    <input type="text" name="sendmail_email" data-role="tagsinput">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Subject</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control text-xs" name="sendmail_subject">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Message</label>
                <div class="col-sm-10">
                    <textarea class="form-control textarea" name="sendmail_message" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="text-right">
                <button class="btn btn-sm btn-primary" onclick="sending_mail()"><i class="fas fa-paper-plane"></i> Send</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/back/js/page/send_mail.js"></script>