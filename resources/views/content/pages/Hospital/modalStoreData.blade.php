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
                        <label for="name" class="form-label">ชื่อโรงพยาบาล</label>
                        <input type="text" id="name" class="form-control" placeholder="Enter Title Name">
                    </div>
                    <div class="col-mb-12 m-1">
                        <label for="address" class="form-label">ที่อยู่</label>
                        <textarea class="form-control" id="address" rows="3" placeholder="Enter address"></textarea>
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
