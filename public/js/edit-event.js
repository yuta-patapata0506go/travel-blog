
function updateSelectedCategories() {
    const selectedCategories = [];
    document.querySelectorAll('#categoryForm .form-check-input:checked').forEach(checkbox => {
        selectedCategories.push(checkbox.value);
    });

    const categoryContainer = document.getElementById('selectedCategories');
    categoryContainer.innerHTML = ''; // 既存のカテゴリー表示をクリア
    selectedCategories.forEach(category => {
        const span = document.createElement('span');
        span.classList.add('category-badge');
        span.innerText = category;
        categoryContainer.appendChild(span);
    });
}
