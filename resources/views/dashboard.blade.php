@extends('layouts.master')

@section('addCss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
@endsection

@section('content')

<div class="content-wrapper">
  <div class="container-fluid">
    <div class="container-fluid mt-4">
      <div class="row">

          <!-- Kartu Statistik -->
          <div class="col-md-3 mb-3">
              <div class="card bg-primary text-white">
                  <div class="card-body d-flex align-items-center">
                      <i class="fas fa-chalkboard-teacher fa-2x mr-3"></i>
                      <div>
                          <h5 class="card-title">Teachers</h5>
                          <p class="card-text">{{ $data['teachers'] }}</p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-md-3 mb-3">
              <div class="card text-white bg-success">
                  <div class="card-body d-flex align-items-center">
                      <i class="fas fa-user-graduate fa-2x mr-3"></i>
                      <div>
                          <h5 class="card-title mb-0">Students</h5>
                          <p class="card-text">{{ $data['students'] }}</p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-md-3 mb-3">
              <div class="card text-white bg-info">
                  <div class="card-body d-flex align-items-center">
                      <i class="fas fa-school fa-2x mr-3"></i>
                      <div>
                          <h5 class="card-title mb-0">Classes</h5>
                          <p class="card-text">{{ $data['class'] }}</p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card text-white bg-warning">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-money-bill-wave fa-2x mr-3"></i> <div>
                        <h5 class="card-title mb-0">Payments</h5> <p class="card-text">Rp. {{ $data['total_payments'] }}</p> 
                    </div>
                </div>
            </div>            
          </div>
      </div>

      <!-- Form Tambah Acara dan Pengaturan Notifikasi -->
      <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Academic Calendar
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addEventModal">Add Event</button>
                    <button type="button" class="btn btn-danger float-right mr-2" id="deleteEventsBtn">Delete Events</button>
                </div>
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
            
        </div>
          <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header bg-dark text-white">Add Notification</div>
                <div class="card-body">
                    <form action="{{ route('store.notification') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="notificationMessage">Notification Content:</label>
                            <textarea class="form-control" id="notificationMessage" name="notificationMessage" rows="3" placeholder="Enter notification content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header bg-dark text-white">Latest Notifications</div>
                <ul class="list-group list-group-flush">
                    @foreach ($data['notifications'] as $notification)
                        <li class="list-group-item">
                            <i class="fas fa-bell text-info mr-2"></i>{{ $notification->content }}
                            <form action="{{ route('delete.notification', $notification->id) }}" method="POST" class="float-right">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
      </div>
    </div>

    <div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEventModalLabel">Add Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="eventFormModal">
                        <div class="form-group">
                            <label for="eventTitleModal">Event Title:</label>
                            <input type="text" class="form-control" id="eventTitleModal" placeholder="Enter event title">
                        </div>
                        <div class="form-group">
                            <label for="eventDateModal">Event Date:</label>
                            <input type="date" class="form-control" id="eventDateModal">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitEvent">Save</button>
                </div>
            </div>
        </div>
    </div>



  </div>
</div>
</div>

@endsection


@section('addJavascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
<script>
$(document).ready(function () {
    // Inisialisasi FullCalendar
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        events: '{{ route("events.fetch") }}', // Panggil route untuk mengambil event
        editable: true,
        selectable: true,
        selectHelper: true,
        eventRender: function(event, element) {
            element.popover({
                title: event.title,
                placement: 'top',
                content: 'Event Date: ' + moment(event.start).format('YYYY-MM-DD')
            });
        },
        eventClick: function(event) {
            // Tambahkan logika untuk menangani klik event jika dibutuhkan
        }
    });

    // Fungsi untuk menangkap event form modal dan menyimpan ke database
    $('#submitEvent').click(function() {
        var title = $('#eventTitleModal').val();
        var eventDate = $('#eventDateModal').val();

        $.ajax({
            url: '{{ route("events.store") }}',
            type: 'POST',
            data: {
                title: title,
                event_date: eventDate,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log(response);
                $('#addEventModal').modal('hide');
                $('#calendar').fullCalendar('refetchEvents'); // Refresh kalender setelah menyimpan event
            },
            error: function(error) {
                console.error(error);
            }
        });
    });

    // Fungsi untuk menghapus semua event dari kalender
    $('#deleteEventsBtn').click(function() {
        if (confirm('Are you sure you want to delete all events?')) {
            $.ajax({
                url: '{{ route("events.delete.all") }}',
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log(response);
                    $('#calendar').fullCalendar('removeEvents'); // Hapus semua event dari kalender
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }
    });

    // Fungsi untuk mengambil event dari server
    function fetchEvents(start, end, timezone, callback) {
        $.ajax({
            url: '{{ route("events.fetch") }}',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var events = [];
                $.each(response, function(index, event) {
                    events.push({
                        title: event.title,
                        start: event.start // event.start sudah sesuai dengan format yang digunakan FullCalendar
                    });
                });
                callback(events);
            },
            error: function(error) {
                console.error(error);
            }
        });
    }
});
</script>
@endsection
