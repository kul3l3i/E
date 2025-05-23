<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HirayaFit - Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 280px;
            height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-logo {
            color: white;
            text-decoration: none;
            font-size: 24px;
            font-weight: bold;
        }

        .sidebar-logo span {
            color: #ffd700;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .menu-title {
            color: rgba(255,255,255,0.7);
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 20px 20px 10px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255,255,255,0.1);
            color: white;
            border-right: 3px solid #ffd700;
        }

        .sidebar-menu a i {
            margin-right: 12px;
            width: 20px;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            min-height: 100vh;
        }

        /* Top Navigation */
        .top-navbar {
            background: white;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .navbar-title {
            font-size: 24px;
            font-weight: 600;
            color: #333;
        }

        .welcome-text {
            color: #666;
            font-size: 14px;
        }

        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nav-link {
            position: relative;
            color: #666;
            font-size: 18px;
            text-decoration: none;
        }

        .notification-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #ff4757;
            color: white;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 10px;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .admin-info {
            display: flex;
            flex-direction: column;
        }

        .admin-name {
            font-weight: 600;
            font-size: 14px;
        }

        .admin-role {
            color: #666;
            font-size: 12px;
        }

        /* Dashboard Container */
        .dashboard-container {
            padding: 30px;
        }

        /* Statistics Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .stat-title {
            color: #666;
            font-size: 14px;
            font-weight: 500;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
        }

        .stat-value {
            font-size: 32px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .stat-change {
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .stat-change.positive {
            color: #27ae60;
        }

        .stat-change.negative {
            color: #e74c3c;
        }

        /* Chart Containers */
        .charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .chart-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .chart-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
        }

        .chart-container {
            position: relative;
            height: 400px;
        }

        /* Tables */
        .table-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .table-header {
            padding: 20px 25px;
            border-bottom: 1px solid #eee;
        }

        .table-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th,
        .data-table td {
            padding: 15px 25px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .data-table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #333;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-delivered {
            background: #d4edda;
            color: #155724;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-cancelled {
            background: #f8d7da;
            color: #721c24;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
            }

            .charts-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Color schemes for stat cards */
        .revenue-card .stat-icon { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .orders-card .stat-icon { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
        .users-card .stat-icon { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
        .products-card .stat-icon { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <a href="dashboard.php" class="sidebar-logo">Hiraya<span>Fit</span></a>
        </div>
        
        <div class="sidebar-menu">
            <div class="menu-title">MAIN</div>
            <a href="dashboard.php" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="orders_admin.php"><i class="fas fa-shopping-cart"></i> Orders</a>
            <a href="payment-history.php"><i class="fas fa-money-check-alt"></i> Payment History</a>
            
            <div class="menu-title">INVENTORY</div>
            <a href="products.php"><i class="fas fa-tshirt"></i> Products & Categories</a>
            <a href="stock.php"><i class="fas fa-box"></i> Stock Management</a>
            
            <div class="menu-title">USERS</div>
            <a href="users.php"><i class="fas fa-users"></i> User Management</a>
            
            <div class="menu-title">REPORTS & SETTINGS</div>
            <a href="reports.php"><i class="fas fa-file-pdf"></i> Reports & Analytics</a>
            <a href="settings.php"><i class="fas fa-cog"></i> System Settings</a>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navigation -->
        <nav class="top-navbar">
            <div class="nav-left">
                <span class="navbar-title">Dashboard</span>
                <div class="welcome-text">Welcome back, <strong>Admin</strong>!</div>
            </div>
            
            <div class="navbar-actions">
                <a href="notifications.php" class="nav-link">
                    <i class="fas fa-bell"></i>
                    <span class="notification-count">3</span>
                </a>
                <a href="messages.php" class="nav-link">
                    <i class="fas fa-envelope"></i>
                    <span class="notification-count">5</span>
                </a>
                
                <div class="admin-profile">
                    <img src="/api/placeholder/40/40" alt="Admin" class="admin-avatar">
                    <div class="admin-info">
                        <span class="admin-name">John Doe</span>
                        <span class="admin-role">Administrator</span>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Dashboard Content -->
        <div class="dashboard-container">
            <!-- Statistics Cards -->
            <div class="stats-grid">
                <div class="stat-card revenue-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-title">Total Revenue</div>
                            <div class="stat-value">₱<span id="totalRevenue">1,500</span></div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i> +12.5% from last month
                            </div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-peso-sign"></i>
                        </div>
                    </div>
                </div>

                <div class="stat-card orders-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-title">Total Orders</div>
                            <div class="stat-value"><span id="totalOrders">1</span></div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i> +5 this week
                            </div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>

                <div class="stat-card users-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-title">Active Users</div>
                            <div class="stat-value"><span id="activeUsers">1</span></div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i> +2 new users
                            </div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>

                <div class="stat-card products-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-title">Total Products</div>
                            <div class="stat-value"><span id="totalProducts">2</span></div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i> +3 this month
                            </div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-box"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="charts-grid">
                <div class="chart-card">
                    <h3 class="chart-title">Revenue Overview</h3>
                    <div class="chart-container">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <div class="chart-card">
                    <h3 class="chart-title">Order Status Distribution</h3>
                    <div class="chart-container">
                        <canvas id="orderStatusChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Additional Charts -->
            <div class="charts-grid">
                <div class="chart-card">
                    <h3 class="chart-title">Top Selling Products</h3>
                    <div class="chart-container">
                        <canvas id="topProductsChart"></canvas>
                    </div>
                </div>

                <div class="chart-card">
                    <h3 class="chart-title">Payment Methods</h3>
                    <div class="chart-container">
                        <canvas id="paymentMethodsChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Transactions Table -->
            <div class="table-card">
                <div class="table-header">
                    <h3 class="table-title">Recent Transactions</h3>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Payment Method</th>
                        </tr>
                    </thead>
                    <tbody id="transactionsTable">
                        <tr>
                            <td>TRX-682D449D50900</td>
                            <td>Loraine Castro</td>
                            <td>2025-05-21</td>
                            <td>₱1,500</td>
                            <td><span class="status-badge status-delivered">Delivered</span></td>
                            <td>GCash</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Sample data simulation - In real implementation, this would come from your PHP backend
        const dashboardData = {
            transactions: [
                {
                    transaction_id: "TRX-682D449D50900",
                    user_id: 1,
                    transaction_date: "2025-05-21 05:12:29",
                    status: "delivered",
                    payment_method: "gcash",
                    subtotal: 1400,
                    shipping_fee: 100,
                    total_amount: 1500,
                    items: [{
                        product_id: 2025,
                        product_name: "Jump Rope",
                        price: 700,
                        quantity: 2,
                        color: "Black",
                        size: "Adjustable",
                        subtotal: 1400
                    }],
                    shipping_info: {
                        fullname: "Loraine Castro",
                        email: "castro.loraine.26@gmail.com",
                        phone: "0995 974 8216",
                        address: "Caingin San Rafael Bulacan",
                        city: "malolos",
                        postal_code: "3006"
                    }
                }
            ],
            products: [
                {
                    id: 2001,
                    name: "Men's Compression Shirt",
                    category: "Men's Activewear",
                    price: 1200,
                    stock: 45,
                    rating: 4.5,
                    review_count: 28
                },
                {
                    id: 2002,
                    name: "Men's Jogger Pants",
                    category: "Men's Activewear",
                    price: 1800,
                    stock: 32,
                    rating: 4.3,
                    review_count: 16
                }
            ]
        };

        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Revenue (₱)',
                    data: [800, 1200, 900, 1600, 1500, 2100],
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '₱' + value;
                            }
                        }
                    }
                }
            }
        });

        // Order Status Chart
        const orderStatusCtx = document.getElementById('orderStatusChart').getContext('2d');
        new Chart(orderStatusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Delivered', 'Pending', 'Processing', 'Cancelled'],
                datasets: [{
                    data: [1, 0, 0, 0],
                    backgroundColor: [
                        '#27ae60',
                        '#f39c12',
                        '#3498db',
                        '#e74c3c'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Top Products Chart
        const topProductsCtx = document.getElementById('topProductsChart').getContext('2d');
        new Chart(topProductsCtx, {
            type: 'bar',
            data: {
                labels: ['Jump Rope', 'Compression Shirt', 'Jogger Pants'],
                datasets: [{
                    label: 'Units Sold',
                    data: [2, 0, 0],
                    backgroundColor: [
                        '#667eea',
                        '#f093fb',
                        '#4facfe'
                    ],
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Payment Methods Chart
        const paymentMethodsCtx = document.getElementById('paymentMethodsChart').getContext('2d');
        new Chart(paymentMethodsCtx, {
            type: 'pie',
            data: {
                labels: ['GCash', 'PayMaya', 'Credit Card', 'Cash on Delivery'],
                datasets: [{
                    data: [1, 0, 0, 0],
                    backgroundColor: [
                        '#00d2ff',
                        '#ff6b6b',
                        '#4ecdc4',
                        '#45b7d1'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Update statistics dynamically
        function updateStats() {
            // Calculate stats from data
            const totalRevenue = dashboardData.transactions.reduce((sum, transaction) => sum + transaction.total_amount, 0);
            const totalOrders = dashboardData.transactions.length;
            const totalProducts = dashboardData.products.length;
            const activeUsers = 1; // This would come from your user data

            document.getElementById('totalRevenue').textContent = totalRevenue.toLocaleString();
            document.getElementById('totalOrders').textContent = totalOrders;
            document.getElementById('totalProducts').textContent = totalProducts;
            document.getElementById('activeUsers').textContent = activeUsers;
        }

        // Initialize dashboard
        updateStats();

        // Add some interactivity
        document.addEventListener('DOMContentLoaded', function() {
            // Add hover effects to stat cards
            const statCards = document.querySelectorAll('.stat-card');
            statCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html>