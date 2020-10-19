<!doctype html>
<html>
 
<head>
    <meta charset="UTF-8">
    <title>status</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
 
<body>
 
    
    <select class="form-control" name="" id="" style="width: 150px;">
        <option>Change Status</option>
        <option class="get_value" value="F">Fixed</option>
        <option class="get_value" value="D">Deferred</option>
        <option class="get_value" value="R">Rejected</option>
    </select>
    
    <br/>
    <button class="btn btn-danger" type="button" name="submit" id="submit" onClick="window.location.reload();">Update</button>
    <br/>
    <h4 id="result"></h4>
    
    <script>

        $(document).ready(function() {
            $('#submit').click(function() {
                var insert = [];
                $('.get_value').each(function() {
                    if ($(this).is(":checked")) {
                        insert.push($(this).val());
                    }
                });
                insert = insert.toString();
                $.ajax({
                    url: "backendfiles/dev_update_db.php",
                    method: "POST",
                    data: {
                        insert: insert
                    },
                    success: function(data) {
                        $('#result').html(data);
                    }
                });
            });
        });
    </script>
   
</body>
 
</html>