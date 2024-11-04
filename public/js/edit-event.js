document.addEventListener("DOMContentLoaded", function() {
    function updateSelectedCategories() { 
        const selectedCategories = [];
        const selectedCategoryNames = [];

        // モーダル内でチェックされたカテゴリを取得
        document.querySelectorAll('#categoryModal .form-check-input:checked').forEach(checkbox => {
            selectedCategories.push(checkbox.value); 
            selectedCategoryNames.push(checkbox.getAttribute('data-name')); 
        });

        // 選択されたカテゴリを表示
        const categoryContainer = document.getElementById('selectedCategories');
        categoryContainer.innerHTML = ''; 
        selectedCategoryNames.forEach(categoryName => {
            const span = document.createElement('span');
            span.classList.add('category-badge');
            span.innerText = categoryName;
            categoryContainer.appendChild(span);
        });

        // 隠しフィールドにカテゴリIDを設定
        document.getElementById('category-input').value = selectedCategories.join(',');
    }

    // モーダルの選択ボタンにイベントを設定
    document.getElementById("selectedcategory-btn").addEventListener("click", updateSelectedCategories);
});


const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

let imageIdToDelete = null;

function confirmDelete(imageId) {
    imageIdToDelete = imageId;
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
    deleteModal.show();
}

// 画像削除処理
document.getElementById('confirmDeleteButton').addEventListener('click', function () {
    if (imageIdToDelete) {
        fetch(`/images/${imageIdToDelete}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (response.ok) {
                // 成功した場合、ページから画像要素を削除
                const imageElement = document.querySelector(`[onclick="confirmDelete(${imageIdToDelete})"]`).parentElement;
                imageElement.remove();
            } else {
                return response.json().then(error => {
                    throw new Error(error.message || "Failed to delete the image.");
                }).catch(() => {
                    throw new Error("An error occurred, and the response is not in JSON format.");
                });
            }
        })
        .catch(error => {
            alert(error.message);
        })
        .finally(() => {
            imageIdToDelete = null;
            const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteConfirmModal'));
            deleteModal.hide();
        });
    }
});

document.getElementById('selectedcategory-btn').addEventListener('click', function () {
    const selectedCategories = [];
    document.querySelectorAll('#cat-form-div .form-check-input:checked').forEach((checkbox) => {
        selectedCategories.push({
            id: checkbox.value,
            name: checkbox.getAttribute('data-name')
        });
    });

    const categoryContainer = document.getElementById('selectedCategories');
    categoryContainer.innerHTML = '';
    selectedCategories.forEach((category) => {
        const span = document.createElement('span');
        span.classList.add('category-badge');
        span.innerText = category.name;
        categoryContainer.appendChild(span);
    });

    // 隠しフィールドを更新
    const categoryInputsContainer = document.getElementById('category-inputs');
    if (!categoryInputsContainer) {
        console.error("Element with ID 'category-inputs' not found.");
        return; // エラーが発生したら処理を中断
    }
    categoryInputsContainer.innerHTML = ''; // Clear old inputs
    selectedCategories.forEach((category) => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'category[]';
        input.value = category.id;
        categoryInputsContainer.appendChild(input);
    });

    console.log("Updated hidden category inputs:", selectedCategories);
});


