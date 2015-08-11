$(function(){

    getProjects();
});

function getProjects(){

    $.ajax({
        url: root + 'data-list-projects',
        type: 'get',
        dataType: 'json',
        success: function(result){

            if(result.message.indexOf('not logged')>-1) {
                window.location.replace(root);
                return;
            }

            var table = getProjectTable(result);

            if(table!=null){

                $("#table-data").html(table);
                $('#project-table').DataTable();

                $(".remove-project").unbind('click');
                $(".remove-project").click(function(){
                    var id = $(this).attr('rel');

                    var row = $(this).closest('tr');

                    removeProject(id, row);
                });

            }
            else
                $("#table-data").html("No projects found");
        }
    });
}

function getProjectTable(data){

    if(data==undefined || data.found==undefined || data.found==false || data.projects==undefined)
        return null;
    else{

        var str = '<table id="project-table" class="display" cellspacing="0" width="100%">';

        str += '<thead>';

        str += '<tr>';
        str += '<td>S.No.</td>';
        str += '<td>Name</td>';
        str += '<td>Description</td>';
        str += '<td>Action</td>';
        str += '</tr>';

        str += '</thead><tbody>';

        for(var i=0; i<data.projects.length;i++){

            var project = data.projects[i];

            str += '<tr>';
            str += '<td>' + (i+1) + '</td>';
            str += '<td>' + project.name + '</td>';
            str += '<td>' + project.description + '</td>';

            str += '<td>';
            str += '<a href="' + root + 'list-bugs/' + project.id + '" title="View bugs"><img class="icon" src="' + root + 'public/images/bug.png"/></a>';
            str += '&nbsp;&nbsp;&nbsp;';
            str += '<a href="' + root + 'edit-project/' + project.id + '" title="Edit project"><img class="icon" src="' + root + 'public/images/edit.png"/></a>';
            str += '&nbsp;&nbsp;&nbsp;';
            str += '<a href="javascript:void(0)" class="remove-project" rel="' + project.id + '" title="Remove project"><img class="icon" src="' + root + 'public/images/remove.png"/></a>';
            str += '</td>';

            str += '</tr>';
        }

        str += '</tbody></table>';

        return str;
    }
}

function removeProject(id, row) {

    if(!confirm("Are you sure to remove this project?"))
        return;

    $.ajax({
        url: root + 'remove-project/' + id,
        type: 'get',
        success: function (result) {

            if(result.indexOf('done')>-1)
                getProjects();
            else
                alert("Invalid data provided");
        }
    });
}