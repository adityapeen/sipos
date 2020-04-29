<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" href="dk.png">
    <title>Dewan Autocomplete - www.dewankomputer.com</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>
        ul {
            background-color: #eee;
            cursor: pointer;
            position: absolute;
            width: 95%;
        }

        li {
            padding: 12px;
            border: thin solid #F0F8FF;
        }

        li:hover {
            background-color: #7FFFD4;
        }
    </style>
</head>

<body class="bg-light">
    <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand text-white" href="index.php">
            Dewan Komputer
        </a>
    </nav>

    <div class="container">
        <h3 align="center" class="mt-3 mb-5">Dewan Autocomplete pada Textbox Menggunakan Ajax</h3>
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <label>Nama Provinsi</label>
                <input type="text" name="provinsi" id="provinsi" class="form-control" placeholder="Tulis Nama Provinsi Indonesia" />
                <div id="provinsiList"></div>
            </div>
        </div>
    </div>

    <div class="fixed-bottom text-center mt-5">© <?php echo date('Y'); ?> Copyright:
        <a href="https://dewankomputer.com/"> Dewan Komputer</a>
    </div>
</body>

</html>
<script>
    $(document).ready(function() {
        $('#provinsi').keyup(function() {
            var query = $(this).val();
            if (query != '') {
                $.ajax({
                    url: "<?= base_url('user/get_autocomplete'); ?>",
                    method: "GET",
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#provinsiList').fadeIn();
                        $('#provinsiList').html(data);
                    }
                });
            }
        });
        $(document).on('click', 'li', function() {
            $('#provinsi').val($(this).text());
            $('#provinsiList').fadeOut();
        });
    });

    
</script>