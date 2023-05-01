<form method="POST" action="{{ route('updateUserProfile') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="hoTen">Họ tên</label>
        <input type="text" class="form-control" id="hoTen" name="hoTen">
    </div>
    <div class="form-group">
        <label for="ngaySinh">Ngày sinh</label>
        <input type="date" class="form-control" id="ngaySinh" name="ngaySinh">
    </div>
    <div class="form-group">
        <label for="diaChi">Địa chỉ</label>
        <input type="text" class="form-control" id="diaChi" name="diaChi">
    </div>
    <div class="form-group">
        <label for="gioiTinh">Giới tính</label>
        <select class="form-control" id="gioiTinh" name="gioiTinh">
            <option value="Nam">Nam</option>
            <option value="Nữ">Nữ</option>
        </select>
    </div>
    <div class="form-group">
        <label for="avatar">Ảnh đại diện</label>
        <input type="file" class="form-control-file" id="avatar" name="avatar">
        <small class="form-text text-muted">Kích thước ảnh tối đa là 2MB</small>
    </div>
    <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>
