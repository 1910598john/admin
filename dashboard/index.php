<!DOCTYPE html>
<html>
<head>
    <title>ADMIN DASHBOARD</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./sas/styles.css"/>
</head>
<body id="body">
<div class="body-content">
    <div class="side-bar">
        <div class="content">
            <button>Detailed report</button>
            <button id="insert-products">Insert products</button>
        </div>
    </div>
    <div class="main">
        <div class="header"></div>
        <select id="options" size='1'>
            <option value="daily">Daily</option>
            <option value="monthly">Monthly</option>
        </select>
        <select id="dates" size='1'>
        </select>
        <button id="show">Show</button>
        <div class="main-content">
            <div class="playground-report-wrapper">
                <div>Playground Sales</div>
                <div id="playground-daily-report">0</div>
            </div>
            <div class="cafe-report-wrapper">
                <div>Cafe Sales</div>
                <div id="cafe-daily-report">0</div>
            </div>
            <div class="total-report-wrapper">
                <div>Total Sales</div>
                <div id="total-daily-report">0</div>
            </div>
        </div>
    </div>
</div>
<script src="./sas/main.js"></script>
</body>
</html>