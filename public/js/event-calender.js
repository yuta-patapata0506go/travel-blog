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

    // 前月ボタン
    document.getElementById('prev-month').addEventListener('click', () => {
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

// サーバーからイベントを取得して表示する関数
function fetchEvents(selectedDate, isInitialLoad) {
    fetch(`/api/events/search?date=${selectedDate}`)
        .then(response => response.json())
        .then(data => {
            if (isInitialLoad) {
                // 初回ロード時に「今日」「明日」「今月」のイベントを保存
                savedTodayEvents = data.today;
                savedTomorrowEvents = data.tomorrow;
                savedMonthEvents = data.month;
            }
            displayEvents(data, isInitialLoad);
        })
        .catch(error => console.error('Error fetching events:', error));
}

// イベントデータを表示する関数
function displayEvents(data, isInitialLoad) {
    const todayEventsContainer = document.getElementById('today-events');
    const tomorrowEventsContainer = document.getElementById('tomorrow-events');
    const monthEventsContainer = document.getElementById('month-events');
    const selectedDateEventsContainer = document.getElementById('event-list');

    // 初回ロード時または日付をクリックした場合、「今日」「明日」「今月」のイベントを表示
    if (isInitialLoad) {
        todayEventsContainer.innerHTML = savedTodayEvents ? savedTodayEvents.map(event => generateEventHtml(event)).join('') : '<p>No events for today.</p>';
        tomorrowEventsContainer.innerHTML = savedTomorrowEvents ? savedTomorrowEvents.map(event => generateEventHtml(event)).join('') : '<p>No events for tomorrow.</p>';
        monthEventsContainer.innerHTML = savedMonthEvents ? savedMonthEvents.map(event => generateEventHtml(event)).join('') : '<p>No events for this month.</p>';
    }

    // 日付をクリックしたときのみ、選択された日付のイベントリストを更新
    selectedDateEventsContainer.innerHTML = data.selected ? data.selected.map(event => generateEventHtml(event)).join('') : '<p>No events on this date.</p>';
}

// イベントHTMLを生成する関数
function generateEventHtml(event) {
    return `
        <div class="event-card">
            <h3>${event.title}</h3>
            <p>${event.event_name}</p>
            <p>Category: ${event.comments}</p>
            <p>${event.helpful_info}</p>
            <p>${event.start_date} - ${event.end_date}</p>
        </div>
    `;
}
