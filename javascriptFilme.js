$(document).ready(function () {
    var page = 1;
    var current_page = 1;
    var total_page = 0;
    var is_ajax_fire = 0;
    var dataCon;
    createHeadTable();
    createForm();
    createEditForm();
    manageData();

    function manageData() {
        $.ajax({
            dataType: 'json',
            url: 'getFilme.php',
            data: { page: page }
        }).done(function (data) {
            total_page = Math.ceil(data.total / 10);
            current_page = page;

            $('#pagination').twbsPagination({
                totalPages: total_page,
                visiblePages: 5,
                onPageClick: function (event, pageL) {
                    page = pageL;
                    getPageData();
                }
            });

            manageRow(data.data);
            is_ajax_fire = 1;
        });
    }

    function getPageData() {
        $.ajax({
            dataType: 'json',
            url: 'getFilme.php',
            data: { page: page }
        }).done(function (data) {
            manageRow(data.data);
        });
    }

    function manageRow(data) {
        dataCon = data;
        var rows = '';
        var i = 0;
        $.each(data, function (key, value) {
            rows += '<tr>';
            rows += '<td>' + value.id + '</td>';
            rows += '<td>' + value.titulo + '</td>';
            rows += '<td>' + value.diretor + '</td>';
            rows += '<td>' + value.anoLancamento + '</td>';
            rows += '<td>' + value.genero + '</td>';
            rows += '<td>' + value.nota + '</td>';
            rows += '<td data-id="' + i++ + '">';
            rows += '<button data-toggle="modal" data-target="#edit-item" class="btn btn-primary edit-item">Editar</button> ';
            rows += '<button class="btn btn-danger remove-item">Deletar</button>';
            rows += '</td>';
            rows += '</tr>';
        });

        $("tbody").html(rows);
    }

    function createHeadTable() {
        var rows = '<tr>';
        rows += '<th>ID</th>';
        rows += '<th>Título</th>';
        rows += '<th>Diretor</th>';
        rows += '<th>Ano de Lançamento</th>';
        rows += '<th>Gênero</th>';
        rows += '<th>Nota</th>';
        rows += '<th width="200px">Ação</th>';
        rows += '</tr>';
        $("thead").html(rows);

        $("#filtro").attr("placeholder", "Entre com o título do filme");
    }

    function createForm() {
        var html = `
            <div class="form-group">
                <label class="control-label" for="titulo">Título</label>
                <input type="text" name="titulo" class="form-control" required />
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <label class="control-label" for="diretor">Diretor</label>
                <input type="text" name="diretor" class="form-control" required />
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <label class="control-label" for="anoLancamento">Ano de Lançamento</label>
                <input type="number" name="anoLancamento" class="form-control" required />
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <label class="control-label" for="genero">Gênero</label>
                <input type="text" name="genero" class="form-control" required />
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <label class="control-label" for="nota">Nota</label>
                <input type="number" name="nota" class="form-control" step="0.1" min="0" max="10" required />
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn crud-submit btn-success">Salvar</button>
            </div>
        `;
        $("#create-item").find("form").html(html);
    }

    function createEditForm() {
        var html = `
            <input type="hidden" name="id" class="edit-id">
            <div class="form-group">
                <label class="control-label" for="titulo">Título</label>
                <input type="text" name="titulo" class="form-control" required />
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <label class="control-label" for="diretor">Diretor</label>
                <input type="text" name="diretor" class="form-control" required />
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <label class="control-label" for="anoLancamento">Ano de Lançamento</label>
                <input type="number" name="anoLancamento" class="form-control" required />
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <label class="control-label" for="genero">Gênero</label>
                <input type="text" name="genero" class="form-control" required />
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <label class="control-label" for="nota">Nota</label>
                <input type="number" name="nota" class="form-control" step="0.1" min="0" max="10" required />
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn crud-submit-edit btn-success">Salvar</button>
            </div>
        `;
        $("#edit-item").find("form").html(html);
    }

    $(".crud-submit").click(function (e) {
        e.preventDefault();
        var form_action = $("#create-item").find("form").attr("action");
        var titulo = $("#create-item").find("input[name='titulo']").val();
        var diretor = $("#create-item").find("input[name='diretor']").val();
        var anoLancamento = $("#create-item").find("input[name='anoLancamento']").val();
        var genero = $("#create-item").find("input[name='genero']").val();
        var nota = $("#create-item").find("input[name='nota']").val();

        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: form_action,
            data: { titulo: titulo, diretor: diretor, anoLancamento: anoLancamento, genero: genero, nota: nota }
        }).done(function (data) {
            $("#create-item").find("input[name='titulo']").val('');
            $("#create-item").find("input[name='diretor']").val('');
            $("#create-item").find("input[name='anoLancamento']").val('');
            $("#create-item").find("input[name='genero']").val('');
            $("#create-item").find("input[name='nota']").val('');
            getPageData();
            $(".modal").modal('hide');
            toastr.success(data.msg, 'Alerta de Sucesso', { timeOut: 5000 });
        });
    });

    $("body").on("click", ".edit-item", function () {
        var index = $(this).parent("td").data('id');

        var id = dataCon[index].id;
        var titulo = dataCon[index].titulo;
        var diretor = dataCon[index].diretor;
        var anoLancamento = dataCon[index].anoLancamento;
        var genero = dataCon[index].genero;
        var nota = dataCon[index].nota;

        $("#edit-item").find("input[name='id']").val(id);
        $("#edit-item").find("input[name='titulo']").val(titulo);
        $("#edit-item").find("input[name='diretor']").val(diretor);
        $("#edit-item").find("input[name='anoLancamento']").val(anoLancamento);
        $("#edit-item").find("input[name='genero']").val(genero);
        $("#edit-item").find("input[name='nota']").val(nota);
    });

    $(".crud-submit-edit").click(function (e) {
        e.preventDefault();
        var form_action = $("#edit-item").find("form").attr("action");
        var id = $("#edit-item").find("input[name='id']").val();
        var titulo = $("#edit-item").find("input[name='titulo']").val();
        var diretor = $("#edit-item").find("input[name='diretor']").val();
        var anoLancamento = $("#edit-item").find("input[name='anoLancamento']").val();
        var genero = $("#edit-item").find("input[name='genero']").val();
        var nota = $("#edit-item").find("input[name='nota']").val();

        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: form_action,
            data: { id: id, titulo: titulo, diretor: diretor, anoLancamento: anoLancamento, genero: genero, nota: nota }
        }).done(function (data) {
            getPageData();
            $(".modal").modal('hide');
            toastr.success(data.msg, 'Alerta de Sucesso', { timeOut: 5000 });
        });
    });

    function getDataSelect(type, select) {
        $.ajax({
            dataType: 'json',
            url: 'Acesso' + type,
            data: { page: page }
        }).done(function (data) {
            manageSelectOption(data.data, select, type);
        });
    }
});