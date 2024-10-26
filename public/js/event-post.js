function updateSelectedCategories() {
    const selectedCategories = [];
    const selectedCategoryNames = []; // カテゴリ名を保存する配列
    
    // チェックされたチェックボックスのカテゴリIDとカテゴリ名を取得
    document.querySelectorAll('#categoryForm .form-check-input:checked').forEach(checkbox => {
        selectedCategories.push(checkbox.value); // IDを取得
        selectedCategoryNames.push(checkbox.getAttribute('data-name')); // カテゴリ名を取得
    });

    // 選択されたカテゴリ名を表示
    const categoryContainer = document.getElementById('selectedCategories');
    categoryContainer.innerHTML = ''; // 既存のカテゴリー表示をクリア
    selectedCategoryNames.forEach(categoryName => {
        const span = document.createElement('span');
        span.classList.add('category-badge'); // CSSクラスでスタイリング
        span.innerText = categoryName;
        categoryContainer.appendChild(span);
    });

    // hidden input に選択されたカテゴリーのIDをセット
    const categoryInput = document.getElementById('category-input');
    categoryInput.value = selectedCategories.join(','); // カンマ区切りでセット

     // デバッグ用
     console.log("Selected Categories (IDs):", categoryInput.value);
}
