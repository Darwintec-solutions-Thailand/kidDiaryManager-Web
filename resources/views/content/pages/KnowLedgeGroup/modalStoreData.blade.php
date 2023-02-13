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
                        <label for="title" class="form-label">ชื่อหัวข้อ</label>
                        <input type="text" id="title" class="form-control" placeholder="Enter Title Name">
                    </div>
                    <div class="col-mb-6 m-1">
                        <label for="ageMin" class="form-label">อายุขั้นต่ำ</label>
                        <input type="number" id="ageMin" class="form-control" placeholder="Enter Age Min">
                    </div>
                    <div class="col-mb-6 m-1">
                        <label for="ageMax" class="form-label">อายุสูงสุด</label>
                        <input type="number" id="ageMax" class="form-control" placeholder="Enter Age Max">
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
