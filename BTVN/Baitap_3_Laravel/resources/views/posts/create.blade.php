<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<div class="container-fluid bg-light py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white">
                    <h3 class="text-center font-weight-light my-2">
                        Thêm Bài Viết Mới
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('posts.store') }}" method="post">
                        @csrf
                        
                        <div class="form-group">
                            <label for="title" class="small mb-1">Tiêu Đề Bài Viết</label>
                            <div class="input-group">
                                <input 
                                    type="text" 
                                    class="form-control py-3 @error('title') is-invalid @enderror" 
                                    id="title" 
                                    name="title" 
                                    placeholder="Nhập tiêu đề bài viết" 
                                    required
                                    maxlength="255"
                                >
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="form-text text-muted">Tiêu đề ngắn gọn và súc tích (tối đa 255 ký tự)</small>
                        </div>

                        <div class="form-group mt-4">
                            <label for="content" class="small mb-1">Nội Dung Bài Viết</label>
                            <textarea 
                                class="form-control py-3 @error('content') is-invalid @enderror" 
                                id="content" 
                                name="content" 
                                rows="8" 
                                placeholder="Nhập nội dung chi tiết bài viết" 
                                required
                            ></textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group text-center mt-4 mb-0">
                            <button 
                                type="submit" 
                                class="btn btn-primary btn-lg px-5 waves-effect waves-light">
                                Tạo Bài Viết
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <div class="small">
                        <a href="{{ route('posts.index') }}" class="text-muted">
                            Quay lại danh sách
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #f4f4f4;
    }
    .card {
        transition: transform 0.3s ease-in-out;
    }
    .card:hover {
        transform: scale(1.02);
    }
    .input-group-text {
        transition: all 0.3s ease;
    }
    .input-group-prepend:hover .input-group-text {
        background-color: #0056b3 !important;
    }
</style>

<script>
    // Optional: Character count for title
    document.getElementById('title').addEventListener('input', function() {
        var remainingChars = 255 - this.value.length;
        if (remainingChars < 0) {
            this.value = this.value.substr(0, 255);
        }
    });
</script>