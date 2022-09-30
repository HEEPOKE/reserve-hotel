@extends('adminlte::page')
@section('content')
    <div class="container-fluid calendarbottom">
        <div class="card">
            <div id="calendar"></div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {

                locale: 'th',
                timeZone: 'Asia/Bangkok',
                titleFormat: {
                    month: 'long',
                    year: 'numeric',
                    day: 'numeric'
                },
                editable: true,
                selectable: true,
                nowIndicator: true,
                aspectRatio: 1.8,
                scrollTime: '00:00',
                height: 880,
                headerToolbar: {
                    left: 'today prev,next',
                    center: 'title',
                    right: 'resourceTimelineDay,resourceTimelineMonth'
                },
                initialView: 'resourceTimelineMonth',
                resourceAreaHeaderContent: 'ห้องพัก',
                resources: [
                    @foreach ($room_company as $room)
                        {
                            id: '{{ $room->room_name }}',
                        },
                    @endforeach
                ],
                events: [
                    @foreach ($customers_reserve as $customer)
                        {
                            id: '{{ $customer->room_name }}',
                            resourceId: '{{ $customer->room_name }}',
                            start: '{{ $customer->start_in_room }}',
                            end: '{{ $customer->end_in_room }}',
                            title: '{{ $customer->first_name }}',
                            @if ($customer->stay_status == '0')
                                color: 'yellow',
                                textColor: 'black'
                            @elseif ($customer->stay_status == '1')
                                color: 'green',
                            @elseif ($customer->stay_status == '2')
                                color: 'red',
                            @endif
                        },
                    @endforeach
                ]
            });

            calendar.render();
        });
    </script>
@endsection
