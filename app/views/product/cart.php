<?php include 'app/views/shares/header.php'; ?>

<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex items-center mb-8">
        <i class="fas fa-shopping-cart text-blue-600 text-4xl mr-4"></i>
        <div>
            <h1 class="text-4xl font-bold">Giỏ hàng của bạn</h1>
            <p class="text-gray-600">Kiểm tra và quản lý sản phẩm trong giỏ hàng</p>
        </div>
    </div>

    <?php if (!empty($cart)): ?>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="bg-white p-6 border-b border-gray-200">
                        <h5 class="text-xl font-bold">Sản phẩm trong giỏ hàng</h5>
                    </div>
                    <div>
                        <?php 
                        $total = 0;
                        foreach ($cart as $id => $item): 
                            $itemTotal = $item['price'] * $item['quantity'];
                            $total += $itemTotal;
                        ?>
                            <div class="border-b border-gray-200 p-6" data-product-id="<?php echo $id; ?>">
                                <div class="flex flex-col md:flex-row items-start md:items-center gap-4">
                                    <div class="flex-shrink-0">
                                        <?php if ($item['image']): ?>
                                            <img src="/webbanhang/<?php echo $item['image']; ?>" 
                                                 class="w-20 h-20 object-cover rounded-lg shadow-sm" 
                                                 alt="<?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?>">
                                        <?php else: ?>
                                            <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-image text-gray-400"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex-grow">
                                        <h6 class="font-bold text-lg mb-1"><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></h6>
                                        <small class="text-gray-500">ID: #<?php echo $id; ?></small>
                                    </div>
                                    <div class="text-center">
                                        <span class="font-bold text-lg"><?php echo number_format($item['price'], 0, ',', '.'); ?> VNĐ</span>
                                    </div>
                                    <div class="text-center">
                                        <div class="flex items-center justify-center space-x-2">
                                            <button class="quantity-btn minus bg-red-500 hover:bg-red-600 text-white w-8 h-8 rounded-full flex items-center justify-center" 
                                                    data-product-id="<?php echo $id; ?>" data-action="decrease">
                                                <i class="fas fa-minus text-xs"></i>
                                            </button>
                                            <input 
                                                   class="quantity-input bg-blue-100 text-blue-800 px-2 py-2 rounded-lg text-sm font-medium text-center w-20 border-0 focus:ring-2 focus:ring-blue-500" 
                                                   value="<?php echo htmlspecialchars($item['quantity'], ENT_QUOTES, 'UTF-8'); ?>"
                                                   data-product-id="<?php echo $id; ?>"
                                                   min="1"
                                                   max="999">
                                            <button class="quantity-btn plus bg-green-500 hover:bg-green-600 text-white w-8 h-8 rounded-full flex items-center justify-center" 
                                                    data-product-id="<?php echo $id; ?>" data-action="increase">
                                                <i class="fas fa-plus text-xs"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <strong class="item-total text-green-600 text-xl"><?php echo number_format($itemTotal, 0, ',', '.'); ?> VNĐ</strong>
                                    </div>
                                    <div class="text-center">
                                        <button class="remove-item bg-red-500 hover:bg-red-600 text-white w-8 h-8 rounded-full flex items-center justify-center" 
                                                data-product-id="<?php echo $id; ?>" title="Xóa sản phẩm">
                                            <i class="fas fa-trash text-xs"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Cart Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden sticky top-4">
                    <div class="bg-blue-600 text-white p-6">
                        <h5 class="text-xl font-bold">Tóm tắt đơn hàng</h5>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex justify-between">
                                <span>Số lượng sản phẩm:</span>
                                <span class="total-items"><?php 
                                    $totalQuantity = 0;
                                    foreach ($cart as $item) {
                                        $totalQuantity += $item['quantity'];
                                    }
                                    echo $totalQuantity;
                                ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span>Tổng tiền hàng:</span>
                                <strong class="total-amount"><?php echo number_format($total, 0, ',', '.'); ?> VNĐ</strong>
                            </div>
                            <div class="flex justify-between">
                                <span>Phí vận chuyển:</span>
                                <strong class="text-green-600">Miễn phí</strong>
                            </div>
                            <hr class="border-gray-300">
                            <div class="flex justify-between text-xl">
                                <span class="font-semibold">Tổng cộng:</span>
                                <strong class="final-total text-blue-600"><?php echo number_format($total, 0, ',', '.'); ?> VNĐ</strong>
                            </div>
                        </div>
                        
                        <div class="mt-6 space-y-3">
                            <a href="/webbanhang/Product/checkout" class="w-full inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-200">
                                <i class="fas fa-credit-card mr-2"></i>Thanh toán ngay
                            </a>
                            <a href="/webbanhang/Delivery/status" class="w-full inline-flex items-center justify-center px-6 py-3 bg-orange-500 text-white font-semibold rounded-lg hover:bg-orange-600 transition duration-200">
                                <i class="fas fa-truck mr-2"></i>Theo dõi đơn hàng
                            </a>
                            <a href="/webbanhang/Product" class="w-full inline-flex items-center justify-center px-6 py-3 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition duration-200">
                                <i class="fas fa-arrow-left mr-2"></i>Tiếp tục mua sắm
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <!-- Empty Cart -->
        <div class="text-center py-16">
            <div class="mb-8">
                <i class="fas fa-shopping-cart text-gray-400 text-8xl"></i>
            </div>
            <h3 class="text-2xl font-semibold text-gray-600 mb-4">Giỏ hàng của bạn đang trống</h3>
            <p class="text-gray-500 mb-8">Hãy khám phá các sản phẩm tuyệt vời của chúng tôi và thêm vào giỏ hàng!</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center max-w-md mx-auto">
                <a href="/webbanhang/Product" class="inline-flex items-center px-8 py-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-200">
                    <i class="fas fa-shopping-bag mr-2"></i>Bắt đầu mua sắm
                </a>
                <a href="/webbanhang/Delivery/status" class="inline-flex items-center px-8 py-4 bg-orange-500 text-white font-semibold rounded-lg hover:bg-orange-600 transition duration-200">
                    <i class="fas fa-truck mr-2"></i>Theo dõi đơn hàng
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle quantity changes
    document.querySelectorAll('.quantity-btn').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.productId;
            const action = this.dataset.action;
            
            updateQuantity(productId, action);
        });
    });

    // Handle direct quantity input changes
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function() {
            const productId = this.dataset.productId;
            const newQuantity = parseInt(this.value);
            
            if (newQuantity < 1) {
                this.value = 1;
                return;
            }
            
            updateQuantityDirect(productId, newQuantity);
        });
        
        // Prevent invalid input
        input.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    });

    // Handle item removal
    document.querySelectorAll('.remove-item').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.productId;
            removeItem(productId);
        });
    });

    function updateQuantity(productId, action) {
        // Get current quantity before making request
        const productRow = document.querySelector(`[data-product-id="${productId}"]`);
        const currentQuantity = parseInt(productRow.querySelector('.quantity-input').value);
        
        // Prevent decrease if quantity is already 1
        if (action === 'decrease' && currentQuantity <= 1) {
            // Show visual feedback
            const decreaseBtn = productRow.querySelector('.quantity-btn.minus');
            decreaseBtn.classList.add('opacity-50', 'cursor-not-allowed');
            setTimeout(() => {
                decreaseBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }, 1000);
            
            // Show message
            const message = document.createElement('div');
            message.className = 'text-red-500 text-xs mt-1';
            message.textContent = 'Số lượng tối thiểu là 1';
            productRow.appendChild(message);
            setTimeout(() => {
                message.remove();
            }, 2000);
            return;
        }
        
        fetch('/webbanhang/Product/updateCartQuantity', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                product_id: productId,
                action: action
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateCartDisplay(data.cart);
            } else {
                alert(data.message || 'Có lỗi xảy ra');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra khi cập nhật giỏ hàng');
        });
    }

    function updateQuantityDirect(productId, quantity) {
        fetch('/webbanhang/Product/updateCartQuantityDirect', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: quantity
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateCartDisplay(data.cart);
            } else {
                alert(data.message || 'Có lỗi xảy ra');
                // Reset input to original value
                location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra khi cập nhật giỏ hàng');
            location.reload();
        });
    }

    function removeItem(productId) {
        if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')) {
            fetch('/webbanhang/Product/removeFromCart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    product_id: productId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message || 'Có lỗi xảy ra');
                }
            });
        }
    }

    function updateCartDisplay(cart) {
        let total = 0;
        let itemCount = 0;
        let totalQuantity = 0;

        Object.keys(cart).forEach(productId => {
            const item = cart[productId];
            const itemTotal = item.price * item.quantity;
            total += itemTotal;
            itemCount++;
            totalQuantity += item.quantity;

            // Update quantity display
            const productRow = document.querySelector(`[data-product-id="${productId}"]`);
            if (productRow) {
                const quantityInput = productRow.querySelector('.quantity-input');
                const decreaseBtn = productRow.querySelector('.quantity-btn.minus');
                
                quantityInput.value = item.quantity;
                productRow.querySelector('.item-total').textContent = new Intl.NumberFormat('vi-VN').format(itemTotal) + ' VNĐ';
                
                // Update decrease button state
                if (item.quantity <= 1) {
                    decreaseBtn.classList.add('opacity-50', 'cursor-not-allowed');
                    decreaseBtn.disabled = true;
                } else {
                    decreaseBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                    decreaseBtn.disabled = false;
                }
            }
        });

        // Update totals - use totalQuantity instead of itemCount for total items
        document.querySelector('.total-items').textContent = totalQuantity;
        document.querySelector('.total-amount').textContent = new Intl.NumberFormat('vi-VN').format(total) + ' VNĐ';
        document.querySelector('.final-total').textContent = new Intl.NumberFormat('vi-VN').format(total) + ' VNĐ';
    }

    // Initialize button states on page load
    document.querySelectorAll('[data-product-id]').forEach(productRow => {
        const quantityInput = productRow.querySelector('.quantity-input');
        const decreaseBtn = productRow.querySelector('.quantity-btn.minus');
        
        if (parseInt(quantityInput.value) <= 1) {
            decreaseBtn.classList.add('opacity-50', 'cursor-not-allowed');
            decreaseBtn.disabled = true;
        }
    });
});
</script>

<div class="justify-between">
    <?php include 'app/views/shares/footer.php'; ?>
</div>