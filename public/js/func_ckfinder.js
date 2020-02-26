function ckeditor(name) {
    var editor = CKEDITOR.replace(name, {
        language: 'vi',
        filebrowserBrowseUrl: baseURL + '/js/ckfinder/ckfinder.html ',
        filebrowserImageBrowseUrl: baseURL + '/js/ckfinder/ckfinder.html?type=Images',
        filebrowserFlashBrowseUrl: baseURL + '/js/ckfinder/ckfinder.html?type=Flash',
        filebrowserUploadUrl: baseURL + '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: baseURL + '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: baseURL + '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
    })
}