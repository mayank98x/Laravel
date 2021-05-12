
<html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Event Page</title>
      <meta name="csrf-token" content="{{ csrf_token() }}">
      
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.2/moment.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.1.1/fullcalendar.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
  
    </head>
    <body>
    <h1 style="text-align:center;"><a href="/events" > {{ ($role) }} Calendar</a></h1>
  
      <div class="container">
        <div class=" jumbotron">
          <div class="row">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <p> {{ \session::get('success')}} </p>
                    </div>
                @endif
              <a href="/form" class="btn btn-success"> Add Events </a> 
              <a href="/events" class="btn btn-warning"> Student</a>
          </div>
    <br>
          <div class="row" id="calendar">
                       {{-- {!! $calendar->calendar() !!} --}}
                        </div>
                      </div>
                </div>
          </div>
        </div>
      </div>
    
      <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h4>Edit Events Slot</h4>
                    <div class="row">
                      <button class="btn btn-danger" id="delete" value="">DELETE</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
    
    
    
        $(document).ready(function() {
          $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
                    $('#calendar').fullCalendar({
                        "header": {
                            "left": "prev,next today",
                            "center": "title",
                            "right": "month,agendaWeek,agendaDay"
                        },
    
                        "eventLimit": true,
                        events : [
                        @foreach($slots as $slot)
                        {
                            id : '{{ $slot->id}}',
                            title : '{{ $slot->title }}',
                            start : '{{ $slot->start }}',
                            end: '{{ $slot->end }}',
                            color : '{{ $slot->color }}'
                        },
                        @endforeach
                    ],
                        eventClick: function(calEvent, jsEvent, view) {

                          $('#delete').val(calEvent.id);
                          id =calEvent.id;
                         
                         $('#editModal').modal();
                    $('#delete').click(function() {
                      console.log(calEvent);
                      // const id=$(this).val()
                         console.log(id);
                  // console.log($(this).val());
                      
                    $.ajax({
                        type: "POST",
                        url:'ajax-delete', 
                        dataType: "json",  
                        data: {id: id },
                        success: function (response) {
                        console.log(response);
                        if(response !== undefined) {
                            $('#calendar').fullCalendar('removeEvents', calEvent._id);
                            displayMessage("Event Deleted Successfully");
                        }
                        },
                        error: function (request,status,errorThrown) {
                        console.log(status, errorThrown);
                        }
                    });
                    });
                        },
                    });
                    });
                function displayMessage(message) {
                  // toastr.options.timeOut = 2000;
                toastr.success(message, 'Event');
                toastr.clear();
                }     
    </script>
 
    </body>
    </html>