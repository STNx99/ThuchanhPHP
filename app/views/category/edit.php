<?php include 'app/views/shares/header.php'; ?>
<div class="max-w-4xl mx-auto px-4 py-6">
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="/webbanhang/category" class="text-blue-600 hover:text-blue-800">Danh mục</a>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    <span class="text-gray-500">Sửa danh mục</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="bg-yellow-500 text-white px-6 py-4 rounded-t-lg">
            <h1 class="text-2xl font-semibold">Sửa danh mục</h1>
        </div>
        <div class="p-6">
            <?php if (!empty($errors)): ?>
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                    <ul class="list-disc list-inside">
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="/webbanhang/Category/update" onsubmit="return validateForm();" class="space-y-6">
                <input type="hidden" name="id" value="<?php echo $category->id; ?>">

                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">Tên danh mục</label>
                    <input type="text" id="name" name="name" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition duration-200"
                        value="<?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>"
                        placeholder="Nhập tên danh mục" required>
                    <div class="text-red-500 text-sm hidden" id="name-error">Vui lòng nhập tên danh mục.</div>
                </div>

                <div class="space-y-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">Mô tả</label>
                    <textarea id="description" name="description" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition duration-200"
                        rows="5" placeholder="Nhập mô tả chi tiết về danh mục" required><?php echo htmlspecialchars($category->description, ENT_QUOTES, 'UTF-8'); ?></textarea>
                    <div class="text-red-500 text-sm hidden" id="description-error">Vui lòng nhập mô tả danh mục.</div>
                </div>

                <div class="flex flex-col md:flex-row justify-between gap-4 pt-4">
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg flex items-center justify-center space-x-2 transition duration-200">
                        <i class="fas fa-save"></i>
                        <span>Lưu thay đổi</span>
                    </button>
                    <a href="/webbanhang/Category/" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-lg flex items-center justify-center space-x-2 transition duration-200">
                        <i class="fas fa-arrow-left"></i>
                        <span>Quay lại</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        const name = document.getElementById('name').value.trim();
        const description = document.getElementById('description').value.trim();
        let isValid = true;

        // Reset error states
        document.getElementById('name').classList.remove('border-red-500');
        document.getElementById('description').classList.remove('border-red-500');
        document.getElementById('name-error').classList.add('hidden');
        document.getElementById('description-error').classList.add('hidden');

        if (!name) {
            document.getElementById('name').classList.add('border-red-500');
            document.getElementById('name-error').classList.remove('hidden');
            isValid = false;
        }

        if (!description) {
            document.getElementById('description').classList.add('border-red-500');
            document.getElementById('description-error').classList.remove('hidden');
            isValid = false;
        }

        return isValid;
    }
</script>

<?php include 'app/views/shares/footer.php'; ?>