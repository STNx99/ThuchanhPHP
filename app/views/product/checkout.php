<?php include 'app/views/shares/header.php'; ?>

<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="text-center mb-12">
        <i class="fas fa-credit-card text-blue-600 text-6xl mb-4"></i>
        <h1 class="text-4xl font-bold mb-2">Thanh toán đơn hàng</h1>
        <p class="text-gray-600">Vui lòng điền thông tin để hoàn tất đơn hàng</p>
    </div>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="bg-blue-600 text-white p-6">
                <h5 class="text-xl font-bold flex items-center">
                    <i class="fas fa-user-edit mr-2"></i>Thông tin giao hàng
                </h5>
            </div>
            <div class="p-8">
                <form method="POST" action="/webbanhang/Product/processCheckout" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-user mr-2"></i>Họ và tên
                            </label>
                            <input type="text" id="name" name="name" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" 
                                   placeholder="Nhập họ tên đầy đủ" required>
                        </div>
                        
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-phone mr-2"></i>Số điện thoại
                            </label>
                            <input type="tel" id="phone" name="phone" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" 
                                   placeholder="Nhập số điện thoại" required pattern="[0-9]{10,11}">
                        </div>
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-map-marker-alt mr-2"></i>Địa chỉ giao hàng
                        </label>
                        <textarea id="address" name="address" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" 
                                  rows="4" placeholder="Nhập địa chỉ chi tiết (số nhà, đường, phường/xã, quận/huyện, tỉnh/thành phố)" 
                                  required></textarea>
                    </div>

                    <!-- Payment Method -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            <i class="fas fa-credit-card mr-2"></i>Phương thức thanh toán
                        </label>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center">
                                <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500" 
                                       type="radio" name="payment_method" id="cod" value="cod" checked>
                                <label class="ml-3 text-sm font-medium text-gray-900" for="cod">
                                    <i class="fas fa-money-bill-wave text-green-600 mr-2"></i>
                                    Thanh toán khi nhận hàng (COD)
                                </label>
                            </div>
                            <p class="ml-7 mt-1 text-sm text-gray-500">
                                Thanh toán bằng tiền mặt khi nhận được hàng
                            </p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col md:flex-row justify-between gap-4 pt-6 border-t border-gray-200">
                        <a href="/webbanhang/Product/cart" class="inline-flex items-center justify-center px-6 py-3 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition duration-200">
                            <i class="fas fa-arrow-left mr-2"></i>Quay lại giỏ hàng
                        </a>
                        <button type="submit" class="inline-flex items-center justify-center px-8 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition duration-200">
                            <i class="fas fa-check-circle mr-2"></i>Xác nhận đặt hàng
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="justify-between">
    <?php include 'app/views/shares/footer.php'; ?>
</div>