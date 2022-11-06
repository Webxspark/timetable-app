var edit = {
    _init_() {
        this.init_page();
        this.init_eventListeners();
    },
    init_page() {
        var key = $('[table-key]').attr('table-key');
        this.request({
            action: 'fetch',
            key: key
        }).then(data => {
            Wxp_DOM.render('', 'wxp-alert', { animate: { settings: 'fade' } });
            if (data.error) {
                edit.processErrorMsg(data.error);
            } else {
                $('[name="classIncharge"]').val(data.class_incharge);
                $('[name="year"]').val(data.year);
                $('[name="sem"]').val(data.sem);
                $('[name="class"]').val(data.class);
                var time = 500;
                $.each(data.periods, (key,val) => {
                    $.each(val, (k,v) => {
                        setTimeout(function(){
                            $(`[name="${key}"][period="${k}"]`).val(v)
                        },time)
                        time += 30;
                    })
                })
            }
        })
    },
    init_eventListeners() {

    },
    processErrorMsg(error_msg) {
        var template = (error_msg) => {
            return `<div class="alert alert-info alert-icon" role="alert"><i class="uil uil-exclamation-circle"></i> ${error_msg}</div>`;
        }
        Wxp_DOM.render(template(error_msg), 'wxp-alert', { animate: { settings: 'fade' } });
        Wxp_DOM.showWarning('[wxpclid="required"]', {
            flicker: 1,
            interval: 4000,
            scrollView: true
        })
    },
    request(data) {
        return $.ajax({
            url: './components/admin?alt=json&token=' + makeid(10),
            method: 'POST',
            data: data,
            dataType: 'JSON'
        });
    }
}
edit._init_();