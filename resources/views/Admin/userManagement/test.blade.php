<form method="POST" action="{{ route('updateUserProfile', 9) }}" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="soDienThoai">Số điện thoại:</label>
        <input type="text" name="soDienThoai" id="soDienThoai">
    </div>

    <div>
        <label for="hoTen">Họ tên:</label>
        <input type="text" name="hoTen" id="hoTen">
    </div>

    {{-- <div>
        <label for="gioiTinh">Giới tính:</label>
        <select name="gioiTinh" id="gioiTinh">
            <option value="Nam" {{ $user->gioiTinh == 'Nam' ? 'selected' : '' }}>Nam</option>
            <option value="Nữ" {{ $user->gioiTinh == 'Nữ' ? 'selected' : '' }}>Nữ</option>
            <option value="Khác" {{ $user->gioiTinh == 'Khác' ? 'selected' : '' }}>Khác</option>
        </select>
    </div> --}}

    <div>
        <label for="ngaySinh">Ngày sinh:</label>
        <input type="date" name="ngaySinh" id="ngaySinh">
    </div>

    <div>
        <label for="diaChi">Địa chỉ:</label>
        <input type="text" name="diaChi" id="diaChi">
    </div>

    <div>
        <label for="avatar">Ảnh đại diện:</label>
        <input type="file" name="avatar" id="avatar">
    </div>

    <button type="submit">Cập nhật</button>
</form>
