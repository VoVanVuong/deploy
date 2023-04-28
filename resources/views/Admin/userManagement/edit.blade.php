@extends('Admin.master')
@section('content')
    <div class="layout-content">
        <!-- [ content ] Start -->
        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="sucs" style=" display: flex;  ">
                <h4 class="font-weight-bold py-3 mb-0">Chỉnh sửa</h4>
                @if (session()->has('success'))
                    <div
                        class="alert alert-dark-success alert-dismissible fade show"style=" border-radius: 6px;right: 33px; position: absolute; ">
                        <button type="button" style=" outline: none; " class="close" data-dismiss="alert">×</button>
                        {{ session()->get('success') }}
                    </div>
                @endif
            </div>
            <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}"><i
                                class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item active"> Chỉnh sửa @if ($user->phanQuyen == 3)
                            Admin {{ $user->hoTen }}
                        @elseif ($user->phanQuyen == 2)
                            nhân viên {{ $user->hoTen }}
                        @else
                            giảng viên {{ $user->hoTen }}
                        @endif
                    </li>
                </ol>
            </div>
            <div class="card mb-4">
                <h6 class="card-header">Chỉnh sửa @if ($user->phanQuyen == 3)
                        Admin ( {{ $user->hoTen }} )
                    @elseif ($user->phanQuyen == 2)
                        nhân viên ( {{ $user->hoTen }} )
                    @else
                        giảng viên ( {{ $user->hoTen }} )
                    @endif
                </h6>
                <div class="card-body">
                    <form action="{{ route('user-update', $user->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Email</label>
                                <input name="email" type="email" value="{{ old('email', $user->email) }}"
                                    class="form-control" placeholder="Email">
                                <div class="clearfix"></div>
                                @error('email')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Họ Tên</label>
                                <input name="hoTen" value="{{ old('hoTen', $user->hoTen) }}" type="text"
                                    class="form-control" placeholder="Họ tên">
                                <div class="clearfix"></div>
                                @error('hoTen')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label class="form-label">Số điện thoại</label>
                                <input name="soDienThoai" value="{{ old('soDienThoai', $user->soDienThoai) }}"
                                    type="number" class="form-control" placeholder="Số điện thoại">
                                <div class="clearfix"></div>
                                @error('soDienThoai')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label class="form-label">Ngày sinh</label>
                                <input name="ngaySinh" value="{{ old('ngaySinh', $user->ngaySinh) }}" type="text"
                                    class="form-control" placeholder="Ngày sinh">
                                <div class="clearfix"></div>
                                @error('ngaySinh')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Địa chỉ</label>
                                <input name="diaChi" value="{{ old('diaChi', $user->diaChi) }}" type="text"
                                    class="form-control" placeholder="Địa chỉ">
                                <div class="clearfix"></div>
                                @error('diaChi')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label class="form-label">Phân quyền</label>
                                <select name="phanQuyen" class="custom-select">
                                    <option value="3"{{ $user->phanQuyen == 3 ? 'selected' : '' }}>Admin</option>
                                    <option value="2"{{ $user->phanQuyen == 2 ? 'selected' : '' }}>Nhân viên</option>
                                    <option value="1"{{ $user->phanQuyen == 1 ? 'selected' : '' }}>Giảng viên</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label class="form-label">Giới tính</label>
                                <div class="fixx" style="display:flex">
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="radio" name="gioiTinh"
                                            {{ old('gioiTinh', $user->gioiTinh) == 'Nam' ? 'checked' : '' }} value="Nam"
                                            class="custom-control-input" checked>
                                        <span style=" margin-left: 16px; "class="custom-control-label">Nam</span>
                                    </label>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="radio" name="gioiTinh"
                                            {{ old('gioiTinh', $user->gioiTinh) == 'Nữ' ? 'checked' : '' }} value="Nữ"
                                            class="custom-control-input">
                                        <span style=" margin-left: 16px; "class="custom-control-label">Nữ</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="form-label">Trạng thái</label>
                                <div class="fixx" style="display:flex">
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="radio" name="trangThai"
                                            {{ old('trangThai', $user->trangThai) == '0' ? 'checked' : '' }}
                                            value="0" class="custom-control-input" checked>
                                        <span style=" margin-left: 16px; "class="custom-control-label">Bật</span>
                                    </label>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="radio" name="trangThai"
                                            {{ old('trangThai', $user->trangThai) == '1' ? 'checked' : '' }}
                                            value="1" class="custom-control-input">
                                        <span style=" margin-left: 16px; "class="custom-control-label">Tắt</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="form-label w-100">Avatar</label>
                                <input name="avatar" value="{{ old('avatar') }}" type="file">
                                <div class="img-edit">
                                    <img class="d-block ui-w-40 rounded-circle" src="{{ $user->avatar }}"
                                        alt="">
                                </div>
                                <div class="clearfix"></div>
                                @error('avatar')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- [ content ] End -->
    </div>
@endsection
