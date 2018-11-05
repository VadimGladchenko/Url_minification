<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Statistic</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        let analytics = <?php echo $statistic; ?>

        google.charts.load('current', {'packages': ['corechart']});

        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            let options = {
                titlePosition: 'none',
                backgroundColor: 'transparent',
                chartArea: {
                    left: 5,
                    top: 20,
                    width: '100%',
                    height: '70%',
                    fill: 'transparent',
                },
                legend: {
                    'position': 'bottom'
                }
            };

            //browsers
            let dataBrowsers = new google.visualization.DataTable();
            dataBrowsers.addColumn('string', 'Browser');
            dataBrowsers.addColumn('number', 'Transition');

            for (let item in analytics['browsers']) {
                dataBrowsers.addRow([item, analytics['browsers'][item]]);
            }

            let chartBrowsers = new google.visualization.PieChart(document.getElementById('browsers_chart'));

            chartBrowsers.draw(dataBrowsers, options);

            //countries
            let dataCountries = new google.visualization.DataTable();
            dataCountries.addColumn('string', 'Country');
            dataCountries.addColumn('number', 'Transition');

            for (let item in analytics['countries']) {
                dataCountries.addRow([item, analytics['countries'][item]]);
            }

            let chartCountries = new google.visualization.PieChart(document.getElementById('countries_chart'));

            chartCountries.draw(dataCountries, options);

            //operating systems
            let dataOS = new google.visualization.DataTable();
            dataOS.addColumn('string', 'Operating system');
            dataOS.addColumn('number', 'Transition');

            for (let item in analytics['operating_systems']) {
                dataOS.addRow([item, analytics['operating_systems'][item]]);
            }

            let chartOS = new google.visualization.PieChart(document.getElementById('operating_systems_chart'));

            chartOS.draw(dataOS, options);
        }
    </script>

</head>
<body>
<header class="navbar navbar-dark bg-dark">
    <div class="container">
        <h3 class="text-white m-0">Url Minification</h3>
    </div>
</header>

<div class="panel panel-default">
    <div class="panel-heading container mt-3 mb-5 pb-5">
        <h2 class="panel-title d-inline-block">Transition statistic for: <span href="#" class="font-weight-bold"
                                                                               id="base_url"></span></h2>
        <h2 class="panel-title d-inline-block float-right">Transition count: <span href="#" class="font-weight-bold"
                                                                                   id="trans_count"></span></h2>
    </div>
    <div class="panel-body text-center">
        <div class="d-inline-block" style="width:500px; height:500px;">
            <h4 class="d-inline-block">Browsers</h4>
            <div id="browsers_chart" style="width:500px; height:500px;"></div>
        </div>
        <div class="d-inline-block" style="width:500px; height:500px;">
            <h4 class="d-inline-block">Countries</h4>
            <div id="countries_chart" style="width:500px; height:500px;"></div>
        </div>
        <div class="d-inline-block" style="width:500px; height:500px;">
            <h4 class="d-inline-block">Operating systems</h4>
            <div id="operating_systems_chart" style="width:500px; height:500px;"></div>
        </div>
    </div>
    <div class="text-center">
        <a href="/" class="btn btn-dark m-5">Return to main page</a>
    </div>
</div>


<script type="text/javascript">
    let url = document.URL;
    url = url.replace('/statistic', '');
    $('#base_url').text(url);

    $('#trans_count').text(analytics['count']);
</script>
</body>
</html>