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
        console.table(timetable);
    }
}
newPost._init_();