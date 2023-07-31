<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>نتيجة الثانوية العامة</title>
    <link rel="stylesheet" type="text/css" href="https://nafezly.com/css/cust-fonts.css">
    <link rel="stylesheet" type="text/css" href="https://nafezly.com/css/responsive-font.css">
    <link rel="stylesheet" type="text/css" href="https://nafezly.com/css/fontawsome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <script src="https://unpkg.com/vue@next"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <style type="text/css">
        *{
            direction: rtl;
        }
    </style>
    <div class="container p-3">
        <form onsubmit="event.preventDefault()" >
        <h1 class="mb-3">أدخل رقم الجلوس</h1>
        <input type="number" name="seating_no"  class="form-control mb-3" style="width:500px;max-width:100%" placeholder="مثال : 123456" id="seating_no" required>
        <button class="btn btn-success mb-3" id="get-result">عرض النتيجة</button>
        </form>
    </div>
    <iframe id="response" style="border: none;box-shadow: none;width: 100%;height: 800px;direction: rtl;text-align: right;">
        
    </iframe>
    <script type="text/javascript">
        $('#get-result').on('click',function()
        {
            $.ajax({
                url:"{{route('get-result')}}",
                method:"GET",
                data:{seeting_no:$('#seating_no').val()}
            }).done(function(res){
                //console.log(res); 
                $('#response').contents().find('body').append('<style type="text/css">*{direction:rtl;}</style>');
                $('#response').contents().find('body').html(res);
                
                //$('#response').empty().append(res);
            }); 
        });
    </script>
</body>
</html>