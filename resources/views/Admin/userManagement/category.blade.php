<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Đăng danh mục</title>
</head>

<body>
    <h1>Đăng danh mục</h1>

    <form id="category-form">
        <div>
            <label for="category-name">Tên danh mục:</label>
            <input type="text" id="category-name" name="tenDanhMuc">
            <label for="category-name">Tên danh mục:</label>
            <input type="text" id="category-mota" name="moTa">
        </div>
        <div>
            <button type="submit">Đăng danh mục</button>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#category-form').submit(function(event) {
                event.preventDefault();

                var categoryName = $('#category-name').val();
                var categorymota = $('#category-mota').val();

                var data = {
                    tenDanhMuc: categoryName,
                    moTa: categorymota
                };

                $.ajax({
                    url: 'http://127.0.0.1:8000/api/post/category',
                    method: 'POST',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Authorization': 'Bearer ' + localStorage.getItem('access_token')
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
</body>

</html>
