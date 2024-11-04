document.addEventListener("DOMContentLoaded", function() {
    function updateSelectedCategories() { 
        const formElement = document.getElementById('cat-form-div');

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
