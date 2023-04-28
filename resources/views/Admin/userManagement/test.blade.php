<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <style>
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 100px;
        }

        input {
            margin: 10px;
            padding: 5px;
            width: 300px;
            border: none;
            border-radius: 5px;
            box-shadow: 0px 0px 5px #ccc;
        }

        button {
            padding: 10px;
            width: 100px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <form>
        <input type="email" id="email" placeholder="Email">
        <input type="password" id="password" placeholder="Password">
        <button type="submit">Login</button>
    </form>
</body>

<script>
    const form = document.querySelector('form');
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const response = await fetch(
            'http://127.0.0.1:8000/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    email: email,
                    password: password
                })
            });
        const data = await response.json();
        localStorage.setItem('access_token', data.access_token);
        console.log(data);
    });
</script>

</html>
