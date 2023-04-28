@extends('Admin.master')
@section('content')
    <div class="layout-content">
        <!-- [ content ] Start -->
        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="sucs" style=" display: flex;  ">
                <h4 class="font-weight-bold py-3 mb-0">Quản lí giảng viên</h4>
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
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin-dashboard') }}">
                            <i class="feather icon-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Quản lí giảng viên</li>
                </ol>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <div class="card-header with-elements pb-0">
                            <h6 class="card-header-title mb-0">Thông tin giảng viên</h6>
                            <div class="card-header-elements ml-auto p-0">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#sale-stats">Thông tin</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#latest-sales">Thông tin liên lạc</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="nav-tabs-top">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="sale-stats">
                                    <div id="tab-table-1" class="ps ps--active-y">
                                        <table class="table table-hover card-table">
                                            <thead>
                                                <tr>
                                                    <th>Hình ảnh / Họ tên</th>
                                                    <th>Quyền</th>
                                                    <th>Trạng thái</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td>
                                                            <div class="media mb-0">
                                                                <img src="{{ $user->avatar }}"
                                                                    class="d-block ui-w-40 rounded-circle" alt="">
                                                                <div class="media-body align-self-center ml-3">
                                                                    <h6 class="mb-0">{{ $user->hoTen }}</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td style=" display: table-cell; vertical-align: middle; ">
                                                            @if ($user->phanQuyen >= 3)
                                                                <span
                                                                    style=" font-size: 10px; background-color: #e9170b !important; "
                                                                    class="badge badge-pill badge-success">Admin
                                                                </span>
                                                            @elseif ($user->phanQuyen == 1)
                                                                <span
                                                                    style=" font-size: 10px; background-color: #0081f5 !important; "
                                                                    class="badge badge-pill badge-success">Giảng viên
                                                                </span>
                                                            @endif
                                                        </td>
                                                        <td style=" display: table-cell; vertical-align: middle; ">
                                                            @if ($user->isUserOnline())
                                                                <span
                                                                    style=" font-size: 10px; background-color: #02b91c !important; "
                                                                    class="badge badge-pill badge-success">online</span>
                                                                </span>
                                                            @else
                                                                <span
                                                                    style=" font-size: 10px; background-color: #beb4b3 !important; "
                                                                    class="badge badge-pill badge-success">offline</span>
                                                                </span>
                                                            @endif
                                                        </td>
                                                        <td style=" display: table-cell; vertical-align: middle; ">
                                                            <a href="#">
                                                                <button type="button"
                                                                    class="btn icon-btn btn-sm btn-outline-secondary">
                                                                    <span class="feather icon-edit-1"></span>
                                                                </button>
                                                            </a> / <a
                                                                href="{{ route('user-delete', ['id' => $user->id]) }}">
                                                                <button type="button"
                                                                    class="btn icon-btn btn-sm btn-outline-danger">
                                                                    <span class="feather icon-trash-2"></span>
                                                                </button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @if ($users->count() >= 5)
                                        <div class="paginate-nhanVien"
                                            style=" display: flex; justify-content: center;margin-top: 20px ">
                                            {{ $users->links() }}
                                        </div>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="latest-sales">
                                    <div id="tab-table-2" class="ps">
                                        <table class="table table-hover card-table">
                                            <thead>
                                                <tr>
                                                    <th>Email</th>
                                                    <th>Số điện thoại</th>
                                                    <th>Giới tính</th>
                                                    <th>Ngày sinh</th>
                                                    <th>Địa chỉ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td class="align-middle">
                                                            <a href="javascript:" class="text-dark">{{ $user->email }}</a>
                                                        </td>
                                                        <td class="align-middle">{{ $user->soDienThoai }}</td>
                                                        <td class="align-middle">{{ $user->gioiTinh }}</td>
                                                        <td class="align-middle">
                                                            {{ date('d-m-Y', strtotime($user->ngaySinh)) }}</td>
                                                        <td class="align-middle">{{ $user->diaChi }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @if ($users->count() >= 5)
                                        <div class="paginate-nhanVien"
                                            style=" display: flex; justify-content: center;margin-top: 20px ">
                                            {{ $users->links() }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ content ] End -->
    </div>
@endsection
