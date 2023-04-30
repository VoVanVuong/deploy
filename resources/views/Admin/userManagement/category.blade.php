<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng video mới</title>
</head>

<body>
    <h1>Đăng video mới</h1>
    <form action="{{ route('post-video') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="title">Tiêu đề:</label>
            <input type="text" name="title" id="title">
        </div>
        <div>
            <label for="description">Mô tả:</label>
            <textarea name="description" id="description"></textarea>
        </div>
        <div>
            <label for="video">Video:</label>
            <input type="file" name="video" id="video">
        </div>
        <button type="submit">Đăng</button>
    </form>
</body>

</html>
