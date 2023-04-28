<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="post" action="{{ route('from') }}" enctype="multipart/form-data">
        @csrf
        <input name="image" type="file">

        <div class="col-md-6">
            <button type="submit" class="btn btn-success">Upload</button>
        </div>
        <div class="img">
            <img src="https://drive.google.com/uc?id=1cM2LQRKwaLR08ZyE_kWLlBXMF3JlAZpk&export=media" alt="">
        </div>
    </form>
</body>
</html>
