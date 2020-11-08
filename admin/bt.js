$(document).ready(function() {
    $("#input-b9").fileinput({
        showPreview: false,
        showUpload: false,
        elErrorContainer: '#kartik-file-errors',
        allowedFileExtensions: ["jpg", "png", "gif"]
        //uploadUrl: '/site/file-upload-single'
    });
});