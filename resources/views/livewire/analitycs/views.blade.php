<div>
    <select id="post_by"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[20%] p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        wire:model.live="postBy">
        <option value="days">Days</option>
        <option value="weeks">Weeks</option>
        <option value="year">Year</option>
    </select>
    <div id="chart"></div>
    @push('script')
        <script>
            document.addEventListener('livewire:load', function() {
                console.log(@js($postByName));
                var options = {
                    series: [{
                        name: 'Views per days',
                        data: @json(array_column($postByName, 'views'))
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
                        categories: @json(array_column($postByName, 'date')),
                    },
                    yaxis: {
                        title: {
                            text: 'views'
                        }
                    },
                    fill: {
                        opacity: 1,
                        colors: ['#f43f5e']
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return val
                            }
                        }
                    }
                };

                var chart = new ApexCharts(document.querySelector("#chart"), options);
                chart.render();
                
                @this.on(`refreshChartData`, (chartData) => {
                    chart.updateOptions({
                        xaxis: {
                            categories: chartData.map(item => item.date)
                        }
                    });
                    chart.updateSeries([{
                        data: chartData.map(item => item.views),
                    }]);
                });
                
            })
        </script>
    @endpush
</div>
