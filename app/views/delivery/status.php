<?php include 'app/views/shares/header.php'; ?>

<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="text-center mb-12">
        <i class="fas fa-truck text-blue-600 text-6xl mb-4"></i>
        <h1 class="text-4xl font-bold mb-2">Trạng thái đơn hàng</h1>
        <p class="text-gray-600">Danh sách tất cả đơn hàng và trạng thái giao hàng</p>
    </div>

    <!-- Filter and Search -->
    <div class="max-w-4xl mx-auto mb-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="searchOrder" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-search mr-2"></i>Tìm kiếm đơn hàng
                    </label>
                    <input type="text" id="searchOrder" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                           placeholder="Nhập mã đơn hàng hoặc tên khách hàng">
                </div>
                <div>
                    <label for="statusFilter" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-filter mr-2"></i>Lọc theo trạng thái
                    </label>
                    <select id="statusFilter" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="">Tất cả trạng thái</option>
                        <option value="pending">Chờ xác nhận</option>
                        <option value="confirmed">Đã xác nhận</option>
                        <option value="shipping">Đang giao hàng</option>
                        <option value="delivered">Đã giao hàng</option>
                        <option value="cancelled">Đã hủy</option>
                    </select>
                </div>
                <div>
                    <label for="dateFilter" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-calendar mr-2"></i>Lọc theo ngày
                    </label>
                    <select id="dateFilter" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="">Tất cả thời gian</option>
                        <option value="today">Hôm nay</option>
                        <option value="week">Tuần này</option>
                        <option value="month">Tháng này</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders List -->
    <?php if (!empty($orders)): ?>
        <div class="max-w-6xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-blue-600 text-white p-6">
                    <h2 class="text-2xl font-bold flex items-center">
                        <i class="fas fa-list-alt mr-2"></i>Danh sách đơn hàng 
                        <span class="ml-2 bg-blue-500 px-3 py-1 rounded-full text-sm"><?php echo count($orders); ?> đơn hàng</span>
                    </h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mã đơn hàng</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Khách hàng</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày đặt</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tổng tiền</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hành động</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="ordersTableBody">
                            <?php foreach ($orders as $order): ?>
                                <tr class="hover:bg-gray-50 order-row" 
                                    data-status="<?php echo $order['status']; ?>"
                                    data-order-code="<?php echo strtolower($order['order_code']); ?>"
                                    data-customer="<?php echo strtolower($order['customer_name'] ?? ''); ?>"
                                    data-date="<?php echo date('Y-m-d', strtotime($order['created_at'])); ?>">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-blue-600">
                                            <?php echo htmlspecialchars($order['order_code'], ENT_QUOTES, 'UTF-8'); ?>
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            ID: #<?php echo $order['id']; ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <?php echo htmlspecialchars($order['customer_name'] ?? 'Khách hàng', ENT_QUOTES, 'UTF-8'); ?>
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            <?php echo htmlspecialchars($order['customer_phone'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <?php echo date('d/m/Y', strtotime($order['created_at'])); ?>
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            <?php echo date('H:i', strtotime($order['created_at'])); ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-green-600">
                                            <?php echo number_format($order['total_amount'], 0, ',', '.'); ?> VNĐ
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            <?php echo ($order['item_count'] ?? 0); ?> sản phẩm
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'confirmed' => 'bg-blue-100 text-blue-800',
                                            'shipping' => 'bg-purple-100 text-purple-800',
                                            'delivered' => 'bg-green-100 text-green-800',
                                            'cancelled' => 'bg-red-100 text-red-800'
                                        ];
                                        $statusTexts = [
                                            'pending' => 'Chờ xác nhận',
                                            'confirmed' => 'Đã xác nhận',
                                            'shipping' => 'Đang giao hàng',
                                            'delivered' => 'Đã giao hàng',
                                            'cancelled' => 'Đã hủy'
                                        ];
                                        $statusIcons = [
                                            'pending' => 'fa-clock',
                                            'confirmed' => 'fa-check-circle',
                                            'shipping' => 'fa-truck',
                                            'delivered' => 'fa-check-double',
                                            'cancelled' => 'fa-times-circle'
                                        ];
                                        $statusColor = $statusColors[$order['status']] ?? 'bg-gray-100 text-gray-800';
                                        $statusText = $statusTexts[$order['status']] ?? $order['status'];
                                        $statusIcon = $statusIcons[$order['status']] ?? 'fa-question-circle';
                                        ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo $statusColor; ?>">
                                            <i class="fas <?php echo $statusIcon; ?> mr-1"></i>
                                            <?php echo $statusText; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button onclick="viewOrderDetails('<?php echo $order['order_code']; ?>')" 
                                                class="text-blue-600 hover:text-blue-900 mr-3">
                                            <i class="fas fa-eye mr-1"></i>Chi tiết
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php else: ?>
        <!-- No Orders -->
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg p-12 text-center">
                <i class="fas fa-clipboard-list text-gray-400 text-8xl mb-6"></i>
                <h3 class="text-2xl font-bold text-gray-600 mb-4">Chưa có đơn hàng nào</h3>
                <p class="text-gray-500 mb-8">Hệ thống chưa có đơn hàng nào được tạo.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/webbanhang/Product" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-200">
                        <i class="fas fa-shopping-bag mr-2"></i>Bắt đầu mua sắm
                    </a>
                    <a href="/webbanhang/" class="inline-flex items-center px-6 py-3 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition duration-200">
                        <i class="fas fa-home mr-2"></i>Về trang chủ
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Statistics Summary -->
    <?php if (!empty($orders)): ?>
        <div class="max-w-6xl mx-auto mt-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <?php
                $stats = [
                    'pending' => ['count' => 0, 'color' => 'yellow', 'icon' => 'fa-clock', 'label' => 'Chờ xác nhận'],
                    'confirmed' => ['count' => 0, 'color' => 'blue', 'icon' => 'fa-check-circle', 'label' => 'Đã xác nhận'],
                    'shipping' => ['count' => 0, 'color' => 'purple', 'icon' => 'fa-truck', 'label' => 'Đang giao'],
                    'delivered' => ['count' => 0, 'color' => 'green', 'icon' => 'fa-check-double', 'label' => 'Đã giao']
                ];
                
                foreach ($orders as $order) {
                    if (isset($stats[$order['status']])) {
                        $stats[$order['status']]['count']++;
                    }
                }
                ?>
                
                <?php foreach ($stats as $status => $stat): ?>
                    <div class="bg-white rounded-lg shadow p-6 text-center">
                        <div class="bg-<?php echo $stat['color']; ?>-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas <?php echo $stat['icon']; ?> text-<?php echo $stat['color']; ?>-600 text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800"><?php echo $stat['count']; ?></h3>
                        <p class="text-sm text-gray-600"><?php echo $stat['label']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
// Search and filter functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchOrder');
    const statusFilter = document.getElementById('statusFilter');
    const dateFilter = document.getElementById('dateFilter');
    const orderRows = document.querySelectorAll('.order-row');

    function filterOrders() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusValue = statusFilter.value;
        const dateValue = dateFilter.value;
        
        const today = new Date();
        const weekAgo = new Date(today.getTime() - 7 * 24 * 60 * 60 * 1000);
        const monthAgo = new Date(today.getTime() - 30 * 24 * 60 * 60 * 1000);

        orderRows.forEach(row => {
            let showRow = true;

            // Search filter
            if (searchTerm) {
                const orderCode = row.dataset.orderCode;
                const customer = row.dataset.customer;
                if (!orderCode.includes(searchTerm) && !customer.includes(searchTerm)) {
                    showRow = false;
                }
            }

            // Status filter
            if (statusValue && row.dataset.status !== statusValue) {
                showRow = false;
            }

            // Date filter
            if (dateValue) {
                const orderDate = new Date(row.dataset.date);
                switch (dateValue) {
                    case 'today':
                        if (orderDate.toDateString() !== today.toDateString()) {
                            showRow = false;
                        }
                        break;
                    case 'week':
                        if (orderDate < weekAgo) {
                            showRow = false;
                        }
                        break;
                    case 'month':
                        if (orderDate < monthAgo) {
                            showRow = false;
                        }
                        break;
                }
            }

            row.style.display = showRow ? '' : 'none';
        });
    }

    searchInput.addEventListener('input', filterOrders);
    statusFilter.addEventListener('change', filterOrders);
    dateFilter.addEventListener('change', filterOrders);
});

function viewOrderDetails(orderCode) {
    // Create a form to submit the order code
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '/webbanhang/Delivery/trackOrder';
    
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'order_code';
    input.value = orderCode;
    
    form.appendChild(input);
    document.body.appendChild(form);
    form.submit();
}
</script>

<?php include 'app/views/shares/footer.php'; ?>
