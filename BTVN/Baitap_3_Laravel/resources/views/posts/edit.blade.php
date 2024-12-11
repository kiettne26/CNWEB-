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
                        Chỉnh Sửa Bài Viết
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('posts.update', $post->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="title" class="small mb-1">Tiêu Đề</label>
                            <input 
                                type="text" 
                                class="form-control py-3 @error('title') is-invalid @enderror" 
                                id="title" 
                                name="title" 
                                value="{{ old('title', $post->title) }}" 
                                placeholder="Nhập tiêu đề bài viết"
                                required
                            >
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="content" class="small mb-1">Nội Dung</label>
                            <textarea 
                                class="form-control py-3 @error('content') is-invalid @enderror" 
                                id="content" 
                                name="content" 
                                rows="8" 
                                placeholder="Nhập nội dung bài viết"
                                required
                            >{{ old('content', $post->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group text-center mt-4 mb-0">
                            <button 
                                type="submit" 
                                class="btn btn-primary btn-lg px-5 waves-effect waves-light"
                            >
                                Cập Nhật Bài Viết
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
    .waves-effect {
        position: relative;
        cursor: pointer;
        overflow: hidden;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        z-index: 1;
    }
    .waves-effect .waves-ripple {
        position: absolute;
        border-radius: 50%;
        width: 100px;
        height: 100px;
        margin-top:-50px;
        margin-left:-50px;
        opacity: 0;
        background: rgba(0,0,0,0.2);
        background: radial-gradient(rgba(0,0,0,0.2) 0, rgba(0,0,0,0.3) 40%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.5) 60%, rgba(255,255,255,0) 70%);
        -webkit-transition: all 0.5s ease-out;
        -moz-transition: all 0.5s ease-out;
        -o-transition: all 0.5s ease-out;
        transition: all 0.5s ease-out;
        -webkit-transition-property: -webkit-transform, opacity;
        -moz-transition-property: -moz-transform, opacity;
        -o-transition-property: -o-transform, opacity;
        transition-property: transform, opacity;
        -webkit-transform: scale(0) translate(0,0);
        -moz-transform: scale(0) translate(0,0);
        -ms-transform: scale(0) translate(0,0);
        -o-transform: scale(0) translate(0,0);
        transform: scale(0) translate(0,0);
        pointer-events: none;
    }
</style>

<script>
    // Ripple Effect for Buttons
    document.addEventListener('DOMContentLoaded', function() {
        var buttons = document.querySelectorAll('.waves-effect');
        buttons.forEach(function(button) {
            button.addEventListener('click', function(e) {
                var ripple = document.createElement('span');
                ripple.classList.add('waves-ripple');
                this.appendChild(ripple);
                
                var x = e.clientX - this.offsetLeft;
                var y = e.clientY - this.offsetTop;
                
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                
                setTimeout(() => {
                    ripple.remove();
                }, 1000);
            });
        });
    });
</script>