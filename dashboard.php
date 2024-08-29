

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha384-hrmPO4HCmSpvwyuLWHX5z5xXkz8TjJU5pXcFpFQwqfOeG8Bl/5+PtcO87NNb5O4" crossorigin="anonymous">
    <link href='https://unpkg.com/@fullcalendar/core@5.10.1/main.min.css' rel='stylesheet' />
    <link rel="stylesheet" href="dashboard.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link re="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src ="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>

</head>

<body>
    <div class="progress"></div>
    <div class="wrapper">
        <aside id ="sidebar">
        <div class="top">
            <div class="logo">
                <img src="/system/images/laundry_logo.png" alt="Laundry logo">
                <span>Azia Skye</span>
            </div>
            <i class='bx bx-menu' id="btnMenu"></i>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="laundry_system/dashboard/dashboard.php" class="sidebar-link">
                    <i class="bx bxs-grid-alt"></i>
                    <span class="nav-item">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>

            <li>
                <a href="laundry_system/my_profile/profile.html" class="sidebar-link">
                    <i class='bx bxs-user'></i>
                    <span class="nav-item">Profile</span>
                </a>
                <span class="tooltip">Profile</span>
            </li>

            <li>
                <a href="/system/users/users.html">
                    <i class='bx bxs-group'></i>
                    <span class="nav-item">Users</span>
                </a>
                <span class="tooltip">Users</span>
            </li>

            
            <li class="sidebar-item">
                <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse"
                    data-bs-target="#records" aria-expanded="false" aria-controls="records">
                    <i class='bx bxs-folder-open'></i>
                    <span class="nav-item">Records</span>
                </a>

                <ul id="records" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Customer</a>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Service</a>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Category</a>
                    </li>
                </ul>
                <span class="tooltip">Records</span>
            </li>
            

            <li>
                <a href="/system/transaction/transaction.html">
                    <i class='bx bx-transfer-alt'></i>
                    <span class="nav-item">Transaction</span>
                </a>
                <span class="tooltip">Transaction</span>
            </li>

            <li>
                <a href="/system/sales report/report.html">
                    <i class='bx bx-line-chart'></i>
                    <span class="nav-item">Report</span>
                </a>
                <span class="tooltip">Report</span>
            </li>

            <li>
                <a href="/system/settings/settings.html">
                    <i class='bx bxs-cog'></i>
                    <span class="nav-item">Settings</span>
                </a>
                <span class="tooltip">Settings</span>
            </li>

            
            <li>
                <a href="/system/archive/archive.html">
                    <i class='bx bxs-archive-in'></i>
                    <span class="nav-item">Archived</span>
                </a>
                <span class="tooltip">Archived</span>
            </li>

            <li>
                <a href="logout.php">
                    <i class='bx bx-log-out'></i>
                    <span class="nav-item">Logout</span>
                </a>
                <span class="tooltip">Logout</span>
            </li>
        </ul>
        </aside>
    </div>

    <div class="main-content">
        <div class="cards-container">
            <h1>Dashboard</h1>
            <div class="cards">
                <div class="card">
                    <h3>Pick-up request</h3>
                    <p id="pickup-orders">0</p>
                </div>
                <div class="card">
                    <h3>Delivery request</h3>
                    <p id="pickup-orders">0</p>
                </div>
                <div class="card">
                    <h3>Rush request</h3>
                    <p id="pickup-orders">0</p>
                </div>
            </div>
        </div>

        <div class = "charts-container">
            <div class = "charts">
                <div class = "chart">
                    <h3>Orders In Day</h3>
                    <canvas id="daychart" width="230" height="235"></canvas>
                        <?php
                        // Connect to database
                        $servername = "localhost";
                        $username = "root";
                        $password = "padayon143";
                        $dbname = "orders_graph";

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $query = "SELECT SUM(amount) as total_amount FROM orders WHERE DATE(created) = CURDATE()";
                        $result = $conn->query($query);

                        // Fetch data from query
                        $row = $result->fetch_assoc();
                        $total_amount = $row['total_amount'];

                        // Close connection
                        $conn->close();
                        ?>

                        <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const ctx = document.getElementById('daychart').getContext('2d');
                            const daychart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: ['Today'],
                                    datasets: [{
                                        label: 'Today\'s Orders',
                                        data: [<?php echo $total_amount; ?>],
                                        backgroundColor: 'rgba(255, 99, 132, 1)',
                                        borderColor: 'rgba(255, 99, 132, 1)',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        });
                        </script>
                    </div>         
     <!--ORDERS WEEK-->      
               
                <div class="chart">
                    <h3>Orders In Week</h3>
                    <canvas id="weekchart" width="230" height="240"></canvas>
                        <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "padayon143";
                            $dbname = "orders_graph";

                            $conn = new mysqli($servername, $username, $password, $dbname);

                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Retrieve data from database
                            $query = "SELECT DAYNAME(created) as day, SUM(amount) as total_amount
                                    FROM orders
                                    GROUP BY DAYNAME(created)
                                    ORDER BY MIN(created) ASC"; // Add ORDER BY clause to sort by date
                            $result = $conn->query($query);

                            $data = array();
                            $labels = array();
                            $amount = array();

                            while ($row = $result->fetch_assoc()) {
                                $labels[] = $row['day'];
                                $amount[] = $row['total_amount'];
                            }

                            $conn->close();
                            ?>

                            <script>
                            const labels = <?php echo json_encode($labels); ?>;
                            const data = {
                            labels: labels,
                            datasets: [{
                                label: 'Total Orders',
                                data: <?php echo json_encode($amount); ?>,
                                backgroundColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 1)',
                                ],
                                borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 1)',
                                ],
                                borderWidth: 1
                            }]
                            };

                            const config = {
                            type: 'doughnut',
                            data: data,
                            options: {
                                responsive: true,
                                plugins: {
                                legend: {
                                    position: 'top',
                                },
                                title: {
                                    display: true,
                                }
                                }
                            },
                            };

                            var weekchart = new Chart(
                            document.getElementById('weekchart'),
                            config
                            );
                            </script>
                         </div>
<!--ORDERS IN A MONTH-->

            <div class="chart">
                <h3>Orders In Month</h3>
                <canvas id="monthchart" width="230" height="240"></canvas>
                
                <?php
                    // Connect to database
                    $servername = "localhost";
                    $username = "root";
                    $password = "padayon143";
                    $dbname = "orders_graph";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $query = "SELECT MONTHNAME(created) as monthname, SUM(amount) as amount FROM orders GROUP BY monthname";
                    $result = $conn->query($query);

                    // Create arrays to store data
                    $month = array();
                    $amount = array();

                    // Fetch data from query
                    while ($row = $result->fetch_assoc()) {
                        $month[] = $row['monthname'];
                        $amount[] = $row['amount'];
                    }

                    // Close connection
                    $conn->close();
                    ?>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const ctx = document.getElementById('monthchart').getContext('2d');
                            const daychart = new Chart(ctx, {
                                type: 'doughnut',
                                data: {
                                    labels: <?php echo json_encode($month); ?>,
                                    datasets: [{
                                        label: 'Month',
                                        data: <?php echo json_encode($amount); ?>,
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',
                                            'rgba(75, 192, 192, 1)',
                                            'rgba(153, 102, 255, 1)',
                                            'rgba(255, 159, 64, 1)',
                                        ],
                                        borderColor: [
                                            'rgba(255, 99, 132, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',
                                            'rgba(75, 192, 192, 1)',
                                            'rgba(153, 102, 255, 1)',
                                            'rgba(255, 159, 64, 1)',
                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        });
                            </script> 
                        </div>

<!--YEAR CHART-->
            <div class="chart">
                <h3>Orders In Year</h3>
                <canvas id="yearchart" width="350" height="357"></canvas>
                    <?php
                        // Connect to database
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "orders_graph";

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                                        // Create table if it doesn't exist
                        $query = "CREATE TABLE IF NOT EXISTS orders (
                            id INT PRIMARY KEY AUTO_INCREMENT,
                            created YEAR,
                            amount DECIMAL(10, 2)
                        )";
                        $conn->query($query);
                                        // Query to get orders data by year
                        $query = "SELECT YEAR(created) as year, SUM(amount) as amount FROM orders GROUP BY year";
                        $result = $conn->query($query);

                        // Check if query was successful
                        if (!$result) {
                            die("Query failed: " . $conn->error);
                        }

                        // Create arrays to store data
                        $year = array();
                        $amount = array();

                        // Fetch data from query
                        while ($row = $result->fetch_assoc()) {
                            $year[] = $row['year'];
                            $amount[] = $row['amount'];
                        }
                                        ?>

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                const labels = <?php echo json_encode($year); ?>;
                                const data = {
                                    labels: labels,
                                    datasets: [{
                                        label: 'Orders',
                                        data: <?php echo json_encode($amount); ?>,
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',
                                            'rgba(75, 192, 192, 1)',
                                            'rgba(153, 102, 255, 1)',
                                            'rgba(255, 159, 64, 1)',
                                            'rgba(255, 99, 132, 1)'
                                        ],
                                        borderColor: [
                                            'rgba(255, 99, 132, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',
                                            'rgba(75, 192, 192, 1)',
                                            'rgba(153, 102, 255, 1)',
                                            'rgba(255, 159, 64, 1)',
                                            'rgba(255, 99, 132, 1)'
                                        ],
                                        borderWidth: 1
                                    }]
                                };

                                const config = {
                                    type: 'line',
                                    data: data,
                                    options: {
                                        responsive: true,
                                        plugins: {
                                            legend: {
                                                position: 'top',
                                            },
                                            title: {
                                                display: true,
                                            }
                                        }
                                    },
                                };

                                var yearchart = new Chart(
                                    document.getElementById('yearchart'),
                                    config
                                );
                            });
                        </script>
        </div>
            </div><!--end of charts-->      
                </div>

                            <!--Calendar-->
        <div class = "calendar-container">
            <div class = "calendar-content">
                <div id="calendar"></div>
                  <div id="event-list">
                      <h2>Event List</h2>
                          <ul id="events">
                            <!--list of events-->
                          </ul>
                            </div>
                            </div>

                            <?php
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "events";

                                // Create connection
                                $conn = new mysqli($servername, $username, $password, $dbname);

                                // Check connection
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                // Retrieve events
                                $sql = "SELECT * FROM events";
                                $result = $conn->query($sql);

                                $events = array();
                                while ($row = $result->fetch_assoc()) {
                                    $events[] = array(
                                        'id' => $row['id'],
                                        'title' => $row['title'],
                                        'start' => $row['start_date'],
                                        'end' => $row['end_date'],
                                        'description' => $row['description']
                                    );
                                }

                                $conn->close();
                                ?>
                        <script>
                        $(document).ready(function() {
                            var events = <?php echo json_encode($events) ?>;

                            $('#calendar').fullCalendar({
                                header: {
                                    left: 'prev,next today',
                                    center: 'title',
                                    right: 'month,agendaWeek,agendaDay'
                                },
                                defaultDate: '2024-08-01', // Set a default date
                                navLinks: true, // can click day/week names to navigate views
                                editable: true,
                                eventLimit: true, // allow "more" link when too many events
                                events: events,
                                dayClick: function(date, jsEvent, view) {
                                    // Filter events for the clicked day
                                    var dayEvents = events.filter(function(event) {
                                        return moment(event.start).isSame(date, 'day');
                                    });

                                    // Update the event list
                                    var eventList = $('#events');
                                    eventList.empty();
                                    $.each(dayEvents, function(index, event) {
                                        eventList.append('<li>' + event.title + ' - ' + event.start + '</li>');
                                    });

                                    // Add a CSS class to the day cell element
                                    $(this).addClass('hovered');
                                }
                                
                            });
                            $(document).ready(function() {
                            var events = <?php echo json_encode($events) ?>;

                            $('#calendar').fullCalendar({
                                // ...
                            });

                            // Add event listeners for mouseenter and mouseleave
                            $('.fc-day').on('mouseenter', function() {
                                $(this).addClass('hovered');
                            }).on('mouseleave', function() {
                                $(this).removeClass('hovered');
                            });
                        });
                        });
                        </script>
                  </div>
    </div><!--end of main-container-->
</body>
<script src="dashboard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
</html>