<?php include 'app/views/shares/header.php'; ?>
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/webbanhang/product">Sản phẩm</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thêm sản phẩm mới</li>
        </ol>
    </nav>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h1 class="h3 mb-0">Thêm sản phẩm mới</h1>
        </div>
        <div class="card-body">
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="/webbanhang/Product/save" onsubmit="return validateForm();" enctype="multipart/form-data" class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Nhập tên sản phẩm" required>
                            <label for="name">Tên sản phẩm</label>
                            <div class="invalid-feedback">Vui lòng nhập tên sản phẩm.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="number" id="price" name="price" class="form-control form-control-lg" step="0.01" placeholder="Nhập giá sản phẩm" required>
                            <label for="price">Giá (VNĐ)</label>
                            <div class="invalid-feedback">Vui lòng nhập giá sản phẩm hợp lệ.</div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả:</label>
                    <textarea id="description" name="description" class="form-control form-control-lg" rows="5" placeholder="Nhập mô tả chi tiết về sản phẩm" required></textarea>
                    <div class="invalid-feedback">Vui lòng nhập mô tả sản phẩm.</div>
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Danh mục:</label>
                    <select id="category_id" name="category_id" class="form-select form-select-lg" required>
                        <option value="" selected disabled>-- Chọn danh mục --</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category->id; ?>">
                                <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">Vui lòng chọn danh mục.</div>
                </div>

                <div class="mb-4">
                    <label for="product_image" class="form-label">Hình ảnh sản phẩm:</label>
                    <input type="file" id="product_image" name="product_image" class="form-control form-control-lg" accept="image/*">
                    <div class="form-text">Chọn file ảnh định dạng JPG, PNG hoặc GIF (tối đa 2MB).</div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-between mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus-circle me-2"></i> Thêm sản phẩm
                    </button>
                    <a href="/webbanhang/Product/list" class="btn btn-outline-secondary btn-lg">
                        <i class="fas fa-arrow-left me-2"></i> Quay lại danh sách sản phẩm
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()

    function validateForm() {
        const name = document.getElementById('name').value.trim();
        const description = document.getElementById('description').value.trim();
        const price = document.getElementById('price').value;
        const category = document.getElementById('category_id').value;

        if (!name) {
            alert('Vui lòng nhập tên sản phẩm');
            return false;
        }

        if (!description) {
            alert('Vui lòng nhập mô tả sản phẩm');
            return false;
        }

        if (!price || price <= 0) {
            alert('Vui lòng nhập giá sản phẩm hợp lệ');
            return false;
        }

        if (!category) {
            alert('Vui lòng chọn danh mục');
            return false;
        }

        return true;
    }
</script>

<?php include 'app/views/shares/footer.php'; ?>