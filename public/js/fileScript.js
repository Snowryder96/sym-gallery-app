// Script pour afficher l'image a upload
function filePreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#painting_painting + img').remove();
            $('#img-preview').html('<img src="'+e.target.result+'" height="200px" width:auto color:white; />');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
function removeFilePreview() {
    $('#img-preview').html(' ');
}

$("#painting_painting").change(function () {
    filePreview(this);
    console.log(this);
});
$(window).load(function () {
    removeFilePreview();
});

