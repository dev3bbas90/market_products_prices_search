<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HEFNAWY</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.dataTables.min.css')}}">
</head>

<body>

    <br>
    <h1>Data Table</h1>
    <br>
    <table id="table_id" class="display">
        <thead>
            <tr>
                <th>Column 1</th>
                <th>Column 2</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Row 1 Data 1</td>
                <td>Row 1 Data 2</td>
            </tr>
            <tr>
                <td>Row 2 Data 1</td>
                <td>Row 2 Data 2</td>
            </tr>
        </tbody>
    </table>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });
    </script>

</body>

</html>
