import './bootstrap';
import Chart from 'chart.js/auto';


import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const ctx = document.getElementById('studyChart');
if(ctx) {
    fetch('/chart/sessions')
        .then(response => response.json())
        .then(data => {
            new Chart(ctx, {
                type: 'line',
                
                data: {
                    labels: data.labels, // Days of the week
                    datasets: [{
                        label: 'Study Sessions (minutes)',
                        data: data.data,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                    }]
                },
                options: {
                    animation: false,
                    tooltip: {
                        enabled: true,
                    },
                    scales: {
                        x: {
                        title: {
                            display: true,
                            text: 'Days of the Week',
                            color: '#333',
                        }
                    },
                        y: {
                            title: {
                                display: true,
                                text: 'Minutes',
                                color: '#333',
                            },
                            beginAtZero: true,
                    },
                    }
                
                }
                
            })
        })
   
}

