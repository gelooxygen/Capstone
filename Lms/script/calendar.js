document.addEventListener('DOMContentLoaded', function() {
        // Initialize calendar in widget area
        var calendarWidget = document.getElementById('school-calendar-widget');
        var widgetCalendar = new FullCalendar.Calendar(calendarWidget, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            height: 'auto',
            events: [
                // Sample events - replace with your school events
                {
                    title: 'First Day of School',
                    start: '2024-06-01',
                    className: 'bg-success'
                },
                {
                    title: 'Parent-Teacher Conference',
                    start: '2024-07-15',
                    className: 'bg-primary'
                },
                {
                    title: 'Mid-Term Exams',
                    start: '2024-08-10',
                    end: '2024-08-14',
                    className: 'bg-warning'
                }
            ]
        });
        widgetCalendar.render();

        // Full Calendar Modal Trigger
        var viewFullCalendarBtn = document.querySelector('.btn-success');
        var calendarModal = new bootstrap.Modal(document.getElementById('calendarModal'));
        
        viewFullCalendarBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Initialize full modal calendar
            var fullCalendarEl = document.getElementById('fullCalendar');
            var fullCalendar = new FullCalendar.Calendar(fullCalendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                height: 'auto',
                events: [
                    // Comprehensive school events
                    {
                        title: 'First Day of School',
                        start: '2024-06-01',
                        className: 'bg-success'
                    },
                    {
                        title: 'Parent-Teacher Conference',
                        start: '2024-07-15',
                        className: 'bg-primary'
                    },
                    {
                        title: 'Mid-Term Exams',
                        start: '2024-08-10',
                        end: '2024-08-14',
                        className: 'bg-warning'
                    },
                    {
                        title: 'School Foundation Day',
                        start: '2024-09-01',
                        className: 'bg-info'
                    },
                    {
                        title: 'Final Exams',
                        start: '2024-12-10',
                        end: '2024-12-14',
                        className: 'bg-danger'
                    }
                ]
            });
            fullCalendar.render();
            
            // Show modal
            calendarModal.show();
        });
    });