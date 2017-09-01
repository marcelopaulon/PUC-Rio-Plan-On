var SimulacaoView = (function()
{
    var publicMethods = {};
    
    var error = function(text)
    {
        $('#ErrorMessage').text(text);
        $('#ErrorModal').modal('show');
    };
    
    publicMethods.onDragOver = function(event) {
        event.preventDefault();
    };

    publicMethods.drag = function(event)
    {
        event.dataTransfer.setData("id", $(event.target).attr("data-id"));
    };
    
    publicMethods.drop = function(event)
    {
        event.preventDefault();
        var disciplina = event.dataTransfer.getData("id");
        var toElem = event.toElement || event.relatedTarget || event.target || function () { throw "Failed to attach an event target!"; };
        var idGrade = $(toElem).closest("div.gradePanelContainer").attr('data-grade-id');
        
        $.ajax({
            method: "POST",
            url: "/Grade/AddDisciplina",
            data: {
                "cod_disciplina_add": disciplina.toUpperCase(),
                "id_grade_add": idGrade
            },
            success: function(result){
                if(result.indexOf("Erro-Nao-Cursou-Pre-Reqs") !== -1)
                {
                    error("Não cursou pré-requisitos");
                    return;
                }
                
                if(result.indexOf("Erro-Disciplina-Duplicada-Grade") !== -1)
                {
                    error("Esta disciplina já foi associada a esta grade");
                    return;
                }
                
                if(result.indexOf("Erro-Mais30Cred") !== -1)
                {
                    error("Não é possível cursar mais de 30 créditos por período");
                    return;
                }
                                
                result = JSON.parse(result);
                if(result["error"])
                {
                    error("Erro");
                }
                else
                {
                    window.location.reload();
                }
            }
        });
    };
    
    publicMethods.SendAvaliacao = function(element)
    {
        var codDisciplina = $(element).attr("data-coddisciplina");
        var idUsuario = $(element).attr("data-idusuario");
        var form = $('#modalDificuldade' + codDisciplina);
        var comment = form.find("textarea[name=\"comment\"]").val();
        var dificuldadeTempo = form.find("input[name=\"tempo\"]:checked").val();
        var dificuldadeConteudo = form.find("input[name=\"conteudo\"]:checked").val();
        var dificuldadeAvaliacao = form.find("input[name=\"avaliacao\"]:checked").val();
        
        if(!comment)
        {
            error("Digite um comentário sobre essa disciplina");
            return;
        }
        
        $.ajax({
            method: "POST",
            url: "/Avaliacao/Create?cod_disciplina=" + codDisciplina, 
            data: {
                "dificuldade_tempo": dificuldadeTempo,
                "dificuldade_conteudo": dificuldadeConteudo,
                "dificuldade_avaliacao": dificuldadeAvaliacao,
                "id_usuario": idUsuario,
                "comentario": comment
            },
            success: function(result){
                window.location.reload();
            }
        });
    };
    
    publicMethods.ChangeType = function(element)
    {
        var select = $(element);
        var codDisciplina = select.attr("data-coddisciplina");
        var idGrade = select.attr("data-idgrade");
        var tipo = element.value;
        
        $.ajax({
            method: "POST",
            url: "/Grade/ChangeDisciplinaTipo", 
            data: {
                "cod_disciplina_change": codDisciplina,
                "id_grade_change": idGrade,
                "type": tipo                
            },
            success: function(result){
                window.location.reload();
            }
        });
    };
    
    $(document).ready(function() {
        setupEvents();
    });
    
    var search = function() {
        var text = $('#txtSearch').val();
        if(text && text.length > 2)
        {
            $.ajax({
                url: "/Disciplina/Search?text=" + text, 
                success: function(result){
                    result = JSON.parse(result);
                    $('#searchTableResult').html('');
                    var newData = '<tr><th>Código</th><th>Nome</th><th>Créditos</th></tr>';

                    if(result["error"] || !result["result"])
                    {
                        $('#searchTableResult').html('Erro!');
                    }
                    else
                    {
                        if(result["result"].length == 0)
                        {
                            $('#searchTableResult').html('<tr><td>Nenhuma disciplina encontrada</td></tr>');
                        }
                        else
                        {
                            for(var i = 0; i < result["result"].length; i++)
                            {
                                var disciplina = result["result"][i];
                                newData = newData + '<tr draggable="true" ondragstart="SimulacaoView.drag(event)" style="cursor: move;" data-id="' + disciplina["id"] + '"><td>' + disciplina["id"] + "</td><td>" + disciplina["nome"] + "</td><td>" + disciplina["qtdCreditos"] + "</td></tr>";  
                            }

                            $('#searchTableResult').html(newData);
                        }
                    }
                }
            });
        }
        else
        {
            error('Você precisa digitar pelo menos 3 caracteres para filtrar');
        }
     };
    
    var setupEvents = function()
    {
        $('#txtSearch').on('keypress', function(e) {
            if (e.keyCode == 13) {
                search();
            }
        });
        
        $('#btnSearch').on('click', search);
    };

    return publicMethods;
}());