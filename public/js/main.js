// document.addEventListener('DOMContentLoaded', function() {
//     var likeButtons = document.getElementsByClassName('likeButton');
//     Array.from(likeButtons).forEach(function(likeButton) {
//     likeButton.addEventListener('click', function() {
//     likeButton.classList.toggle('liked');
//     });
//     });
// }, false);

document.addEventListener('DOMContentLoaded', function() {
    let likeButtons = document.getElementsByClassName('likeButton');
    Array.from(likeButtons).forEach(function(likeButton) {
        likeButton.addEventListener('click', function() {
            likeButton.classList.toggle('liked');
            //フォーム送信
            document.getElementById('likeForm').submit();
        });
    });
});