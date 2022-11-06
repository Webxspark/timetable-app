var viewer = {
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
            if (data.error) {
                alert(data.error);
            } else {
                var time = 0;
                $.each(data.periods, (key, val) => {
                    $.each(val, (k, v) => {
                        setTimeout(function () {
                            Wxp_DOM.render(v, `[name="${key}"][period="${k}"]`, { animate: { settings: 'fade' } });
                        }, time)
                        time += 10;
                    })
                })
            }
        })
    },
    init_eventListeners() {

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
viewer._init_();