
$('.target').click(function() {
    // パラメータを末尾につける
    window.location.href = "../view/index.php" + "?tab=" + this.id
});
