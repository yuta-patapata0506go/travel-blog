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
        const formElement = document.getElementById('cat-form-div');

        const checkboxes = formElement.getElementsByClassName('form-check-input2');
       
        const selectedCategories = [];
        const selectedCategoryNames = [];

        document.querySelectorAll('#cat-form-div .form-check-input2:checked').forEach(checkbox => {
            selectedCategories.push(checkbox.value); 
            selectedCategoryNames.push(checkbox.getAttribute('data-name')); 
        });

        const categoryContainer = document.getElementById('selectedCategories');
        if (categoryContainer) {
            categoryContainer.innerHTML = ''; 
            selectedCategoryNames.forEach(categoryName => {
                const span = document.createElement('span');
                span.classList.add('category-badge');
                span.innerText = categoryName;
                categoryContainer.appendChild(span);
            });
        } else {
            console.error("selectedCategories container not found.");
        }

        const categoryInput = document.getElementById('category-input');
        if (categoryInput) {
            categoryInput.value = selectedCategories.join(',');
        } else {
            console.error("category-input hidden input not found.");
        }

      
    }

    const selectButton = document.querySelector("#selectedcategory-btn");
    if (selectButton) {
        selectButton.addEventListener("click", function() {
            updateSelectedCategories();
        });
    } else {
        console.error("selectedcategory-btn button not found.");
    }
});







