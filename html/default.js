var oldQuestionsJson = [];
var updateCount = 0;

$(document).bind("mobileinit", function(){
    $.mobile.page.prototype.options.degradeInputs.date = true;
    $.mobile.touchOverflowEnabled = true;
});

$(document).delegate("#main", "pagecreate", onCreateMainPage);
$(document).delegate("#questions", "pagecreate", onCreateQuestionsPage);
$(document).delegate("#newQuestion", "pagecreate", onCreateNewQuestionPage);
$(document).delegate("#newEvent", "pagecreate", onCreateNewEventPage);

function onFacebookLogin() {
    console.log("onfacebooklogin");
    FB.api('/me', function(user) {
        if (user) {
            window.fbUser = user;
            console.log(user);
            /*
            var userProfilePic = document.createElement('img');
            userProfilePic.id = 'userProfilePic';
            userProfilePic.src = 'https://graph.facebook.com/' + user.id + '/picture';
            var header = document.getElementsByTagName('header')[0];
            if(header.firstChild) header.insertBefore(userProfilePic, header.firstChild);
            else header.appendChild(userProfilePic);
            document.getElementsByTagName('header')[0].appendChild(userProfilePic);
            */
            var url = "/main/createUser";
            $.ajax({
                url: url,
                type: "POST",
                data: {id: user.id, name: user.name, email: user.email},
                dataType: "json"
            })
            .success(function(response) {
                console.log("success");
                console.log(response);
            })
            .fail(function(response) {
                console.log("fail");
                console.log(response);
            })
            ;
            $('#facebook-text').text("Logged in as " + user.name);
        }
    });
} 

function facebookLogin (onLoginSuccess) {
    FB.login(function(response) {
        if (response.authResponse) {
            console.log('Fetching Facebook login info...');
            FB.api('/me', function(user) {
                console.log('Good to see you, ' + user.name + '.');
                console.log('Your email is ' + user.email + '.');
            });
            onFacebookLogin();
            if (onLoginSuccess) {
                onLoginSuccess();
            }
        } else {
            console.log('Facebook user cancelled login or did not fully authorize.');
        }
    }, {scope: 'email'});
}

function onCreateMainPage () {
    $('#search-submit').click(function () {
        var code = $('#search-basic').val();
        if (code) {
            window.location.href = "/main/searchEvents/?code=" + code;
        }
    });
    setTimeout(function () {
        if (!window.fbUser) {
            $('#facebook-link').click(facebookLogin);
        }
    }, 1500);
}

function onCreateNewEventPage () {
    $('.datepicker').datetimepicker();

    if (!window.fbUser) {
        $('#new-event-li').html('<h2>In order to create an event you must log in. Please log in:</h2>');
        var facebookText = $('<h3>').text("Log In with Facebook!");
        var facebookLink = $('<a>').append(facebookText);
        var facebookLi = $('<li>').append(facebookLink);
        facebookLi.click(facebookLogin);
        $('#new-event-li').after(facebookLi);
    } else {
        $('#event-submit').click(function (){
            var title = $('#title-input').val();
            var code = $('#code-input').val();
            var startTime = $('#starttime-input').val();
            var endTime = $('#endtime-input').val();
            if (title && code && startTime && endTime) {
                startTime = formatTime(startTime);
                endTime = formatTime(endTime);
                if (startTime.comparable >= endTime.comparable) {
                    alert("Please provide a start time before your end time.");
                } else {
                    $.ajax({
                      url: "/main/createEvent",
                      type: "POST",
                      data: {title: title, code: code, startTime: startTime.time, endTime: endTime.time, creatorId: window.fbUser.id},
                      dataType: "text"
                    })
                    .success(function(response) {
                      console.log("success");
                      console.log(response);
                    })
                    .fail(function(response) {
                      console.log("fail");
                      console.log(response);
                    })
                    .always(function(response) {
                        if (response == -1) {
                            alert("An event with that event code already exists. Use a different code :)");
                        } else {
                            window.location.href = "/main/questions/" + response;
                        }
                    })
                    ;
                }
            } else {
                alert("Please fill out all of your event's information.");
            }
        });
    }
}

function formatTime (time) {
    var s1 = time.split('/');
    var s2 = s1[2].split(' ');
    var t = s2[0] + '-' + s1[0] + '-' + s1[1] + ' ' + s2[1];
    var s3 = s2[1].split(':');
    var c = s2[0] + s1[0] + s1[1] + s3[0] + s3[1];
    return {"time": t, "comparable": c};
}

function onCreateNewQuestionPage () {
    if (!window.fbUser) {
        $('#new-question-li').html('<h2>In order to create a question you must log in. Please log in:</h2>');
        var facebookText = $('<h3>').text("Log In with Facebook!");
        var facebookLink = $('<a>').append(facebookText);
        var facebookLi = $('<li>').append(facebookLink);
        facebookLi.click(facebookLogin);
        $('#new-question-li').after(facebookLi);
        console.log(facebookLi);
    } else {
        $('#question-submit').click(function (){
            text = $('#question-input').val();
            if (text) {
                var u = document.URL.split('/');
                eventId = u[u.length-1];
                $.ajax({
                  url: "/main/createQuestion",
                  type: "POST",
                  data: {text: text, eventId: eventId, userId: window.fbUser.id},
                  dataType: "text"
                })
                .success(function(response) {
                  console.log("success");
                  console.log(response);
                })
                .fail(function(response) {
                  console.log("fail");
                  console.log(response);
                })
                ;
            }
            u = window.location.toString().split("/");
            u = u.pop();
            window.location.href = "/main/questions/" + u;
        });
    }
}

function onCreateQuestionsPage () {
    userVotes = [];
    if(localStorage['userVotes']) {
        loadUserVotes();
        disableVotes();
    }
    $('.upvote').click(function (){
        window.clickedVote = $(this);
        if (window.fbUser) {
            vote("up");
        } else {
            alert("Please log in, in order to vote.");
            facebookLogin(function () {
                vote("up");
            });
        }
    });

    $('.downvote').click(function (){
        window.clickedVote = $(this);
        if (window.fbUser) {
            vote("down");
        } else {
            alert("Please log in, in order to vote.");
            facebookLogin(function () {
                vote("down");
            });
        }
    });

    setInterval(function () {
        if ($('div#questions').length > 0) {
            var u = document.URL.split('/');
            eventId = u[u.length-1];
            var url = "/main/questionsJson";
            $.ajax({
                url: url,
                type: "POST",
                data: {id: eventId},
                dataType: "text"
                })
            .success(function(response) {
                console.log("success");
                console.log(response);
                var r = JSON.parse(response);
                if (questionsChanged(r)) {
                    console.log("new!");
                    window.oldQuestionsJson = r;
                    console.log(window.oldQuestionsJson);
                    if (window.updateCount > 0) {
                        location.reload();
                    } else {
                        window.updateCount++;
                    }
                }
            })
            .fail(function(response) {
                console.log("fail");
                console.log(response);
            })
            ;
        }
    }, 1000);
}

function questionsChanged (response) {
    var i = 0;
    while (true) {
        if (!response[i] && !window.oldQuestionsJson[i]) {
            return false;
        } else if (!response[i] || !window.oldQuestionsJson[i]) {
            return true;
        } else {
            if (response[i].id != window.oldQuestionsJson[i].id || response[i].votes != window.oldQuestionsJson[i].votes) {
                return true;
            }
        }
        i++;
    }
    return false;
}

function vote (direction) {
    var id = window.clickedVote.parent().parent().parent().attr('id');
    if (direction == "up") {
        var url = "/main/upVote";
        var value = 1;
    } else if (direction == "down") {
        var url = "/main/downVote";
        var value = -1;
    }
    $.ajax({
        url: url,
        type: "POST",
        data: {id: id},
        dataType: "text"
        })
    .success(function(response) {
        console.log("success");
        console.log(response);
        })
    .fail(function(response) {
        console.log("fail");
        console.log(response);
        })
    ;
    var voteStore = {
        "id" : id, 
        "value" : value
    }
    if (searchUserVotes(id, value) == -1) {
        userVotes.push(voteStore);
        localStorage['userVotes'] = JSON.stringify(userVotes);
    }
    setTimeout(function() { location.reload() }, 500);
}

function loadUserVotes () {
    userVotes = JSON.parse(localStorage['userVotes']);
    console.log(userVotes);
}

function searchUserVotes (id, value) {
    for (var i = 0; i < userVotes.length; i++) {
        if (userVotes[i].id == id && userVotes[i].value == value)
            return i;
    }
    return -1;
}

function disableVotes () {
    for (var i = 0; i < userVotes.length; i++) {
        if(userVotes[i].value == 1) {
            //alert($('#'+ userVotes[i].id).children().children('.upvote').html());
            $('#'+ userVotes[i].id).children().children('.upvote').attr('disabled', 'disabled');
        }
        else if(userVotes[i].value == -1) {
            $('#'+ userVotes[i].id).children().children('.downvote').attr('disabled', 'disabled');
        }
    }
}

