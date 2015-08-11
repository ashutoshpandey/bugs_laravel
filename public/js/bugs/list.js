var currentBugId = -1;

$(function(){

    $("input[name='bug_type']").click(getBugs);

    getBugs();
});

function getBugs(){

    var bugType = $("input[name='bug_type']:checked").val();

    $.ajax({
        url: root + 'data-list-bugs',
        type: 'get',
        data: 'bug_type=' + bugType,
        dataType: 'json',
        success: function(result){

            if(result.message.indexOf('not logged')>-1) {
                window.location.replace(root);
                return;
            }

            var table = getBugTable(result);

            if(table!=null){

                $("#table-data").html(table);
                $('#bug-table').DataTable();

                $('.change_status').unbind('click');
                $('.change_status').click(function (e) {
                    currentBugId = $(this).attr('rel');
                    $('#popup_status').modal();
                    return false;
                });

                $("input[name='btn-cancel-status']").unbind('click');
                $("input[name='btn-cancel-status']").click(function(){
                    $.modal.close();
                });

                $("input[name='btn-change-status']").unbind('click');
                $("input[name='btn-change-status']").click(function(){
                    var status = $("input[name='bug_status']:checked").val();

                    var data = 'id=' + currentBugId + '&status=' + status;

                    $.ajax({
                        url: root + 'change-bug-status',
                        data: data,
                        type: 'post',
                        success: function(result){
                            getBugs();
                            $.modal.close();
                        }
                    });
                });
            }
            else
                $("#table-data").html("No bugs found");
        }
    });
}

function getBugTable(data){

    if(data==undefined || data.found==undefined || data.found==false || data.bugs==undefined)
        return null;
    else{

        var str = '<table id="bug-table" class="display" cellspacing="0" width="100%">';

        str += '<thead>';

        str += '<tr>';
        str += '<td>S.No.</td>';
        str += '<td>Name</td>';
        str += '<td>Description</td>';
        str += '<td>Severity</td>';
        str += '<td>Action</td>';
        str += '</tr>';

        str += '</thead><tbody>';

        for(var i=0; i<data.bugs.length;i++){

            var bug = data.bugs[i];

            str += '<tr>';
            str += '<td>' + (i+1) + '</td>';
            str += '<td>' + bug.title + '</td>';
            str += '<td>' + bug.description + '</td>';
            str += '<td class="' + bug.severity.toLowerCase() + '">' + bug.severity + '</td>';

            str += '<td>';
            str += '<a href="' + root + 'bug-detail/' + bug.id + '" title="View detail"><img class="icon" src="' + root + 'public/images/view.png"/></a>';
            str += '&nbsp;&nbsp;&nbsp;';
            str += '&nbsp;&nbsp;&nbsp;';
            str += '<a href="javascript:void(0)" rel="' + bug.id + '" class="change_status" title="Change status"><img class="icon" src="' + root + 'public/images/change-status.jpg"/></a>';
            str += '</td>';

            str += '</tr>';
        }

        str += '</tbody></table>';

        return str;
    }
}