var newPost = {
    _init_() {
        this.init_eventListeners();
    },
    init_eventListeners() {
        $('[wxpclid="new-data"]').submit(e => {
            newPost.handleFormSubmission();
            return false;
        })
    },
    errorTemplate(str) {
        return `<div class="alert alert-info alert-icon" role="alert"><i class="uil uil-exclamation-circle"></i> ${str}</div>`;
    },
    handleFormSubmission() {
        var ci = $('[name="classIncharge"]').val(),
            year = $('[name="year"]').val(),
            sem = $('[name="sem"]').val(),
            _class = $('[name="class"]').val();
        var monday = {}, tuesday = {}, wednesday = {}, thursday = {}, friday = {};
        $.each($('[name="monday"]'), (key, elm) => {
            monday[(key + 1)] = $(elm).val() ? $(elm).val() : '-';
        })
        $.each($('[name="tuesday"]'), (key, elm) => {
            tuesday[(key + 1)] = $(elm).val() ? $(elm).val() : '-';
        })
        $.each($('[name="wednesday"]'), (key, elm) => {
            wednesday[(key + 1)] = $(elm).val() ? $(elm).val() : '-';
        })
        $.each($('[name="thursday"]'), (key, elm) => {
            thursday[(key + 1)] = $(elm).val() ? $(elm).val() : '-';
        })
        $.each($('[name="friday"]'), (key, elm) => {
            friday[(key + 1)] = $(elm).val() ? $(elm).val() : '-';
        })
        var timetable = {
            monday, tuesday, wednesday, thursday, friday
        }
        if (ci == '' || year == '' || sem == '' || _class == '') {
            processErrorMsg('Please fill all the required field!');
        } else {
            var data = {
                action: 'insert-new',
                timetable: timetable,
                ci: ci,
                year: year,
                sem: sem,
                class: _class
            };
            if ($('[table-key]').length > 0) {
                data.action = 'update';
                data.key = $('[table-key]').attr('table-key');
            }
            $.ajax({
                url: './components/admin?alt=json&token=' + makeid(10),
                method: "POST",
                data: data,
                dataType: 'JSON'
            }).then(response => {
                if (response.error) {
                    processErrorMsg(response.error);
                } else {
                    if (response.status == 200) {
                        window.location.href = ('./admin');
                    }
                }
            })
        }
        function processErrorMsg(error_msg) {
            var template = (error_msg) => {
                return `<div class="alert alert-info alert-icon" role="alert"><i class="uil uil-exclamation-circle"></i> ${error_msg}</div>`;
            }
            Wxp_DOM.render(template(error_msg), 'wxp-alert', {
                animate: {
                    settings: 'fade'
                }
            });
            Wxp_DOM.showWarning('[wxpclid="required"]', {
                flicker: 1,
                interval: 4000,
                scrollView: true
            })
        }
    }
}
newPost._init_();