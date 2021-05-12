<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Event Calendar</title>
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet"
          href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous">
    </script>
   <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js" 
   type="text/javascript"></script>
</head>

<body>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('danger'))
        <div class="alert alert-danger">
            <h3>{{ $message }}</h3>
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <h1>Enter Event Details</h1>
        <div class=" jumbotron">

            <div class="row form">
                <form action="submit" method="post" id="event" >
                    @csrf
                    <Label>Enter Event Name</Label>
                    <br>
                    <div class="row col-md-8">
                        <input type="text" placeholder="Enter Event Name" id="title" name="title"
                               value="{{ old('title') }}" required>
                    </div>
                    <br><br>
                    <Label>Enter Starting Time</Label>
                    <br>
                    <div class="row col-md-8 ">
                        <input type="datetime-local" id="start" name="start"
                               value="{{ old('start') }} " required>
                    </div>
                    <br><br>
                    <Label>Enter End Time</Label>
                    <br>
                    <div class="row col-md-8">

                        <input type="datetime-local" id="end" name="end"
                               value="{{ old('end') }} " required>
                    </div>
                    <br><br>
                    <div class="row col-md-8">
                        <select name="time" id="time">
                            <option value="15">15 min</option>
                            <option value="30">30 min</option>
                        </select>
                    </div>
                    <table class="table table-bordered" id="dynamicTable">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date Of Birth</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <td><input type="text" name="field[0][name]"
                                       placeholder="Enter your Name" class="form-control"
                                       required /></td>
                            <td><input type="email" name="field[0][email]"
                                       placeholder="Enter your Email" class="form-control"
                                       required pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" />
                            </td>
                            <td><input type="date" name="field[0][DOB]" class="form-control"
                                       required /></td>
                            <td><button type="button" name="add" id="add"
                                        class="btn btn-success">Add More</button></td>
                        </tr>
                    </table>
                    <br><br>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var i = 0;
        $("#add").click(function() {
            ++i;
            $("#dynamicTable").append('<tr><td><input type="text" name="field[' + i +
                '][name]" placeholder="Enter your Name" class="form-control required" /></td><td><input type="email" name="field[' +
                i +
                '][email]" placeholder="Enter your Email" class="form-control" required pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}"/></td><td><input type="date" name="field[' +
                i +
                '][DOB]" class="form-control" required /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>'
                );
        });
        $(document).on('click', '.remove-tr', function() {
            console.log(this);
            // console.log((this).parents('tr'));            
            $(this).parents('tr').remove();
        });

        $("#event").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                email: {
                    required: "Please enter your email address.",
                }
            }
        });

    </script>
</body>

</html>
