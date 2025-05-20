<?php include 'app/views/shares/header.php'; ?>
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/webbanhang/category">Danh mục</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sửa danh mục</li>
        </ol>
    </nav>

    <div class="card shadow-sm">
        <div class="card-header bg-warning text-white">
            <h1 class="h3 mb-0">Sửa danh mục</h1>
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

            <form method="POST" action="/webbanhang/Category/update" onsubmit="return validateForm();" class="needs-validation" novalidate>
                <input type="hidden" name="id" value="<?php echo $category->id; ?>">

                <div class="form-floating mb-3">
                    <input type="text" id="name" name="name" class="form-control form-control-lg"
                        value="<?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>"
                        placeholder="Nhập tên danh mục" required>
                    <label for="name">Tên danh mục</label>
                    <div class="invalid-feedback">Vui lòng nhập tên danh mục.</div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả:</label>
                    <textarea id="description" name="description" class="form-control form-control-lg"
                        rows="5" placeholder="Nhập mô tả chi tiết về danh mục" required><?php echo htmlspecialchars($category->description, ENT_QUOTES, 'UTF-8'); ?></textarea>
                    <div class="invalid-feedback">Vui lòng nhập mô tả danh mục.</div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-between mt-4">
                    <button type="submit" class="btn btn-warning btn-lg text-white">
                        <i class="fas fa-save me-2"></i> Lưu thay đổi
                    </button>
                    <a href="/webbanhang/Category/" class="btn btn-outline-secondary btn-lg">
                        <i class="fas fa-arrow-left me-2"></i> Quay lại
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    (function() {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
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

        if (!name) {
            alert('Vui lòng nhập tên danh mục');
            return false;
        }

        if (!description) {
            alert('Vui lòng nhập mô tả danh mục');
            return false;
        }

        return true;
    }
</script>

<?php include 'app/views/shares/footer.php'; ?>