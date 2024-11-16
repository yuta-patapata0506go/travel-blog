// try {

document.addEventListener("DOMContentLoaded", function () {
    const weeks = ['日', '月', '火', '水', '木', '金', '土'];
    const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    let date = new Date();
    let year = date.getFullYear();
    let month = date.getMonth();
    let today = date.getDate();

    // 「今日」「明日」「今月」のイベントデータを保存する変数
    let savedTodayEvents = null;
    let savedTomorrowEvents = null;
    let savedMonthEvents = null;

    const renderCalendar = () => {
        const startDate = new Date(year, month, 1);
        const endDate = new Date(year, month + 1, 0);
        const endDayCount = endDate.getDate();
        const startDay = startDate.getDay();

        let dayCount = 1;
        let calendarHtml = '';

        // 月名と年を表示
        document.getElementById('month-year').textContent = `${monthNames[month]} ${year}`;

        document.getElementById('calendar-body').innerHTML = '';

        calendarHtml += '<tr>';
        for (let w = 0; w < 6; w++) {
            for (let d = 0; d < 7; d++) {
                if (w === 0 && d < startDay) {
                    calendarHtml += '<td></td>';
                } else if (dayCount > endDayCount) {
                    calendarHtml += '<td></td>';
                } else {
                    const cellClass = (dayCount === today && month === (new Date().getMonth()) && year === new Date().getFullYear()) ? 'today' : '';
                    calendarHtml += `<td class="${cellClass}" data-year="${year}" data-month="${month + 1}" data-day="${dayCount}">${dayCount}</td>`;
                    dayCount++;
                }
            }
            calendarHtml += '</tr>';
        }

        document.querySelector('#calendar-body').innerHTML = calendarHtml;

        // 各日付セルにクリックイベントを追加
        document.querySelectorAll('#calendar-body td').forEach(cell => {
            cell.addEventListener('click', function () {
                const selectedYear = this.getAttribute('data-year');
                const selectedMonth = this.getAttribute('data-month');
                const selectedDay = this.getAttribute('data-day');
                const selectedDate = `${selectedYear}-${String(selectedMonth).padStart(2, '0')}-${String(selectedDay).padStart(2, '0')}`;

                // クリックした日付を表示
                document.getElementById('selected-date').textContent = selectedDate;

                // 「Events on」セクションを表示
                document.getElementById('selected-date-section').style.display = 'block';

                // 青い丸の位置を更新
                document.querySelectorAll('#calendar-body td').forEach(td => td.classList.remove('today'));
                this.classList.add('today');

                // 選択した日付のイベントを取得して表示し、「今日」「明日」「今月」のイベントも再表示
                fetchEvents(selectedDate, false);
            });
        });
    };

    // 初回ロード時に今日、明日、今月のイベントを取得し保存
    const todayDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(today).padStart(2, '0')}`;
    fetchEvents(todayDate, true); // 初期ロードで「今日」「明日」「今月」のイベントを取得

    renderCalendar();

    document.getElementById('prev-month').addEventListener('click', () => {
        console.log("Prev month button clicked"); // クリックイベントの確認
        month--;
        if (month < 0) {
            month = 11;
            year--;
        }
        renderCalendar();
    });
    

    // 翌月ボタン
    document.getElementById('next-month').addEventListener('click', () => {
        month++;
        if (month > 11) {
            month = 0;
            year++;
        }
        renderCalendar();
    });
});

function displayEvents(data, isInitialLoad) {
    const todayEventsContainer = document.getElementById('today-events');
    const tomorrowEventsContainer = document.getElementById('tomorrow-events');
    const monthEventsContainer = document.getElementById('month-events');
    const selectedDateEventsContainer = document.getElementById('event-list');

    // 初回ロード時または日付をクリックした場合、「今日」「明日」「今月」のイベントを表示
    if (isInitialLoad) {
        todayEventsContainer.innerHTML = savedTodayEvents ? savedTodayEvents.slice(0, 4).map(event => generateEventHtml(event)).join('') : '<p>No events for today.</p>';
        tomorrowEventsContainer.innerHTML = savedTomorrowEvents ? savedTomorrowEvents.slice(0, 4).map(event => generateEventHtml(event)).join('') : '<p>No events for tomorrow.</p>';
        monthEventsContainer.innerHTML = savedMonthEvents ? savedMonthEvents.slice(0, 4).map(event => generateEventHtml(event)).join('') : '<p>No events for this month.</p>';
    }

    // 日付をクリックしたときのみ、選択された日付のイベントリストを更新 (最大4つ)
    selectedDateEventsContainer.innerHTML = data.selected ? data.selected.slice(0, 4).map(event => generateEventHtml(event)).join('') : '<p>No events on this date.</p>';
    
    // ボタンのリスナーを設定
    setLikeFavoriteListeners();
}



function generateEventHtml(event) {
    console.log(event); 
    // 画像が存在する場合のURL設定
    const imageUrl = event.images && event.images.length > 0 ? `/storage/${event.images[0].image_url}` : '/path/to/default-image.jpg';
    console.log("Generated image URL:", imageUrl); // URLを確認するためのデバッグ出力

    return `
        <div class="small_post col-md-3">
            <div class="card">
                <a href="${event.link || '#'}">
                  ${imageUrl ? `<img src="${imageUrl}" class="card-img-top" alt="Event Image">` : ''}
                </a>
                <div class="card-body">
                  <div class="row">
                    <div class="col-auto">
                      <h5 class="fw-bolder">${event.title || 'Title'}</h5>
                    </div>
                    <div class="col-auto">
                      <button type="button" class="btn btn-sm shadow-none p-0 like-btn" data-id="${event.id}">
                        <i class="fa-regular fa-heart" id="like-icon-${event.id}"></i>
                      </button>
                      <span class="count-text ms-1" id="like-count-${event.id}">${event.like_count || 0}</span>
                    </div>
                    <div class="col-auto p-0">
                      <button type="button" class="btn btn-sm shadow-none p-0 favorite-btn" data-id="${event.id}">
                        <i class="fa-regular fa-star" id="favorite-icon-${event.id}"></i>
                      </button>
                      <span class="count-text ms-1" id="favorite-count-${event.id}">${event.favorite_count || 0}</span>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-auto mb-1">
                      ${(event.categories || []).map(category => `<span class="badge bg-secondary bg-opacity-50 rounded-pill ms-1">${category.name}</span>`).join('')}
                    </div>
                  </div>
                  
                  <div class="post_text">
                    <p>${event.comments || 'No comments available.'}</p>
                    <button class="btn comment-card">Learn More</button>
                  </div>
                </div>
            </div>
        </div>
    `;
}

function fetchEvents(selectedDate, isInitialLoad) {
    fetch(`/api/events/search?date=${selectedDate}`)
        .then(response => {
            if (!response.ok) {
                console.error(`HTTP error! Status: ${response.status}`);
                return response.text().then(text => { throw new Error(text) });
            }
            return response.json().catch(error => {
                console.error("JSON parse error:", error);
                throw new Error("Failed to parse JSON response.");
            });
        })
        .then(data => {
            console.log("Fetched data:", data);
            if (isInitialLoad) {
                savedTodayEvents = data.today;
                savedTomorrowEvents = data.tomorrow;
                savedMonthEvents = data.month;
            }
            displayEvents(data, isInitialLoad);
        })
       
}

function fetchEvents(selectedDate, isInitialLoad) {
    console.log("Fetching events for date:", selectedDate);
    fetch(`/api/events/search?date=${selectedDate}`)
        .then(response => {
            console.log("Fetch response status:", response.status);
            if (!response.ok) {
                console.error(`HTTP error! Status: ${response.status}`);
                return response.text().then(text => {
                    console.error("Response text (non-JSON):", text);
                    throw new Error(`Fetch events error: ${text}`);
                });
            }
            return response.json().catch(error => {
                console.error("JSON parse error in fetchEvents:", error);
                throw new Error("Failed to parse JSON response in fetchEvents.");
            });
        })
        .then(data => {
            console.log("Fetched data:", data);
            if (isInitialLoad) {
                savedTodayEvents = data.today;
                savedTomorrowEvents = data.tomorrow;
                savedMonthEvents = data.month;
            }
            displayEvents(data, isInitialLoad);
        })
        // .catch(error => {
        //     console.error("Error fetching events:", error);
        //     alert('イベントの取得に失敗しました。エンドポイントやサーバーの設定を確認してください。');
        // });
}

function setLikeFavoriteListeners() {
    document.querySelectorAll(".like-btn").forEach(button => {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            const postId = this.getAttribute("data-id");
            console.log("Liking post with ID:", postId);
            fetch(`/post/${postId}/like`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                    "Content-Type": "application/json"
                }
            })
            .then(async response => {
                console.log("Like response status:", response.status);
                if (!response.ok) {
                    const text = await response.text();
                    console.error("Error response text (non-JSON):", text);
                    throw new Error(`Error ${response.status}: ${text}`);
                }
                try {
                    return await response.json();
                } catch (error) {
                    console.error("JSON parse error on like response:", error);
                    throw new Error("Failed to parse JSON response for like action.");
                }
            })
            .then(data => {
                console.log("Like action data:", data);
                document.getElementById(`like-icon-${postId}`).style.color = data.isLiked ? "red" : "gray";
                console.log(document.getElementById(`like-icon-${postId}`).classList);
                
                document.getElementById(`like-count-${postId}`).textContent = data.likeCount;
            })
           
        });
    });

    document.querySelectorAll(".favorite-btn").forEach(button => {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            const postId = this.getAttribute("data-id");
            console.log("Favoriting post with ID:", postId);
            fetch(`/post/${postId}/favorite`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                    "Content-Type": "application/json"
                }
            })
            .then(response => {
                console.log("Favorite response status:", response.status);
                if (!response.ok) {
                    return response.text().then(text => {
                        console.error("Error response text (non-JSON):", text);
                        throw new Error(`Error ${response.status}: ${text}`);
                    });
                }
                return response.json().catch(error => {
                    console.error("JSON parse error on favorite response:", error);
                    throw new Error("Failed to parse JSON response for favorite action.");
                });
            })
            .then(data => {
                console.log("Favorite action data:", data);
                document.getElementById(`favorite-icon-${postId}`).classList.toggle("active", data.isFavorited);
                document.getElementById(`favorite-count-${postId}`).textContent = data.favoriteCount;
            })
            
        });
    });
}


// } catch (error) {
//     console.error("An error occurred:", error.message);
// };