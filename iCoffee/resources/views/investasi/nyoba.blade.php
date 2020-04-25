<html>
<head>
    <meta charset="utf-8">
    <title>Wizard-v1</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet/less" type="text/css" href="investasi/css/gambar.less" />
</head>
<body>
    <div class="container">
        <form action="/daftar-mitra-nyoba" method="POST" enctype="multipart/form-data">
        @csrf
        <h1>jQuery Image Upload 
            <small>with preview</small>
        </h1>
        <div class="avatar-upload">
            <div class="avatar-edit">
                <input type='file' id="imageUpload" name="gambar" accept=".png, .jpg, .jpeg" />
                <label for="imageUpload"></label>
            </div>
            <div class="avatar-preview">
                <div id="imagePreview" style="background-image: url(https://cdn2.iconfinder.com/data/icons/user-icon-2-1/100/user_5-15-512.png);">
                </div>
            </div>
        </div>
        <button type="submit">Daftar Koperasi</button>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageUpload").change(function() {
        readURL(this);
    });
    </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.9.0/less.min.js" ></script>
</body>
</html>
