<div class="modal-header">
    <h3 class="modal-title">Thêm nhà cung cấp</h3>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body m-3">
    <form action="" autocomplete="off" method="POST" enctype="multipart/form-data" id="createSupplier">
        @csrf
        @method('post')
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">Tên nhà cung cấp</label>
                    <input class="form-control form-control-lg" type="text" name="name" placeholder="Nhập tên nhà cung cấp"/>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">Người liên hệ</label>
                    <input class="form-control form-control-lg" type="text" name="contact_person" placeholder="Nhập tên người liên hệ"/>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input class="form-control form-control-lg" type="text" name="contact_number" placeholder="Nhập số điện thoại"/>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <button class="btn btn-dark btn-block" id="btnCreateSupplier" type="button">Thêm nhà cung cấp</button>
        </div>
    </form>
</div>
