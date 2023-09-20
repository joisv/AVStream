<div>
    <select id="post_by"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[20%] p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        wire:model.live="postBy">
        <option value="days">Days</option>
        <option value="weeks">Weeks</option>
        <option value="year">Year</option>
    </select>
    <div id="user_chart"></div>
    @push('script')
        <script>
            document.addEventListener('livewire:load', function() {

                var options = {
                    series: [{
                        name: 'Registered user',
                        data: @js($postByName['data'])
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
                        categories: @js($postByName['date']),
                    },
                    yaxis: {
                        title: {
                            text: 'Today Registered user'
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

                var chart = new ApexCharts(document.querySelector("#user_chart"), options);
                chart.render();
                
                @this.on(`refreshChartData`, (chartData) => {
                    chart.updateOptions({
                        xaxis: {
                            categories: chartData['date']
                        }
                    });
                    chart.updateSeries([{
                        data: chartData['data'],
                    }]);
                });
                
            })
        </script>
    @endpush
</div>
