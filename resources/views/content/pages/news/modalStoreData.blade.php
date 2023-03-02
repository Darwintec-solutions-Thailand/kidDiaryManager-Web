<div class="modal fade " id="modalStoreData" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">เพิ่มข้อมูล</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="modalType">
                <div class="row">
                    <div class="col-md-12 m-1">
                        <label for="news_title" class="form-label">ชื่อหัวข้อ</label>
                        <input type="text" id="news_title" class="form-control" placeholder="Enter Title Name">
                    </div>
                    <div class="col-md-12">
                        <label for="news_img" class="form-label">รูปภาพหน้าปก</label>
                        <div class="input-group">
                            <input type="file" class="form-control" id="news_img">
                            <label class="input-group-text" for="news_img">Upload</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <h5 class="card-header">รายระเอียด</h5>

                        <div id="news_detail">
                        </div>

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-primary btnSave">บันทึกข้อมูล</button>
            </div>
        </div>
    </div>
</div>
