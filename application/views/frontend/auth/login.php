<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Вход в панель Администратора</div>
        <div class="card-body">
            <form action="/auth/login" method="post">
                <div class="form-group">
                    <label for="login">Логин</label>
                    <input class="form-control" id="login" type="text" name="login" placeholder="Введите логин">
                    <div class="invalid-feedback"></div>
                </div>
                <div class="form-group">
                    <label>Пароль</label>
                    <input class="form-control" type="password" name="password" placeholder="Введите пароль">
                </div>
                <button type="submit" class="btn btn-primary btn-block" value="Вход">Вход</button>
            </form>
        </div>
    </div>
</div>