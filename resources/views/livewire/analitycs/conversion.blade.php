<div>
    <select id="post_by"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[20%] p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        wire:model="postBy">
        <option value="days">Days</option>
        <option value="weeks">Weeks</option>
        <option value="year">Year</option>
    </select>
    <div id="conversion_chart"></div>
    @push('script')
        <script>
            document.addEventListener('livewire:load', function() {
                
                var options = {
                    series: [{
                        name: 'Conversion rate percentage',
                        data: @js($conversions['conversion_rate'])
                    }],
                    chart: {
                        type: 'bar',
                        height: 350
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '55%',
                            endingShape: 'rounded'
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    xaxis: {
                        categories: @js($conversions['date']),
                    },
                    yaxis: {
                        title: {
                            text: 'Conversion rates'
                        }
                    },
                    fill: {
                        opacity: 1,
                        colors: ['#111827']
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return val
                            }
                        }
                    }
                };

                var chart = new ApexCharts(document.querySelector("#conversion_chart"), options);
                chart.render();
                
                @this.on(`refreshChartData`, (chartData) => {
                    chart.updateOptions({
                        xaxis: {
                            categories: chartData['date']
                        }
                    });
                    chart.updateSeries([{
                        data: chartData['conversion_rate'],
                    }]);
                });
                
            })
        </script>
    @endpush
</div>
