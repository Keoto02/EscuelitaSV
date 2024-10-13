<?php

include "../conf/conf.php";

$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';

$sql = "SELECT 
            cc.name_career_course AS course_name, 
            COUNT(pr.id) AS total_reports
        FROM 
            problem_reports pr
        JOIN 
            careers_courses cc ON pr.career_course_id = cc.id_career_course
        WHERE 
            pr.report_date BETWEEN :start_date AND :end_date
        GROUP BY 
            cc.name_career_course
        ORDER BY 
            total_reports DESC";

$stmt = $connection->prepare($sql);
$stmt->execute(['start_date' => $start_date, 'end_date' => $end_date]);
$results = $stmt->fetchAll();

$categories = [];
$data = [];
foreach ($results as $row) {
    $categories[] = $row['course_name'];
    $data[] = (int)$row['total_reports'];
}

?>
<script>
Highcharts.chart('container', {
    chart: {
        type: 'column',
        width: 800,
        height: 600
    },
    title: {
        text: 'Reporte de Problemas por Cursos o Carrera',
        align: 'center'
    },
    subtitle: {
        text: 'Rango de Fecha: <?php echo $start_date; ?> a <?php echo $end_date; ?>',
        align: 'left'
    },
    xAxis: {
        categories: <?php echo json_encode($categories); ?>,
        crosshair: true,
        title: {
            text: 'Carrera o Cursos'
        },
        labels: {
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total de Reportes'
        },
        allowDecimals: false,
        minTickInterval: 1
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">Reportes: </td>' +
            '<td style="padding:0"><b>{point.y}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                rotation: 0,
                color: '#000000',
                align: 'center',
                format: '{point.y}',
                y: -30,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }
    },
    series: [{
        name: 'Reportes',
        data: <?php echo json_encode($data); ?>,
        colorByPoint: true
    }],
    legend: {
        enabled: false
    },
    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                chart: {
                    width: 400,
                    height: 300
                },
                yAxis: {
                    labels: {
                        align: 'left',
                        x: 0,
                        y: -5
                    },
                    title: {
                        text: null
                    }
                },
                subtitle: {
                    text: null
                },
                credits: {
                    enabled: false
                }
            }
        }]
    }
});
</script>