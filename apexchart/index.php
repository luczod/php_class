<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap"
        rel="stylesheet" />

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temperatures</title>
    <!-- libs -->
    <link rel="stylesheet" href="libs/styles.css" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="libs/axios.min.js"></script>
</head>

<body>
    <main>
        <section>
            <h2>Temperature</h2>
            <div class="wrapper">
                <div id="chart"></div>
            </div>
            <div class="chart-control">
                <button class="btn btn-primary btn-lg" onclick="start()">Start</button>
                <button class="btn btn-primary btn-lg" onclick="stop()">Stop</button>
            </div>
        </section>
    </main>
    <script>
        let arr = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        let myInterval = null;
        let el = document.querySelector("#chart");

        let options = {
            chart: {
                height: 600,
                width: 800,
                type: 'area',
                animations: {
                    enabled: false
                }
            },
            series: [{
                name: 'Data',
                data: arr
            }],
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10']
            },
            yaxis: {
                min: 0,
                max: 100
            }
        };

        let chart = new ApexCharts(el, options);
        chart.render();

        function start() {
            myInterval = setInterval(ajaxFunc, 2000);
        }

        function stop() {
            clearInterval(myInterval);
        }

        function ajaxFunc() {
            axios.get('http://localhost/php_class/apexchart/ajax/utils.php')
                .then((response) => {
                    arr = response.data;
                    chart.updateSeries(
                        [{
                            data: arr
                        }]
                    );
                })
                .catch((error) => {
                    console.error(error);
                })
        }
    </script>
</body>

</html>