<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>
<body>
<br>
<div class="container">
    <div class="row">
        <div id="loadData"></div>
    </div>
    <div class="row">
        <form style="width: 100%" method="post" onsubmit="sendData();return false;" id="formNews" >
            <div class="form-group row">
                <label for="title" class="col-md-2 col-form-label">Название книги</label>
                <div class="col-md-10">
                    <input
                            type="text"
                            class="form-control"
                            id="title"
                            name="title"
                            value=""
                    >
                    <div class="invalid-feedback"></div>
                </div>
            </div>

            <div class="form-group row">
                <label for="annotation" class="col-md-2 col-form-label">Краткое описание</label>
                <div class="col-md-10">
                    <textarea
                            name="annotation"
                            id="annotation"
                            class="form-control"
                            cols="30"
                            rows="10"></textarea>
                    <div class="invalid-feedback"></div>
                </div>
            </div>

            <div class="form-group row">
                <label for="author" class="col-md-2 col-form-label">Автор</label>
                <div class="col-md-10">
                    <input
                            type="text"
                            class="form-control"
                            id="author"
                            name="author"
                            value=""
                    >
                    <div class="invalid-feedback"></div>
                </div>
            </div>

            <div class="form-group row">
                <label for="date" class="col-md-2 col-form-label">Дата публикации</label>
                <div class="col-md-10">
                    <input
                            type="date"
                            class="form-control"
                            id="date"
                            name="date"
                            value=""
                    >
                    <div class="invalid-feedback"></div>
                </div>
            </div>

            <div class="form-group row">
                <label for="category" class="col-md-2 col-form-label">Категория</label>
                <div class="col-md-10">
                    <select id="category" class="form-control" name="category">
                        <option disabled selected>Выберете категорию из списка..</option>
                        <option value="1">Спорт</option>
                        <option value="2">Культура</option>
                        <option value="3">Политика</option>
                    </select>
                    <div class="invalid-feedback"></div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </div>
            </div>
        </form>


<style>
    .error{border-color:red;}
    li{
        background-color: #ffff99;
        margin-bottom: 5px;
        padding: 8px;
    }
</style>

<script type="text/javascript">
    $('#loadData').load('getdata.php');
    function sendData()
    {
        let form = '#formNews';
        let dataForm = $(form).serialize();
        $('*', form).removeClass('error');
        $('.invalid-feedback').empty();

        $.ajax({
            url: 'form.php', //куда отправить данные
            type: 'POST',
            dataType: 'json',
            data: dataForm, // данные для отправки
            success: function(responce){//метод который выполняется когда
                //пришел ответ от сервера
                console.log(responce);
                for(key in responce)
                {
                    $(`[name="${key}"]`, form).addClass('error');
                    $(`[name="${key}"]`, form).siblings('.invalid-feedback')
                        .html( responce[key]
                            .join("<br>") )
                            .show();
                }
            }
        })
        window.location.reload();
    }
</script>
    </div>
</div>
</body>
</html>