<!doctype html>
<html lang = "en">
<head>
    <meta charset = "utf-8">
    <title>ASSESSMENT</title>
    <link href = "css/jquery.css" rel = "stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js" integrity="sha256-6XMVI0zB8cRzfZjqKcD01PBsAy3FlDASrlC8SxCpInY=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Javascript -->
    <script>
        $(function() {
            $( "#currencies" ).autocomplete({
                source: "currencyList.php",
                minLength: 2
            })
        });
    </script>
</head>

<body style="padding: 20px">

<div class="adding">
    <label for="currencies" style="padding-right: 15px">Search:</label>
    <input id = "currencies" /> <br /><br />
    <button class="btn btn-primary update add">ADD</button>
    <span class="warning"></span>
</div>

<div class="editing">

    <label for="currencyEditTicker" style="padding-right: 15px">Ticker: </label><input id="currencyEditTicker" readonly /><br /><br />
    <label for="currencyEdit" style="padding-right: 15px">Edit watchlist value:</label><input id="currencyEdit" /><br /> <br />
    <button class="btn btn-primary update">Update</button> <button class="btn btn-danger cancel">Cancel</button><br />
    <span class="warningEdit"></span>

</div>

<div class="generalMsg"><span class="message"></span></div>


<div class="tableDiv" style="padding-top: 100px">

    <table class="table table-bordered" style="width: 50%">
        <thead>
            <tr>
                <th>Ticker</th>
                <th>Value</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php

            include 'dbConnect/dbConnect.php';
            $results = $con->query("SELECT * FROM table_user_watchlist WHERE user_id = 1");
            if($results->rowCount() < 1) { echo '<tr><td colspan="3">No Data</td></tr>';}
            while($row = $results->fetch()){

                $rowId = $row['sTicker'];

                echo '<tr id="'.$rowId.'">';
                    echo '<td>'.$row['sTicker'].'</td>';
                    echo '<td>'.$row['sValue'].'</td>';
                    echo '<td><input class="btn btn-warning edit" value="Edit" type="button" style="margin-right: 25px"/><input class="btn btn-danger remove" value="Remove" type="button" /></td>';
                echo '</tr>';
            }
        ?>
        </tbody>
    </table>

</div>

</body>
</html>

<script>
    $(function (){

        $('.editing').hide();
        let mainTable = $(".table");

        //Adding
        $('.add').click(function (){

            let currencySearchBox = $('#currencies');
            let currencyType = $('#currencies').val();
            let spanWarning = $('.warning');
            let lenSpanWarning = spanWarning.find("span").text();

            currencySearchBox.on('input', function (){
                spanWarning.text('')
            })

            if(currencyType !== ''){
                $.confirm({
                    title: 'Request',
                    content: 'Are you sure you want to add this to your watchlist?',
                    buttons: {
                        confirm: {
                            text: 'ADD',
                            btnClass: 'btn-green',
                            keys: ['enter', 'shift'],
                            action: function(){
                                $.post( "scripts/user-watchlist.php", { tickerVal: currencyType, typeRequest: "add" }, function( data ) {

                                    let dataResponse = $.trim(data);
                                    if(dataResponse === 'Successfully Added'){
                                        location.reload();
                                        spanWarning.text(data).css('color', 'green')
                                        currencySearchBox.empty()
                                    }else{
                                        spanWarning.text(data).css('color', 'red')
                                    }
                                });
                            }
                        },
                        cancel: {
                            text: 'CANCEL',
                            btnClass: 'btn-red',
                            keys: ['enter', 'shift']
                        }
                    }
                });

            }else{
                spanWarning.text("Please search currency pair before trying to add").css('color', 'red');
            }

        })

        //Editing
        mainTable.on('click','.edit',function(){

            function show(){
                $('.adding').hide();
                $('.editing').show();
            }

            show();

            let spanWarning = $('.warningEdit');
            let cancelBtn = $('.cancel');
            let updateBtn = $('.update');

            // get the current row
            let currentRow = $(this).closest("tr");
            let ticker = currentRow.find("td:eq(0)").text();
            let tickerVal = currentRow.find("td:eq(1)").text();

            if(ticker !== '' && tickerVal !== ''){
                $('#currencyEdit').val(tickerVal)
                $('#currencyEditTicker').val(ticker)

                cancelBtn.click(function (){
                    $('.adding').show();
                    $('.editing').hide();
                })

                updateBtn.click(function(e){

                    e.stopImmediatePropagation();

                    let updatedVal = $('#currencyEdit').val()
                    let newValSet = $('#currencyEdit').val()

                    //Verify Interger or Decimal
                    if(!$.isNumeric(updatedVal)){
                        $('#currencyEdit').empty();
                        spanWarning.text("Only Numbers are allowed, please try again").css('color', 'red');
                    }else{
                        $.confirm({
                            title: 'Request',
                            content: 'Are you sure you want to edit this ticker value?',
                            buttons: {
                                confirm: {
                                    text: 'Continue',
                                    btnClass: 'btn-green',
                                    keys: ['enter', 'shift'],
                                    action: function(){
                                        $.post( "scripts/user-watchlist.php", { ticker: ticker, tickerVal: newValSet, typeRequest: "edit" }, function( data ) {

                                            let dataResponse = $.trim(data);
                                            if(dataResponse === 'Successfully Edited'){
                                                location.reload();
                                                spanWarning.text(data).css('color', 'green')
                                            }else{
                                                spanWarning.text(data).css('color', 'red')
                                            }
                                        });
                                    }
                                },
                                cancel: {
                                    text: 'CANCEL',
                                    btnClass: 'btn-red',
                                    keys: ['enter', 'shift']
                                }
                            }
                        });
                    }
                })

            }else{
                alert('Oops something went wrong')
            }

        });

        //Removing
        mainTable.on('click','.remove',function(){

            let spanWarning = $('.message');

            // get the current row
            let currentRow = $(this).closest("tr");
            let ticker = currentRow.find("td:eq(0)").text();

            if(ticker !== ''){
                $.confirm({
                    title: 'Request',
                    content: 'Are you sure you want to remove this from your watchlist permanently?',
                    buttons: {
                        confirm: {
                            text: 'CONTINUE',
                            btnClass: 'btn-green',
                            keys: ['enter', 'shift'],
                            action: function(){
                                $.post( "scripts/user-watchlist.php", { ticker: ticker, typeRequest: "remove" }, function( data ) {

                                    let dataResponse = $.trim(data);
                                    if(dataResponse === 'Successfully Removed'){
                                        spanWarning.text(data).css('color', 'green')
                                        location.reload();
                                    }else{
                                        spanWarning.text(data).css('color', 'red')
                                    }
                                });
                            }
                        },
                        cancel: {
                            text: 'CANCEL',
                            btnClass: 'btn-red',
                            keys: ['enter', 'shift']
                        }
                    }
                });
            }else{
                alert('Try again')
            }


        });


    });
</script>