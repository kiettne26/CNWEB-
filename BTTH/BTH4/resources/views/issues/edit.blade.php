<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>EDIT ISSUE</title>
    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h1 class="h3 mb-0">Sửa Vấn Đề</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('issues.update', $issue->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="computer_id" class="form-label">Máy tính</label>
                                    <select class="form-select" id="computer_id" name="computer_id" required>
                                        <option value="">Chọn máy tính</option>
                                        @foreach($computers as $computer)
                                            <option value="{{ $computer->id }}" {{ $issue->computer_id == $computer->id ? 'selected' : '' }}>
                                                {{ $computer->computer_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="model" class="form-label">Máy tính</label>
                                    <select class="form-select" id="model" name="model" required>
                                        <option value="">Chọn Phiên bản</option>
                                        @foreach($computers as $computer)
                                            <option value="{{ $computer->model }}" {{ isset($issue->computer) && $issue->computer->model == $computer->model ? 'selected' : '' }}>
                                                {{ $computer->model }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="reported_by" class="form-label">Người báo cáo</label>
                                    <input type="text" class="form-control" id="reported_by" name="reported_by" value="{{ $issue->reported_by }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="reported_date" class="form-label">Ngày báo cáo</label>
                                    <input type="datetime-local" class="form-control" id="reported_date" name="reported_date" value="{{ date('Y-m-d\TH:i', strtotime($issue->reported_date)) }}" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="description" class="form-label">Mô tả sự cố</label>
                                    <textarea class="form-control" id="description" name="description" rows="4" required>{{ $issue->description }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="urgency" class="form-label">Mức độ</label>
                                    <select class="form-select" id="urgency" name="urgency" required>
                                        <option value="">Chọn mức độ</option>
                                        <option value="Low" {{ $issue->urgency == 'Low' ? 'selected' : '' }}>LOW</option>
                                        <option value="Medium" {{ $issue->urgency == 'Medium' ? 'selected' : '' }}>Medium</option>
                                        <option value="High" {{ $issue->urgency == 'High' ? 'selected' : '' }}>High</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="status" class="form-label">Trạng thái</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="">Chọn trạng thái</option>
                                        <option value="Open" {{ $issue->status == 'Open' ? 'selected' : '' }}>OPEN</option>
                                        <option value="In Progress" {{ $issue->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="Resolved" {{ $issue->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary w-100">Cập Nhật Vấn Đề</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
