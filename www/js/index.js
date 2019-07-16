const SERVER_REQUESTS = 'server/server_requests.php';
let months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

$(function () {
    updateTime();
    setInterval(updateTime,1000);
    $('#sidebarToggle').on('click', function (event) {
        event.preventDefault();
        $("body").toggleClass('sidebar-toggled');
        $(".sidebar").toggleClass('toggled');
    });
});

function updateTime() {
    let date = new Date();
    let time =('0'  + date.getHours()).slice(-2)+':'+ ('0'  + date.getMinutes()).slice(-2)+':'+('0' + date.getSeconds()).slice(-2);
    let day = (months[date.getMonth()] + ' ' + ('0'  + date.getDate()).slice(-2) + ' ' + date.getFullYear())
    let today = time + ' - ' + day;
    $('#datetime').html(today.toLocaleString());
}
function callToServer(data,dataType ) {

    var response;
    $.ajax({
        url: SERVER_REQUESTS,
        type: 'POST',
        data: data,
        async: false,
        dataType: dataType,
        success: function(data) {
            response = data;
        },
    });
    return response;
}
