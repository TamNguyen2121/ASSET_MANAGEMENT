<div>

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Báo cáo thông kê</h1>
        </div>
        {{-- <nav class="nav nav-pills flex-column flex-sm-row bg-white rounded mb-3">
            <a class="flex-sm-fill text-sm-center nav-link active" href="{{ route('admin.allocation.list') }}" wire:navigate>
        Tài sản chưa cấp phát
        </a>
        <a class="flex-sm-fill text-sm-center nav-link text-dark" href="{{ route('admin.allocation.issued') }}" wire:navigate>Tài
            sản đã cấp phát</a>
        <a class="flex-sm-fill text-sm-center nav-link text-dark" href="{{ route('admin.allocation.history') }}" wire:navigate>Lịch sử cấp phát</a>
        <a class="flex-sm-fill text-sm-center nav-link text-dark" href="{{ route('admin.allocation.issued') }}" wire:navigate>Tài
            sản đã cấp phát</a>
        <a class="flex-sm-fill text-sm-center nav-link text-dark" href="{{ route('admin.allocation.history') }}" wire:navigate>Lịch sử cấp phát</a>
        </nav> --}}
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border2 shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Tất cả tài sản</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countEquipment }} tài sản</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border3 shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Tài sản đang cấp phát</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countAllocation }} tài sản</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border4 shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tài sản đã hỏng
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                            {{ $countBrokenEquipment }} tài sản</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border1 shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">

                                    Tài sản đã thanh lý</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countDispensing }} tài sản</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100 mx-3">
                <div class="card-body p-4 shadow-lg">
                    <div class="d-flex mb-3" style="justify-content: space-between;">
                        <h5 class="card-title fw-semibold ">Danh sách tài sản</h5>
                        <button class="btn btn-primary" onclick="exportToExcel()"><i class="ti ti-file-export px-2" ></i>Xuất Excel</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-nowrap table-bordered mb-0 align-middle" id="tableExport">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">STT</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Tên tài sản</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Người nhận</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Trạng thái cấp phát</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Ngày cấp phát</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 1;
                                @endphp
                                @foreach ($allocations as $data)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">
                                            {{ $i }}
                                        </h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">{{ $data->getEquipmentName() }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{ $data->getUser() }}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        @if ($data->status == 1)
                                        <span class="badge text-bg-success" style="width: 150px">Đang cấp
                                            phát</span>
                                        @else
                                        <span class="badge text-bg-danger" style="width: 150px">Đã huỷ cấp
                                            phát</span>
                                        @endif
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 fs-4">
                                            {{ date('d/m/Y', strtotime($data->created_at)) }}
                                        </h6>
                                    </td>
                                </tr>
                                @php
                                $i++;
                                @endphp
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <script>
        function exportToExcel() {
            // Hiển thị hộp thoại xác nhận bằng SweetAlert2
            Swal.fire({
                title: 'Xác nhận xuất file'
                , text: 'Bạn có chắc muốn xuất file Excel từ bảng này?'
                , icon: 'question'
                , showCancelButton: true
                , confirmButtonText: 'Xuất Excel'
                , cancelButtonText: 'Hủy bỏ'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Lấy dữ liệu từ bảng HTML
                    var htmlTable = document.getElementById('tableExport');

                    // Tạo một workbook mới
                    var wb = XLSX.utils.table_to_book(htmlTable);

                    // Chuyển đổi workbook thành một binary string
                    var wbout = XLSX.write(wb, {
                        bookType: 'xlsx'
                        , type: 'binary'
                    });

                    // Tạo một blob từ binary string
                    var blob = new Blob([s2ab(wbout)], {
                        type: 'application/octet-stream'
                    });

                    // Tạo một đường dẫn URL từ blob
                    var url = window.URL.createObjectURL(blob);

                    // Tạo một thẻ <a> ẩn và kích hoạt sự kiện click để tải xuống file
                    var a = document.createElement('a');
                    a.style.display = 'none';
                    a.href = url;
                    a.download = 'table.xlsx';
                    document.body.appendChild(a);
                    a.click();

                    // Xóa thẻ <a> sau khi đã nhấp
                    document.body.removeChild(a);

                    // Xóa đường dẫn URL khi đã hoàn thành
                    setTimeout(function() {
                        window.URL.revokeObjectURL(url);
                    }, 100);
                }
            });
        }

        // Hàm để chuyển đổi string thành ArrayBuffer
        function s2ab(s) {
            var buf = new ArrayBuffer(s.length);
            var view = new Uint8Array(buf);
            for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xff;
            return buf;
        }

    </script>
    @endpush

