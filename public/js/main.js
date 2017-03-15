$(document).ready(function () {
    var rows = $('.rwd-table').find('tr');
    var dataGraph = [];
    $.each(rows, function (i, key) {
        if (i > 0) {
            var dataForGraph = {
                'date': $(key).find("[data-th='date']").text(),
                'total': $(key).find("[data-th='total']").text()
            };
            dataGraph.push(dataForGraph);
        }
    });

    new Morris.Line({
        element: 'canvas',
        data: dataGraph,
        parseTime: false,
        xkey: 'date',
        ykeys: ['total'],
        labels: ['total']
    });

    $(document).on('click', '.edit-order', function () {
        var textToInput = $(this).closest('tr').children();
        $(textToInput).each(function (i, index) {
            if (i > 0 && i < 4) {
                var textEdit = $(index).text();
                var thAttr = $(index).attr('data-th');
                $(index).html('');
                $(index).html('<input type="text" data-th="' + thAttr + '" class="edit-input" size="' + textEdit.length + '" value="' + textEdit + '" />');
            }
        });
        changeClass(this, event, true);
    });

    $(document).on('click', '.save-order', function () {
        var collectDatas = $(this).closest('tr').find('.edit-input');
        var setNewValue = $(this).closest('tr').children();
        var datas = {
            id: $(this).attr('order')
        };
        $(collectDatas).each(function (i, index) {
            var key = $(index).attr('data-th');
            datas[key] = $(index).val();
        });
        changeClass(this, event, false);

        doAjax(datas, $(this).attr('token'), "update", function (response) {
            if (response) {
                $(setNewValue).each(function (i, index) {
                    if (i > 0 && i < 4) {
                        var textEdit = $(index).find('input').val();
                        $(index).html('');
                        $(index).text(textEdit);
                    }
                });
            } else {
                alert("Sorry, something going wrong");
            }
        });
    });

    $('.sortable').click(function () {
        var currentPage = window.location.toString();

        var split = currentPage.split('/');
        if (split.length > 5) {
            currentPage = '';
            $.each(split, function (i, key) {
                if (i < 6) {
                    currentPage += key + '/';
                }
            });
        }
        var direction = $(this).attr('direction');
        var column = $(this).attr('column');
        var token = $(this).attr('token');

        if (split[split.length - 1] == 'up' || split[split.length - 1] == 'down') {
            currentPage = '';
            $.each(split, function (i, key) {
                if (i < split.length - 3) {
                    currentPage += key + '/';
                }
            });
        }
        if (currentPage[currentPage.length - 1] != '/')
            currentPage += '/';

        window.location.href = currentPage + 'sort/' + column + '/' + direction;
        return false;
    });

    $('.delete-order').click(function () {
        doAjax($(this).attr('order'), $(this).attr('token'), "delete", function (response) {
            if (response) {
                window.location.reload();
            } else {
                alert("Sorry, something going wrong");
            }
        });
    });

    $('.search-query').bind("enterKey",function(e){
        searcher();
    });

    $('.search-query').keyup(function(e){
        if(e.keyCode == 13)
        {
            $(this).trigger("enterKey");
        }
    });

    $('.searcher').click(function () {
        searcher();
    });
});

function searcher(){
    var query = $('.search-query').val();
    var category = $('#category option:selected').val();
    if (query.length < 1) {
        alert("Who looking for nothing will find nothing");
    } else {
        window.location.href = '/graph/' + query + '/' + category;
    }
}

function changeClass(obj, e, isTrue) {
    e.preventDefault();
    e.stopPropagation();
    if (isTrue) {
        $(obj).removeClass('btn-warning edit-order').addClass('btn-success save-order').text('SAVE');
    } else {
        $(obj).removeClass('btn-success save-order').addClass('btn-warning edit-order').text('EDIT');
    }
    return false;
}

function doAjax(subject, token, type, response) {
    $.ajax({
        url: "/graph/handle",
        type: 'post',
        dataType: 'json',
        data: {
            "_token": token,
            "info": subject,
            "handle-type": type
        },
        success: function (data) {
            if (data.result) {
                response(true);
            } else {
                response(false);
            }
        }, error: function (data) {
            response(false);
        }
    });
}