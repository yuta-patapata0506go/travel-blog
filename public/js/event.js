import 'bootstrap';

document.addEventListener("DOMContentLoaded", function() {
  const weeks = ['日', '月', '火', '水', '木', '金', '土'];
  const date = new Date();
  let year = date.getFullYear();
  let month = date.getMonth() + 1;
  let today = date.getDate();

  const renderCalendar = () => {
    console.log("カレンダーが描画されました"); // この行を追加
      const startDate = new Date(year, month - 1, 1);
      const endDate = new Date(year, month, 0);
      const endDayCount = endDate.getDate();
      const startDay = startDate.getDay();

      let dayCount = 1;
      let calendarHtml = '';

      document.getElementById('month-year').textContent = `${year}年 ${month}月`;

      calendarHtml += '<tr>';

      for (let w = 0; w < 6; w++) {
          for (let d = 0; d < 7; d++) {
              if (w === 0 && d < startDay) {
                  calendarHtml += '<td></td>';
              } else if (dayCount > endDayCount) {
                  calendarHtml += '<td></td>';
              } else {
                  const cellClass = (dayCount === today && month === (new Date().getMonth() + 1) && year === new Date().getFullYear()) ? 'today' : '';
                  calendarHtml += `<td class="${cellClass}" data-year="${year}" data-month="${month}" data-day="${dayCount}">${dayCount}</td>`;
                  dayCount++;
              }
          }
          calendarHtml += '</tr><tr>';
      }

      calendarHtml += '</tr>';
      document.querySelector('#calendar-body').innerHTML = calendarHtml;

      // 各日付セルにクリックイベントを追加
      document.querySelectorAll('#calendar-body td').forEach(cell => {
          cell.addEventListener('click', function() {
              const year = this.getAttribute('data-year');
              const month = this.getAttribute('data-month');
              const day = this.getAttribute('data-day');
              searchEvents(year, month, day);
          });
      });
  }

  document.getElementById('prev-month').addEventListener('click', () => {
      month--;
      if (month < 1) {
          month = 12;
          year--;
      }
      renderCalendar();
  });

  document.getElementById('next-month').addEventListener('click', () => {
      month++;
      if (month > 12) {
          month = 1;
          year++;
      }
      renderCalendar();
  });

  renderCalendar();
});

// searchEvents 関数
function searchEvents(year, month, day) {
    const selectedDate = `${year}-${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
    fetchEvents(selectedDate);
}

function fetchEvents(selectedDate) {
    fetch(`/events/search?date=${selectedDate}`)
        .then(response => response.json())
        .then(data => displayEvents(data))
        .catch(error => console.error('Error fetching events:', error));
}

function displayEvents(data) {
    const todayContainer = document.getElementById('today-events');
    const tomorrowContainer = document.getElementById('tomorrow-events');
    const monthContainer = document.getElementById('month-events');

    todayContainer.innerHTML = '';
    tomorrowContainer.innerHTML = '';
    monthContainer.innerHTML = '';

    data.today.forEach(event => {
        todayContainer.innerHTML += generateEventHtml(event);
    });
    data.tomorrow.forEach(event => {
        tomorrowContainer.innerHTML += generateEventHtml(event);
    });
    data.month.forEach(event => {
        monthContainer.innerHTML += generateEventHtml(event);
    });
}

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
