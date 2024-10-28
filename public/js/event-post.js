// function updateSelectedCategories() {
//     const selectedCategories = [];
//     const selectedCategoryNames = []; // カテゴリ名を保存する配列
    
//     // チェックされたチェックボックスのカテゴリIDとカテゴリ名を取得
//     document.querySelectorAll('#categoryForm .form-check-input:checked').forEach(checkbox => {
//         selectedCategories.push(checkbox.value); // IDを取得
//         selectedCategoryNames.push(checkbox.getAttribute('data-name')); // カテゴリ名を取得
//     });
//     console.log(selectedCategories);
//     // 選択されたカテゴリ名を表示
//     const categoryContainer = document.getElementById('selectedCategories');
//     categoryContainer.innerHTML = ''; // 既存のカテゴリー表示をクリア
//     selectedCategoryNames.forEach(categoryName => {
//         const span = document.createElement('span');
//         span.classList.add('category-badge'); // CSSクラスでスタイリング
//         span.innerText = categoryName;
//         categoryContainer.appendChild(span);
//     });

//     // hidden input に選択されたカテゴリーのIDをセット
//     const categoryInput = document.getElementById('category-input');
//     categoryInput.value = selectedCategories.join(','); // カンマ区切りでセット

//      // デバッグ用
//      console.log("Selected Categories (IDs):", categoryInput.value);
// }

document.addEventListener("DOMContentLoaded", function() {

function updateSelectedCategories() { 
    const checkboxes = document.getElementById('categoryForm2').getElementsByClassName('form-check-input2');
    console.log("checkboxes:", checkboxes);
    const selectedCategories = [];
    const selectedCategoryNames = [];
    // Select checked checkboxes inside #categoryForm
    document.querySelectorAll('#categoryForm2 .form-check-input2:checked').forEach(checkbox => {
        selectedCategories.push(checkbox.value); // Push ID
        selectedCategoryNames.push(checkbox.getAttribute('data-name')); // Push Name
    });
    // Display selected category names in #selectedCategories div
    const categoryContainer = document.getElementById('selectedCategories');
    categoryContainer.innerHTML = ''; // Clear previous selection
    selectedCategoryNames.forEach(categoryName => {
        const span = document.createElement('span');
        span.classList.add('category-badge'); // Add CSS class for styling
        span.innerText = categoryName;
        categoryContainer.appendChild(span);
    });
    // Update hidden input with selected IDs
    const categoryInput = document.getElementById('category-input');
    categoryInput.value = selectedCategories.join(','); // Join IDs with commas
    // Debugging logs
    console.log("Selected Categories (IDs):", categoryInput.value);
    console.log("Selected Category Names:", selectedCategoryNames);
}


    document.querySelector("#selectedcategory-btn").addEventListener("click", function() {
    updateSelectedCategories();
     });
})








