<!-- <!DOCTYPE html>
<html>

<head>
    <title>JQuery UI Part 5 : Membuat Form Autocomplete Dengan JQuery UI</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <h1>Membuat Form Autocomplete Dengan JQuery UI | www.malasngoding.com</h1>

    <div class="form-control">
        <p>Your Skills: <input type="text" id="skill_input" /></p>
    </div>

</body>
<script>
    $(function() {
        $("#skill_input").autocomplete({
            source: "<?php echo base_url('user/get_autocomplete'); ?>",
            select: function(event, ui) {
                event.preventDefault();
                $("#skill_input").val(ui.item.id);
            }
        });
    });
</script>

</html> -->

<html>

<!-- demo of a jquery autocomplete widget using a php json data source -->

<head>
    <!-- (1) include the jquery css and javascript we need (load them from google urls) -->
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

    <!-- (2) define two jquery functions we need (default input focus, and autocomplete) -->
    <script>
        // (a) put default input focus on the state field
        $(document).ready(function() {
            $('#state').focus();
        });

        // (b) jquery ajax autocomplete implementation
        $(document).ready(function() {
            // tell the autocomplete function to get its data from our php script
            $('#state').autocomplete({
                source: "<?php echo base_url('user/get_autocomplete'); ?>"
            });
        });
    </script>
</head>

<!-- (3) very basic html body for our example -->

<body>
    <label for="state">State:</label>
    <input id="state" name="state" />
</body>

</html>