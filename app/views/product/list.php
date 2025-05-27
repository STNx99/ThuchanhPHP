<?php include 'app/views/shares/header.php'; ?>
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Danh sách sản phẩm</h1>
    <a href="/webbanhang/Product/add" class="inline-block bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200 mb-6">Thêm sản phẩm mới</a>
    
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        <?php foreach ($products as $product): ?>
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-200">
                <?php if (isset($product->image) && $product->image): ?>
                    <img src="/webbanhang/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" 
                         alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>" 
                         class="w-full h-48 object-cover">
                <?php else: ?>
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">Không có hình ảnh</span>
                    </div>
                <?php endif; ?>
                
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">
                        <a href="/webbanhang/Product/show/<?php echo $product->id; ?>" class="hover:text-blue-600 transition duration-200">
                            <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                    </h2>
                    
                    <p class="text-gray-600 mb-3"><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></p>
                    
                    <div class="mb-4">
                        <p class="text-lg font-bold text-green-600 mb-1">
                            Giá: <?php echo number_format($product->price, 0, ',', '.'); ?> VND
                        </p>
                        <p class="text-sm text-gray-500">
                            Danh mục: <?php echo htmlspecialchars($product->category_name ?? 'Chưa phân loại', ENT_QUOTES, 'UTF-8'); ?>
                        </p>
                    </div>
                    
                    <div class="flex gap-2">
                        <a href="/webbanhang/Product/show/<?php echo $product->id; ?>" 
                           class="flex-1 bg-blue-500 hover:bg-blue-600 text-white text-center py-2 px-3 rounded-md transition duration-200 text-sm font-medium">
                            Xem chi tiết
                        </a>
                        <a href="/webbanhang/Product/edit/<?php echo $product->id; ?>" 
                           class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white text-center py-2 px-3 rounded-md transition duration-200 text-sm font-medium">
                            Sửa
                        </a>
                        <a href="/webbanhang/Product/delete/<?php echo $product->id; ?>"
                           class="flex-1 bg-red-500 hover:bg-red-600 text-white text-center py-2 px-3 rounded-md transition duration-200 text-sm font-medium" 
                           onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                            Xóa
                        </a>
                        <a href="/webbanhang/Product/addToCart/<?php echo $product->id; ?>" 
                           class="flex-1 bg-gray-100 hover:bg-gray-500 text-black text-center py-2 px-3 rounded-md transition duration-200 text-sm font-medium">
                            Thêm vào giỏ hàng
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="justify-between">
    <?php include 'app/views/shares/footer.php'; ?>
</div>