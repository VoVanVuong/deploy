<form method="POST" action="{{ route('createCourse') }}">
    @csrf
    <div class="form-group">
        <label for="tenKhoaHoc">Tên khóa học</label>
        <input type="text" class="form-control" id="tenKhoaHoc" name="tenKhoaHoc">
    </div>
    <div class="form-group">
        <label for="moTa">Mô tả</label>
        <textarea class="form-control" id="moTa" name="moTa"></textarea>
    </div>
    <div class="form-group">
        <label for="linkVideo">Link video</label>
        <input type="text" class="form-control" id="linkVideo" name="linkVideo">
    </div>
    <div class="form-group">
        <label for="giaCa">Giá cả</label>
        <input type="number" class="form-control" id="giaCa" name="giaCa">
    </div>
    <div class="form-group">
        <label for="trangThai">Trạng thái</label>
        <select class="form-control" id="trangThai" name="trangThai">
            <option value="0">Chưa kích hoạt</option>
            <option value="1">Đã kích hoạt</option>
        </select>
    </div>
    <div class="form-group">
        <label for="idGiangVien">Giảng viên</label>
        <select class="form-control" id="idGiangVien" name="idGiangVien">

            <option value=""></option>

        </select>
    </div>
    <div class="form-group">
        <label for="idDanhMuc">Danh mục</label>
        <select class="form-control" id="idDanhMuc" name="idDanhMuc">

            <option value=""></option>

        </select>
    </div>
    <div class="form-group">
        <label for="idNguoiDung">Người dùng</label>
        <select class="form-control" id="idNguoiDung" name="idNguoiDung">

            <option value=""></option>

        </select>
    </div>
    <button type="submit" class="btn btn-primary">Tạo khóa học</button>
</form>
