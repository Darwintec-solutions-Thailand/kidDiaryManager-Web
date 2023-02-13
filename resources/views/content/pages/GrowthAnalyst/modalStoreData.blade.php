<div class="modal fade" id="modalStoreData" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">เพิ่มข้อมูล</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="modalType">
                <div class="row">
                    <div class="col-mb-12 m-1">
                        <label for="title_message" class="form-label">ชื่อหัวข้อ</label>
                        <input type="text" id="title_message" class="form-control" placeholder="Enter Title Name">
                    </div>
                    <div class="col-mb-12 m-1">
                        <label for="description" class="form-label">รายระเอียด</label>
                        <textarea class="form-control" id="description" rows="3" placeholder="Enter Description"></textarea>
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
