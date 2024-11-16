document.addEventListener("DOMContentLoaded", function() {
    // 現在のURLを取得
    var currentUrl = window.location.href;

    // シェアリンクに現在のURLを設定
    document.getElementById("shareLink").value = currentUrl;
    document.getElementById("facebookShare").href = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(currentUrl);
    document.getElementById("twitterShare").href = "https://twitter.com/intent/tweet?url=" + encodeURIComponent(currentUrl);
    document.getElementById("instagramShare").href = "https://www.instagram.com/"; // Instagramはリンク共有機能がないため空のままにしておきます
});

function copyLink() {
    var copyText = document.getElementById("shareLink");
    copyText.select();
    document.execCommand("copy");
    alert("Link copied to clipboard!");
}

