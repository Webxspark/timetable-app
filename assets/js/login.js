var userAuth = {
    _init_() {
        this.initialize_event_listeners();
    },
    initialize_event_listeners() {
        $('[wxpclid="login-form"]').submit(e => {
            this.handleFormSubmission();
            return false;
        })
    },
    handleFormSubmission() {
        var email = $('#loginEmail').val(),
            pass = $('#loginPassword').val(),
            error = false;
        if (email == '' || email == null || email == undefined) {
            error = "Please enter your email address to continue!";
        } else if (pass == '' || pass == null || pass == undefined) {
            error = "Please enter your password to continue!";
        } else {
            var redir = $('wxp-redir').text();
            if(redir == '' || redir == undefined || redir == null){
                redir = ''
            }
            this.sendRequest({
                action: 'process-login',
                credentials: {
                    e: email,
                    p: pass
                },
                redir: redir
            }).then(response => {
                if (response != 'processAborted') {
                    if(response.error){
                        processErrorMsg(response.error);
                    }
                    if (response.redirect) {
                        window.location.replace(response.redirect);
                    }
                }
            })
        }
        if (error != false) {
            processErrorMsg(error);
        }
        function processErrorMsg(error_msg) {
            var template = (str) => {
                return `<div class="alert alert-info alert-icon" role="alert"><i class="uil uil-exclamation-circle"></i> ${error_msg}</div>`;
            }
            Wxp_DOM.render(template(error), 'wxp-alert', {
                animate: {
                    settings: 'fade'
                }
            });
            Wxp_DOM.showWarning('.card-body', {
                flicker: 1,
                interval: 4000,
                scrollView: true
            })
        }
    },
    sendRequest(data = {}) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: './components/userAuth?alt=json&token='+makeid(10),
                method: 'POST',
                data: data,
                dataType: "JSON"
            }).then(response => {
                resolve(response);
            })
        })
    }
}

userAuth._init_();