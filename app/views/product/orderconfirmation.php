<?php include 'app/views/shares/header.php'; ?>

<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto text-center">
        <!-- Success Animation -->
        <div class="mb-8">
            <div class="animate-bounce">
                <i class="fas fa-check-circle text-green-500 text-8xl"></i>
            </div>
        </div>

        <!-- Success Message -->
        <div class="bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="p-12">
                <h1 class="text-5xl font-bold text-green-600 mb-6">Đặt hàng thành công!</h1>
                <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                    Cảm ơn bạn đã đặt hàng. Đơn hàng của bạn đã được xử lý thành công và sẽ được giao trong thời gian sớm nhất.
                </p>

                <!-- Order Details -->
                <div class="bg-gray-50 rounded-lg p-6 mb-8">
                    <h5 class="text-xl font-bold mb-6 flex items-center justify-center">
                        <i class="fas fa-info-circle mr-2"></i>Thông tin đơn hàng
                    </h5>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-left">
                        <div>
                            <p class="mb-3"><strong>Mã đơn hàng:</strong> #DH<?php echo date('YmdHis'); ?></p>
                            <p class="mb-3"><strong>Ngày đặt:</strong> <?php echo date('d/m/Y H:i'); ?></p>
                        </div>
                        <div>
                            <p class="mb-3"><strong>Trạng thái:</strong> <span class="inline-block bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">Đang xử lý</span></p>
                            <p class="mb-3"><strong>Thanh toán:</strong> <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">COD</span></p>
                        </div>
                    </div>
                </div>

                <!-- Next Steps -->
                <div class="bg-blue-50 border-l-4 border-blue-400 p-6 mb-8 text-left">
                    <h6 class="text-lg font-bold mb-4 flex items-center">
                        <i class="fas fa-lightbulb mr-2 text-blue-600"></i>Các bước tiếp theo:
                    </h6>
                    <ul class="space-y-3">
                        <li class="flex items-center">
                            <i class="fas fa-envelope text-blue-600 mr-3"></i>
                            Chúng tôi sẽ gửi email xác nhận đơn hàng
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-shipping-fast text-blue-600 mr-3"></i>
                            Đơn hàng sẽ được chuẩn bị và giao trong 1-3 ngày
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone text-blue-600 mr-3"></i>
                            Nhân viên giao hàng sẽ liên hệ trước khi giao
                        </li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col md:flex-row justify-center gap-4">
                    <a href="/webbanhang/Product" class="inline-flex items-center px-8 py-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-200">
                        <i class="fas fa-shopping-bag mr-2"></i>Tiếp tục mua sắm
                    </a>
                    <a href="/webbanhang/" class="inline-flex items-center px-8 py-4 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition duration-200">
                        <i class="fas fa-home mr-2"></i>Về trang chủ
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="justify-items-between">
    <?php include 'app/views/shares/footer.php'; ?>
</div>