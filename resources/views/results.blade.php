<!DOCTYPE html>
<html>
<head>
    <title>Thanaweya Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 20px;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            text-align: center;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #428bca;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #3071a9;
        }

        #resultsContainer {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            display: none;
        }

        #resultsContainer h2 {
            color: #333;
            margin-bottom: 10px;
        }

        #resultsContainer ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        #resultsContainer li {
            margin-bottom: 10px;
        }

        #resultsContainer span {
            font-weight: bold;
        }

        .error-message {
            color: #d9534f;
            text-align: center;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <h1>Thanaweya Results</h1>
    <form id="resultsForm">
        <label for="seatingNo">Enter Seating Number:</label>
        <input type="text" id="seatingNo" name="seating_no" required>
        <button type="submit">Get Results</button>
    </form>
    <div id="resultsContainer">
        <h2>Results:</h2>
        <ul>
            <li><span>Name:</span> <span id="name"></span></li>
            <li><span>Marks:</span> <span id="marks"></span></li>
            <li><span>Percentage:</span> <span id="percentage"></span></li>
            <li><span>School:</span> <span id="school"></span></li>
            <li><span>State:</span> <span id="state"></span></li>
            <li><span>Department:</span> <span id="dept"></span></li>
        </ul>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#resultsForm").submit(function(e) {
                e.preventDefault();
                const seatingNo = $("#seatingNo").val();
                getThanaweyaResults(seatingNo);
            });

            function getThanaweyaResults(seatingNo) {
                $.ajax({
                    url: "/get-natega",
                    type: "POST",
                    data: { seating_no: seatingNo ,_token:"{{csrf_token()}}"},
                    success: function(data) {
                        displayResults(data);
                    },
                    error: function(xhr, status, error) {
                        const errorMessage = JSON.parse(xhr.responseText).error;
                        alert(`Error: ${errorMessage}`);
                    }
                });
            }

            function displayResults(data) {
                $("#name").text(data.name);
                $("#marks").text(data.marks);
                $("#percentage").text(data.percentage);
                $("#school").text(data.school);
                $("#state").text(data.state);
                $("#dept").text(data.dept);
                $("#resultsContainer").show();
            }
        });
    </script>
</body>
</html>