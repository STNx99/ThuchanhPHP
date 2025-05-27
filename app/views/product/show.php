<?php include 'app/views/shares/header.php'; ?>
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <a href="/webbanhang/Product" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-6">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Quay lại danh sách
        </a>
        
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="md:flex">
                <div class="md:w-1/2">
                    <?php if (isset($product->image) && $product->image): ?>
                        <img src="/webbanhang/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" 
                             alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>" 
                             class="w-full h-96 object-cover">
                    <?php else: ?>
                        <div class="w-full h-96 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500">Không có hình ảnh</span>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="md:w-1/2 p-8">
                    <h1 class="text-3xl font-bold text-gray-800 mb-4">
                        <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                    </h1>
                    
                    <div class="mb-6">
                        <span class="text-3xl font-bold text-green-600">
                            <?php echo number_format($product->price, 0, ',', '.'); ?> VND
                        </span>
                    </div>
                    
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Mô tả sản phẩm:</h3>
                        <p class="text-gray-600 leading-relaxed">
                            <?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?>
                        </p>
                    </div>
                    
                    <div class="mb-6">
                        <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                            <?php echo htmlspecialchars($product->category_name ?? 'Chưa phân loại', ENT_QUOTES, 'UTF-8'); ?>
                        </span>
                    </div>                                                                                                                                                                           
                    <div class="flex gap-4">
                        <a href="/webbanhang/Product/edit/<?php echo $product->id; ?>" 
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg font-medium transition duration-200">
                            Chỉnh sửa
                        </a>
                        <a href="/webbanhang/Product/addToCart/<?php echo $product->id; ?>"
                           class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg font-medium transition duration-200">
                            Thêm vào giỏ hàng
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="justify-items">
    <?php include 'app/views/shares/footer.php'; ?>
</div>