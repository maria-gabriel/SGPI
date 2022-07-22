@extends('layouts.modal')
@section('content')
    <div class="row bg-white p-10 m-10 rounded">
        <div class="col-12 py-3">
            <p class="mb-4">Presiona <span class="text-secondary text-bold">Más detalles</span> para ver la tabla de tareas
                completa.</p>
            <div class="table-responsive">
                <table id="dataTab" class="display table2" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Subtareas</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

<script type="text/javascript">
let array_proyecto = @json($proyecto, JSON_PRETTY_PRINT);
var editor;
var url = '/SGPI/crud/tarea';
var url2 = '/SGPI/crud/subtarea';
var jsontype = 'application/json';
var token = $("meta[name='csrf-token']").attr('content');

function toask_error(e) {
    $(".preloader").fadeOut(400, function() {
        setTimeout(function() {
            toastr.options = {
                timeOut: 5000,
                progressBar: true,
                showMethod: "slideDown",
                hideMethod: "slideUp",
                showDuration: 200,
                hideDuration: 300,
                positionClass: "toast-bottom-center",
            };
            toastr.error("Operación no exitosa");
            a(".theme-switcher").removeClass("open")
        }, 500)
    });
    console.log(e);
}

$(document).ready(function() {
    editor = new $.fn.dataTable.Editor({
        ajax: {
            create: {
                type: 'POST',
                url: url,
                contentType: jsontype,
                data: function(addData) {
                    addData.data[0]["_token"] = token;
                    addData.data[0]["id_proyecto"] = array_proyecto['id'];
                    addData.data[0]['index'] = 'save';
                    return JSON.stringify(addData.data[0]);
                },
                error: function(e) {
                    toask_error(e);
                }
            },
            edit: {
                type: 'POST',
                url: url,
                contentType: jsontype,
                data: function(editData) {
                    var id = Object.keys(editData.data);
                    editData.data[id[0]]["_token"] = token;
                    editData.data[id[0]]["id"] = id[0];
                    editData.data[id[0]]['index'] = 'update';
                    return JSON.stringify(editData.data[id[0]]);
                },
                complete: function() {
                    editorTab.row({
                        selected: true
                    }).deselect();
                },
                error: function(e) {
                    toask_error(e);
                }
            },
            remove: {
                type: 'POST',
                url: url,
                contentType: jsontype,
                data: function(editData) {
                    var idSelected;
                    $.each(editData.data, function(key, value) {
                        idSelected = value.id;
                    });
                    editData.data[idSelected]["_token"] = token;
                    editData.data[idSelected]['index'] = 'remove';
                    return JSON.stringify(editData.data[idSelected]);
                },
                success: function() {},
                error: function(e) {
                    toask_error(e);
                }
            }
        },
        table: "#dataTab",
        idSrc: 'id',
        fields: [{
            label: "Nombre:",
            name: "nombre"
        }, {
            label: "Descripción:",
            name: "descripcion"
        }, {
            label: "Fecha inicio:",
            name: "inicio",
            type: "datetime"
        }, {
            label: "Fecha final:",
            name: "final",
            type: "datetime"
        }],

    });

    function createChild(row) {
    var table = $('<table id="dataTab2" class="display table2" width="100%"/>');
    row.child(table).show();

    var rowData = row.data();
    var editor2 = new $.fn.dataTable.Editor({
        ajax: {
            create: {
                type: 'POST',
                url: url2,
                contentType: jsontype,
                data: function(addData) {
                    addData.data[0]["_token"] = token;
                    addData.data[0]["id_tarea"] = rowData.id;
                    addData.data[0]['index'] = 'save';
                    return JSON.stringify(addData.data[0]);
                },
                error: function(e) {
                    toask_error(e);
                }
            },
            edit: {
                type: 'POST',
                url: url2,
                contentType: jsontype,
                data: function(editData) {
                    var id = Object.keys(editData.data);
                    editData.data[id[0]]["_token"] = token;
                    editData.data[id[0]]["id"] = id[0];
                    editData.data[id[0]]["index"] = 'update';
                    return JSON.stringify(editData.data[id[0]]);
                },
                complete: function() {
                    editorTab2.row({
                        selected: true
                    }).deselect();
                },
                error: function(e) {
                    toask_error(e);
                }
            },
            remove: {
                type: 'POST',
                url: url2,
                contentType: jsontype,
                data: function(editData) {
                    var idSelected;
                    $.each(editData.data, function(key, value) {
                        idSelected = value.id;
                    });
                    editData.data[idSelected]["_token"] =token;
                    editData.data[idSelected]['index'] = 'remove';
                    return JSON.stringify(editData.data[idSelected]);
                },
                error: function(e) {
                    toask_error(e);
                }
            }
        },
        table: table,
        idSrc: 'id',
        fields: [{
            label: "Nombre:",
            name: "nombre"
        }, {
            label: "Descripción:",
            name: "descripcion"
        }, {
            label: "Fecha inicio:",
            name: "inicio",
            type: "datetime"
        }, {
            label: "Fecha final:",
            name: "final",
            type: "datetime"
        }],
    });

    var editorTab2 = table.DataTable({
        dom: "Bfrtip",
        paging: false,
        info: false,
        idSrc: 'id',
        ajax: {
            type: 'POST',
            url: url2,
            data: {
                '_token':token,
                'id_tarea': rowData.id,
                'index': 'get',
            },
            complete: function() {
                var t = document.getElementById("dataTab2");
                t.getElementsByTagName("th")[0].style.width = "10px";
                t.getElementsByTagName("th")[1].textContent = "Nombre";
                t.getElementsByTagName("th")[1].style.width = "181px";
                t.getElementsByTagName("th")[2].textContent = "Descripción";
                t.getElementsByTagName("th")[2].style.width = "385px";
                $("td").css({
                    "line-height": "9px"
                });
                $("td").addClass("td-short");
            },
        },
        columns: [{
                data: null,
                defaultContent: '',
                className: 'select-checkbox',
                orderable: false
            },

            {
                data: "nombre"
            },
            {
                data: "descripcion"
            },
        ],
        lengthMenu: [
            [5],
        ],
        select: {
            style: 'os',
            selector: 'td:first-child'
        },
        buttons: [{
                extend: "create",
                text: 'Nuevo',
                editor: editor2
            },
            {
                extend: "edit",
                editor: editor2
            },
            {
                extend: "remove",
                editor: editor2
            }
        ],
        language: lenguaje,
    });
    $(".buttons-create").removeClass("dt-button").addClass("btn btn-success btn-sm");
    $(".buttons-edit").removeClass("dt-button").addClass("btn btn-info btn-sm");
    $(".buttons-remove").removeClass("dt-button").addClass("btn btn-danger btn-sm");
    $("#dataTab2_filter input").addClass("border border-none bg-lavender opacity-8 mt-1");
    }

    function destroyChild(row) {
        var table = $("dataTab", row.child());
        table.detach();
        table.DataTable().destroy();
        row.child.hide();
    }

    $("#dataTab").on("click", "tbody td.dt-control", function(e) {
        var tr = $(this).closest("tr");
        var row = editorTab.row(tr);
        if (row.child.isShown()) {
            destroyChild(row);
            tr.removeClass("shown");
        } else {
            createChild(row);
            tr.addClass("shown");
            $(".shown").next().addClass("bg-ghost");
        }
    });

    var editorTab = $('#dataTab').DataTable({
        dom: "Bfrtip",
        idSrc: 'id',
        ajax: {
            type: 'POST',
            url: url,
            data: {
                '_token': token,
                'id_proyecto': array_proyecto['id'],
                'index': 'get',
            },
            complete: function() {
                $(".select-checkbox, .row-add, .row-view").addClass("pointer");
                $("td").css({
                    "line-height": "10px"
                });
                $("td").addClass("td-short");

                var myDiv = document.getElementsByClassName("dt-buttons");
                var button = document.createElement("BUTTON");
                button.innerHTML = "Más detalles";
                button.className = "more btn btn-secondary btn-sm text-white";
                myDiv[0].appendChild(button);
                $(".more").click(function() {
                    localStorage.setItem('res', 'tareas');
                    window.parent.closeModal();
                });
            },
        },
        columns: [{
                data: null,
                defaultContent: '',
                className: 'select-checkbox',
                orderable: false
            },

            {
                data: "nombre"
            },
            {
                data: "descripcion"
            },
            {
                className: "dt-control dt-center",
                orderable: false,
                data: null,
                defaultContent: ""
            },
        ],
        lengthMenu: [
            [5],
        ],
        select: {
            style: 'os',
            selector: 'td:first-child'
        },
        buttons: [{
                extend: "create",
                editor: editor
            },
            {
                extend: "edit",
                editor: editor
            },
            {
                extend: "remove",
                editor: editor
            }
        ],
        language: lenguaje,
    });
    $(".buttons-create").removeClass("dt-button").addClass("btn btn-success btn-sm");
    $(".buttons-edit").removeClass("dt-button").addClass("btn btn-info btn-sm");
    $(".buttons-remove").removeClass("dt-button").addClass("btn btn-danger btn-sm");
    $("#dataTab_filter input").addClass("border border-none bg-lavender opacity-7");
});
</script>
@endsection
