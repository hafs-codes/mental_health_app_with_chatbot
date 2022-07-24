<!DOCTYPE html>

<head>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <style>
        .wrapper {
            border: 5px solid white;
       
            background: white;
            width: 70%;
            height:50%;
           margin-left: 200px;
         margin-top: 200px;
       top: 50%;
       left: 50%;
            border-radius: 10px;
        overflow: hidden;
         
           
        }
        .wrapper div{
            padding: auto;
            border: solid #5caf8f;
            border-radius: 20px;
            overflow: hidden;
        }
        body{
            background: #5caf8f;
        }
        input{
            width: 100%;
            border: none;
            padding: 5px;
        }
        label{
            padding: 10px;
        }
        .title{
            border: none;
            size: 70px;
        }
    </style>
</head>

@extends('navbar')

@section('content')
<body>




    <div class="wrapper">
        <div class="title" style="border:none;text-align:center;"><h2>Q/A chatbot</h2></div>
        <div class="insidebox">
        <form id="register" action="#">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label for="mindlychatbot"><b>mindly chatbot:</b></label>
            <br><br>
            <input type="text" id="postRequestData"></input>
            <br><br>
            <label>you:</label>
            <br>
            <input id="firstname">
            <input type="submit" class="btn btn-primary" value="Send">
        </form>
    </div>
    </div>

    <div id="getRequestData"></div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {

        $('#getRequest').click(function() {
            //    $.get('getRequest',function(data){
            //     $('#getRequestData').append(data);
            //     // console.log(data);
            //    })
            $.ajax({
                type: "GET",
                url: "getRequest",
                success: function(data) {
                    console.log(data);
                    $('#getRequestData').append(data);

                }
            });
        });

    });

    $('#register').submit(function() {
        var fname = $('#firstname').val();
        // $.post('register',{firstname:fname,lastname:lname},function(data){
        //     console.log(data);
        //     $('#postRequestData').append(data);
        // });
        // var dataString = "firstname" + fname + "&lastname" + lname;
        var dataString = {
            firstname: fname
        };
        $.ajax({
            type: "POST",
            url: "chatbot",
            data: dataString,

            success: function(data) {
                // console.log(data);
                $botresponse = data;
                console.log($botresponse);             
                $("#postRequestData").val(data);
                document.getElementById("firstname").value = "";


            },
            error: function() {
                $("#postRequestData").val("could you repeat that");
              
            }
        });


    });
    $("#firstname").empty();
</script>

</html>
@endsection