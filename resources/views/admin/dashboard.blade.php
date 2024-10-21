@extends('admin.app')
@section('index')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    {{ $pageName }}
                </h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row" style="display: block;">
            <div class="col-md-12 col-sm-12">
                <div class="tile_count">
                    <div class="col-md-2 tile_stats_count">
                        <span class="count_top"><i class="fa fa-user"></i> Khách hàng</span>
                        <div class="count">{{ number_format($userCount) }}</div>
                    </div>
                    <div class="col-md-2 tile_stats_count">
                        <span class="count_top"><i class="fa fa-clone"></i> Danh mục</span>
                        <div class="count">{{ number_format($categoryCount) }}</div>
                    </div>
                    <div class="col-md-2 tile_stats_count">
                        <span class="count_top"><i class="fa fa-table"></i> Sản phẩm</span>
                        <div class="count">{{ number_format($productCount) }}</div>
                    </div>
                    <div class="col-md-2 tile_stats_count">
                        <span class="count_top"><i class="fa fa-shopping-cart"></i> Đơn hàng</span>
                        <div class="count">{{ number_format($orderCount) }}</div>
                    </div>
                    <div class="col-md-4 tile_stats_count">
                        <span class="count_top"><i class="fa fa-dollar"></i> Doanh thu tổng</span>
                        <div class="count">{{ number_format($orderTotalSum) }}đ</div>
                    </div>
                </div>
            </div>
        </div>


        <div class="clearfix"></div>

        <div class="row" style="display: block;">
            <div class="col-md-12 col-sm-12">
                <div class="dashboard_graph">

                    <div class="row x_title">
                        <div class="col-md-2">
                            <label>Thống kê</label>
                            <select class="form-control" id="year">
                                @foreach ($threeYears as $year)
                                    <option value="{{ $year }}">
                                        Năm {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>Bắt đầu</label>
                            <input type="date" id="start-at" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label>Kết thúc</label>
                            <input type="date" id="finish-at" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label>&nbsp;</label>
                            <br>
                            <a href="#" onclick="filterChart(event)" class="btn btn-outline-primary">Lọc</a>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <canvas id="quantity-chart"></canvas>
                    </div>

                    <div class="col-md-6">
                        <canvas id="total-chart"></canvas>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var url = window.location.origin;
        var ctx = document.getElementById('quantity-chart');
        var ctx1 = document.getElementById('total-chart');
        var chart = null;
        var chart1 = null;
        var year = null;
        var startAt = null;
        var finishAt = null;

        function getChart() {
            var param = '';
            if (year != null) {
                param = '?year=' + year;
            }

            if (startAt) {
                param += '&start_at=' + startAt;
            }

            if (finishAt) {
                param += '&finish_at=' + finishAt;
            }

            $.ajax({
                url: url + '/admin/chart' + param,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    res = Object.values(res);
                    let months = res.map(item => 'Tháng ' + item.month + '/' + item.year);
                    let quantity = res.map(item => item.quantity);
                    let total = res.map(item => item.total);

                    chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: months,
                            datasets: [{
                                label: 'Tổng sản phẩm',
                                data: quantity,
                                borderWidth: 1,
                                backgroundColor: 'rgba(0, 123, 255, 0.5)',
                                borderColor: 'rgba(0, 123, 255, 1)',
                                categoryPercentage: 0.5, // Kích thước của category là 80% không gian tối đa có sẵn
                                barPercentage: 0.5
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            return value + ' sản phẩm';
                                        }
                                    },
                                    grid: {
                                        display: false // Tắt đường lưới trên trục Y
                                    },
                                }
                            },
                            plugins: {
                                legend: {
                                    display: true,
                                    labels: {
                                        color: 'rgb(255, 99, 132)'
                                    }
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return 'Đã bán ' + tooltipItem.formattedValue +
                                                ' sản phẩm';
                                        }
                                    }
                                }
                            }
                        }
                    });

                    chart1 = new Chart(ctx1, {
                        type: 'bar',
                        data: {
                            labels: months,
                            datasets: [{
                                label: 'Tổng doanh thu',
                                data: total,
                                borderWidth: 1,
                                backgroundColor: 'rgba(0, 123, 255, 0.5)',
                                borderColor: 'rgba(0, 123, 255, 1)',
                                categoryPercentage: 0.5, // Kích thước của category là 80% không gian tối đa có sẵn
                                barPercentage: 0.5
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            return value.toLocaleString('en-US') + 'đ';
                                        }
                                    },
                                    grid: {
                                        display: false // Tắt đường lưới trên trục Y
                                    },
                                }
                            },
                            plugins: {
                                legend: {
                                    display: true,
                                    labels: {
                                        color: 'rgb(255, 99, 132)'
                                    }
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return 'Doanh thu: ' + tooltipItem.formattedValue + 'đ';
                                        }
                                    }
                                }
                            }
                        }
                    });
                },
                error: function(XHR, status, error) {

                },
                complete: function(res) {

                }
            });
        }

        function filterChart(e) {
            if (chart != null) {
                chart.destroy();
            }

            if (chart1 != null) {
                chart1.destroy();
            }

            year = document.getElementById('year').value;
            startAt = document.getElementById('start-at').value;
            finishAt = document.getElementById('finish-at').value;
            getChart();
        }

        getChart();
    </script>
@endsection
