const SERVER_REQUESTS = 'server/server_requests.php';
const queueID = 'queueItem_';

$(function () {
    setInterval(getQueue, 1000);
});

function callToServer(data, dataType) {

    var response;
    $.ajax({
        url: SERVER_REQUESTS,
        type: 'POST',
        data: data,
        async: false,
        dataType: dataType,
        success: function (data) {
            response = data;
        },
    });
    return response;
}

function moveElevator(floor) {

    let currentFloor = parseInt($('#currentFloor').text());
    if (floor !== currentFloor) {
        let data = 'action=addToQueue&floor=' + floor;
        let dataType = 'text';
        let success = callToServer(data, dataType);
        if (success) {
            ($('#requestedFloor').text(floor));
            $.ajax({
                type: "POST",
                url: SERVER_REQUESTS,
                async: true,
                data: 'action=moveElevator&floor=' + floor,
                success: function (data) {
                }
            });
        }
    }
}

function getCurrentFloor() {

    let data = 'action=getCurrentFloor';
    let dataType = 'text';
    let currentFloor = callToServer(data, dataType);
    $('#currentFloor').text(currentFloor);
}

function getQueue() {

    let data = 'action=getQueue';
    let dataType = 'json';
    let queue = callToServer(data,dataType);

    $('#queueBox').empty();
    for(let i = 0; i < queue.length; i++) {
        $('#queueBox').append('       <a href="#" onclick="deleteFromQueue(this.id)" id="' + queueID + queue[i].id + '"\
                                  class="list-group-item list-group-item-action text-center align-items-center queueItem">\
                                   <div class="d-flex w-100 justify-content-center text-center small">Going to Floor: ' + queue[i].nodeID + '\
                                   </div>\
                               </a>');
    }
}

function deleteFromQueue(queueItemID) {

    let id = parseInt(queueItemID.substring(queueID.length));
    let data= "action=deleteFromQueue&id=" + id;
    let dataType= 'text';
    callToServer(data,dataType);
    getQueue();
}

function validateCorrectLength(id) {
    const minLength = 7;
    if ($('#' + id).prop('value').length < minLength) {
        $('#' + id + 'Err').html((minLength + ' character minimum').trim());
    } else {
        $('#' + id + 'Err').html('');
    }
}

function validateSignUpForm() {

    let validLength = false;
    let validPassword = false;
    let passwordMatch = false;
    const minLength = 7;
    const USER_EXISTS = 'exists';
    const SUCCESS = 'success';

    let user = $('#username').prop('value');
    let password = $('#userPassword').prop('value');
    let confirm = $('#confirmPassword').prop('value');

    let passwordCheck = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])/;

    if (user.length >= minLength && password.length >= minLength && confirm.length >= minLength) {
        validLength = true;
    }
    if (passwordCheck.test(password) === true) {
        validPassword = true;
    }
    if (password === confirm) {
        passwordMatch = true;
    }
    $('#signUpError').empty();
    if (!validLength) {
        $('#signUpError').append('<p class="my-0">Username and password must be at least ' + minLength + ' characters.</p>');
    }
    if (!validPassword) {
        $('#signUpError').append('<p class="my-0">Password must contain at least one lower case, upper case and number character.</p>');
    }
    if (!passwordMatch) {
        $('#signUpError').append('<p class="my-0">The passwords do not match.</p>');
    }

    if (validLength && validPassword && passwordMatch) {
        let form = $('#signUpForm');
        $.ajax({
            type: "POST",
            url: 'server/addcredentials.php',
            data: form.serialize(),
            success: function (data) {
                let response = data.trim();
                if (response == USER_EXISTS) {
                    alert("This username is already taken!");
                    // location.reload(true);
                } else if (response == SUCCESS) {
                    alert("Successfully Added!");
                    window.location = 'login.html';
                } else {
                    alert("Server Error");
                }
            }
        });
    }
}


